<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserRoleController extends Controller
{
    public function index(): View
    {
        return view('users.index', [
            'users' => User::query()->orderBy('name')->get(),
            'roles' => UserRole::cases(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', Rule::enum(UserRole::class)],
        ]);

        $newRole = UserRole::from($validated['role']);

        if ($user->role === UserRole::Beheerder
            && $newRole !== UserRole::Beheerder
            && User::query()->where('role', UserRole::Beheerder->value)->count() <= 1) {
            return back()->withErrors([
                'role' => 'De laatste beheerder kan niet worden gedegradeerd.',
            ]);
        }

        $user->role = $newRole;
        $user->save();

        return to_route('users.index')->with('status', 'De rol van de gebruiker is bijgewerkt.');
    }
}
