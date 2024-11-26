<?php

namespace aliirfaan\CitronelCore\Http\Controllers;

use App\Http\Controllers\Controller;
use aliirfaan\LaravelSimpleApi\Services\ApiHelperService;
use aliirfaan\LaravelSimpleApi\HypermediaRelation;
use aliirfaan\LaravelSimpleApi\Http\Resources\ApiResponseCollection;
use aliirfaan\CitronelCore\Services\CitronelHelperService;

class CitronelController extends Controller
{
    /**
     * apiHelperService
     *
     * @var class
     */
    public $apiHelperService;
    
    /**
     * hypermediaRelation
     *
     * @var class
     */
    public $hypermediaRelation;
    
    /**
     * data
     *
     * @var array
     */
    public $data;
    
    /**
     * helperService
     *
     * @var class
     */
    public $helperService;
    
    /**
     * namespace
     *
     * @var string a namespace used for better error logging when generaring debug id
     */
    public $namespace;
    
    /**
     * responseResult
     *
     * @var ApiResponseCollection
     */
    public $resultResponse;
    
    /**
     * a key for generating error codes per process
     *
     * @var string
     */
    public $mainProcess;

    /**
     * a key for generating error codes per process
     *
     * @var string
     */
    public $subProcess;

    /**
     * the logged in model
     *
     * @var mixed
     */
    public $actor;

    /**
     * Main command model for controller
     *
     * @var mixed
     */
    public $modelApiCommand;
        
    /**
     * Main query model for controller
     *
     * @var mixed
     */
    public $modelApiQuery;
    
    /**
     * auditData to log
     *
     * @var mixed
     */
    public $auditData;

    /**
     * Method __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->apiHelperService = new ApiHelperService();
        $this->hypermediaRelation = new HypermediaRelation();
        $this->data = $this->apiHelperService->responseArrayFormat;
        $this->helperService = new CitronelHelperService();
        $this->resultResponse = new ApiResponseCollection($this->data);
        $this->mainProcess = null;
        $this->subProcess = null;
        $this->actor = null;
        $this->modelApiCommand = null;
        $this->modelApiQuery = null;
        $this->auditData = null;
    }
}
