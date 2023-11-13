@props([
    'number',
    'title',
    'body',
    'prose' => false
])
<div class="grid grid-cols-24 px-8 max:px-0  lg:pt-4 lg:pb-12 ">

    <div class="col-span-24 max:col-span-10 flex flex-col md:flex-row max:justify-between max:pt-0">

        <span class="self-start text-secondary font-gilroy font-extrabold text-xl border-b-4 border-secondary pb-1 lg:pb-2 mb-8 md:mb-0 mr-8 max:mr-0">
            {{ ($number > 9 ? '' : '0') . $number }}.
        </span>

        <span class="font-gilroy font-extrabold text-2xl lg:text-4xl text-primary-darkest lg:text-right">
            {{ __($title) }}
        </span>

    </div>

    <div class="col-span-24 max:col-start-13 max:col-span-10 font-grotesk font-semibold text-lg lg:text-xl text-primary-darkest pt-4 pb-12 max:pt-0 max:pb-0">
        <div class="font-grotesk font-semibold text-primary-darkest {{ $prose ? 'prose' : '' }} inline-body">
            {!! $body !!}
        </div>
    </div>

</div>
