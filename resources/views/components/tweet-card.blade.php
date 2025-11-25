@props(['tweet'])

<article class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150 cursor-pointer">
    <div class="p-4">
        <div class="flex space-x-3">
            {{-- User Avatar --}}
            <a href="{{ route('profile.show', $tweet->user) }}" class="flex-shrink-0">
                <x-user-avatar :user="$tweet->user" size="md" />
            </a>

            {{-- Tweet Content --}}
            <div class="flex-1 min-w-0">
                {{-- Header --}}
                <div class="flex items-start justify-between mb-1">
                    <div class="flex items-center space-x-1 flex-wrap">
                        <a href="{{ route('profile.show', $tweet->user) }}" class="font-bold text-gray-900 dark:text-white hover:underline">
                            {{ $tweet->user->name }}
                        </a>
                        <span class="text-gray-500 dark:text-gray-400">·</span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">
                            {{ $tweet->created_at->diffForHumans() }}
                        </span>
                        @if ($tweet->created_at != $tweet->updated_at)
                            <span class="text-gray-500 dark:text-gray-400 text-sm">· Edited</span>
                        @endif
                    </div>

                    {{-- Actions Dropdown --}}
                    @auth
                        @if (auth()->id() === $tweet->user_id)
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-gray-500 hover:text-sky-500 dark:text-gray-400 dark:hover:text-sky-400 p-1 rounded-full hover:bg-sky-50 dark:hover:bg-gray-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                                    </svg>
                                </button>
                                
                                <div x-show="open" @click.away="open = false" 
                                     class="absolute right-0 mt-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-10"
                                     style="display: none;">
                                    <button onclick="toggleEdit({{ $tweet->id }})" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </button>
                                    <form method="POST" action="{{ route('tweets.destroy', $tweet) }}" onsubmit="return confirm('Are you sure you want to delete this tweet?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Tweet Text --}}
                <div id="content-{{ $tweet->id }}" class="text-gray-900 dark:text-white text-[15px] leading-normal mb-3">
                    {{ $tweet->content }}
                </div>

                {{-- Edit Form --}}
                @auth
                    @if (auth()->id() === $tweet->user_id)
                        <form id="edit-form-{{ $tweet->id }}" class="hidden mb-3" method="POST" action="{{ route('tweets.update', $tweet) }}">
                            @csrf
                            @method('PUT')
                            <textarea 
                                name="content" 
                                rows="3" 
                                class="w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg p-3 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-sky-500 dark:focus:ring-sky-400"
                                maxlength="280"
                                required>{{ $tweet->content }}</textarea>
                            <div class="flex gap-2 mt-2">
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-full font-semibold text-sm transition">
                                    Save
                                </button>
                                <button 
                                    type="button" 
                                    onclick="toggleEdit({{ $tweet->id }})" 
                                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-full text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold transition">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    @endif
                @endauth

                {{-- Tweet Actions --}}
                <div class="flex items-center space-x-12 mt-3">
                    {{-- Reply Button --}}
                    @auth
                        <button 
                            type="button"
                            onclick="toggleReply({{ $tweet->id }})"
                            class="group flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-sky-500 dark:hover:text-sky-400 transition">
                            <div class="p-2 rounded-full group-hover:bg-sky-50 dark:group-hover:bg-sky-900/20 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ ($tweet->replies_count ?? 0) > 0 ? ($tweet->replies_count ?? 0) : '' }}</span>
                        </button>
                    @else
                        <div class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
                            <div class="p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ ($tweet->replies_count ?? 0) > 0 ? ($tweet->replies_count ?? 0) : '' }}</span>
                        </div>
                    @endauth

                    {{-- Like Button --}}
                    @auth
                        <button 
                            type="button"
                            onclick="toggleLike({{ $tweet->id }})"
                            id="like-btn-{{ $tweet->id }}"
                            data-tweet-id="{{ $tweet->id }}"
                            data-liked="{{ auth()->check() && auth()->user()->likedTweets->contains($tweet->id) ? 'true' : 'false' }}"
                            class="group flex items-center space-x-2 {{ auth()->check() && auth()->user()->likedTweets->contains($tweet->id) ? 'text-rose-500' : 'text-gray-500 dark:text-gray-400 hover:text-rose-500' }} transition">
                            <div class="p-2 rounded-full group-hover:bg-rose-50 dark:group-hover:bg-rose-900/20 transition">
                                <svg id="like-icon-{{ $tweet->id }}" class="w-5 h-5" fill="{{ auth()->check() && auth()->user()->likedTweets->contains($tweet->id) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    @if(auth()->check() && auth()->user()->likedTweets->contains($tweet->id))
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    @endif
                                </svg>
                            </div>
                            <span id="like-count-{{ $tweet->id }}" class="text-sm">{{ ($tweet->likes_count ?? $tweet->likes()->count()) > 0 ? ($tweet->likes_count ?? $tweet->likes()->count()) : '' }}</span>
                        </button>
                    @else
                        <div class="flex items-center space-x-2 text-gray-500 dark:text-gray-400">
                            <div class="p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ $tweet->likes_count ?? $tweet->likes()->count() }}</span>
                        </div>
                    @endauth
                </div>

                {{-- Reply Form (Hidden by default) --}}
                @auth
                    <div id="reply-form-{{ $tweet->id }}" class="hidden mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('tweets.store') }}" class="flex space-x-3">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $tweet->id }}">
                            <x-user-avatar :user="auth()->user()" size="sm" class="flex-shrink-0" />
                            <div class="flex-1">
                                <textarea 
                                    name="content" 
                                    rows="2" 
                                    maxlength="280"
                                    class="w-full bg-transparent border border-gray-300 dark:border-gray-600 rounded-lg p-3 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 dark:focus:ring-sky-400 resize-none"
                                    placeholder="Post your reply..."
                                    required></textarea>
                                <div class="flex justify-end gap-2 mt-2">
                                    <button 
                                        type="button" 
                                        onclick="toggleReply({{ $tweet->id }})"
                                        class="px-4 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-full text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold transition">
                                        Cancel
                                    </button>
                                    <button 
                                        type="submit" 
                                        class="px-4 py-1.5 text-sm bg-sky-500 hover:bg-sky-600 text-white rounded-full font-semibold transition">
                                        Reply
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endauth

                {{-- Replies Section (Dropdown) --}}
                @if($tweet->replies && $tweet->replies->count() > 0)
                    <div class="mt-4">
                        <button 
                            onclick="toggleReplies({{ $tweet->id }})"
                            class="text-sm text-sky-500 hover:text-sky-600 dark:text-sky-400 dark:hover:text-sky-300 font-semibold flex items-center space-x-1">
                            <span id="replies-text-{{ $tweet->id }}">Show {{ $tweet->replies->count() }} {{ Str::plural('reply', $tweet->replies->count()) }}</span>
                            <svg id="replies-icon-{{ $tweet->id }}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="replies-{{ $tweet->id }}" class="hidden mt-3 space-y-3 pl-4 border-l-2 border-gray-200 dark:border-gray-700">
                            @foreach($tweet->replies as $reply)
                                <div class="flex space-x-2">
                                    <a href="{{ route('profile.show', $reply->user) }}" class="flex-shrink-0">
                                        <x-user-avatar :user="$reply->user" size="sm" />
                                    </a>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-1 flex-wrap">
                                            <a href="{{ route('profile.show', $reply->user) }}" class="font-bold text-sm text-gray-900 dark:text-white hover:underline">
                                                {{ $reply->user->name }}
                                            </a>
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">·</span>
                                            <span class="text-gray-500 dark:text-gray-400 text-xs">
                                                {{ $reply->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $reply->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</article>

<script>
function toggleEdit(tweetId) {
    const contentDiv = document.getElementById('content-' + tweetId);
    const editForm = document.getElementById('edit-form-' + tweetId);
    
    if (editForm.classList.contains('hidden')) {
        contentDiv.classList.add('hidden');
        editForm.classList.remove('hidden');
    } else {
        contentDiv.classList.remove('hidden');
        editForm.classList.add('hidden');
    }
}

function toggleReply(tweetId) {
    const replyForm = document.getElementById('reply-form-' + tweetId);
    
    if (replyForm.classList.contains('hidden')) {
        replyForm.classList.remove('hidden');
        // Focus on textarea
        const textarea = replyForm.querySelector('textarea');
        if (textarea) textarea.focus();
    } else {
        replyForm.classList.add('hidden');
    }
}

function toggleReplies(tweetId) {
    const repliesDiv = document.getElementById('replies-' + tweetId);
    const repliesIcon = document.getElementById('replies-icon-' + tweetId);
    const repliesText = document.getElementById('replies-text-' + tweetId);
    const replyCount = repliesDiv.children.length;
    
    if (repliesDiv.classList.contains('hidden')) {
        repliesDiv.classList.remove('hidden');
        repliesIcon.classList.add('rotate-180');
        repliesText.textContent = 'Hide ' + replyCount + (replyCount === 1 ? ' reply' : ' replies');
    } else {
        repliesDiv.classList.add('hidden');
        repliesIcon.classList.remove('rotate-180');
        repliesText.textContent = 'Show ' + replyCount + (replyCount === 1 ? ' reply' : ' replies');
    }
}

function toggleLike(tweetId) {
    const button = document.getElementById('like-btn-' + tweetId);
    const icon = document.getElementById('like-icon-' + tweetId);
    const countSpan = document.getElementById('like-count-' + tweetId);
    
    // Get CSRF token
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    fetch(`/tweets/${tweetId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button state
            if (data.isLiked) {
                button.classList.remove('text-gray-500', 'dark:text-gray-400', 'hover:text-rose-500');
                button.classList.add('text-rose-500');
                icon.setAttribute('fill', 'currentColor');
                icon.innerHTML = '<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>';
            } else {
                button.classList.add('text-gray-500', 'dark:text-gray-400', 'hover:text-rose-500');
                button.classList.remove('text-rose-500');
                icon.setAttribute('fill', 'none');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>';
            }
            
            // Update count
            countSpan.textContent = data.likesCount > 0 ? data.likesCount : '';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
