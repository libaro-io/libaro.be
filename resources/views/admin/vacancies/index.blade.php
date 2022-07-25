<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.create route="{{ route('admin.vacancies.create') }}"/>

    <x-admin.tables.vacancies :vacancies="$vacancies"/>

</x-admin.layout>
