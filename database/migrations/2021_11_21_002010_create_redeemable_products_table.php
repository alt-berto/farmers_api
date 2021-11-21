<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedeemableProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeemable_products', function (Blueprint $table) {
            $table->id();
            $table->string( 'sku' )->unique(  )->nullable(  );
            $table->double( 'value', 10, 2 )->default( 0 );
            $table->string( 'name' )->nullable(  );
            $table->string( 'description' )->nullable(  );
            $table->string( 'note' )->nullable(  );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redeemable_products');
    }
}
