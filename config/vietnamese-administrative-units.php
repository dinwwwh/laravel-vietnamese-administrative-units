<?php

// config for Dilee/VietnameseAdministrativeUnits
return [
    'province' => [
        'model' => \Dilee\VietnameseAdministrativeUnits\Models\Province::class,
        'table' => 'provinces',
    ],

    'district' => [
        'model' => \Dilee\VietnameseAdministrativeUnits\Models\District::class,
        'table' => 'districts',
    ],

    'ward' => [
        'model' => \Dilee\VietnameseAdministrativeUnits\Models\Ward::class,
        'table' => 'wards',
    ],
];
