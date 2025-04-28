<x-layout>
    @section('title', page_title(__('footer.assets')))

    <div class="hidden max:block border-b-10 border-secondary"
    style="background-image: url('{{ asset('/storage/images/header_striped.jpg') }}'); background-repeat: no-repeat; background-size: cover">
   <div class="max:max-w-8xl mx-auto">
       <div class="hidden max:block">
           <x-nav />

       </div>
       <div class="pt-24">
           <x-header-single-column title="{{ __('footer.assets') }}"
                                   subtitle="{{ __('footer.branding') }}"
                                   body="{{ __('footer.assets_intro') }}"
           />
       </div>
   </div>
</div>

<div x-data="{ show: false }" class="max:hidden relative">
   <div style="background-image: url('{{ asset('/storage/images/header_bg.png') }}'); background-repeat: no-repeat; background-size: cover">
       <div class="relative max:max-w-8xl mx-auto">
           <x-header-single-column title="{{ __('footer.assets') }}"
                                   subtitle="{{ __('footer.branding') }}"
                                   body="{{ __('footer.assets_intro') }}"
           />
       </div>
   </div>
   <x-header-hamburger :dark=false />
   <div x-show="show"
        x-transition:enter="transition transform duration-1000"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="z-30 bg-primary-dark fixed top-0 left-0 min-h-screen w-screen">
       <x-nav-full-screen/>
   </div>
</div>
<main class="lg:mt-24">
    <section>
        <div class="bg-white pb-24 sm:py-32">
            <div class="mx-auto max-w-8xl px-6 lg:px-8">
              <div class="-mx-6 grid grid-cols-2 gap-0.5 overflow-hidden sm:mx-0 sm:rounded-inner md:grid-cols-3 gap-2">
                <div class="bg-primary-light p-8 sm:p-10 flex text-center items-center justify-center">
                    <a href="https://drive.google.com/file/d/1q0o5icwiK5Z_lwdZchx1II_8LTkU5MOv/view?usp=drive_link" target="_blank">
                        <img class="max-h-12 object-contain" src="{{ asset('storage/images/libaro_icon.png') }}" alt="Transistor" width="125" height="38">
                    </a>
                </div>
                <div class="bg-primary-light p-6 sm:p-10">
                    <a href="https://drive.google.com/file/d/18c-Y-pHDRHKRn29LPo3pQYY30uMjKxHL/view?usp=drive_link" target="_blank">
                        <img class="max-h-12 w-full object-contain" src="{{ asset('storage/images/libaro_logo_full_blue_without_tagline.svg') }}" alt="Reform" width="158" height="48">
                    </a>
                </div>
                <div class="bg-primary-light p-6 sm:p-10">
                    <a href="https://drive.google.com/file/d/18a2HQB02EYdmOUF-YABj1ucCvBXNXvmS/view?usp=drive_link" target="_blank">
                        <img class="max-h-12 w-full object-contain" src="{{ asset('storage/images/libaro_logo_full_blue.svg') }}" alt="Tuple" width="158" height="48">
                    </a>
                </div>
                <div class="bg-primary-dark p-6 sm:p-10 flex text-center items-center justify-center">
                    <a href="https://drive.google.com/file/d/1XM09o0Dr405TenqEEQQZef94GoJT2_lt/view?usp=drive_link" target="_blank">
                        <img class="max-h-12 object-contain" src="{{ asset('storage/images/libaro_icon_white.png') }}" alt="" width="125" height="38">
                    </a>
                </div>
                <div class="bg-primary-dark p-6 sm:p-10">
                    <a href="https://drive.google.com/file/d/1zFLtwH6ixRkn4nP9dKoIkLZ2h0YwCBUd/view?usp=drive_link" target="_blank">
                        <img class="max-h-12 w-full object-contain" src="{{ asset('storage/images/libaro_logo_full_white_without_tagline.svg') }}" alt="SavvyCal" width="158" height="48">
                    </a>
                </div>
                <div class="bg-primary-dark p-6 sm:p-10">
                    <a href="https://drive.google.com/file/d/1JeIY_lQ6S_wbbRGsdXmh6yN6Oqi20wJo/view?usp=drive_link" target="_blank">
                        <img class="max-h-12 w-full object-contain" src="{{ asset('storage/images/libaro_logo_full_white.svg') }}" alt="Statamic" width="158" height="48">
                    </a>
                </div>
              </div>
            </div>
          </div>
    </section>
</main>
</x-layout>
