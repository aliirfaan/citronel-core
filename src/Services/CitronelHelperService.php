<?php

namespace aliirfaan\CitronelCore\Services;

use aliirfaan\CitronelCore\Traits\resultFormatTrait;

class CitronelHelperService
{
    use resultFormatTrait;
    
    /**
     * Method makeObject
     *
     * @param string $className [explicite description]
     * @param array $parameters [explicite description]
     * @param string $classPath [explicite description]
     *
     * @return mixed
     */
    public function makeObject($className, $parameters = [], $classPath = 'App\\Services\\Api\\v1\\')
    {
        return app()->makeWith($classPath . $className, $parameters);
    }
}