<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_program' => $this->faker->sentences(5, true),
            'tanggal' => now()->format('Y-m-d'),
            'kategori' => $this->faker->randomElement(['pembangunan masjid', 'kemanusiaan']),
            'biaya' =>  $this->faker->randomNumber(8),
            'target' => now()->addYears($this->faker->numberBetween(1, 3))->addDays($this->faker->numberBetween(1, 365))->format('Y-m-d'),
            'status' => 'selesai',
            'keterangan_program' => $this->faker->paragraph(15, true),
        ];
    }
}
