<?php

namespace App\Http\Controllers;


use App\Http\Resources\HomeClientResource;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('website/home', [
            'clients' => Inertia::defer(fn() => $this->getClients())
        ]);
    }

    private function getClients(): LengthAwarePaginator
    {
        return Client::query()
        ->where('visible', 1)
        //->has('showcases')
        ->orderBy('weight', 'desc')
        ->paginate(8)
            ->through(fn (Client $client) => HomeClientResource::make($client));
    }
}
