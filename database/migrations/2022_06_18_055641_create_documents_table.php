<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->string('document_no')->unique();
            $table->string('document_subject');
            $table->enum('status', ['on progress', 'approve', 'reject'])->default('on progress');
            $table->enum('remark', ['approve', 'reject'])->nullable();
            $table->string('created_by');
            $table->timestamp('created_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('created_by')->references('username')->on('users');
            $table->foreign('updated_by')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
