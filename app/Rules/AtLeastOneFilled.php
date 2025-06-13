<?php
// app/Rules/AtLeastOneFilled.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AtLeastOneFilled implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if all the fields are empty
        if(!empty(request('q1')) || !empty(request('q2')) || !empty(request('q3'))  || !empty(request('q4')) ){
            return true; exit;
        }
        // return false;
        return true;
    }

    public function message()
    {
        return 'At least one of the fields q1, q2, q3, or q4 must have a value.';
    }
}
