<?php

namespace aliirfaan\CitronelCore\Http\Middleware\Customer;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use aliirfaan\CitronelCore\Services\CitronelHelperService;
use aliirfaan\LaravelSimpleApi\Services\ApiHelperService;
use aliirfaan\LaravelSimpleAuditLog\Services\AuditLogService;
use aliirfaan\CitronelErrorCatalogue\Traits\ErrorCatalogue;
use aliirfaan\LaravelSimpleAuditLog\Events\AuditLogged;
use aliirfaan\CitronelCore\Auth\MustBeVerified;

class EnsureActorIsVerified
{
    use ErrorCatalogue;

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    protected $apiHelperService;

    protected $helperService;

    protected $auditService;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth, ApiHelperService $apiHelperService, CitronelHelperService $helperService, AuditLogService $auditService)
    {
        $this->auth = $auth;
        $this->apiHelperService = $apiHelperService;
        $this->helperService = $helperService;
        $this->auditService = $auditService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $correlationToken = $this->helperService->getCorrelationToken($request);
        $reponseHeaders = $this->helperService->correlationResponseHeader($correlationToken);
        
        try {
            $namespace = 'customer';
            $mainProcessKey = config('error-catalogue.process.customer.key');
            $subProcessKey = config('error-catalogue.process.customer.sub_process.is_verified_check.key');

            $auditData = $this->auditService->generatePreliminaryEventData($request, $correlationToken);
            $auditData['al_event_name'] = config('error-catalogue.process.customer.sub_process.is_verified_check.name');

            $actor = $request->get('actor', null);

            if ($actor instanceof MustBeVerified && ! $actor->isActive()) {
                $code = $this->helperService->generateProcessCode($mainProcessKey, $subProcessKey, null, $this->authenticationErrorCatalogue()['code']);

                $auditData['al_is_success'] = false;
                $auditData['al_code'] = $code['code'];
                $auditData['al_request'] = json_encode($actor->getActorIdentifier());
                AuditLogged::dispatch($auditData);

                $resultResponse = $this->apiHelperService->apiAuthenticationErrorResponse($namespace, [], null, 'customer/messages.customer_not_active', ['code' => $code['code']]);

                return $resultResponse->response()->setStatusCode($resultResponse->collection['status_code'])->withHeaders($reponseHeaders);
            }

        } catch (\Exception $e) {
            report($e);

            $code = $this->helperService->generateProcessCode($mainProcessKey, $subProcessKey, null, $this->unknownErrorCatalogue()['code']);

            $auditData['al_is_success'] = false;
            $auditData['al_request'] = $request->bearerToken();
            $auditData['al_code'] = $code['code'];
            AuditLogged::dispatch($auditData);

            $resultResponse = $this->apiHelperService->apiUnknownErrorResponse($namespace, [], null, $this->unknownErrorCatalogue()['lang'], ['code' => $code['code']]);

            return $resultResponse->response()->setStatusCode($resultResponse->collection['status_code'])->withHeaders($reponseHeaders);
        }

        return $next($request);
    }
}
