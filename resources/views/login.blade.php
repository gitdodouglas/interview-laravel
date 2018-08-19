<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Interview Blog</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Custom styles for this template -->
        <link href="css/clean-blog.min.css" rel="stylesheet">
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
                    <div class="site-heading">
                        <h1>Entrar</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form id="form-login">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Usuário</label>
                            <input type="text" class="form-control" placeholder="Usuário" id="nickname">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Senha</label>
                            <input type="password" class="form-control" placeholder="Senha" id="password">
                        </div>
                    </div>
                    <br>
                    <h6 id="mensagem"></h6>
                    <input id="token" type="hidden" value="{{ csrf_token() }}">
                    <div id="success"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#form-login').submit(function(){
                const apelido = $('#nickname').val();
                const senha = $('#password').val();
                const token = $('#token').val();

                const dados =  {
                    nickname: apelido, password: senha, _token: token
                };

                console.log(dados);

                if ($.trim(apelido).length == 0 || $.trim(senha).length == 0){
                    $('#mensagem').html('Todos os campos são de preenchimento obrigatório!');
                } else {

                    $.ajax({
                        method: 'post',
                        url: 'login',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(dados),
                        success: function (data) {
                            console.log(data);
                            if (data.codigo == 'success') {
                                window.location.replace('/dash');
                            } else {
                                $("#mensagem").html(data.mensagem);
                            }
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
