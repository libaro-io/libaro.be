<?php

use App\Models\NavigationItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameBlogRouteToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        NavigationItem::withoutGlobalScopes()
            ->where('route', 'blog')
            ->update(['route' => 'articles']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No way down
    }
}
