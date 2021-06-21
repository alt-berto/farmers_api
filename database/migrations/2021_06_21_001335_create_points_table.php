<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements( 'id' );
            $table->string( 'key' )->unique(  )->nullable(  );
            $table->double( 'value', 10, 2 )->default( 0 );
            $table->string( 'message' )->nullable(  );
            $table->smallInteger( 'max_uses' )->default( 1 );
            $table->string( 'note' )->nullable(  );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
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
        Schema::dropIfExists('points');
    }
}
