<div class="bg-projects-bg border-b-30 border-project-border py-10.5 xl:py-0 xl:h-768">
    <div class="relative max-w-9xl mx-auto">
        <div class="xl:absolute xl:top-0 xl:left-0 xl:bg-white xl:rounded-outer-sm xl:shadow-2xl grid xl:grid-cols-3 gap-10.5 xl:-mt-14 p-7.5">

            @foreach($showcases as $showcase)
                <x-recent-showcase-card :showcase="$showcase" />
            @endforeach

        </div>
    </div>
</div>

