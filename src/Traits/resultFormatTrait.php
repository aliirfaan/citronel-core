<?php

namespace aliirfaan\CitronelCore\Traits;

trait resultFormatTrait
{
    /**
     * array format to return in functions
     *
     * @return array
     */
    public function returnFormat()
    {
        return [
            'success' => false,
            'result' => null,
            'errors' => null,
            'message' => null,
            'issues' => [],
            'extra' => [],
        ];
    }
}
