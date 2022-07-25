@props([
    'key'
])

<div class="grid grid-cols-24 px-8 max:px-0">

    <div class="col-span-24 max:col-span-7 flex flex-col md:flex-row md:items-center max:justify-between pt-29 max:pt-0">

        <span class="self-start md:self-center text-secondary font-gilroy font-extrabold text-xl border-b-4 border-secondary pb-2 mb-8 md:mb-0 mr-8 max:mr-0">
            {{ ($key->number > 9 ? '': '0') . $key->number }}.
        </span>

        <span class="font-gilroy font-extrabold text-5xl text-primary-darkest text-right ml-4">
            {{ __($key->title) }}
        </span>

    </div>
    <p class="col-span-24 max:col-start-10 max:col-span-15 font-grotesk font-semibold text-2xl py-29 text-primary-darkest">
        {{ __($key->body) }}
    </p>

</div>
