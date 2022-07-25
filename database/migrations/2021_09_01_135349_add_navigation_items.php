<?php

use App\Models\NavigationItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNavigationItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        NavigationItem::create([
            'nl' => 'Home',
            'en' => 'Home',
            'route' => 'home',
        ]);

        NavigationItem::create([
            'nl' => 'Onze Expertise',
            'en' => 'Our Expertise',
            'route' => 'our-expertise',
        ]);

        NavigationItem::create([
            'nl' => 'Onze Realisaties',
            'en' => 'Our Realisations',
            'route' => 'our-realizations',
        ]);

        NavigationItem::create([
            'nl' => 'Over Libaro',
            'en' => 'About Libaro',
            'route' => 'about-libaro',
        ]);

        NavigationItem::create([
            'nl' => 'Vacatures',
            'en' => 'Vacancies',
            'route' => 'vacancies',
        ]);

        NavigationItem::create([
            'nl' => 'Contacteer Ons',
            'en' => 'Contact Us',
            'route' => 'contact-us',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
