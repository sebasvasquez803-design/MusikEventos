<?php

namespace App\Http\Controllers;

use App\Models\Passkey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PasskeyController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Passkey::query()->latest('id')->paginate(15),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'credential_id' => ['required', 'string', 'unique:passkeys,credential_id'],
            'credential' => ['required', 'array'],
            'last_used_at' => ['nullable', 'date'],
        ]);

        $passkey = Passkey::create($validated);

        return response()->json(['data' => $passkey], 201);
    }

    public function show(Passkey $passkey): JsonResponse
    {
        return response()->json(['data' => $passkey]);
    }

    public function update(Request $request, Passkey $passkey): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'credential_id' => ['sometimes', 'required', 'string', 'unique:passkeys,credential_id,' . $passkey->id],
            'credential' => ['sometimes', 'required', 'array'],
            'last_used_at' => ['sometimes', 'nullable', 'date'],
        ]);

        $passkey->update($validated);

        return response()->json(['data' => $passkey->fresh()]);
    }

    public function destroy(Passkey $passkey): JsonResponse
    {
        $passkey->delete();

        return response()->json(status: 204);
    }
}
