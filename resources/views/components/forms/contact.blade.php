<div>
    <form action="{{ route('contact-form') }}" method="POST">
        @csrf

        <x-honeypot />

        <div class="space-y-10 md:px-8 max:px-0">
            <div class="flex items-stretch items-center justify-between flex-col max:flex-row space-y-10 max:space-y-0 max:space-x-10">
                <div class="flex flex-col flex-grow">
                    <label class="text-primary-dark font-grotesk font-extrabold text-lg mb-2" for="name">{{ __('general.name') }}</label>
                    <input class="p-4 border-1 border-primary-dark rounded-md" type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-red-800 text-xs mt-2">{{ __('contact.error-name') }}</div>
                    @enderror
                </div>

                <div class="flex flex-col flex-grow">
                    <label class="text-primary-dark font-grotesk font-extrabold text-lg mb-2" for="email">Email</label>
                    <input class="block p-4 border-1 border-primary-dark rounded-md" type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-red-800 text-xs mt-2">{{ __('contact.error-email') }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col">
                <label class="text-primary-dark font-grotesk font-extrabold text-lg mb-2" for="message">{{ __('general.message') }}</label>
                <textarea class="h-40 p-4 border-1 border-primary-dark rounded-md" id="message" name="message" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="text-red-800 text-xs mt-2">{{ __('contact.error-message') }}</div>
                @enderror
            </div>

            {!! htmlFormSnippet() !!}
            @error('g-recaptcha-response')
            <div class="text-red-800 text-xs mt-2">{{ __('contact.no-robot') }}</div>
            @enderror

            <input class="text-white bg-primary-dark px-6 py-2 rounded-xl shadow-lg hover:shadow-sm uppercase font-bold cursor-pointer transform transition-all" type="submit" value="{{ __('general.send') }}">
        </div>
    </form>
</div>
