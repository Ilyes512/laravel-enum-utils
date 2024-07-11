<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils\Tests\Unit\Rules;

use Illuminate\Translation\PotentiallyTranslatedString;
use Ilyes512\EnumUtils\Rules\EnumNames;
use Ilyes512\EnumUtils\Tests\Enums\Color;
use Ilyes512\EnumUtils\Tests\Unit\UnitTestCase;
use Mockery;
use Mockery\MockInterface;

class EnumNamesTest extends UnitTestCase
{
    public function testWithEnumInstance(): void
    {
        /** @var callable&MockInterface $closure */
        $closure = Mockery::mock(function () {
        });

        $rule = new EnumNames(Color::class);
        $rule->validate('attribute', Color::RED, $closure(...));

        $closure->shouldNotHaveBeenCalled();
    }

    public function testWithNonStringValue(): void
    {
        /** @var PotentiallyTranslatedString&MockInterface $translatableString */
        $translatableString = Mockery::mock(PotentiallyTranslatedString::class);
        $translatableString->shouldReceive('translate')->once();

        $closure = function (string $key) use ($translatableString): PotentiallyTranslatedString {
            $this->assertSame('enumUtils::validation.enum_names', $key);

            return $translatableString;
        };

        $rule = new EnumNames(Color::class);
        $rule->validate('attribute', 100, $closure);
    }

    public function testWithInvalidNameValue(): void
    {
        /** @var PotentiallyTranslatedString&MockInterface $translatableString */
        $translatableString = Mockery::mock(PotentiallyTranslatedString::class);
        $translatableString->shouldReceive('translate')->once();

        $closure = function (string $key) use ($translatableString): PotentiallyTranslatedString {
            $this->assertSame('enumUtils::validation.enum_names', $key);

            return $translatableString;
        };

        $rule = new EnumNames(Color::class);
        $rule->validate('attribute', 'UNKNOWN_VALUE', $closure);
    }

    public function testWithValidNameValue(): void
    {
        /** @var callable&MockInterface $closure */
        $closure = Mockery::mock(function () {
        });

        $rule = new EnumNames(Color::class);
        $rule->validate('attribute', Color::RED->name, $closure(...));

        $closure->shouldNotHaveBeenCalled();
    }
}
