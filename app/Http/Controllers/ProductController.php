<?php

namespace App\Http\Controllers;

use Spatie\Tags\Tag;
use App\Models\Showcase;
use Illuminate\Http\Request;
use App\ValueObjects\Domains;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('domain', Domains::PRODUCTS);

        if (request()->has('filter')) {
            $filters = explode(',', request()->filter);
            $showcases = Showcase::query()
                ->where('is_product', 1)
                ->where('visible', 1)
                ->withAnyTags($filters)
                ->orderBy('date', 'desc')
                ->orderBy('id', 'asc')
                ->paginate(6);
        } else {
            $filters = null;
            $showcases = Showcase::query()
                ->where('is_product', 1)
                ->where('visible', 1)
                ->orderBy('date', 'desc')
                ->orderBy('id', 'asc')
                ->paginate(6);
        }

        if (request()->ajax()) {
            $results = '';
            foreach ($showcases as $showcase) {
                $img = $showcase->getFirstMedia('showcase_card')->img()->attributes(['class' => 'relative h-full w-full object-cover overflow-hidden lg:rounded-inner'])->toHtml();
                $showcaseName = Str::limit($showcase->name, 50);
                $clientName = $showcase->client->name;
                $results .= <<<END
                                <div class="h-420 md:h-620 lg:h-840 bg-white col-span-24 max:col-span-12 max:row-span-2 border-2 border-primary-medium border-opacity-20 overflow-hidden lg:rounded-outer lg:mx-10 lg:mb-90
                                        transition duration-300 transform hover:scale-105">
                                    <a href="$showcase->routeProduct" class="relative block h-full md:p-5">
                                        <div class="absolute z-30 md:m-5 inset-0 bg-gradient-to-t from-primary-darkest via-transparent to-transparent opacity-80 overflow-hidden lg:rounded-inner"></div>
                                            $img
                                        <div class="absolute z-40 bottom-6 md:bottom-12 lg:bottom-20 left-0 px-4 sm:px-20">
                                            <h3 class="font-gilroy font-light leading-relaxed tracking-wide text-sm uppercasex bg-secondary text-white mb-5 max-w-max px-3 py-1 rounded-lg">$showcase->type</h3>
                                            <h2 class="font-gilroy font-bold text-2xl sm:text-6xl text-white mb-3">$showcaseName</h2>
                                            <p class="font-grotesk font-semibold text-lg text-white">$clientName</p>
                                        </div>
                                    </a>
                                </div>
                                END;
            }
            return $results;
        }

        return view('products.index', [
            'showcases' => $showcases,
            'filters' => $filters,
            'title' => 'our_products',
        ]);
    }

    /**
     * Return a view for a particular Showcase which is marked as visible
     *
     * @param Showcase $showcase
     * @param Request $request
     * @return View
     */
    public function show(Showcase $showcase, Request $request): View
    {
        $request->session()->put('domain', Domains::PRODUCTS);

        $showcase = Showcase::find($showcase->id);

        return view('showcases.show', [
            'showcase' => $showcase->load('keys', 'quotes'),
            'tags' => $showcase->getMappedTags(),
        ]);
    }
}
