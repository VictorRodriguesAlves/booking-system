<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de salas com suas características
        $rooms = [
            [
                'name' => 'Sala Executiva',
                'location' => '10º Andar - Área Executiva',
                'capacity' => 20,
                'requires_approval' => true,
                'active' => true,
            ],
            [
                'name' => 'Sala de Treinamento',
                'location' => '3º Andar - Área de RH',
                'capacity' => 30,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Sala de Videoconferência',
                'location' => '5º Andar - Área de TI',
                'capacity' => 12,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Sala Ágil',
                'location' => '5º Andar - Área de TI',
                'capacity' => 8,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Auditório Principal',
                'location' => 'Térreo',
                'capacity' => 100,
                'requires_approval' => true,
                'active' => true,
            ],
            [
                'name' => 'Sala de Criação',
                'location' => '4º Andar - Área de Marketing',
                'capacity' => 10,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Sala de Cliente',
                'location' => '2º Andar - Área Comercial',
                'capacity' => 6,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Sala de Projetos',
                'location' => '6º Andar',
                'capacity' => 15,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Sala de Reunião A1',
                'location' => '1º Andar',
                'capacity' => 8,
                'requires_approval' => false,
                'active' => true,
            ],
            [
                'name' => 'Sala de Reunião B2',
                'location' => '2º Andar',
                'capacity' => 8,
                'requires_approval' => false,
                'active' => true,
            ],
            // Exemplo de sala inativa (em manutenção ou reforma)
            [
                'name' => 'Sala de Reunião C3',
                'location' => '3º Andar',
                'capacity' => 10,
                'requires_approval' => false,
                'active' => false,
            ]
        ];

        // Criar as salas
        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
