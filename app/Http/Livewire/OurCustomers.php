<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class OurCustomers extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.our-customers', ['customers' => Client::query()->with('media')->where('visible', 1)->has('showcases')->orderBy('weight', 'desc')->orderBy('id')->paginate(8)]);
    }

    public function getCustomers()
    {
        return Client::query()
            ->where('visible', 1)
            ->has('showcases')
            ->orderBy('weight', 'desc')
            ->paginate(8);
    }

    public function goToPreviousPage(Bool $onFirstPage = false)
    {
        if(!$onFirstPage) {
            $this->previousPage();
        }
    }

    public function goToNextPage(Bool $hasMorePages = false)
    {
        if(!$hasMorePages) {
            $this->resetPage();
        } else {
            $this->nextPage();
        }
    }

}
