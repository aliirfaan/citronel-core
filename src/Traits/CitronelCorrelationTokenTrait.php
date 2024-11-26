<?php

namespace aliirfaan\CitronelCore\Traits;

use Illuminate\Support\Str;

trait CitronelCorrelationTokenTrait
{
    /**
     * Method generateCorrelationToken
     *
     * @param $type $type [explicite description]
     * @param $generationKey $generationKey [explicite description]
     *
     * @return string
     */
    public function generateCorrelationToken($type = 'prefix', $generationKey = null) : string
    {
        $correlationToken = (string) Str::uuid();
        $generationKey = $generationKey ?? config('citronel.correlation_token_generation_key');
        
        switch ($type) {
            case 'prefix':
                $correlationToken = $generationKey . $correlationToken;
                break;
            case 'suffix':
                $correlationToken = $correlationToken . $generationKey;
                break;
            default:
                break;
        }
        
        return $correlationToken;
    }

    /**
     * Get correlation token from header
     *
     * @param mixed $request [explicite description]
     *
     * @return string
     */
    public function getCorrelationTokenFromHeader($request)
    {
        $correlationTokenHeaderKey = config('citronel.correlation_token_header_key');

        return $request->header($correlationTokenHeaderKey, null);
    }

    /**
     * Method correlationResponseHeader
     *
     * @param $correlationToken $correlationToken [explicite description]
     *
     * @return array
     */
    public function setCorrelationResponseHeader($correlationToken)
    {
        $correlationTokenHeaderKey = config('citronel.correlation_token_header_key');

        return [
            $correlationTokenHeaderKey => $correlationToken
        ];
    }
}
