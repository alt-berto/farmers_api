<?php

use Illuminate\Database\Seeder;
use App\Point;

class PointSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(  ) {
  //
    if (Point::count() == 0) {
      //
      Point::create([ #1
        'key' => '3caff61cb19d855503fe',
        'value' => 1000,
        'message' => 'Puntos promocionales exclusivos de...',
        'max_uses' => 5,
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Point::create([ #2
        'key' => '7cdc97fa291989fc5518',
        'value' => 2000,
        'message' => 'Puntos promocionales exclusivos de...',
        'max_uses' => 10,
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Point::create([ #3
        'key' => 'f7d7b0d4903a4a6b047e',
        'value' => 3000,
        'message' => 'Puntos promocionales exclusivos de...',
        'max_uses' => 20,
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Point::create([ #4
        'key' => '2d335b3ea463df5e989b',
        'value' => 4000,
        'message' => 'Puntos promocionales exclusivos de...',
        'max_uses' => 10,
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Point::create([ #5
        'key' => 'bbef2be5f0210575985d',
        'value' => 5000,
        'message' => 'Puntos promocionales exclusivos de...',
        'max_uses' => 10,
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

      Point::create([ #6
        'key' => '1f3d55d64150e9fbbd1e',
        'value' => 6000,
        'message' => 'Puntos promocionales exclusivos de...',
        'max_uses' => 10,
        'is_active' => true,
        'note' => 'Pre-Registro',
      ]);

    }
  }
}
