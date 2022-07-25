@props([
    'client_id'
])

<div class="col-span-6">
    <label for="type" class="block text-sm font-medium text-gray-700">Client</label>
    <select id="client_id" name="client_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

        <option value="null">--- Choose a client ---</option>
        @foreach($clients as $client)
                <option {{ $client->id == $client_id ? 'selected' : '' }} value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select>

    @error('client_id')
    <div class="text-red-800 text-xs mt-2">{{ $message }}</div>
    @enderror
</div>
