<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'orders', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'client_id' )->nullable(  );
            $table->string( 'card_info' )->nullable(  );
            $table->string( 'card_name' )->nullable(  );
            $table->integer( 'last_digit_card' )->nullable(  );
            $table->string( 'session' )->nullable(  );
            $table->longText( 'note' )->nullable(  );
            $table->enum( 'state', ['pending', 'active', 'canceled', 'done'] )->default( 'pending' )->nullable( $value = false );
            $table->boolean( 'is_deleted' )->default( false );
            $table->timestamps(  );
            $table->foreign( 'client_id' )->references( 'id' )->on( 'users' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'orders' );
    }
}
