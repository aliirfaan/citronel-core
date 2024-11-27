<?php

namespace aliirfaan\CitronelCore\Traits;

use Illuminate\Database\QueryException;
use Illuminate\Auth\Access\AuthorizationException;
use aliirfaan\LaravelSimpleAuditLog\Events\AuditLogged;
use Illuminate\Support\Facades\DB;

trait CitronelExceptionHandlerTrait
{
    public $namespace;
    
    public $errorCatalogueService;

    public $apiHelperService;

    public $mainProcess;

    public $subProcess;

    public $auditData;
    
    /**
     * Method handleException
     *
     * @param mixed $e exception
     * @param bool $auditLogEnabled whether to dispatch audit log event
     *
     * @return mixed
     */
    public function handleException($e, $auditLogEnabled = true)
    {
        $code = null;
        $response = null;

        report($e);
        
        if ($e instanceof QueryException) {
            DB::rollBack();

            $code = $this->errorCatalogueService->generateCodeFromCatalogue($this->mainProcess['key'], $this->subProcess['key'], null, $this->databaseErrorCatalogue()['code']);

            $response = $this->apiHelperService->apiDatabaseErrorResponse($this->namespace, [], null, $this->databaseErrorCatalogue()['lang'], ['code' => $code['code']]);
        } elseif ($e instanceof AuthorizationException) {

            $code = $this->errorCatalogueService->generateCodeFromCatalogue($this->mainProcess['key'], $this->subProcess['key'], null, $this->authorizationErrorCatalogue()['code']);

            $response = $this->apiHelperService->apiAuthorizationErrorResponse($this->namespace, [], null, $this->authorizationErrorCatalogue()['lang'], ['code' => $code['code']]);
        } else {
            DB::rollBack();

            $code = $this->errorCatalogueService->generateCodeFromCatalogue($this->mainProcess['key'], $this->subProcess['key'], null, $this->unknownErrorCatalogue()['code']);

            $response = $this->apiHelperService->apiUnknownErrorResponse($this->namespace, [], null, $this->unknownErrorCatalogue()['lang'], ['code' => $code['code']]);
        }

        $this->auditData['al_is_success'] = false;
        $this->auditData['al_code'] = (is_array($code) && array_key_exists('code', $code)) ? $code['code'] : null;

        if ($auditLogEnabled) {
            AuditLogged::dispatch($this->auditData);
        }

        return  $response;
    }
}
