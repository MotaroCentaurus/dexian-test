<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * Get user actual
     *
     * @return void
     */
    /*public function me()
    {
        return response()->json(
            auth()->guard('api')->user()
        );
    }*/
    public function me()
    {
        // Use o guard 'api' para buscar o usuário autenticado
        //$user = Auth::guard('api')->user();

        // Retorne as informações do usuário
        return response()->json(auth('api')->user() );
    }

    /**
     * Get list of users
     *
     * @return void
     */
    public function getUsers()
    {
        return response()->json([
            'list' => User::all()
        ]);
    }
}
