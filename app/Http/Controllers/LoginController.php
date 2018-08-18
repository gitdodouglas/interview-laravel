<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            if ($request->json('nickname') == "" || $request->json('password') == "") {
                throw new \Exception('Todos os campos são de preenchimento obrigatório.');
            }

            $userController = new UserController;

            if ($user = $userController->query('nickname', $request->json('nickname'))) {
                if (Auth::attempt(['nickname' => $request->json('nickname'), 'password' => $request->json('password')])) {
                    return [
                        'codigo' => 'success',
                        'objeto' => Auth::user(),
                        'mensagem' => null,
                    ];
                } else {
                    throw new \Exception('Login ou senha inválidos.');
                }
            } else {
                throw new \Exception('Login ou senha inválidos.');
            }
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}
