<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $resources = [
            'Projetor',
            'TV Smart',
            'Sistema de Videoconferência',
            'Quadro Branco',
            'Flipchart',
            'Sistema de Som',
            'Conexão para Laptops',
            'Webcam'
        ];

        foreach ($resources as $resourceName) {
            Resource::create([
                'name' => $resourceName
            ]);
        }
    }
}
