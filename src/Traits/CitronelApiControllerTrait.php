<?php

namespace aliirfaan\CitronelCore\Traits;

trait CitronelApiControllerTrait
{
    /**
     * Method sendApiResponse
     *
     * @param mixed $result
     * @param int $statusCode HTTP status code
     * @param array $headers additional headers
     *
     * @return mixed
     */
    public function sendApiResponse($result, $statusCode, $headers = [])
    {
        return $result
            ->response()
            ->setStatusCode($statusCode)
            ->withHeaders($headers);
    }
}
