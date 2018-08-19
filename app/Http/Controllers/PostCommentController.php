<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function comment($id, Request $request)
    {
        try {
            if ($request->json('comment') == "") {
                throw new \Exception('O campo não pode estar vazio!');
            }

            $commentController = new CommentController;
            $commentController->create($id, $request, Auth::user());

            return [
                'codigo' => 'success',
                'objeto' => null,
                'mensagem' => 'Comentário enviado com sucesso!',
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
