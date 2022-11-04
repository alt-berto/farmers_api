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
      Product::create([ #1
        'name' => 'Generico',
        'description' => '',
        'image' => '',
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

    }
  }
}
