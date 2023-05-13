<?php

namespace Dilee\VietnameseAdministrativeUnits;

use Dilee\VietnameseAdministrativeUnits\Commands\VietnameseAdministrativeUnitsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VietnameseAdministrativeUnitsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('vietnamese-administrative-units')
            ->hasConfigFile()
            ->hasMigration('create_vietnamese_administrative_units_table')
            ->hasCommand(VietnameseAdministrativeUnitsCommand::class);
    }
}
