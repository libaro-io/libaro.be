<?php

use App\Models\LandingPage;
use App\Models\Showcase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('skill');
            $table->string('target');
            $table->string('location');
            $table->string('title')->nullable();
            $table->text('text1')->nullable();
            $table->text('text2')->nullable();
            $table->text('text3')->nullable();
            $table->string('slug');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('landing_page_showcase', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Showcase::class);
            $table->foreignIdFor(LandingPage::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_pages');
    }
}
