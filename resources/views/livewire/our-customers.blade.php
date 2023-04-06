<section class="lg:max-w-8xl mx-auto bg-white px-4 md:px-12 max:px-0">
    <div class="flex flex-col sm:pl-4 md:pl-0 md:flex-row md:items-center justify-between">
        <div>
            <h3 class="font-gilroy font-extrabold text-sm md:text-lg text-secondary uppercase">{{ __('home.success.title') }}</h3>
            <h2 class="font-gilroy font-bold text-2xl md:text-h2 text-primary-darkest md:mt-8 mb-2 md:mb-20">{{ __('home.success.subtitle') }}</h2>
        </div>
        <div class="flex space-x-7.5 lg:mt-0 md:pb-20">
            <div wire:click="goToPreviousPage({{ $customers->onFirstPage() }})"
                 wire:loading.attr="disabled"
                 id="prev"
                 class="h-10 w-10 md:h-20 md:w-20 rounded-full border-2 border-primary-light bg-white flex items-center justify-center bg-white {{ $customers->onFirstPage() ? '' : 'cursor-pointer' }}">
                <x-svg.arrow class="text-primary-darkest transform rotate-180"/>
            </div>

            <div wire:click="goToNextPage({{ $customers->hasMorePages() }})"
                 wire:loading.attr="disabled"
                 id="next"
                 class="h-10 w-10 md:h-20 md:w-20 rounded-full border-2 border-secondary bg-secondary flex items-center justify-center bg-white cursor-pointer">
                <x-svg.arrow class="text-white"/>
            </div>

        </div>
    </div>
    <div class="pt-4 md:pt-0 pb-24 select-none">
        <div id="slider_box"
             class="transform transition duration-300 ease-in-out grid grid-cols-4 gap-10">
            @foreach($customers as $customer)
                <div class="col-span-2 xl:col-span-1 flex justify-center">
                    <a href="{{ route('client.showcase', ['client' => $customer]) }}"
                       class="bg-white hover:z-50 col-span-4 flex-shrink-0 border border-primary-medium rounded-inner-sm w-32 h-32 xs:w-48 xs:h-48 md:w-74 md:h-74 flex items-center justify-center cursor-pointer
                              transform transition duration-300 hover:border-6px hover:border-secondary hover:scale-110">
                        {{ $customer->getFirstMedia('client_logo')->img()->attributes(['class' => 'w-full h-full object-contain p-4']) }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    let elNext = document.getElementById('next');
    let elPrev = document.getElementById('prev');
    let autoscrollDisabled = false;

    function disableAutoScrollCustomers(event) {
        if(event.isTrusted) {
            autoscrollDisabled = true;
        }
    }

    function repeatingFunc() {
        if (autoscrollDisabled) {
            return;
        }

        elNext.click();
        setTimeout(repeatingFunc, 10000);
    }

    elNext.onclick= disableAutoScrollCustomers;
    elPrev.onclick= disableAutoScrollCustomers;

    document.onload = setTimeout(repeatingFunc, 10000);
</script>
