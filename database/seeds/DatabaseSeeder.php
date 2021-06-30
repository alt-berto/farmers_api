<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call( CompanySeeder::class );
        $this->call( UserSeeder::class );
        $this->call( CategorySeeder::class );
        $this->call( ProductSeeder::class );
        $this->call( PointSeeder::class );
        $this->call( InventorySeeder::class );
        $this->call( InventoryPriceSeeder::class );
        $this->call( TagSeeder::class );
        $this->call( InventoryTagSeeder::class );
        $this->call( InventoryImageSeeder::class );
    }
}
