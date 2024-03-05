<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'resetPassword']]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(
                [
                    'message' => 'Unauthorized',
                ],
                401,
            );
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->roles()->attach(3); // assign user role of customer by default

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ],
        ]);
    }

    // public function forgotPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return response()->json(
    //             [
    //                 'message' => 'User not found',
    //             ],
    //             404,
    //         );
    //     }

    //     $token = JWTAuth::fromUser($user);

    //     // Send reset password email or return token
    //     Mail::raw("Reset password token: $token", function ($message) use ($user) {
    //         $message->to($user->email)->subject('Reset Your Password');
    //     });

    //     return response()->json([
    //         'message' => 'Reset password token sent to your email',
    //         'token' => $token,
    //     ]);
    // }
    // public function resetPassword(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'token' => 'required|string',
//             'password' => 'required|string|min:6',
//         ]);

//         try {
//             $user = JWTAuth::parseToken()->authenticate();
//         } catch (\Exception $e) {
//             return response()->json(
//                 [
//                     'message' => 'Invalid or expired token',
//                 ],
//                 401,
//             );
//         }

//         if (!$user || $user->email !== $request->email) {
//             return response()->json(
//                 [
//                     'message' => 'Invalid token or email',
//                 ],
//                 401,
//             );
//         }

//         $user->update([
//             'password' => Hash::make($request->password),
//         ]);

//         return response()->json([
//             'message' => 'Password reset successful',
//         ]);
//     }
// }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => __($status)])
                    : response()->json(['message' => __($status)], 400);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => bcrypt($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? response()->json(['message' => __($status)])
                    : response()->json(['message' => __($status)], 400);
    }
}     