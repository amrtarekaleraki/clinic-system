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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('patient_name', 255);
            $table->foreignId('patient_id')->nullable()->constrained('patients')->cascadeOnDelete();
            // $table->string('disea_name', 255);
            $table->foreignId('disea_id')->nullable()->constrained('diseases');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors');
            $table->string('disease_number', 255);
            $table->date('invoice_Date')->nullable();
            $table->decimal('Discount',8,2);
            $table->string('Status', 50);
            $table->string('note', 255);
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
        Schema::dropIfExists('invoices');
    }
};





