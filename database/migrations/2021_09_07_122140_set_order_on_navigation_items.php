<?php

use App\Models\NavigationItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetOrderOnNavigationItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        NavigationItem::where('route', 'home')
            ->update(['order' => 1]);

        NavigationItem::where('route', 'our-expertise')
            ->update(['order' => 2]);

        NavigationItem::where('route', 'our-realizations')
            ->update(['order' => 3]);

        NavigationItem::where('route', 'about-libaro')
            ->update(['order' => 4]);

        NavigationItem::where('route', 'vacancies')
            ->update(['order' => 5]);

        NavigationItem::where('route', 'articles')
            ->update(['order' => 6]);

        NavigationItem::where('route', 'contact-us')
            ->update(['order' => 7]);
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
