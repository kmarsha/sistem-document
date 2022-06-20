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
        Schema::create('document_detail', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->id();
            $table->string('document_no');
            $table->string('nama_nasabah');
            $table->string('amount');
            $table->timestamps();

            $table->foreign('document_no')->references('document_no')->on('documents')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_detail');
    }
};
