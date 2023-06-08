<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class NumericOrArray implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!is_numeric($value) && !is_array($value)) {
            $fail(__('rule.numeric_or_array', ['field' => $attribute]));
        }
    }
}
