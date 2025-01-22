<x-layout>
    @section('title', page_title(__('products.title')))

    <x-nav-bottom-container :dark=true/>

    <div class="relative pt-12 max:pt-0">
        <div
            class="hidden xl:block bg-primary-light absolute inset-0 mt-96 mb-64 border-b-30 border-t-30 border-primary-medium border-opacity-5"></div>

        <main class="relative max-w-8xl mx-auto">
            <div id="data-wrapper" class="grid grid-cols-24 auto-rows-minx">
                <div
                    class="row-span-1 row-start-1 col-span-24 max:col-span-12 mx-4 md:mx-14 max:mx-0 mt-32 md:mt-16 max:mt-0 pb-8 max:pb-0 max:min-h-500">
                    <h2 class="font-gilroy font-extrabold text-lg uppercase text-secondary mb-4">{{ __('products.subtitle') }}</h2>
                    <h1 class="font-gilroy font-bold text-4xl md:text-7xl text-primary-darkest mb-10 md:mb-15">{{ __('products.title') }}</h1>
                    <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">{{ __('products.intro.first_paragraph') }}</p>
                    <p class="font-grotesk font-semibold text-xl md:text-2xl text-primary-darkest">{!! __('products.intro.second_paragraph') !!}</p>

                    @if($filters)
                        <p class="mt-4 font-grotesk font-semibold text-xl text-primary-darkest">{{ __('products.with_tags') }} {{ implode(', ', $filters) }}</p>
                        <a href="{{ route('our-realizations') }}"
                           class="flex items-center font-grotesk text-lg text-primary-dark mt-2.5 hover:underline">{{ __('products.clear_tags') }} <x-svg.arrow/>
                        </a>
                    @endif
                </div>
            </div>
            <!-- Data Loader -->
            <div class="auto-load text-center">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
                     xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite"/>
                </path>
            </svg>
            </div>
        </main>


    </div>

    <div id="nav-bottom">
        <x-nav-bottom/>
    </div>

    <x-footer/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $('#nav-bottom').offset().top) {
                page++;
                infinteLoadMore(page);
            }
        });

        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/nl/producten?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
</x-layout>

