<?php

use Illuminate\Database\Seeder;
use App\InventoryTag;

class InventoryTagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  //
  if ( InventoryTag::count(  ) == 0 ) {
    //
    InventoryTag::create( [ #1
      'inventory_id' => 1,
      'tag_id' => 3,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #2
      'inventory_id' => 1,
      'tag_id' => 4,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #3
      'inventory_id' => 1,
      'tag_id' => 5,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #4
      'inventory_id' => 2,
      'tag_id' => 3,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #5
      'inventory_id' => 2,
      'tag_id' => 4,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #6
      'inventory_id' => 2,
      'tag_id' => 5,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #7
      'inventory_id' => 3,
      'tag_id' => 1,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #8
      'inventory_id' => 3,
      'tag_id' => 5,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #9
      'inventory_id' => 4,
      'tag_id' => 1,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #10
      'inventory_id' => 4,
      'tag_id' => 5,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #11
      'inventory_id' => 5,
      'tag_id' => 1,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #12
      'inventory_id' => 5,
      'tag_id' => 2,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #13
      'inventory_id' => 5,
      'tag_id' => 3,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #14
      'inventory_id' => 6,
      'tag_id' => 1,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #15
      'inventory_id' => 6,
      'tag_id' => 2,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
    InventoryTag::create( [ #16
      'inventory_id' => 6,
      'tag_id' => 3,
      'is_active' => true,
      'note' => 'Pre-Registro',
    ] );
  }
  }
}
