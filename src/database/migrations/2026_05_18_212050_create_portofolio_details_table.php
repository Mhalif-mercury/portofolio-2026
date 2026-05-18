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
        Schema::create('portofolio_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('portofolio_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('project_description');

            $table->longText('problem_analysis');

            $table->longText('system_requirements')
                ->nullable();

            $table->longText('architecture_explanation');

            $table->longText('tech_stack_explanation');

            $table->string('erd_image')
                ->nullable();

            $table->string('flowchart_image')
                ->nullable();

            $table->longText('conclusion')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_details');
    }
};
