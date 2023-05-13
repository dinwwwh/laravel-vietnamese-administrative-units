<?php

namespace Dilee\VietnameseAdministrativeUnits\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinceFactory extends Factory
{
    protected $model = \Dilee\VietnameseAdministrativeUnits\Models\Province::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(2),
            'name' => $this->faker->unique()->city(),
        ];
    }
}
