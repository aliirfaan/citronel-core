<?php

namespace aliirfaan\CitronelCore\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use aliirfaan\LaravelSimpleApi\Services\ApiHelperService;
use aliirfaan\CitronelErrorCatalogue\Traits\ErrorCatalogue;
use aliirfaan\CitronelErrorCatalogue\Services\CitronelErrorCatalogueService;

class CheckBackOfficeApiKey
{
    use ErrorCatalogue;

    protected $apiHelperService;

    protected $mainProcess;

    protected $subProcess;

    /**
     * namespace
     *
     * @var string a namespace used for better error logging when generaring debug id
     */
    protected $namespace = 'back-office';

    /**
     * errorCatalogueService
     *
     * @var mixed
     */
    protected $errorCatalogueService;

    public function __construct(ApiHelperService $apiHelperService, CitronelErrorCatalogueService $errorCatalogueService)
    {
        $this->apiHelperService = $apiHelperService;
        $this->errorCatalogueService = $errorCatalogueService;
        $this->mainProcess = config('citronel-error-catalogue.process.back_office');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKeyHeaderName = config('citronel.back_office_api_key_header_name');

        // Get the API key from the request header
        $apiKey = $request->header($apiKeyHeaderName);

        // Get the configured API key from the environment file
        $configuredApiKey = config('citronel.back_office_api_key');

        // Check if the API key matches the configured key
        if (is_null($apiKey) || ($apiKey !== $configuredApiKey)) {
            $this->subProcess = config('citronel-error-catalogue.process.back_office.sub_process.verify_key');

            $code = $this->errorCatalogueService->generateCodeFromCatalogue($this->mainProcess['key'], $this->subProcess['key'], null, $this->authorizationErrorCatalogue()['code']);

            $resultResponse = $this->apiHelperService->apiAuthorizationErrorResponse($this->namespace, [], null, $this->authorizationErrorCatalogue()['lang'], ['code' => $code['code']]);

            return $resultResponse->response()->setStatusCode($resultResponse->collection['status_code']);
        }

        return $next($request);
    }
}
