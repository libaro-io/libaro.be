<div
    style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">
    <div class="xl:max-w-8xl mx-auto grid grid-cols-24 px-4 md:px-6 xl:px-0 xl:py-16">
        <img class="col-span-24 max-h-96 md:max-h-full md:col-span-14 md:row-span-3 object-contain w-full flex self-center
                    transform transition ease-in-out duration-500 hover:rotate-45 hover:scale-95x"
             src="{{ asset('/storage/images/clock_front.png') }}" alt="">
        <h2 class="text-h3 font-gilroy font-bold leading-snug text-white sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl md:leading-tight flex items-center
                  col-span-24 md:col-start-15 md:col-span-8 md:mt-10">
            {{ __('cta.contact.title') }}
        </h2>
        <p class="font-grotesk font-semibold text-base md:text-2xl my-10 lg:my-0 text-white
                 col-span-24 md:col-start-15 md:col-span-8">
            {{ __('cta.contact.body') }}
        </p>
        <div class="group col-span-24 md:col-start-15 md:col-span-10">
            <a href="{{ route('contact-us') }}">
                <div class="mb-10 text-white pl-7.5 py-5 bg-primary-medium bg-opacity-80 rounded-outer-md inline-flex items-center
                      group-hover:bg-secondary-light group-hover:border-secondary-light
                      transition duration-500 ease-in-out cursor-pointer">
                    <span
                        class="mr-6 font-grotesk font-extrabold text-base md:text-2xl">{{ __('cta.contact.button') }}</span>
                    <span class="flex items-center justify-center mr-4 h-8 w-8 lg:h-12 lg:w-12 rounded-full
                            bg-secondary text-white
                            group-hover:bg-white group-hover:text-secondary-light
                            transition duration-500 ease-in-out">
                     <x-svg.arrow/>
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>
