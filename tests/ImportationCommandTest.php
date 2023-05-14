<?php

use function Pest\Laravel\assertDatabaseCount;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\TestTime\TestTime;
use VietnameseAdministrativeUnits\Models\District;
use VietnameseAdministrativeUnits\Models\Province;
use VietnameseAdministrativeUnits\Models\Ward;

it('includes enough provinces, districts and wards', function () {
    $filePath = __DIR__.'/../assets/vietnamese-administrative-units.csv';

    $this->artisan('vietnamese-administrative-units:import')
        ->assertExitCode(0);

    $provinceCodes = [];
    $districtCodes = [];
    $wardCodes = [];
    SimpleExcelReader::create($filePath)
        ->getRows()
        ->each(function (array $row) use (&$provinceCodes, &$districtCodes, &$wardCodes) {
            [
                'Mã TP' => $provinceCode,
                'Mã QH' => $districtCode,
                'Mã PX' => $wardCode,
            ] = $row;

            $provinceCodes[] = $provinceCode;
            $districtCodes[] = $districtCode;
            $wardCodes[] = $wardCode;
        });

    assertDatabaseCount('provinces', count(array_unique($provinceCodes)));
    assertDatabaseCount('districts', count(array_unique($districtCodes)));
    assertDatabaseCount('wards', count(array_unique($wardCodes)));
});

it('will use soft delete for deleted units', function () {
    TestTime::freeze();

    $basePath = __DIR__.'/assets/base-units.csv';
    $deletedPath = __DIR__.'/assets/deleted-some-units.csv';
    $addedPath = __DIR__.'/assets/added-some-units.csv';

    $this->artisan('vietnamese-administrative-units:import', [
        'file' => $basePath,
    ])
        ->assertExitCode(0);

    $baseCount = [
        'provinces' => Province::count(),
        'districts' => District::count(),
        'wards' => Ward::count(),
    ];

    TestTime::addSecond();
    $this->artisan('vietnamese-administrative-units:import', [
        'file' => $deletedPath,
    ])
        ->assertExitCode(0);

    expect(Province::count())->toBeLessThan($baseCount['provinces']);
    expect(District::count())->toBeLessThan($baseCount['districts']);
    expect(Ward::count())->toBeLessThan($baseCount['wards']);

    expect(Province::withTrashed()->count())->toBe($baseCount['provinces']);
    expect(District::withTrashed()->count())->toBe($baseCount['districts']);
    expect(Ward::withTrashed()->count())->toBe($baseCount['wards']);

    TestTime::addSecond();
    $this->artisan('vietnamese-administrative-units:import', [
        'file' => $basePath,
    ])
        ->assertExitCode(0);

    expect(Province::count())->toBe($baseCount['provinces']);
    expect(District::count())->toBe($baseCount['districts']);
    expect(Ward::count())->toBe($baseCount['wards']);

    TestTime::addSecond();
    $this->artisan('vietnamese-administrative-units:import', [
        'file' => $addedPath,
    ])
        ->assertExitCode(0);

    expect(Province::count())->toBeGreaterThan($baseCount['provinces']);
    expect(District::count())->toBeGreaterThan($baseCount['districts']);
    expect(Ward::count())->toBeGreaterThan($baseCount['wards']);
});
