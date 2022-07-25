<div class="my-12">

    <div class="md:grid md:grid-cols-3 md:gap-6 mt-12">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Delete</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Delete this Client.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('admin.clients.delete', ['client' => $client ]) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                Client with id: {{ $client->id }}, which is currently
                                <span class="block font-bold bg-gray-100 px-2 py-1 mx-2">@if(!$client->visible)  not @endif visible </span>
                                on the site.
                            </div>

                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

