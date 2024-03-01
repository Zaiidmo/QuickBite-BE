<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changeRole(Request $request)
{
    $user = Auth::user(); // Get the authenticated user

    $request->validate([
        'role' => 'required|string',
    ]);

    try {
        $user->changeRole($request->role); // Call the changeRole method on the authenticated user

        return response()->json([
            'message' => 'User role changed successfully',
            'user' => $user,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to change user role',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}
