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
        Schema::create('alhajzs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->string("hour")->nullable();
            $table->foreignId('reason_id')->nullable()->constrained()->nullOnDelete();
            $table->date("register_days");

            $table->tinyInteger('status')->default(1);
            $table->integer('number');
            $table->string('details')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alhajzs');
    }
};
