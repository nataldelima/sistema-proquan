<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Congregacao>
 */
class CongregacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->company,
            'endereco' => $this->faker->address,
            'circuito' => $this->faker->word,
            'supteCircuito' => $this->faker->name,
            'telefoneSupteCircuito' => $this->faker->phoneNumber,
        ];
    }
}
