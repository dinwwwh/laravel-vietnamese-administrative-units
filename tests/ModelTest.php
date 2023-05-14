<?php

use Dilee\VietnameseAdministrativeUnits\Models\District;
use Dilee\VietnameseAdministrativeUnits\Models\Province;
use Dilee\VietnameseAdministrativeUnits\Models\Ward;
use function Pest\Laravel\assertDatabaseCount;

it('relationships are working', function () {
    Ward::factory()->count(10)->create();

    $ward = Ward::first();
    expect($ward->district)->toBeInstanceOf(District::class);
    expect($ward->district->wards)->toHaveCount(1);
    expect($ward->district->province)->toBeInstanceOf(Province::class);
    expect($ward->district->province->districts)->toHaveCount(1);
});

it('bypass soft delete', function () {
    /** @var Ward */
    $ward = Ward::factory()->create();

    $district = $ward->district;
    $province = $district->province;

    $district->delete();
    $province->delete();

    assertDatabaseCount('provinces', 1);
    assertDatabaseCount('districts', 1);
    assertDatabaseCount('wards', 1);

    $ward = Ward::first();

    expect($ward->district)->toBeInstanceOf(District::class);
    expect($ward->district->province)->toBeInstanceOf(Province::class);
});
