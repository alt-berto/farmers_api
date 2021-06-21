<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'product_id' )->nullable( $value = false );
            $table->unsignedBigInteger( 'point_id' )->nullable(  );
            $table->unsignedBigInteger( 'company_id' )->nullable(  );
            $table->string( 'name' )->nullable(  );
            $table->string( 'description' )->nullable(  );
            $table->string( 'include' )->nullable(  );
            $table->string( 'company_name' )->nullable(  );
            $table->string( 'image' )->nullable(  );
            $table->string( 'clasification' )->nullable(  );
            $table->string( 'code' )->nullable(  );
            $table->string( 'unit_measurement' )->nullable(  );
            $table->integer( 'qmin' )->nullable( $value = false );
            $table->integer( 'qmax' )->nullable( $value = false );
            $table->integer( 'existence' )->nullable( $value = false );
            $table->integer( 'aviability' )->nullable( $value = false );
            $table->string( 'note' )->nullable(  );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
            $table->timestamps(  );
            $table->foreign( 'product_id' )->references( 'id' )->on( 'products' );
            $table->foreign( 'point_id' )->references( 'id' )->on( 'points' );
            $table->foreign( 'company_id' )->references( 'id' )->on( 'companies' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
