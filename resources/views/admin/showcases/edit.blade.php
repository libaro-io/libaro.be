<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="divide-y">
        <x-admin.forms.showcases.edit :showcase="$showcase" />

        <x-admin.forms.showcases.delete :showcase="$showcase" />

        <x-admin.tables.keys :showcase="$showcase" />

        <x-admin.tables.quotes :showcase="$showcase" />
    </div>

</x-admin.layout>
