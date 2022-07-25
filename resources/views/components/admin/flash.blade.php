@if(session()->has('success'))
    <div x-data="{show: true}"
         x-init="setTimeout(() => show = false, 10000)">

        <div x-show="show" class="fixed bottom-0 right-0 m-8">
            <div class="bg-green-500 text-white font-bold px-5 py-3 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

@if(session()->has('error'))
    <div x-data="{show: true}">
        <div x-show="show" class="fixed bottom-0 right-0 m-8">
            <div class="bg-red-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center">
                {{ session('error') }}

                <div @click="show = false"
                     class="ml-4 cursor-pointer">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endif
