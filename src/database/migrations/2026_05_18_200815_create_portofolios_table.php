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
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('slug')
                ->unique();

            $table->string('thumbnail')
                ->nullable();

            $table->text('short_description');

            $table->longText('description')
                ->nullable();

            $table->string('github_url')
                ->nullable();

            $table->string('live_url')
                ->nullable();

            $table->json('tech_stack')
                ->nullable();

            $table->year('year')
                ->nullable();

            $table->boolean('is_featured')
                ->default(false);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};
