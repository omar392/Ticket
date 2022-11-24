<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            // $table->id()->startingValue(1200);
            // $table->foreignId('department_id')->constrained('departments');
            // $table->foreignId('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->enum('user_type',['employee','customer'])->default('customer');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('code')->default(rand(1111, 9999));
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('isVerified')->default(false);
            $table->string('google_token')->nullable();
            $table->boolean('active')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};