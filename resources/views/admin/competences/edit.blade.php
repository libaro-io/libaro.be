<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <x-admin.buttons.back-to-vacancy :vacancy="$vacancy" />

    <x-admin.forms.competences.edit :vacancy="$vacancy" :competence="$competence"/>

    <x-admin.forms.competences.delete :vacancy="$vacancy" :competence="$competence" />

</x-admin.layout>
