<?php

use Dilee\VietnameseAdministrativeUnits\Models\District;
use Dilee\VietnameseAdministrativeUnits\Models\Province;
use Dilee\VietnameseAdministrativeUnits\Models\Ward;

it('relationships are working', function () {
    Ward::factory()->count(10)->create();

    $ward = Ward::first();
    expect($ward->district)->toBeInstanceOf(District::class);
    expect($ward->district->wards)->toHaveCount(1);
    expect($ward->district->province)->toBeInstanceOf(Province::class);
    expect($ward->district->province->districts)->toHaveCount(1);
});
