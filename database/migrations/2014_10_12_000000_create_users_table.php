<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

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
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('show_password')->nullable();
            $table->integer('role')->nullable();
            $table->integer('otp')->nullable();
            $table->integer('otp_verify')->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->string('push_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'first_name' => 'Admin',
                'email' => "admin@popularstudio.com",
                'password' => bcrypt("admin@123"),
                'show_password' => "admin@123",
                'role' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
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
