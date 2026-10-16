<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected ProfileService $profileService;

    public function __construct(
        ProfileService $profileService
    ) {
        $this->profileService = $profileService;
    }

    /**
     * Halaman profil.
     */
    public function edit(): View
    {
        $user = Auth::user();

        abort_if(!$user, 401);

        return view(
            'example.content.profil.edit_profil',
            compact('user')
        );
    }

    /**
     * Update profil.
     */
    public function update(
        Request $request
    ): RedirectResponse {

        $user = Auth::user();

        abort_if(!$user, 401);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $updatedUser = $this->profileService->updateProfile(
            $user->id,
            $validated
        );

        if (!$updatedUser) {
            return back()
                ->withInput()
                ->with('error', 'Profil gagal diperbarui.');
        }

        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }
}