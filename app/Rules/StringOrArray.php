<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class StringOrArray implements InvokableRule
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
        if (!is_string($value) && !is_array($value)) {
            $fail(__('rule.string_or_array', ['field' => $attribute]));
        }
    }
}
