<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }} - Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    {{-- Header Navigation --}}
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-sky-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        <circle cx="8" cy="9" r="1.5" fill="white"/>
                        <circle cx="16" cy="9" r="1.5" fill="white"/>
                        <path d="M12 14c-.55 0-1 .45-1 1v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1z" fill="white"/>
                    </svg>
                    <span class="text-xl font-bold text-sky-500 dark:text-sky-400">ChitChat</span>
                </a>
                <div class="flex items-center space-x-6">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400">
                                <x-user-avatar :user="auth()->user()" size="sm" />
                                <span class="font-medium hidden md:block">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2" style="display: none;">
                                <a href="{{ route('profile.show', auth()->user()) }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Profile</span>
                                    </div>
                                </a>
                                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                                <button onclick="toggleTheme()" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                            </svg>
                                            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            <span class="dark:hidden">Dark Mode</span>
                                            <span class="hidden dark:block">Light Mode</span>
                                        </div>
                                        <div class="w-10 h-6 bg-gray-300 dark:bg-sky-500 rounded-full relative">
                                            <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 dark:left-5 transition-all duration-200"></div>
                                        </div>
                                    </div>
                                </button>
                                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Logout</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-full font-medium">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-6xl mx-auto px-4 py-6">
        {{-- Profile Header --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
            {{-- Cover --}}
            <div class="h-48 bg-gradient-to-r from-sky-400 to-sky-600"></div>
            
            {{-- Profile Info --}}
            <div class="px-6 pb-6">
                <div class="flex justify-between items-start -mt-16 mb-4">
                    <x-user-avatar :user="$user" size="xl" class="border-4 border-white dark:border-gray-800" />
                </div>

                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $user->name }}</h1>
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    Joined {{ $user->created_at->format('F Y') }}
                </p>

                <div class="flex gap-6 mb-6">
                    <div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalTweets }}</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">Tweets</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalLikesReceived }}</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">Likes Received</span>
                    </div>
                </div>

                {{-- About Me Section --}}
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">About Me</h3>
                        @auth
                            @if(auth()->id() === $user->id)
                                <button onclick="toggleAboutEdit()" class="text-sky-500 hover:text-sky-600 text-sm font-medium">
                                    <span id="editAboutBtn">Edit</span>
                                    <span id="cancelAboutBtn" class="hidden">Cancel</span>
                                </button>
                            @endif
                        @endauth
                    </div>
                    
                    <div id="aboutMeDisplay" class="text-gray-700 dark:text-gray-300">
                        @if($user->about_me)
                            <p class="whitespace-pre-line">{{ $user->about_me }}</p>
                        @else
                            <p class="text-gray-500 dark:text-gray-400 italic">
                                @if(auth()->check() && auth()->id() === $user->id)
                                    Tell people about yourself...
                                @else
                                    No bio yet.
                                @endif
                            </p>
                        @endif
                    </div>

                    @auth
                        @if(auth()->id() === $user->id)
                            <form id="aboutMeForm" action="{{ route('profile.updateAboutMe') }}" method="POST" class="hidden">
                                @csrf
                                <textarea 
                                    name="about_me" 
                                    rows="4" 
                                    maxlength="500"
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg p-3 text-gray-900 dark:text-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sky-500 resize-none"
                                    placeholder="Tell people about yourself...">{{ old('about_me', $user->about_me) }}</textarea>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-sm text-gray-500 dark:text-gray-400" id="aboutCharCount">{{ strlen($user->about_me ?? '') }} / 500</span>
                                    <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-full font-semibold text-sm">
                                        Save
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        {{-- User's Tweets --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden mt-4">
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Tweets</h2>
            </div>
            
            @forelse ($tweets as $tweet)
                <x-tweet-card :tweet="$tweet" />
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No tweets yet</p>
                    <p class="text-gray-500 dark:text-gray-400">This user hasn't posted anything</p>
                </div>
            @endforelse
        </div>
    </main>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
                html.classList.remove('dark');
                html.classList.add('light');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.remove('light');
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        function toggleAboutEdit() {
            const display = document.getElementById('aboutMeDisplay');
            const form = document.getElementById('aboutMeForm');
            const editBtn = document.getElementById('editAboutBtn');
            const cancelBtn = document.getElementById('cancelAboutBtn');
            
            if (form.classList.contains('hidden')) {
                display.classList.add('hidden');
                form.classList.remove('hidden');
                editBtn.classList.add('hidden');
                cancelBtn.classList.remove('hidden');
            } else {
                display.classList.remove('hidden');
                form.classList.add('hidden');
                editBtn.classList.remove('hidden');
                cancelBtn.classList.add('hidden');
            }
        }

        // Character counter for About Me
        const aboutTextarea = document.querySelector('textarea[name="about_me"]');
        const aboutCharCount = document.getElementById('aboutCharCount');
        
        if (aboutTextarea && aboutCharCount) {
            aboutTextarea.addEventListener('input', () => {
                const length = aboutTextarea.value.length;
                aboutCharCount.textContent = length + ' / 500';
                
                if (length > 480) {
                    aboutCharCount.classList.add('text-red-500');
                    aboutCharCount.classList.remove('text-gray-500', 'dark:text-gray-400');
                } else if (length > 450) {
                    aboutCharCount.classList.add('text-yellow-500');
                    aboutCharCount.classList.remove('text-gray-500', 'dark:text-gray-400');
                } else {
                    aboutCharCount.classList.add('text-gray-500', 'dark:text-gray-400');
                    aboutCharCount.classList.remove('text-red-500', 'text-yellow-500');
                }
            });
        }
    </script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
