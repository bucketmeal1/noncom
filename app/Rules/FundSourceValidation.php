<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Request;

class FundSourceValidation implements Rule
{
    public function passes($attribute, $value)
    {

        dd(Request::is('*/work-financial-plans/create'));
        
        if (Request::is('*/work-financial-plans/create')) {
            // Validation for creating a new record
            return !empty($value);
        }

        // Validation for updating an existing record
        return true;
    }

    public function message()
    {
        return 'The :attribute field is required when creating a new record.';
    }
}
