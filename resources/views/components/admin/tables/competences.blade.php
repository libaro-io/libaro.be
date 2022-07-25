@props(['vacancy'])

<div class="my-12">
    <div class="col-span-3 pt-12 flex items-center justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Competences</h3>
            <p class="mt-1 text-sm text-gray-600">
                All Competences related to this Vacancy
            </p>
        </div>
        <div>
            <x-admin.buttons.create route="{{ route('admin.competences.create', ['vacancy' => $vacancy]) }}"/>
        </div>
    </div>
    <section class="container mx-auto py-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-hidden">
                <table class="w-full">
                    <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Visible</th>
                        <th class="px-4 py-3">Number</th>
                        <th class="px-4 py-3">Title</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($vacancy->competences as $competence)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-xs border">
                                {{ $competence->id }}
                            </td>
                            <td class="px-4 py-3 text-ms font-semibold border">
                                @if($competence->visible)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Visible </span>
                                @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-yellow-700-700 bg-yellow-100 rounded-sm"> Hidden </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm border">{{ $competence->number }}</td>
                            <td class="px-4 py-3 text-sm border">{{ $competence->title }}</td>

                            <td class="px-4 py-3 text-xs border">
                                <a href="{{ route('admin.competences.edit', ['vacancy' => $vacancy, 'competence' => $competence->id]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

