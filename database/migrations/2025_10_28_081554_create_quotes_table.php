<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('quotes')) {
            return;
        }

        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('showcase_id');
            $table->boolean('visible')->default(1);
            $table->text('body');
            $table->string('by');
            $table->string('job_title');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
}
