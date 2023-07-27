<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deluge_components', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("module_id");

            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('insertText');
            $table->json("attributes")->nullable();
            $table->json("slots")->nullable();

            $table->foreign('module_id')
                ->references('id')->on('deluge_modules')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deluge_components');
    }
};
