<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index($nickname)
    {
        try {
            $userController = new UserController;

            if ($user = $userController->query('nickname', $nickname)){
                return [
                    'codigo' => 'success',
                    'objeto' => $userController->getPosts($user->id),
                    'mensagem' => 'Usuário cadastrado com sucesso!',
                ];
            } else {
                throw new \Exception('Perfil não encontrado.');
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
