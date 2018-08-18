<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dash');
    }

    public function create(Request $request)
    {
        try {
            if ($request->json('title') == "" || $request->json('text') == "") {
                throw new \Exception('Todos os campos são de preenchimento obrigatório.');
            }

            $postController = new PostController;

            $postController->create($request, Auth::user());

            return [
                'codigo' => 'success',
                'objeto' => null,
                'mensagem' => 'Post publicado com sucesso!',
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
