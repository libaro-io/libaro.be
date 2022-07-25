@props([
    'repositories'
])

<div class="container mx-auto my-24">
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        @foreach($repositories as $repository)
            <a href="{{ route('docs.show', ['repository' => $repository->slug]) }}" class="flex flex-col justify-between border border-gray-200 shadow-md rounded-md col-span-1 px-8 pt-8 cursor-pointer hover:bg-gray-50 hover:shadow-lg transition-all duration-200">
                <h3 class="text-primary-dark">
                    {{ $repository->name }}
                </h3>
                <p class="text-gray-700 mt-4 text-sm">
                    {{ $repository->description }}
                </p>
                <ul class="flex justify-between mt-4 bg-gray-50 rounded-b-md py-2 -mx-8 px-8">
                    <li class="flex items-center text-gray-600 text-sm">
                        <div>
                            Last updated {{ $repository->lastUpdated->diffForHumans() }}
                        </div>
                    </li>
                    <li class="flex items-center text-gray-600 text-sm">
                        Version: {{ $repository->lastRelease }}
                    </li>
                </ul>
            </a>
        @endforeach
    </div>
</div>
