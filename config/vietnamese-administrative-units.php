<?php

// config for dileedotdev/laravel-vietnamese-administrative-units package
return [
    'province' => [
        'model' => \VietnameseAdministrativeUnits\Models\Province::class,
        'table' => 'provinces',
    ],

    'district' => [
        'model' => \VietnameseAdministrativeUnits\Models\District::class,
        'table' => 'districts',
    ],

    'ward' => [
        'model' => \VietnameseAdministrativeUnits\Models\Ward::class,
        'table' => 'wards',
    ],
];
