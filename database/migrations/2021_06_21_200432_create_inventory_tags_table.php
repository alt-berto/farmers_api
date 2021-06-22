<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'inventory_tags', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'inventory_id' )->nullable( $value = false );
            $table->unsignedBigInteger( 'tag_id' )->nullable( $value = false );
            $table->string( 'note' )->nullable(  );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
            $table->timestamps(  );
            $table->foreign( 'inventory_id' )->references( 'id' )->on( 'inventories' );
            $table->foreign( 'tag_id' )->references( 'id' )->on( 'tags' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'inventory_tags' );
    }
}
