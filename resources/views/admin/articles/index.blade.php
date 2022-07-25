<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.create route="{{ route('admin.articles.create') }}"/>

    <x-admin.tables.articles :articles="$articles"/>

</x-admin.layout>
