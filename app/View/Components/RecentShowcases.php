<?php

namespace App\View\Components;

use App\Models\Showcase;
use Illuminate\View\Component;

class RecentShowcases extends Component
{
    public function render()
    {
        $showcases = Showcase::with('client')
            ->inRandomOrder()
            ->where('visible', true)->where('pin_on_homepage', '=', 1)
            ->select('id', 'client_id', 'slug', 'name', 'type', 'image_card')
            ->limit(3)
            ->get();

        return view('components.recent-showcases', ['showcases' => $showcases]);
    }
}
