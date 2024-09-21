<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \go2hi\go2hi;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Qurban>
 */
class QurbanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tahun_qurban' =>  go2hi::date('F Y', go2hi::GO2HI_HIJRI, strtotime(now())),
            'tanggal_pembukaan' => now()->format('Y-m-d'),
            'tanggal_penutupan' => now()->addYears($this->faker->numberBetween(1, 3))->addDays($this->faker->numberBetween(1, 365))->format('Y-m-d'),
            'status' => 'dibuka',
            'keterangan' => $this->faker->paragraph(15, true),
        ];
    }
}
