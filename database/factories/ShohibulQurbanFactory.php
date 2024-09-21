<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Qurban;
use App\Models\ShohibulQurban;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShohibulQurban>
 */
class ShohibulQurbanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'qurban_id' => $this->faker->numberBetween(1, 3),
            'no_telepon' => '08' . $this->faker->numberBetween(100000000, 999999999),
            'metode_qurban' => $this->faker->randomElement(['mandiri', 'patungan', ]),
            'jenis_hewan' => $this->faker->randomElement(['kambing', 'lembu', ]),
            'jumlah' =>  $this->faker->randomNumber(6),
            'alamat' => $this->faker->address()
        ];
    }
}
