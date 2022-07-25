<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.back-to-showcase :showcase="$showcase" />

    <x-admin.forms.quotes.edit :showcase="$showcase" :quote="$quote" />

    <x-admin.forms.quotes.delete :showcase="$showcase" :quote="$quote" />

</x-admin.layout>
