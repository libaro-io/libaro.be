<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.back-to-vacancy :vacancy="$vacancy" />

    <x-admin.forms.competences.create :vacancy="$vacancy" />

</x-admin.layout>
