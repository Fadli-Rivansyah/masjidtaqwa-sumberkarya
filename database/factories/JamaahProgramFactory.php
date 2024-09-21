<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Program;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JamaahProgramFactory extends Factory
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
            'program_id'=> Program::factory(),
            'tanggal' => now()->format('Y-m-d'),
            'status' => 'lunas',
            'no_telepon' => '08' . $this->faker->numberBetween(100000000, 999999999),
            'jumlah' => $this->faker->randomNumber(6),
        ];
    }
}
