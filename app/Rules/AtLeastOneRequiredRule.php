<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AtLeastOneRequiredRule implements Rule
{
    protected $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    public function passes($attribute, $value)
    {
        $atLeastOneFieldFilled = false;

        foreach ($this->fields as $field) {
            if (!empty($value[$field])) {
                $atLeastOneFieldFilled = true;
                break;
            }
        }

        return $atLeastOneFieldFilled;
    }

    public function message()
    {
        return 'At least one of the specified fields is required.';
    }
}
