<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Store a newly created tweet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:280'],
        ]);

        Tweet::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Tweet posted!');
    }

    /**
     * Update the specified tweet.
     */
    public function update(Request $request, Tweet $tweet)
    {
        // Only owner can update
        if ($tweet->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => ['required', 'string', 'max:280'],
        ]);

        $tweet->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Tweet updated!');
    }

    /**
     * Remove the specified tweet.
     */
    public function destroy(Tweet $tweet)
    {
        // Only owner can delete
        if ($tweet->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $tweet->delete();

        return redirect()->back()->with('success', 'Tweet deleted!');
    }

    /**
     * Toggle like/unlike on a tweet.
     */
    public function toggleLike(Tweet $tweet)
    {
        $user = Auth::user();

        if (!$user) {
            if (request()->wantsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->route('login');
        }

        // Toggle the like (attach if not liked, detach if already liked)
        $user->likedTweets()->toggle($tweet->id);

        // Refresh the tweet to get updated likes count
        $tweet->refresh();
        $likesCount = $tweet->likes()->count();
        $isLiked = $user->likedTweets->contains($tweet->id);

        // Return JSON for AJAX requests
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'isLiked' => $isLiked,
                'likesCount' => $likesCount
            ]);
        }

        return redirect()->back();
    }
}
