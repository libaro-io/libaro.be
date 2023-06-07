@props(['showcase'])

<div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Showcase</h3>
                <p class="mt-1 text-sm text-gray-600">
                    This information will be displayed publicly so be careful what you share.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('admin.showcases.update', ['showcase' => $showcase ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input name="visible" type="hidden" value="0">
                                <input id="visible" name="visible" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="1" {{ $showcase->visible ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="visible" class="font-medium text-gray-700">Visible</label>
                                <p class="text-gray-500">Show this Showcase on the site?</p>

                                @error('visible')
                                <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input name="pin_on_homepage" type="hidden" value="0">
                                <input id="pin_on_homepage" name="pin_on_homepage" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="1" {{ $showcase->pin_on_homepage ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="pin_on_homepage" class="font-medium text-gray-700">Pin on the homepage</label>
                                <p class="text-gray-500">Show this Showcase on the homepage?</p>

                                @error('pin_on_homepage')
                                <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name*</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->name }}">

                            @error('name')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug*</label>
                            <input type="text" name="slug" id="slug" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->slug }}">

                            @error('slug')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type*</label>
                            <input type="text" name="type" id="type" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->type }}">

                            @error('type')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client*</label>
                            <select id="client_id" name="client_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="null">--- Choose a client ---</option>
                                @foreach(\App\Models\Client::all() as $client)
                                    <option {{ $client->id == $showcase->client_id ? 'selected' : '' }} value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>

                            @error('client_id')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" id="date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ optional($showcase->date)->format('Y-m-d') }}">

                            @error('date')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="15" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ $showcase->description }}</textarea>
                            </div>

                            @error('description')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            <input type="text" name="tags" id="tags" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->tags->pluck('name')->implode(',') }}">
                            <p class="text-sm text-gray-700 mt-2 ml-2">A comma seperated list of tags: one, two, with multiple words, three</p>
                            @error('tags')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="client_url" class="block text-sm font-medium text-gray-700">Client URL</label>
                            <input type="text" name="client_url" id="client_url" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="www.example.com" value="{{ $showcase->client_url }}">

                            @error('client_url')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="image_card" class="block text-sm font-medium text-gray-700">Image for card*</label>
                            <input type="file" name="image_card" id="image_card" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->image_card }}">

                            @error('image_card')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror

                            <div class="mt-4">
                                {{ $showcase->getFirstMedia('showcase_card') }}
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="image_header" class="block text-sm font-medium text-gray-700">Image for header</label>
                            <input type="file" name="image_header" id="image_header" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->image_header }}">

                            @error('image_header')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror

                            @if($showcase->getFirstMedia('showcase_header'))
                                <div class="mt-4">
                                    {{ $showcase->getFirstMedia('showcase_header') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-span-6">
                            <label for="image_extra" class="block text-sm font-medium text-gray-700">Image for extra</label>
                            <input type="file" name="image_extra" id="image_extra" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->image_extra }}">

                            @error('image_extra')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror

                            @if($showcase->getFirstMedia('showcase_extra'))
                                <div class="mt-4">
                                    {{ $showcase->getFirstMedia('showcase_extra') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-span-6">
                            <label for="image_logo" class="block text-sm font-medium text-gray-700">Logo</label>
                            <input type="file" name="image_logo" id="image_logo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $showcase->image_logo }}">

                            @error('image_logo')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror

                            @if($showcase->getFirstMedia('showcase_logo'))
                                <div class="mt-4">
                                    {{ $showcase->getFirstMedia('showcase_logo') }}
                                </div>
                            @endif
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
