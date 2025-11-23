<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display a user's public profile.
     */
    public function show(\App\Models\User $user): View
    {
        $tweets = $user->tweets()
            ->with('user')
            ->withCount('likes')
            ->latest()
            ->get();
        
        $totalTweets = $user->tweets()->count();
        $totalLikesReceived = $user->tweets()->withCount('likes')->get()->sum('likes_count');

        return view('profile.show', [
            'user' => $user,
            'tweets' => $tweets,
            'totalTweets' => $totalTweets,
            'totalLikesReceived' => $totalLikesReceived,
        ]);
    }

    /**
     * Update the user's about me section.
     */
    public function updateAboutMe(Request $request): RedirectResponse
    {
        $request->validate([
            'about_me' => ['nullable', 'string', 'max:500'],
        ]);

        $request->user()->update([
            'about_me' => $request->about_me,
        ]);

        return Redirect::back()->with('status', 'about-me-updated');
    }
}
