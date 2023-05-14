<?php

namespace VietnameseAdministrativeUnits\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WardFactory extends Factory
{
    protected $model = \VietnameseAdministrativeUnits\Models\Ward::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(2),
            'name' => $this->faker->unique()->words(asText: true),
            'district_id' => DistrictFactory::new(),
        ];
    }
}
