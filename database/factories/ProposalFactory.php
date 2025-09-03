<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proposal;
use App\Models\User;
use App\Models\School;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposal>
 */
class ProposalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proposal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mendefinisikan bagaimana cara membuat data proposal palsu
        return [
            'user_id' => User::factory(), // Otomatis buat user baru jika tidak disediakan
            'school_id' => School::factory(), // Otomatis buat sekolah baru jika tidak disediakan
            'status' => 'diajukan',
            'proposed_date' => $this->faker->date(),
            'notes' => $this->faker->paragraph,
        ];
    }
}
