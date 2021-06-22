<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'parent_id' )->nullable(  );
            $table->foreign( 'parent_id' )->references( 'id' )->on( 'categories' );
            $table->integer( 'order' )->nullable(  );
            $table->string( 'name' );
            $table->string( 'image' )->nullable(  );
            $table->string( 'note' )->nullable(  );
            $table->boolean( 'is_active' )->nullable( $value = false )->default( true );
            $table->boolean( 'is_deleted' )->nullable( $value = false )->default( false );
            $table->timestamps(  );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
