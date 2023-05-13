<?php

namespace Dilee\VietnameseAdministrativeUnits\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Dilee\VietnameseAdministrativeUnits\VietnameseAdministrativeUnitsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Dilee\\VietnameseAdministrativeUnits\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            VietnameseAdministrativeUnitsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_vietnamese_administrative_units_table.php.stub';
        $migration->up();
    }
}
