@props([
    'quote',
])

<div class="grid grid-cols-24 md:-mt-48 lg:-mt-64">
    <div class="col-span-24 lg:col-start-5 lg:col-span-4">
        <div class="flex items-center justify-center">
            <div class="w-44 h-44 rounded-full border-2 border-primary-light bg-white p-3 ">
                <img class="rounded-full w-full h-full block" src='{{ asset("/storage/$quote->image_person") }}' alt="Head">
            </div>
        </div>
    </div>

    <div class="flex items-center col-span-24 lg:col-start-10 lg:col-span-14">
        <p class="text-center lg:text-left pt-20 lg:pt-0 font-grotesk font-semibold text-4xl text-primary-darkest">
            {{ __($quote->body) }}
        </p>
    </div>

    <div class="col-span-24 lg:col-start-10 lg:col-span-15">
        <p class="text-center lg:text-left font-gilroy font-extrabold text-xl uppercase text-secondary py-15">
            {{ $quote->by }}  • {{ $quote->job_title }}
        </p>
    </div>
</div>
