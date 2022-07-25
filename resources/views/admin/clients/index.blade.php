<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.create route="{{ route('admin.clients.create') }}"/>

    <x-admin.tables.clients :clients="$clients"/>

</x-admin.layout>
