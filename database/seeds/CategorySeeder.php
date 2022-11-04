<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (Category::count() == 0) {
            Category::create([ #1
                'parent_id' => NULL,
                'name' => 'Electronica',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #2
                'parent_id' => 1,
                'name' => 'Computadoras',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #3
                'parent_id' => 3,
                'name' => 'Laptops',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #4
                'parent_id' => 3,
                'name' => 'Tablets',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #5
                'parent_id' => 3,
                'name' => 'Telefono',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #6
                'parent_id' => 1,
                'name' => 'Iluminación',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #7
                'parent_id' => 1,
                'name' => 'Sonido',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #8
                'parent_id' => 1,
                'name' => 'Video Consolas',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #9
                'parent_id' => 1,
                'name' => 'Pantalla',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #10
                'parent_id' => 1,
                'name' => 'Smart Watch',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #11
                'parent_id' => 1,
                'name' => 'Drone',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #12
                'parent_id' => NULL,
                'name' => 'Ejercicio',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #13
                'parent_id' => 12,
                'name' => 'Bicicleta',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #14
                'parent_id' => 12,
                'name' => 'GYM',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #15
                'parent_id' => NULL,
                'name' => 'Muebles',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #16
                'parent_id' => NULL,
                'name' => 'Ropa',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #17
                'parent_id' => NULL,
                'name' => 'Viajes',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            Category::create([ #18
                'parent_id' => NULL,
                'name' => 'Automovil',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
        }
    }
}
