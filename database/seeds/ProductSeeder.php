<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(  ) {
  //
    if (Product::count() == 0) {
      //
      Product::create([ #1
        'category_id' => 3,
        'name' => 'PC',
        'description' => 'Computadora de uso personal.',
        'image' => 'pc.png',
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Product::create([ #2
        'category_id' => 4,
        'name' => 'Tablet',
        'description' => 'Dispositivo movil tactil.',
        'image' => 'tablet.png',
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Product::create([ #3
        'category_id' => 5,
        'name' => 'Smartphone',
        'description' => 'Dispositivo movil tactil.',
        'image' => 'iphone.png',
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

    }
  }
}
