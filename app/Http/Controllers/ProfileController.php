<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->only(['name', 'email', 'role',]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)],
        ]);

        $request->user()->update($validated);

        return response()->json(['success' => true]);
    }


    public function changePassword(Request $request, UpdateUserPassword $updater)
    {
        $updater->update(
            auth()->user(),
            [
                'current_password' => $request->currentPassword,
                'password' => $request->password,
                'password_confirmation' => $request->passwordConfirmation,
            ]
        );

        return response()->json(['message' => 'Password changed successfully!']);
    }
}
