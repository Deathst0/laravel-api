<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OrderStringRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return $value === 'asc' || $value === 'desc';
    }

    public function message(): string
    {
        return 'The order attribute must be "asc" or "desc" only';
    }
}
