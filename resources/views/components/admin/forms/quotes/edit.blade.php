<div class="mt-12">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Quote</h3>
                <p class="mt-1 text-sm text-gray-600">
                    This information will be displayed publicly so be careful what you share.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('admin.quotes.update', ['showcase' => $showcase, 'quote' => $quote]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input name="visible" type="hidden" value="0">
                                <input id="visible" name="visible" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" value="1" {{ $quote->visible ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="visible" class="font-medium text-gray-700">Visible</label>
                                <p class="text-gray-500">Show this Quote on the site?</p>

                                @error('visible')
                                <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label for="by" class="block text-sm font-medium text-gray-700">By</label>
                            <input type="text" name="by" id="by" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $quote->by }}">

                            @error('by')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="job_title" class="block text-sm font-medium text-gray-700">Job Title</label>
                            <input type="text" name="job_title" id="job_title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $quote->job_title }}">

                            @error('job_title')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700">
                                Body
                            </label>
                            <div class="mt-1">
                                <textarea id="body" name="body" rows="15" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">{{ $quote->body }}</textarea>
                            </div>

                            @error('body')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="image_person" class="block text-sm font-medium text-gray-700">Image Person</label>
                            <input type="file" name="image_person" id="image_person" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $quote->image_person }}">

                            @error('image_person')
                            <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
                            @enderror

                            <div class="mt-4">
                                {{ $quote->getFirstMedia('quote') }}
                            </div>
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
