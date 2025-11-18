<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // <-- ¡Importante! Asegúrate de importar tu modelo Category

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Definimos la lista de categorías globales
        // (Basado en tu migración que tiene 'name' y 'type')
        $categories = [
            // Ingresos (income)
            ['name' => 'Salario', 'type' => 'income'],
            ['name' => 'Inversiones', 'type' => 'income'],
            ['name' => 'Regalos', 'type' => 'income'],
            ['name' => 'Otro Ingreso', 'type' => 'income'],
            
            // Gastos (expense)
            ['name' => 'Comida', 'type' => 'expense'],
            ['name' => 'Transporte', 'type' => 'expense'],
            ['name' => 'Vivienda', 'type' => 'expense'],
            ['name' => 'Ocio', 'type' => 'expense'],
            ['name' => 'Salud', 'type' => 'expense'],
            ['name' => 'Educación', 'type' => 'expense'],
            ['name' => 'Otro Gasto', 'type' => 'expense'],
        ];

        // 2. Recorremos el array y creamos las categorías
        foreach ($categories as $category) {
            // Usamos firstOrCreate para evitar duplicados si se corre el seeder varias veces.
            // 1er param: El campo por el que buscar (name)
            // 2do param: Los campos a insertar si no se encuentra (type)
            Category::firstOrCreate(
                ['name' => $category['name']], // Busca por este nombre
                ['type' => $category['type']]  // Si no lo encuentra, lo crea con este tipo
            );
        }
    }
}