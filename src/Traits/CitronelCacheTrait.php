<?php

namespace aliirfaan\CitronelCore\Traits;

use Illuminate\Support\Facades\Cache;

trait CitronelCacheTrait
{
    /**
     * Method cacheResponse
     *
     * First check if cache is enabled for this service
     * Configuration is read from config file citronel-cache.php
     *
     * Cache settings are derived from the $cacheConfigKey:
     * Example:
     * 'cache_countries' => [
     *    'should_cache' => env('API_CACHE_COUNTRIES', true),
     *    'cache_key' => 'countries',
     *    'cache_seconds' => env('API_CACHE_COUNTRIES_SEC', 3600),
     *    'cache_store' => env('CITRONEL_CACHE_STORE', env('CACHE_STORE')),
     * ]
     *
     * @param string $cacheConfigKey [explicite description]
     * @param mixed $cacheData [explicite description]
     * @param string $customCacheKey use if you want to use a cache key other than the default cache_key config
     * @param int $customCacheSeconds override config seconds defined in cache_seconds
     *
     * @return void
     */
    public function cacheResponse($cacheConfigKey, $cacheData, $customCacheKey = null, $customCacheSeconds = null)
    {
        $shouldCache = config('citronel-cache.should_cache') ? config('citronel-cache.should_cache') : false;

        if (!$shouldCache || !config('citronel-cache.' . $cacheConfigKey . '.should_cache')) {
            return false;
        }

        $cacheStore = config('citronel-cache.' . $cacheConfigKey . '.cache_store');

        $cacheSeconds = $customCacheSeconds ?? intval(config('citronel-cache.' . $cacheConfigKey . '.cache_seconds'));
        
        $cacheKey = $customCacheKey ?? config('citronel-cache.' . $cacheConfigKey . '.cache_key');

        Cache::store($cacheStore)->put($cacheKey, $cacheData, $cacheSeconds);
    }

    /**
     * Method getCachedResponse
     *
     * @param string $cacheConfigKey [explicite description]
     * @param string $customCacheKey use if you want to use a cache key other than the default cache_key config
     *
     * @return void|mixed
     */
    public function getCachedResponse($cacheConfigKey, $customCacheKey = null )
    {
        $shouldCache = config('citronel-cache.should_cache') ? config('citronel-cache.should_cache') : false;

        if ($shouldCache && config('citronel-cache.' . $cacheConfigKey . '.should_cache')) {
            $cacheKey = $customCacheKey ?? config('citronel-cache.' . $cacheConfigKey . '.cache_key');

            $cacheStore = config('citronel-cache.' . $cacheConfigKey . '.cache_store');

            if (Cache::store($cacheStore)->has($cacheKey)) {
                return Cache::store($cacheStore)->get($cacheKey);
            }
        }

        return null;
    }
}
