<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

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
     * Create the users api token
     */
    public function createToken(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->api_token = Str::uuid();

        $request->user()->save();

        // redirect user to profile.edit route and section #api-token
        $url = route('profile.edit') . '#api-token';

        return Redirect::to($url)->with('status', 'token-created');
    }

    /**
     * Delete the users api token
     */
    public function deleteToken(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->api_token = null;

        $request->user()->save();

        $url = route('profile.edit') . '#api-token';


        return Redirect::to($url)->with('status', 'token-deleted');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
