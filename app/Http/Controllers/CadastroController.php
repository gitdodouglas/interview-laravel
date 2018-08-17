<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index()
    {
        return view('cadastro');
    }

    public function create(Request $request)
    {
        try {
            if ($request->json('name') == "" || $request->json('nickname') == "" || $request->json('email') == "" || $request->json('password') == "") {
                throw new \Exception('Todos os campos são de preenchimento obrigatório.');
            }

            $userController = new UserController;

            if ($userController->query('email', $request->json('email'))) {
                throw new \Exception('Esse e-mail já está cadastrado. Por favor, informe um endereço de e-mail diferente.');
            }

            if ($userController->query('nickname', $request->json('nickname'))) {
                throw new \Exception('Esse nome de usuário já está cadastrado. Por favor, informe um nome de usuário diferente.');
            }

            $userController->create($request);

            return [
                'codigo' => 'success',
                'objeto' => null,
                'mensagem' => 'Usuário cadastrado com sucesso!',
            ];
        } catch (\Exception $exception) {
            return [
                'codigo' => 'error',
                'objeto' => null,
                'mensagem' => $exception->getMessage(),
            ];
        }
    }
}
