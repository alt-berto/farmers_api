<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if ( User::count(  ) == 0 ) {
            User::create( [ #1
                'company_id' => 1,
                'first_name' => 'Nestor Alberto',
                'last_name' => 'Molina Moran',
                'username' => 'alt_berto',
                'email' => 'alberto@piso83digital.com',
                'password' => Hash::make('admin'),
                'phone' => '72906930',
                'address' => 'Santa Ana, Brasil de Mora.',
                'is_admin' => true,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            User::create( [ #2
                'company_id' => 1,
                'first_name' => 'Nicolas',
                'last_name' => 'Gaudi',
                'username' => 'nico',
                'email' => 'nicolas@piso83digital.com',
                'password' => Hash::make('admin'),
                'phone' => '72906930',
                'address' => 'Santa Ana, Brasil de Mora.',
                'is_admin' => false,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            User::create( [ #3
                'company_id' => 1,
                'first_name' => 'Walter',
                'last_name' => 'Calderon',
                'username' => 'walter',
                'email' => 'walter@piso83digital.com',
                'password' => Hash::make('admin'),
                'phone' => '',
                'address' => '',
                'is_admin' => true,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
        }
    }
}
