<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostPageController extends Controller
{
    public function index()
    {
        return view('post');
    }

    public function post($nickname, $id)
    {
        try {
            $userController = new UserController;

            if ($user = $userController->query('nickname', $nickname)){

                $postController = new PostController;

                if (!$post = $postController->query('id', $id)){
                    throw new \Exception('Post não encontrado.');
                }

                if ($nickname == $post->user_nickname){
                    return [
                        'codigo' => 'success',
                        'objeto' => $post,
                        'mensagem' => null,
                    ];
                } else {
                    throw new \Exception('Post não encontrado.');
                }
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
