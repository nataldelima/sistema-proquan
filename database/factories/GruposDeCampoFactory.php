<?php

namespace Database\Factories;

use App\Models\Publicadores;
use App\Models\Congregacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GruposDeCampo>
 */
class GruposDeCampoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'congregacao_id' => Congregacao::factory(),
            'dirigente_id' => Publicadores::factory(),
            'ajudante_id' => Publicadores::factory(),
        ];
    }
}
