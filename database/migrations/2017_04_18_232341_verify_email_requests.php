<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VerifyEmailRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_email_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('token')->unique();  // should I specify it's a hashed token?
            $table->string('created')->default(Carbon\Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verify_email_requests');
    }
}
