<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Interview Blog</title>

        <!-- Bootstrap core CSS -->
        <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="/css/clean-blog.min.css" rel="stylesheet">
    </head>

    <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/">Interview Blog</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cadastro">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1 id="titulo-post"></h1>
                        <span class="meta">Postado por </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto post">
                    <!-- -->
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto comment">
                    <h4>Comentários:</h4>
                    <!-- -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <form id="form-comment">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label>Comentário</label>
                                <textarea class="form-control" placeholder="Digite o seu comentário" id="comment" rows="5"></textarea>
                            </div>
                        </div>
                        <br>
                        <h6 id="mensagem"></h6>
                        <input id="token" type="hidden" value="{{ csrf_token() }}">
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Comentar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <p class="copyright text-muted">&copy; 2018 Interview Blog</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/clean-blog.min.js"></script>

    <script>
        $(document).ready(function(){

            $.ajax({
                method: 'post',
                url: window.location.pathname,
                dataType: 'json',
                data: {_token: $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    $("#titulo-post").html(data.objeto.title);
                    $(".meta").append(
                        '<a href="/@' + data.objeto.user_nickname + '">' + data.objeto.user_nickname + '</a>' +
                        ' em ' + data.objeto.created_at
                    );
                    $(".post").append(data.objeto.text);

                    $.each(data.comentario, function(idx, comment){
                        $(".comment").append(
                            '<p><small><a href="/@' + comment.user_nickname + '">' + '@' + comment.user_nickname + '</a> comentou: ' + comment.comment + '</small></p>'
                        );
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                }
            })

        });
    </script>

    <script>
        $(document).ready(function(){
            $('#form-comment').submit(function(){
                const comentario = $('#comment').val();
                const pathArray = window.location.pathname.split('/');
                const token = $('#token').val();

                const dados =  {
                    comment: comentario, _token: token
                };

                console.log(dados);

                if ($.trim(comentario).length == 0){
                    $('#mensagem').html('O campo não pode estar vazio!');
                } else {

                    $.ajax({
                        method: 'post',
                        url: '/comment/' + pathArray[2],
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(dados),
                        success: function (data) {
                            console.log(data);
                            $('#mensagem').html(data.mensagem);
                            location.reload();
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });

                }

                return false;
            });
        });
    </script>
    </body>
</html>
