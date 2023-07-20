<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_connections', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("project_id");
            $table->integer("status")->default(0);

            $table->string('client_id');
            $table->string('client_secret');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->string('data_center');
            $table->string('domain');
            $table->timestamp('expire');

            $table->foreign("project_id")
                ->references('id')
                ->on("projects")
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_connections');
    }
};
