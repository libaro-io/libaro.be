@props(['showcase', 'key'])

<div class="mt-12">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Key</h3>
                <p class="mt-1 text-sm text-gray-600">
                    This information will be displayed publicly so be careful what you share.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('admin.keys.update', ['showcase' => $showcase, 'key' => $key]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input name="visible" type="hidden" value="0">
                                <input id="visible" name="visible" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="1" {{ $key->visible ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="visible" class="font-medium text-gray-700">Visible</label>
                                <p class="text-gray-500">Show this Key on the site?</p>

                                @error('visible')
                                <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="number" class="block text-sm font-medium text-gray-700">Number</label>
                                <select id="number" name="number" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @for($i = 1; $i < 20; $i++)
                                        <option {{ $i == $key->number ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            @error('number')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $key->title }}">

                            @error('title')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700">
                                Body
                            </label>
                            <div class="mt-1">
                                <textarea id="body" name="body" rows="15" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ $key->body }}</textarea>
                            </div>

                            @error('body')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
