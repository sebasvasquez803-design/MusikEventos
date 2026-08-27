<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * List users without exposing sensitive attributes.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => User::query()
                ->select(['id', 'name', 'email', 'email_verified_at', 'current_team_id', 'created_at', 'updated_at'])
                ->latest('id')
                ->paginate(15),
        ]);
    }

    /**
     * Create a user.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'current_team_id' => ['nullable', 'integer', 'exists:teams,id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json(['data' => $user->makeHidden([
            'password',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'remember_token',
        ])], 201);
    }

    /**
     * Show one user.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => $user->makeHidden([
                'password',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'remember_token',
            ]),
        ]);
    }

    /**
     * Update a user.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed'],
            'current_team_id' => ['nullable', 'integer', 'exists:teams,id'],
        ]);

        if (array_key_exists('password', $validated)) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $emailChanged = array_key_exists('email', $validated) && $validated['email'] !== $user->email;

        $user->update($validated);

        if ($emailChanged) {
            $user->forceFill(['email_verified_at' => null])->save();
        }

        return response()->json([
            'data' => $user->fresh()->makeHidden([
                'password',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'remember_token',
            ]),
        ]);
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(status: 204);
    }
}
