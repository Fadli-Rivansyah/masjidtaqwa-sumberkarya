<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JamaahProgram;
use App\Models\Program;
use App\Models\Qurban;
use App\Models\ShohibulQurban;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'username' => 'fadli22',
            'password' => 'password',
        ]);
    }
}
