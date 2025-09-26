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
        Schema::table('landing_page_showcase', function (Blueprint $table) {
            $table->renameColumn('showcase_id', 'project_id');
        });

        Schema::rename('landing_page_showcase', 'landing_page_project');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_page_showcases', function (Blueprint $table) {
            $table->renameColumn('project_id', 'showcase_id');
        });

        Schema::rename('landing_page_project', 'landing_page_showcase');
    }
};
