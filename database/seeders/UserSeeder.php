<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Departamentos da empresa
     */
    private $departments = [
        'TI',
        'RH',
        'Financeiro',
        'Marketing',
        'Comercial',
        'Operações',
        'Administrativo',
        'Jurídico'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
            'department' => 'TI'
        ]);

        $this->createAdmins();

        $this->createRegularUsers();
    }

    /**
     * Cria administradores para departamentos específicos
     */
    private function createAdmins(): void
    {
        $admins = [
            [
                'name' => 'Gerente TI',
                'email' => 'ti.manager@empresa.com',
                'department' => 'TI'
            ],
            [
                'name' => 'Gerente RH',
                'email' => 'rh.manager@empresa.com',
                'department' => 'RH'
            ],
            [
                'name' => 'Gerente Financeiro',
                'email' => 'financeiro.manager@empresa.com',
                'department' => 'Financeiro'
            ]
        ];

        foreach ($admins as $admin) {
            User::create([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => Hash::make('password123'),
                'is_admin' => true,
                'department' => $admin['department']
            ]);
        }
    }

    /**
     * Cria usuários regulares predefinidos
     */
    private function createRegularUsers(): void
    {
        $regularUsers = [
            [
                'name' => 'João Silva',
                'email' => 'joao.silva@empresa.com',
                'department' => 'TI',
                'password' => 'password123'
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@empresa.com',
                'department' => 'RH',
                'password' => 'password123'
            ],
            [
                'name' => 'Pedro Oliveira',
                'email' => 'pedro.oliveira@empresa.com',
                'department' => 'Financeiro',
                'password' => 'password123'
            ],
            [
                'name' => 'Ana Rodrigues',
                'email' => 'ana.rodrigues@empresa.com',
                'department' => 'Marketing',
                'password' => 'password123'
            ],
            [
                'name' => 'Carlos Ferreira',
                'email' => 'carlos.ferreira@empresa.com',
                'department' => 'Comercial',
                'password' => 'password123'
            ]
        ];

        foreach ($regularUsers as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'is_admin' => false,
                'department' => $user['department']
            ]);
        }
    }
}
