<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'inventory_images', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'inventory_id' )->nullable( $value = false );
            $table->boolean( 'is_cover' )->default( false );
            $table->string( 'filename' )->nullable(  );
            $table->string( 'name' )->nullable(  );
            $table->string( 'url' )->nullable(  );
            $table->string('note' )->nullable(  );
            $table->boolean('is_active' )->default( true );
            $table->boolean('is_deleted' )->default( false );
            $table->timestamps(  );
            $table->foreign( 'inventory_id' )->references( 'id' )->on( 'inventories' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'inventory_images' );
    }
}
