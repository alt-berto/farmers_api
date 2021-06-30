<?php

use Illuminate\Database\Seeder;
use App\InventoryImage;

class InventoryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (InventoryImage::count() == 0) {
            //
            InventoryImage::create([ #1
                'inventory_id' =>2,
                'is_cover' => true,
                'filename' => 'awaurorawebp',
                'url' => 'awaurorawebp.webp',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            InventoryImage::create([ #2
                'inventory_id' => 2,
                'is_cover' => true,
                'filename' => 'imac',
                'url' => 'imac.webp',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            InventoryImage::create([ #3
                'inventory_id' => 3,
                'is_cover' => true,
                'filename' => 'ipad',
                'url' => 'ipad.png',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            InventoryImage::create([ #4
                'inventory_id' => 4,
                'is_cover' => true,
                'filename' => 'surface_pro_x',
                'url' => 'surface_pro_x.png',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            InventoryImage::create([ #5
                'inventory_id' => 5,
                'is_cover' => true,
                'filename' => 'iphone12',
                'url' => 'iphone12.jpg',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
            InventoryImage::create([ #6
                'inventory_id' => 6,
                'is_cover' => true,
                'filename' => 'surface_duo',
                'url' => 'surface_duo.jpg',
                'is_active' => true,
                'note' => 'Pre-Registro',
            ]);
        }
    }
}
