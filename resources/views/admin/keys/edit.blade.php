<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.back-to-showcase :showcase="$showcase" />

    <x-admin.forms.keys.edit :showcase="$showcase" :key="$key"/>

    <x-admin.forms.keys.delete :showcase="$showcase" :key="$key" />

</x-admin.layout>
