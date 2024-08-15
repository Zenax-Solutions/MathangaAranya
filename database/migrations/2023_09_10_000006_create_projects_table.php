<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('short_description');
            $table->longText('description')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('feature_image');
            $table->json('gallery')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price')->nullable();
            $table->boolean('publish')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
