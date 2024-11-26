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
