<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.back-to-showcase :showcase="$showcase" />

    <x-admin.forms.quotes.create :showcase="$showcase" />

</x-admin.layout>

