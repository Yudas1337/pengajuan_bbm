<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class StationRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @return bool
     */
    public function __invoke($attribute, $value, $fail): bool
    {
        return in_array($value, ['spbn', 'spbu']);
    }
}
