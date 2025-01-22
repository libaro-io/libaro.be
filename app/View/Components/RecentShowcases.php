<?php

namespace App\View\Components;

use App\Models\Showcase;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class RecentShowcases extends Component
{
    public function render()
    {
        $randomShowcaseIds = Showcase::query()
            ->where('visible', true)
            ->where('pin_on_homepage', '=', 1)
            ->select('id')
            ->pluck('id')
            ->whenNotEmpty(fn (Collection $c) => $c->random(3));

        $showcases = Showcase::query()
            ->with('client')
            ->with('media')
            ->select('id', 'client_id', 'slug', 'name', 'type', 'is_product')
            ->whereIn('id', $randomShowcaseIds)
            ->get();

        return view('components.recent-showcases', ['showcases' => $showcases]);
    }
}
