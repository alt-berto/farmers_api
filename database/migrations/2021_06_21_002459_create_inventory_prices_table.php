<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger( 'inventory_id' )->nullable( $value = false );
            $table->double( 'price', 10, 2 )->default( 0 );
            $table->double( 'has_tax', 10, 2 )->nullable(  );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean('is_deleted')->default( false );
            $table->string( 'note' )->nullable(  );
            $table->timestamps(  );
            $table->foreign( 'inventory_id' )->references( 'id' )->on( 'inventories' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_prices');
    }
}
