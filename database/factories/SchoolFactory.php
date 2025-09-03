<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\School>
 */
class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mendefinisikan bagaimana cara membuat data sekolah palsu
        return [
            'name' => 'SMA Negeri ' . $this->faker->numberBetween(1, 20) . ' ' . $this->faker->city,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'contact_person' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
