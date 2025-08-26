<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProgramStudi;

class ProgramStudiFactory extends Factory
{
    protected $model = ProgramStudi::class;

    public function definition(): array
    {
        // Mendefinisikan cara membuat data Program Studi palsu
        return [
            'name' => $this->faker->words(3, true), // contoh: "S1 Teknik Informatika"
            'kode' => strtoupper($this->faker->unique()->lexify('???')), // contoh: "TIF"
        ];
    }
}