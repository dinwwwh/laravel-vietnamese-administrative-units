<?php

namespace Dilee\VietnameseAdministrativeUnits\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DistrictFactory extends Factory
{
    protected $model = \Dilee\VietnameseAdministrativeUnits\Models\District::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(2),
            'name' => $this->faker->unique()->words(asText: true),
            'province_id' => \Dilee\VietnameseAdministrativeUnits\Models\Province::factory(),
        ];
    }
}
