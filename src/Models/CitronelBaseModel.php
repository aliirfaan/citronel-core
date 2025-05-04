<?php

namespace aliirfaan\CitronelCore\Models;

use Illuminate\Database\Eloquent\Model;
use aliirfaan\CitronelCore\Traits\CitronelDateTimeTrait;

class CitronelBaseModel extends Model
{
    use CitronelDateTimeTrait;

    /**
     * Override this property in child classes to add custom attributes
     * that should be timezone-aware.
     */
    protected $timezoneAwareAttributes = [];

    /**
     * List of base attributes that should always be timezone-aware.
     */
    protected function getBaseTimezoneAwareAttributes(): array
    {
        return [
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

    /**
     * Get the full list of timezone-aware attributes by merging base and child-defined ones.
     */
    protected function getMergedTimezoneAwareAttributes(): array
    {
        return array_unique(array_merge(
            $this->getBaseTimezoneAwareAttributes(),
            $this->timezoneAwareAttributes ?? []
        ));
    }

    /**
     * Override attribute access to apply timezone conversion when needed.
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->getMergedTimezoneAwareAttributes())) {
            return $this->convertToDisplayTimezone($value);
        }

        return $value;
    }
}
