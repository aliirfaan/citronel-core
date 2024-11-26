<?php

return [
    'date_display_format' => env('CITRONEL_DATE_DISPLAY_FORMAT', 'd/m/Y'),
    'date_time_display_format' => env('CITRONEL_DATE_TIME_DISPLAY_FORMAT', 'd/m/Y H:i:s'),
    'db_date_format' => env('CITRONEL_DB_DATE_FORMAT', 'Y-m-d'),
    'db_date_time_db_format' => env('CITRONEL_DB_DATE_TIME_FORMAT', 'Y-m-d H:i:s'),
    'display_timezone' => env('CITRONEL_DISPLAY_TIMEZONE', 'Indian/Mauritius'),

    'per_page' => env('CITRONEL_PER_PAGE', 10),
    'max_per_page' => env('CITRONEL_MAX_PER_PAGE', 50),
    'processing_chunk_size' => env('CITRONEL_PROCESSING_CHUNK_SIZE', 100),

    'force_root_url' => env('CITRONEL_FORCE_ROOT_URL', false),
    'force_https' => env('CITRONEL_FORCE_HTTPS', false),

    'correlation_token_header_key' => env('CITRONEL_CORRELATION_TOKEN_HEADER_KEY', 'X-Correlation-Id'),
    // a short prefix or suffix to be added when generatig correlation token
    'correlation_token_generation_key' => env('CITRONEL_CORRELATION_GENERATION_KEY', null),

    'decimals' => env('CITRONEL_DECIMALS', 2),
    'currency' => [
        'supported' => [
            'MUR' => [
                'code' => 'MUR',
                'symbol' => 'Rs'
            ],
        ],
        'base' => env('CITRONEL_BASE_CURRENCY', 'MUR'), // base currency for prices
        'default' => env('CITRONEL_DEFAULT_CURRENCY', 'MUR'),
    ],
    
    'reverse_proxy_url' => env('CITRONEL_REVERSE_PROXY_URL', null),
];
