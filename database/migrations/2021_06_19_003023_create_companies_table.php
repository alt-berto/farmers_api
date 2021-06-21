<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements( 'id' );
            $table->string( 'identification_type', 2 )->nullable(  );
            $table->string( 'legal_id', 16 )->nullable(  );
            $table->string( 'name' );
            $table->string( 'business_name' )->nullable(  );
            $table->string( 'description' )->nullable(  );
            $table->string( 'email', 60 )->unique(  );
            $table->string( 'phone', 12 )->nullable(  );
            $table->string( 'country', 50 )->nullable(  );
            $table->string( 'province', 50 )->nullable(  );
            $table->string( 'canton', 50 )->nullable(  );
            $table->string( 'district', 50 )->nullable(  );
            $table->string( 'address', 200 )->nullable(  );
            $table->string( 'website' )->unique(  );
            $table->string( 'image' )->nullable(  );
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
        Schema::dropIfExists('companies');
    }
}
