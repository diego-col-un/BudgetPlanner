<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Importa el modelo User
use App\Models\Role; // <-- Importa el modelo Role
use Illuminate\Support\Facades\Hash; // <-- Importa Hash para la contraseña

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Llamar a los seeders de "catálogos" primero
        $this->call([
            RoleSeeder::class,       // Esto ya lo tenías, ¡perfecto!
            CategorySeeder::class, // <-- AÑADIR ESTO (para llenar las categorías globales)
        ]);

        // 2. Crear el Usuario de Prueba
        //    (Esto asume que tu RoleSeeder crea un rol llamado 'user')

        // Buscamos el rol "user" que tu RoleSeeder (asumimos) creó.
        // Si se llama "cliente" o "usuario", cambia 'user' por ese nombre.
        $userRole = Role::where('name', 'user')->first();

        // Si por alguna razón el seeder de roles no creó el rol 'user',
        // lo creamos para evitar un error.
        if (!$userRole) {
            $userRole = Role::create(['name' => 'user']);
            // (Si tu tabla 'roles' tiene más campos, este paso debe ser más complejo)
        }

        // Ahora creamos el usuario de prueba
        User::firstOrCreate(
            ['email' => 'usuario@prueba.com'], // Lo busca por email
            [ 
                'name' => 'Usuario de Prueba',
                'password' => Hash::make('password'), // La contraseña será 'password'
                'role_id' => $userRole->id,           // <-- ¡Le asignamos el rol!
            ]
        );

        // \App\Models\User::factory(10)->create();
    }
}