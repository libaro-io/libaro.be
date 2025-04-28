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
                <div class="bg-primary-light p-8 sm:p-10 flex flex-col text-center items-center justify-center space-y-8">
                    <img class="max-h-12 object-contain" src="{{ asset('storage/images/libaro_icon.png') }}" alt="Icons" width="125" height="38">
                    <a class="text-white bg-primary-dark px-6 py-2 rounded-xl shadow-lg hover:shadow-sm uppercase font-bold cursor-pointer transform transition-all" 
                        href="https://drive.google.com/drive/folders/10jTaSiD9pi7aIr2Ax5JDmS8e5EYo3KQZ?usp=drive_link" 
                        target="_blank" type="button">
                        Download
                    </a>
                </div>
                <div class="bg-primary-light p-6 sm:p-10 flex flex-col text-center items-center justify-center space-y-8">
                    <img class="max-h-12 w-full object-contain" src="{{ asset('storage/images/libaro_logo_full_blue_without_tagline.svg') }}" alt="Logo without tagline" width="158" height="48">
                    <a class="text-white bg-primary-dark px-6 py-2 rounded-xl shadow-lg hover:shadow-sm uppercase font-bold cursor-pointer transform transition-all"  
                        href="https://drive.google.com/drive/folders/1M69eO-UTlz70OkKHHqxlHmGcid336Bho?usp=drive_link" 
                        target="_blank" type="button">
                        Download
                    </a>
                </div>
                <div class="bg-primary-light p-6 sm:p-10 flex flex-col text-center items-center justify-center space-y-8">
                    <img class="max-h-12 w-full object-contain" src="{{ asset('storage/images/libaro_logo_full_blue.svg') }}" alt="Full logo" width="158" height="48">
                    <a class="text-white bg-primary-dark px-6 py-2 rounded-xl shadow-lg hover:shadow-sm uppercase font-bold cursor-pointer transform transition-all" 
                        href="https://drive.google.com/drive/folders/1HeVwqq0_leXVphWHuRbVxRaAQ6rRBUvT?usp=drive_link" 
                        target="_blank" type="button">
                        Download
                    </a>
                </div>
              </div>
            </div>
          </div>
    </section>
</main>
</x-layout>
