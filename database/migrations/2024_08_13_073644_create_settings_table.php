<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("start_work");
            $table->string("morning_or_night");
            $table->string("working_hours")->default(0);;
            $table->string("patient_minutes")->default(0);
            $table->string("break")->nullable();
            $table->boolean("type_work")->default(1);
            $table->integer("number_of_patients")->default(0);
            $table->boolean('reset_register')->default(0);
            $table->tinyInteger('cid_number')->default(14);


            $table->date("start_register")->nullable();
            $table->date("end_register")->nullable();

            $table->integer('default_money')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
