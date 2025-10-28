<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('clients')) {
            return;
        }

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->boolean('visible')->default(1);
            $table->timestamps();
            $table->unsignedInteger('weight')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
}
