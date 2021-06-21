<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'order_details', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'order_id' )->nullable( $value = false );
            $table->unsignedBigInteger( 'inventory_price_id' )->nullable( $value = false );
            $table->double( 'real_price', 10, 2 )->nullable(  );
            $table->double( 'has_tax', 10, 2 )->nullable(  );
            $table->string( 'unit_measurement' )->nullable(  );
            $table->integer( 'quantity' )->nullable( $value = false )->default( 1 );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
            $table->string( 'note' )->nullable(  );
            $table->timestamps();
            $table->foreign( 'order_id' )->references( 'id' )->on( 'orders' );
            $table->foreign( 'inventory_price_id' )->references( 'id' )->on( 'inventory_prices' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'order_details' );
    }
}
