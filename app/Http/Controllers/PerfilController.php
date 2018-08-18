<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index($nickname)
    {
        $userController = new UserController;

        if ($user = $userController->query('nickname', $nickname)){
            return $user;
        } else {
            return 'Perfil não encontrado.';
        }
    }
}
