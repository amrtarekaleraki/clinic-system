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
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_name');
            $table->string('patient_number')->nullable();
            $table->string('patient_address')->nullable();
            // $table->string('visit_status');
            $table->foreignId('visit_id')->nullable()->constrained('visits')->cascadeOnDelete();
            // $table->string('patient_doctor');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
            $table->text('note')->nullable();
            $table->date('patient_Date');
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
};
