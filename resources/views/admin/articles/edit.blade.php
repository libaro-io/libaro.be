<x-admin.layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div class="divide-y">
        <x-admin.forms.articles.edit :article="$article" />

        <x-admin.forms.articles.delete :article="$article" />
    </div>

</x-admin.layout>
