<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.create route="{{ route('admin.showcases.create') }}"/>

    <x-admin.tables.showcases :showcases="$showcases"/>

</x-admin.layout>
