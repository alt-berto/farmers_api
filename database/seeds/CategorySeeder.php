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
    public function run(  )
    {
        //
        if ( Category::count(  ) == 0 ) {
            Category::create( [ #1
                'parent_id' => NULL,
                'name' => 'Electronica',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Category::create( [ #2
                'parent_id' => 1,
                'name' => 'Computadoras',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Category::create( [ #3
                'parent_id' => 3,
                'name' => 'Laptops',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Category::create( [ #4
                'parent_id' => 3,
                'name' => 'Tablets',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Category::create( [ #5
                'parent_id' => 3,
                'name' => 'Telefono',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
        }
    }
}
