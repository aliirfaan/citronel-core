<?php

namespace aliirfaan\CitronelCore\Models;

use Illuminate\Database\Eloquent\Model;
use aliirfaan\CitronelCore\Traits\CitronelDateTimeTrait;

class CitronelBaseModel extends Model
{
    use CitronelDateTimeTrait;

    /**
     * Define additional attributes to apply timezone conversion to.
     */
    protected $timezoneAwareAttributes = [];

    /**
     * Define base attributes typically used for timestamps.
     */
    protected function getBaseTimezoneAwareAttributes(): array
    {
        $attributes = ['created_at', 'updated_at'];

        // Only include 'deleted_at' if the column exists in the model
        if (in_array('deleted_at', $this->getDates()) || array_key_exists('deleted_at', $this->attributes)) {
            $attributes[] = 'deleted_at';
        }

        return $attributes;
    }

    /**
     * Merge default + model-defined timezone-aware attributes.
     */
    protected function getMergedTimezoneAwareAttributes(): array
    {
        return array_unique(array_merge(
            $this->getBaseTimezoneAwareAttributes(),
            $this->timezoneAwareAttributes ?? []
        ));
    }

    /**
     * Include *_display keys in JSON output without requiring accessors.
     */
    public function toArray()
    {
        $array = parent::toArray();
    
        foreach ($this->getMergedTimezoneAwareAttributes() as $attribute) {
            if (in_array($attribute, $this->hidden)) {
                continue;
            }

            $value = $this->getRawOriginal($attribute) ?? $this->getAttribute($attribute);
    
            $array[$attribute . '_display'] = $value !== null
                ? $this->convertToDisplayTimezone($value)
                : null;
        }
    
        return $array;
    }
    

    /**
     * Allow manual access to *_display fields dynamically.
     */
    public function __get($key)
    {
        if (str_ends_with($key, '_display')) {
            $baseAttribute = substr($key, 0, -8);

            if (in_array($baseAttribute, $this->getMergedTimezoneAwareAttributes())) {
                return $this->convertToDisplayTimezone(
                    $this->getRawOriginal($baseAttribute)
                );
            }
        }

        return parent::__get($key);
    }
}
