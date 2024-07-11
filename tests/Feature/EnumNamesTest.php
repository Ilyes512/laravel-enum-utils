<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils\Tests\Feature;

use Illuminate\Validation\Factory;
use Ilyes512\EnumUtils\Rules\EnumNames;
use Ilyes512\EnumUtils\Tests\Enums\Color;
use Webmozart\Assert\Assert;

final class EnumNamesTest extends FeatureTestCase
{
    protected Factory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $app = $this->app;
        Assert::notNull($app);

        $this->factory = $app->make(Factory::class);
    }

    public function testEnumNames(): void
    {
        $validator = $this->factory->make(
            [
                'color' => 'INVALID',
            ],
            [
                'color' => [new EnumNames(Color::class)],
            ],
        );

        $this->assertFalse($validator->passes());
        $this->assertMatchesJsonSnapshot($validator->messages()->get('color'));
    }
}
