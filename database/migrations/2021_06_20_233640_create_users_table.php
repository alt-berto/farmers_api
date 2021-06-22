<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'company_id' )->nullable(  );
            $table->string( 'first_name', 60 );
            $table->string( 'last_name', 60 );
            $table->integer( 'partner_number' )->nullable(  );
            $table->string( 'company_name' )->nullable(  );
            $table->date( 'birthday' )->nullable();
            $table->tinyInteger( 'gender' )->default( 0 );
            $table->string( 'username', 50 )->unique();
            $table->string( 'email', 60 )->unique(  );
            $table->timestamp( 'email_verified_at' )->nullable();
            $table->string( 'phone', 12 )->nullable(  );
            $table->string( 'country', 50 )->nullable(  );
            $table->string( 'province', 50 )->nullable(  );
            $table->string( 'canton', 50 )->nullable(  );
            $table->string( 'district', 50 )->nullable(  );
            $table->string( 'address' )->nullable(  );
            $table->string( 'zip', 10 )->nullable(  );
            $table->integer( 'points' )->nullable(  );
            $table->string( 'image' )->nullable(  );
            $table->string( 'note', 200 )->nullable(  );
            $table->boolean( 'is_admin' )->default( false );
            $table->boolean( 'is_active' )->default( true );
            $table->boolean( 'is_deleted' )->default( false );
            $table->string( 'password', 250 );
            $table->rememberToken(  );
            $table->timestamps(  );
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
        Schema::dropIfExists('users');
    }
}
