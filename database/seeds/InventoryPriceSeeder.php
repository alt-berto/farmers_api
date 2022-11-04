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
                'price' => 1456,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #2
                'inventory_id' => 2,
                'price' => 1274,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #3
                'inventory_id' => 3,
                'price' => 1247,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #4
                'inventory_id' => 4,
                'price' => 1176,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );

            InventoryPrice::create( [ #5
                'inventory_id' => 5,
                'price' => 1129,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #6
                'inventory_id' => 6,
                'price' => 1103,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #7
                'inventory_id' => 7,
                'price' => 912,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #8
                'inventory_id' => 8,
                'price' => 799,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #9
                'inventory_id' => 9,
                'price' => 768,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #10
                'inventory_id' => 10,
                'price' => 662,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #11
                'inventory_id' => 11,
                'price' => 599,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #12
                'inventory_id' => 12,
                'price' => 551,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #13
                'inventory_id' => 13,
                'price' => 529,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #14
                'inventory_id' => 14,
                'price' => 440,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #15
                'inventory_id' => 15,
                'price' => 410,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #16
                'inventory_id' => 16,
                'price' => 382,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #17
                'inventory_id' => 17,
                'price' => 299,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #18
                'inventory_id' => 18,
                'price' => 247,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #19
                'inventory_id' => 19,
                'price' => 228,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #20
                'inventory_id' => 20,
                'price' => 191,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #21
                'inventory_id' => 21,
                'price' => 190,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #22
                'inventory_id' => 22,
                'price' => 162,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #23
                'inventory_id' => 23,
                'price' => 149,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #24
                'inventory_id' => 24,
                'price' => 117,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #25
                'inventory_id' => 25,
                'price' => 109,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #26
                'inventory_id' => 26,
                'price' => 95,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #27
                'inventory_id' => 27,
                'price' => 93,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #28
                'inventory_id' => 28,
                'price' => 80,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #29
                'inventory_id' => 29,
                'price' => 70,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #30
                'inventory_id' => 30,
                'price' => 62,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #31
                'inventory_id' => 31,
                'price' => 59,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #32
                'inventory_id' => 32,
                'price' => 58,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #33
                'inventory_id' => 33,
                'price' => 53,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #34
                'inventory_id' => 34,
                'price' => 51,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #35
                'inventory_id' => 35,
                'price' => 43,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #36
                'inventory_id' => 36,
                'price' => 32,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #37
                'inventory_id' => 37,
                'price' => 27,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
            InventoryPrice::create( [ #38
                'inventory_id' => 38,
                'price' => 20,
                'has_tax' => 0,
                'is_active' => true,
                'note' => 'Pre-Registro',
            ] );
        }
    }
}
