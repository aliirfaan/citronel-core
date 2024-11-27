# Citronel core

Boilerplate to start laravel API project.

## Features
* Base configuration.
* Base controller.
* Helper service.
* Traits.

## Requirements

* [Composer](https://getcomposer.org/)
* [Laravel](http://laravel.com/)
* aliirfaan/laravel-simple-api

## Installation

* Install the package using composer:

```bash
 $ composer require aliirfaan/citronel-core
```
* Publish files with:

```bash
 $ php artisan vendor:publish --provider="aliirfaan\CitronelCore\CitronelCoreProvider"
```

or by using only `php artisan vendor:publish` and select the `aliirfaan\CitronelCore\CitronelCoreProvider` from the outputted list.


## Configurations
* citronel
Base configuration

* citronel-cahce
Base cache configuration

## Traits
* CitronelApiControllerTrait  
Use this trait to send API responses with headers.

* CitronelCacheTrait  
Use this trait to cache responses.

* CitronelCorrelationTokenTrait  
Use this trait to work with correlation token.

* CitronelDateTimeTrait  
Use this trait to work with date time.

* CitronelMoneyTrait  
Use this trait to work money/amounts.

* resultFormatTrait  
Use this trait to get return format for function calls.

## Controllers
* CitronelController  
Base controller.

## Middleware
* CitronelCorrelationToken  
Get correlation token in header based on a configurable header key.

## Services
* CitronelHelperService  
Base helper service.

## Usage

* You can use traits in your custom helper service and then use your custom helper service in your controllers
```php
<?php

namespace App\Services\Api\v1\Helper;

use aliirfaan\CitronelCore\Services\CitronelHelperService;
use aliirfaan\CitronelCore\Traits\CitronelCorrelationTokenTrait;

// create your helper service that extends CitronelHelperService
class HelperService extends CitronelHelperService
{
    // use traits
    use CitronelCorrelationTokenTrait;
}

```

* Example cache config
```php
<?php
return [
    'should_cache' => env('CITRONEL_SHOULD_CACHE', false),
    'cache_example_process' => [
        'should_cache' => env('CITRONEL_CACHE_EXAMPLE_PROCESS', true),
        'cache_key' => 'citronel_example_process',
        'cache_seconds' => env('CITRONEL_CACHE_EXAMPLE_PROCESS_SEC', 3600),
        'cache_store' => env('CITRONEL_CACHE_STORE', env('CACHE_STORE')),
    ],
];

```

* Example controller
```php
<?php
namespace App\Http\Controllers\Api\v1;

use aliirfaan\CitronelCore\Http\Controllers\CitronelController;
use aliirfaan\LaravelSimpleApi\Http\Resources\ApiResponseCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Api\v1\Helper\HelperService;

// create your own controller and extend CitronelController
class CustomCitronelController extends CitronelController
{
    public function __construct()
    {
        parent::__construct();

        $this->helperService = new HelperService();
    }

    public function index(Request $request)
    {
        $this->data['result'] = null;
        $this->data['status_code'] = Response::HTTP_OK;

        $this->resultResponse = new ApiResponseCollection($this->data);

        // cache response
        $cacheConfigKey = 'cache_example_process';
        $this->helperService->cacheResponse($cacheConfigKey, $resultResponse);

        // return response
        return $this->sendApiResponse($this->resultResponse, $this->resultResponse->collection['status_code']);
    }
}

```