<?php

namespace Dilee\VietnameseAdministrativeUnits\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WardFactory extends Factory
{
    protected $model = \Dilee\VietnameseAdministrativeUnits\Models\Ward::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(2),
            'name' => $this->faker->unique()->words(asText: true),
            'district_id' => \Dilee\VietnameseAdministrativeUnits\Models\District::factory(),
        ];
    }
}
