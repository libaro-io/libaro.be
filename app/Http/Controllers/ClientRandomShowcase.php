<?php

namespace App\Http\Controllers;

use App\Models\VisibleClient;
use App\Models\VisibleShowcase;

class ClientRandomShowcase extends Controller
{
    public function __invoke(VisibleClient $client)
    {
        $showcase = VisibleShowcase::query()
            ->where('client_id', $client->id)
            ->inRandomOrder()
            ->first();

        return redirect()->route('showcase', ['showcase' => $showcase]);
    }
}
