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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('otp')->unique();
            $table->dateTime('issued_at');
            $table->timestamp('email_verified_at')->nullable();

            /* Foreign Keys */
            $table->unsignedBigInteger('status_id')->nullable();

            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            /* Add Soft Deletes Entries */
            $table->softDeletes();

            /* Foreign Key Checks */
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('set null');
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
