<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="divide-y">
        <x-admin.forms.vacancies.edit :vacancy="$vacancy" />

        <x-admin.forms.vacancies.delete :vacancy="$vacancy" />

        <x-admin.tables.competences :vacancy="$vacancy" />
    </div>

</x-admin.layout>
