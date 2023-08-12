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
            $table->string("component_name")->nullable()->unique();
            $table->longText("component_insert_text")->nullable();
            $table->string("type")->default(\App\Containers\Snippets\Enums\SnippetType::TEMPLATE->value);
            $table->string("language")->default(\App\Containers\Snippets\Enums\SnippetLanguage::DELUGE->value);
            $table->longText('content')->nullable();
            $table->longText("description")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snippets');
    }
};
