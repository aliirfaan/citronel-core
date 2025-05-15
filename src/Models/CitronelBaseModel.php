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
     * Automatically append *_display attributes to JSON.
     */
    protected $appends = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Dynamically append *_display attributes for timezone-aware fields
        foreach ($this->getMergedTimezoneAwareAttributes() as $attribute) {
            $this->appends[] = $attribute . '_display';
        }
    }

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
     * Dynamically return timezone-converted display values.
     */
    public function __get($key)
    {
        // Handle *_display accessors dynamically
        if (str_ends_with($key, '_display')) {
            $baseAttribute = substr($key, 0, -8);

            if (in_array($baseAttribute, $this->getMergedTimezoneAwareAttributes())) {
                return $this->convertToDisplayTimezone($this->attributes[$baseAttribute] ?? null);
            }
        }

        return parent::__get($key);
    }
}
