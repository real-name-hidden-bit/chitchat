<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ChitChat - Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Check for saved theme preference or default to 'light'
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
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 transition-colors duration-200">
        <div class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="flex items-center space-x-2">
                        <!-- Custom ChitChat Logo -->
                        <svg class="w-8 h-8 text-sky-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            <circle cx="8" cy="9" r="1.5" fill="white"/>
                            <circle cx="16" cy="9" r="1.5" fill="white"/>
                            <path d="M12 14c-.55 0-1 .45-1 1v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1z" fill="white"/>
                        </svg>
                        <span class="text-xl font-bold text-sky-500 dark:text-sky-400">ChitChat</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    @auth
                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400 transition">
                                <x-user-avatar :user="auth()->user()" size="sm" />
                                <span class="font-medium hidden md:block">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-2"
                                 style="display: none;">
                                <a href="{{ route('profile.show', auth()->user()) }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Profile</span>
                                    </div>
                                </a>
                                
                                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                                
                                <!-- Theme Toggle -->
                                <button onclick="toggleTheme()" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
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
                                        <div class="w-10 h-6 bg-gray-300 dark:bg-sky-500 rounded-full relative transition-colors duration-200">
                                            <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 dark:left-5 transition-all duration-200"></div>
                                        </div>
                                    </div>
                                </button>
                                
                                <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
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
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-sky-500 dark:hover:text-sky-400 font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-full font-medium transition">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 px-4 py-6">
            <!-- Left Sidebar (Optional - can add trending, etc) -->
            <div class="hidden lg:block lg:col-span-3">
                <div class="sticky top-20">
                    @auth
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <x-user-avatar :user="auth()->user()" size="md" />
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">@username</p>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Center Feed -->
            <div class="col-span-1 md:col-span-12 lg:col-span-6">
                <!-- Tabs Navigation -->
                @auth
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-t-xl overflow-hidden mb-0">
                        <div class="flex border-b border-gray-200 dark:border-gray-700">
                            <a href="{{ route('home') }}" 
                               class="flex-1 text-center py-4 font-semibold transition {{ ($activeTab ?? 'home') === 'home' ? 'text-sky-500 border-b-2 border-sky-500' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span>Home</span>
                                </div>
                            </a>
                            <a href="{{ route('my-tweets') }}" 
                               class="flex-1 text-center py-4 font-semibold transition {{ ($activeTab ?? 'home') === 'my-tweets' ? 'text-sky-500 border-b-2 border-sky-500' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>My Tweets</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endauth

                @auth
                    <!-- Tweet Compose Box -->
                    <div class="bg-white dark:bg-gray-800 border-x border-b border-gray-200 dark:border-gray-700 {{ auth()->check() ? '' : 'rounded-t-xl' }} transition-colors duration-200">
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex space-x-3">
                                <x-user-avatar :user="auth()->user()" size="md" class="flex-shrink-0" />
                                <div class="flex-1">
                                    <form action="{{ route('tweets.store') }}" method="POST">
                                        @csrf
                                        <textarea 
                                            name="content" 
                                            rows="3" 
                                            maxlength="280"
                                            class="w-full bg-transparent text-gray-900 dark:text-white text-lg placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none resize-none"
                                            placeholder="What's happening?"
                                            required
                                        ></textarea>
                                        @error('content')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                        <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm text-gray-500 dark:text-gray-400" id="charCount">0 / 280</span>
                                            </div>
                                            <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-full font-semibold transition">
                                                Post
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Not Logged In State -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center mb-4">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Welcome to ChitChat</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-lg mb-6">Join the conversation today</p>
                        <div class="flex justify-center items-center space-x-4">
                            <a href="{{ route('login') }}" class="text-sky-500 hover:text-sky-600 font-semibold text-lg px-6 py-2 border border-sky-500 rounded-full hover:bg-sky-50 dark:hover:bg-sky-900/20 transition">Log in</a>
                            <a href="{{ route('register') }}" class="bg-sky-500 hover:bg-sky-600 text-white text-lg px-6 py-2 rounded-full font-semibold transition shadow-lg hover:shadow-xl">Sign up</a>
                        </div>
                    </div>
                @endauth

                <!-- Tweets Feed -->
                <div class="bg-white dark:bg-gray-800 border-x border-b border-gray-200 dark:border-gray-700 {{ auth()->check() ? '' : 'rounded-xl border-t' }} overflow-hidden">
                    @forelse($tweets as $tweet)
                        <x-tweet-card :tweet="$tweet" />
                    @empty
                        <div class="p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                @if(($activeTab ?? 'home') === 'my-tweets')
                                    No tweets yet
                                @else
                                    No tweets to show
                                @endif
                            </p>
                            <p class="text-gray-500 dark:text-gray-400">
                                @if(($activeTab ?? 'home') === 'my-tweets')
                                    Start sharing your thoughts with the world!
                                @else
                                    Be the first to share something!
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Sidebar (Optional - can add suggestions, etc) -->
            <div class="hidden lg:block lg:col-span-3">
                <div class="sticky top-20">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-3">What's happening</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Check out the latest tweets from the community</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Character counter
        const textarea = document.querySelector('textarea[name="content"]');
        const charCount = document.getElementById('charCount');
        
        if (textarea && charCount) {
            textarea.addEventListener('input', () => {
                const length = textarea.value.length;
                charCount.textContent = length + ' / 280';
                
                // Change color based on character count
                if (length > 260) {
                    charCount.classList.add('text-red-500');
                    charCount.classList.remove('text-gray-500', 'dark:text-gray-400');
                } else if (length > 240) {
                    charCount.classList.add('text-yellow-500');
                    charCount.classList.remove('text-gray-500', 'dark:text-gray-400');
                } else {
                    charCount.classList.add('text-gray-500', 'dark:text-gray-400');
                    charCount.classList.remove('text-red-500', 'text-yellow-500');
                }
            });
        }

        // Theme toggle function
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
    </script>
    
    <!-- Alpine.js for dropdowns -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
