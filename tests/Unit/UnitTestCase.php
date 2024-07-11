<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils\Tests\Unit;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Spatie\Snapshots\MatchesSnapshots;

abstract class UnitTestCase extends PHPUnitTestCase
{
    use MockeryPHPUnitIntegration;
    use MatchesSnapshots;

    protected function assertSnapshotShouldBeCreated(string $snapshotFileName): void
    {
        if ($this->shouldCreateSnapshots()) {
            return;
        }

        static::fail(
            "Snapshot \"$snapshotFileName\" does not exist.\n" .
            "You can automatically create it by running \"composer update-test-snapshots\".\n" .
            'Make sure to inspect the created snapshot afterwards to ensure its correctness!',
        );
    }
}
