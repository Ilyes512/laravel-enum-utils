<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Ilyes512\EnumUtils\EnumUtils;
use Ilyes512\EnumUtils\Exceptions\EnumUtilsValueError;
use UnitEnum;

final class EnumNames implements ValidationRule
{
    /**
     * @param class-string<UnitEnum> $type
     */
    public function __construct(protected string $type)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string):PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value instanceof $this->type) {
            return;
        }

        if (!is_string($value)) {
            $fail('enumUtils::validation.enum_names')->translate();
            return;
        }

        try {
            EnumUtils::fromName($this->type, $value);
        } catch (EnumUtilsValueError $e) {
            $fail('enumUtils::validation.enum_names')->translate();
            return;
        }
    }
}
