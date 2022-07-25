@props(['vacancy'])

<div class="flex items-center hover:text-blue-500 max-w-max">
    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
    </svg>
    <a class="ml-4" href="{{ route('admin.vacancies.edit', ['vacancy' => $vacancy]) }}">Back to Vacancy</a>
</div>
