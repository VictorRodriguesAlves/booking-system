<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomResource;

class RoomResourceSeeder extends Seeder
{
    private const RESOURCE = [
        'PROJETOR' => 1,
        'TV' => 2,
        'VIDEOCONF' => 3,
        'QUADRO' => 4,
        'FLIPCHART' => 5,
        'SOM' => 6,
        'LAPTOP' => 7,
        'WEBCAM' => 8
    ];

    private const ROOM = [
        'EXECUTIVA' => 1,
        'TREINAMENTO' => 2,
        'VIDEOCONF' => 3,
        'AGIL' => 4,
        'AUDITORIO' => 5,
        'CRIACAO' => 6,
        'CLIENTE' => 7,
        'PROJETOS' => 8,
        'REUNIAO_A1' => 9,
        'REUNIAO_B2' => 10
    ];

    public function run(): void
    {
        $roomResources = [
            self::ROOM['EXECUTIVA'] => [
                self::RESOURCE['PROJETOR'],
                self::RESOURCE['VIDEOCONF'],
                self::RESOURCE['TV'],
                self::RESOURCE['SOM']
            ],
            self::ROOM['TREINAMENTO'] => [
                self::RESOURCE['PROJETOR'],
                self::RESOURCE['QUADRO'],
                self::RESOURCE['SOM']
            ],
            self::ROOM['VIDEOCONF'] => [
                self::RESOURCE['TV'],
                self::RESOURCE['VIDEOCONF'],
                self::RESOURCE['WEBCAM']
            ],
            self::ROOM['AGIL'] => [
                self::RESOURCE['QUADRO'],
                self::RESOURCE['TV']
            ],
            self::ROOM['AUDITORIO'] => [
                self::RESOURCE['PROJETOR'],
                self::RESOURCE['SOM'],
                self::RESOURCE['VIDEOCONF']
            ],
            self::ROOM['CRIACAO'] => [
                self::RESOURCE['QUADRO'],
                self::RESOURCE['TV'],
                self::RESOURCE['FLIPCHART']
            ],
            self::ROOM['CLIENTE'] => [
                self::RESOURCE['TV'],
                self::RESOURCE['VIDEOCONF']
            ],
            self::ROOM['PROJETOS'] => [
                self::RESOURCE['PROJETOR'],
                self::RESOURCE['QUADRO'],
                self::RESOURCE['WEBCAM']
            ],
            self::ROOM['REUNIAO_A1'] => [
                self::RESOURCE['TV'],
                self::RESOURCE['LAPTOP']
            ],
            self::ROOM['REUNIAO_B2'] => [
                self::RESOURCE['TV'],
                self::RESOURCE['LAPTOP']
            ]
        ];

        $records = [];
        foreach ($roomResources as $roomId => $resourceIds) {
            foreach ($resourceIds as $resourceId) {
                $records[] = [
                    'room_id' => $roomId,
                    'resource_id' => $resourceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        RoomResource::insert($records);

    }
}
