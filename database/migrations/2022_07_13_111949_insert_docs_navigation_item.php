<?php

use App\ValueObjects\MenuType;
use App\Models\NavigationItem;
use Illuminate\Database\Migrations\Migration;

class InsertDocsNavigationItem extends Migration
{
    public function up()
    {
        NavigationItem::create([
            'visible' => 1,
            'menu' => MenuType::SECONDARY,
            'nl' => 'Docs',
            'en' => 'Docs',
            'route' => 'docs',
            'order' => 7,
        ]);
    }
}
