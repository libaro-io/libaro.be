<div>
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="w-24" src="{{ asset('/storage/images/libaro_white.png') }}" alt="Workflow">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{ route('admin.dashboard') }}" class="{{ current_admin_route_has_name('admin.dashboard') ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" :class="">Dashboard</a>
                            <a href="{{ route('admin.showcases.index') }}" class="{{ current_admin_route_has_name('admin.showcases.index') ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Showcases</a>
                            <a href="{{ route('admin.clients.index') }}" class="{{ current_admin_route_has_name('admin.clients.index') ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Clients</a>
                            <a href="{{ route('admin.vacancies.index') }}" class="{{ current_admin_route_has_name('admin.vacancies.index') ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Vacancies</a>
                            <a href="{{ route('admin.articles.index') }}" class="{{ current_admin_route_has_name('admin.articles.index') ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Blog</a>

                        @if(!current_admin_route_has_name('admin.dashboard') &&
                            !current_admin_route_has_name('admin.showcases.index') &&
                            !current_admin_route_has_name('admin.clients.index') &&
                            !current_admin_route_has_name('admin.vacancies.index') &&
                            !current_admin_route_has_name('admin.articles.index'))
                                <div class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">{{ Route::currentRouteName()  }}</div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="text-white text-sm">
                        Welcome {{ auth()->user()->name }}
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <form action="{{ route('admin.session.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                <span class="sr-only">Logout</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
