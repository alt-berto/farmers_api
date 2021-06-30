<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if ( Company::count(  ) == 0 ) {
            Company::create( [ #1
                'identification_type' => '01',
                'legal_id' => '123456789',
                'name' => 'Piso 83',
                'business_name' => 'Piso 83 Digital',
                'email' => 'hello@piso83digital.com',
                'description' => '',
                'phone' => '60061983',
                'country' => 506,
                'address' => 'Santa Jose',
                'website' => 'https://www.piso83digital.com/',
                'image' => 'icon-piso833.svg',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
        }
    }
}
