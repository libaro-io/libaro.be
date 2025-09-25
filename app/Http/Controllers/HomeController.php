<?php

namespace App\Http\Controllers;


use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
            ->paginate(5)
            ->through(fn(Client $client) => ClientResource::make($client));
    }

    private function getProjects (): Collection
    {
        $randomShowcaseIds = Showcase::query()
            ->where('visible', true)
            ->where('pin_on_homepage', '=', 1)
            ->select('id')
            ->pluck('id')
            ->whenNotEmpty(fn (Collection $c) => $c->random(3));

        return Showcase::query()
            ->with('client')
            ->with('media')
            ->select('id', 'client_id', 'slug', 'name', 'type', 'is_product')
            ->whereIn('id', $randomShowcaseIds)
            ->get();
    }
}
