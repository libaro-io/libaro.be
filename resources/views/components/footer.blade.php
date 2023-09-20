<footer class="font-grotesk font-semibold text-lg bg-primary-light py-20 px-4 sm:px-0 text-primary-darkest">
    <div class="max-w-xs md:max-w-8xl mx-auto md:px-4 grid gap-y-10 gap-x-8 grid-cols-4">
        <div class="col-span-4 md:col-span-2 xl:col-span-1 flex flex-col">
            <h2 class="font-gilroy font-extrabold uppercase text-primary-medium mb-4 lg:mb-10">&copy; {{ date("Y") }}</h2>
            <p class="text-footer">{{ __("general.about-us") }}</p>
        </div>
        <div class="col-span-4 md:col-span-2 xl:col-span-1 flex flex-col">
            <h2 class="font-gilroy font-extrabold uppercase text-primary-medium mb-4 lg:mb-10">{{ __('footer.contact-details') }}</h2>
            <div class="flex flex-col space-y-2">
                <div class="flex items-center">
                    <div class="relative w-16 h-16 mr-4">
                        <img class="rounded-full w-16 h-16" src="{{ asset('storage/images/bert.jpg') }}" alt="Image of Bert" />
                        <div class="absolute bottom-0 right-0 mr-1 w-3 h-3 rounded-full bg-green-500 border-2 border-white"></div>
                    </div>
                    <div class="mb-4 md:mb-0 text-footer font-grotesk text-lg mb-2 flex flex-col justify-between">
                        <a class="hover:underline" href="mailto:bert@libaro.be">bert@libaro.be</a>
                        <div>+32 (0)494 207025</div>
                    </div>
                </div>
                <div class="text-footer">
                    <p>Vaartdijkstraat 19</p>
                    <p>8200 {{ __('general.brugge') }}</p>
                </div>
            </div>
        </div>
        <div class="col-span-4 md:col-span-2 xl:col-span-1 flex flex-col">
            <h2 class="font-gilroy font-extrabold uppercase text-primary-medium mb-4 lg:pb-10">{{ __('footer.financial') }}</h2>
            <div class="text-footer">
                BTW BE0541352248
            </div>
            <div class="text-footer">
                REK BE03 7360 0710 2484
            </div>
        </div>
        <div class="col-span-4 md:col-span-2 xl:col-span-1 flex flex-col">
            <h2 class="font-gilroy font-extrabold uppercase text-primary-medium mb-4 lg:mb-10">{{ __('footer.privacy-respect') }}</h2>
            <div class="flex flex-col space-y-2">
                <a href="{{ route('privacy') }}" class="text-footer">{{ __('footer.privacy') }}</a>
                <a href="{{ route('cookie') }}" class="text-footer">{{ __('footer.cookie') }}</a>
                <a href="{{ route('terms') }}" class="text-footer">{{ __('footer.general-terms') }}</a>
            </div>
        </div>
        <div class="col-span-4 md:col-span-2 xl:col-span-1 flex flex-col">
            <h2 class="font-gilroy font-extrabold uppercase text-primary-medium mb-4 lg:mb-10">{{ __('footer.follow-us') }}</h2>
            <div class="flex space-x-5">
                <a href="https://www.facebook.com/libaro1?fref=ts" target="_blank" class="flex w-10.5 h-10.5 items-center justify-center rounded-full border-4 bg-primary-dark border-primary-dark">
                    <i class="text-white text-2xl fab fa-facebook-f"></i>
                </a>
                <a href="https://www.linkedin.com/company/libaro" target="_blank" class="flex w-10.5 h-10.5 items-center justify-center rounded-full bg-primary-darkest">
                    <i class="text-white text-2xl fab fa-linkedin-in"></i>
                </a>
                <a href="mailto:info@libaro.be" class="flex w-10.5 h-10.5 items-center justify-center rounded-full bg-primary-dark">
                    <i class="text-2xl text-white far fa-paper-plane"></i>
                </a>
                <a href="https://github.com/libaro-io" title="open source packages" target="_blank" class="flex w-10.5 h-10.5 items-center justify-center rounded-full bg-primary-darkest">
                    <i class="text-white text-2xl fab fa-github"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
