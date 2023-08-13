<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('snippets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("type")->default(\App\Containers\Snippets\Enums\SnippetType::TEMPLATE->value);
            $table->longText("description")->nullable();
            $table->longText('content')->nullable();

            $table->string("component_name")->nullable()->unique();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snippets');
    }
};
