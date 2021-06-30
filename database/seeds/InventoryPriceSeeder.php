<?php

use App\InventoryPrice;
use Illuminate\Database\Seeder;

class InventoryPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if ( InventoryPrice::count(  ) == 0 ) {
            InventoryPrice::create( [ #1
                'inventory_id' => 1,
                'price' => 20000,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #2
                'inventory_id' => 2,
                'price' => 30000,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #3
                'inventory_id' => 3,
                'price' => 35000,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #4
                'inventory_id' => 4,
                'price' => 45000,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );

            InventoryPrice::create( [ #5
                'inventory_id' => 5,
                'price' => 5100,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #6
                'inventory_id' => 6,
                'price' => 15000,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
        }
    }
}
