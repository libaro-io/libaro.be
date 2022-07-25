<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="divide-y">
        <x-admin.forms.clients.edit :client="$client" />

        <x-admin.forms.clients.delete :client="$client" />
    </div>

</x-admin.layout>
