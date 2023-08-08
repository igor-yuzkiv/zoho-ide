<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('snippets', function (Blueprint $table) {
            $table->string("type")->default(\App\Containers\Deluge\Enums\SnippetType::TEMPLATE->value);
        });
    }

    public function down(): void
    {
        Schema::table('snippets', function (Blueprint $table) {
            //
        });
    }
};
