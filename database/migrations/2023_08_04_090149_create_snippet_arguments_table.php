<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('snippet_arguments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('snippet_id')
                ->constrained('snippets')
                ->cascadeOnDelete();

            $table->string("name");
            $table->string("type")->nullable();
            $table->string("default")->nullable();
            $table->boolean("required")->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snippet_arguments');
    }
};
