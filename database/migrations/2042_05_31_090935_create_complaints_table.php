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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('user_id')->constrained('users');

            $table->text('complaint_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->enum('status',['new','pending','waiting','finished'])->default('new');
            $table->string('attached')->nullable();
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
        Schema::dropIfExists('complaints');
    }
};
