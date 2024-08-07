<?php

declare(strict_types=1);

namespace Ilyes512\EnumUtils\Tests\Feature;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\DateFactory;
use Ilyes512\EnumUtils\EnumUtilsServiceProvider;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\TestCase as OrchestraTestbench;
use Spatie\Snapshots\MatchesSnapshots;

abstract class FeatureTestCase extends OrchestraTestbench
{
    use MockeryPHPUnitIntegration;
    use MatchesSnapshots;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        mt_srand(1337, MT_RAND_PHP);
    }

    /**
     * Get package providers.
     *
     * @param Application  $app
     *
     * @return array<class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            EnumUtilsServiceProvider::class,
        ];
    }

    /**
     * Get application timezone.
     *
     * @param Application  $app
     */
    protected function getApplicationTimezone($app): ?string
    {
        return 'Europe/Amsterdam';
    }

    /**
     * Define routes setup.
     *
     * @param Router  $router
     */
    protected function defineRoutes($router): void
    {
        // Define Routes
    }

    /**
     * Define environment setup.
     *
     * @param Application   $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Define your environment setup.

        $app['config']['app.timezone'] = $this->getApplicationTimezone($app);

        DateFactory::use(CarbonImmutable::class);
    }

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
