<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(  )
    {
        //
        if ( Tag::count(  ) == 0 ) {
            Tag::create( [ #1
                'name' => 'Portable',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Tag::create( [ #2
                'name' => 'Light',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Tag::create( [ #3
                'name' => 'Tool',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Tag::create( [ #4
                'name' => 'IT',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            Tag::create( [ #5
                'name' => 'Multitask',
                'image' => '',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
        }
    }
}
