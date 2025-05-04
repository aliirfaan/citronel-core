<?php

namespace aliirfaan\CitronelCore\Models;

use Illuminate\Database\Eloquent\Model;
use aliirfaan\CitronelCore\Traits\CitronelDateTimeTrait;

class CitronelBaseModel extends Model
{
    use CitronelDateTimeTrait;

    protected $timezoneAwareAttributes = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->timezoneAwareAttributes ?? [])) {
            return $this->convertToDisplayTimezone($value);
        }

        return $value;
    }
}
