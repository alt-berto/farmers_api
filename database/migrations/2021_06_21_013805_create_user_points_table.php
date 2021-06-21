<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'user_points', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'user_id' )->nullable( $value = false );
            $table->unsignedBigInteger( 'point_id' )->nullable(  );
            $table->string( 'note' )->nullable(  );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
            $table->timestamps(  );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->foreign( 'point_id' )->references( 'id' )->on( 'points' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'user_points' );
    }
}
