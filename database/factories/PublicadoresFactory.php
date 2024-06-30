<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GruposDeCampo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicadores>
 */
class PublicadoresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'primeiroNome' => $this->faker->firstName,
            'nomeMeio' => $this->faker->firstName,
            'sobrenome' => $this->faker->lastName,
            'dataNascimento' => $this->faker->date(),
            'dataBatismo' => $this->faker->date(),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'privilegios' => json_encode($this->faker->randomElements(['ancião', 'servo ministerial', 'pioneiro regular'], rand(0, 3))),
            'gruposdecampo_id' => GruposDeCampo::factory(),
            'endereco' => $this->faker->address,
            'telefone' => $this->faker->phoneNumber,
            'contatoEmergencia' => $this->faker->name,
            'telContatoEmergencia' => $this->faker->phoneNumber,
            'contatoEmergenciaEhTj' => $this->faker->boolean,
            'ativo' => $this->faker->boolean,
        ];
    }
}
