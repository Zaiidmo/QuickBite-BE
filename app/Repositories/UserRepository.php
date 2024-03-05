<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create($data);
    }
    public function login(array $data){
        $token = Auth::attempt($data);

        if (!$token) {
            return response()->json(
                [
                    'message' => 'Unauthorized',
                ],
                401,
            );
        } 

        return response()->json(
            [
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => Auth::factory()->getTTL() * 60,
                ],
            ]);  
    }
    // public function getById($id)
    // {
    //     return User::findOrFail($id);
    // }


    // public function update($id, array $data)
    // {
    //     $user = $this->getById($id);
    //     $user->update($data);
    //     return $user;
    // }

    // public function delete($id)
    // {
    //     $user = $this->getById($id);
    //     $user->delete();
    // }

    
}