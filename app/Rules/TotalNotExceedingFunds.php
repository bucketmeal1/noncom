<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\FundSource;

class TotalNotExceedingFunds implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    // public function validate(string $attribute, mixed $value, Closure $fail): void
    // {
    //     //
    // }

    // app/Rules/TotalNotExceedingFunds.php

    public function passes($attribute, $value)
    {
        $fundSourceIds = request()->input('fund_source_id');
        $totalFunds = FundSource::whereIn('id', $fundSourceIds)->sum('amount');
        
        return $value <= $totalFunds;
    }

    public function message()
    {
        return 'The total cannot exceed the available funds.';
    }

}
