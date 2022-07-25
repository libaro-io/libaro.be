@props(['showcase'])

<div class="my-12">
    <div class="col-span-3 pt-12 flex items-center justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Keys</h3>
            <p class="mt-1 text-sm text-gray-600">
                All keys related to this showcase
            </p>
        </div>
        <div>
            <x-admin.buttons.create route="{{ route('admin.keys.create', ['showcase' => $showcase]) }}"/>
        </div>
    </div>
    <section class="container mx-auto py-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-hidden">
                <table class="w-full">
                    <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Visible</th>
                        <th class="px-4 py-3">Number</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Body</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($showcase->keys as $key)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-xs border">
                                {{ $key->id }}
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                @if($key->visible)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Visible </span>
                                @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-yellow-700-700 bg-yellow-100 rounded-sm"> Hidden </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm border">{{ $key->number }}</td>
                            <td class="px-4 py-3 text-sm border">{{ $key->title }}</td>
                            <td class="px-4 py-3 text-sm border">{{ $key->body }}</td>

                            <td class="px-4 py-3 text-xs border">
                                <a href="{{ route('admin.keys.edit', ['showcase' => $showcase, 'key' => $key->id]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
