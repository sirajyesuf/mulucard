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
        Schema::create('iframes', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('vcard_id');
            $table->timestamps();

            $table->foreign('vcard_id')->references('id')->on('vcards')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iframes');
    }
};
