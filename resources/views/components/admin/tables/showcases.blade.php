@props(['showcases'])

<section class="container mx-auto p-6 font-mono">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-hidden">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Visible</th>
                    <th class="px-4 py-3">Client</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Site</th>
                    <th class="px-4 py-3">Edit</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($showcases as $showcase)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-xs border">
                            {{ $showcase->id }}
                        </td>
                        <td class="px-4 py-3 text-ms font-semibold border">
                            @if($showcase->visible)
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Visible </span>
                            @else
                                <span class="px-2 py-1 font-semibold leading-tight text-yellow-700-700 bg-yellow-100 rounded-sm"> Hidden </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm border">{{ $showcase->client->name }}</td>
                        <td class="px-4 py-3 text-sm border">{{ $showcase->name }}</td>
                        <td class="px-4 py-3 text-xs border">
                            @if($showcase->visible)
                                <a href="{{ config('app.url/') . $showcase->route }}">View</a>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-xs border">
                            <a href="{{ route('admin.showcases.edit', ['showcase' => $showcase]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>

{{ $showcases->links() }}
