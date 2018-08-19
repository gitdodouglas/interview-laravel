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
                        <a class="nav-link" href="/logout">Sair</a>
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
                        <h1>Publicar</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <form id="form-dash">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Título</label>
                            <input type="text" class="form-control" placeholder="Digite o título" id="title">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Texto</label>
                            <textarea class="form-control" placeholder="Digite o texto" id="text" rows="5"></textarea>
                        </div>
                    </div>
                    <br>
                    <h6 id="mensagem"></h6>
                    <input id="token" type="hidden" value="{{ csrf_token() }}">
                    <div id="success"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Publicar</button>
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
            $('#form-dash').submit(function(){
                const titulo = $('#title').val();
                const texto = $('#text').val();
                const token = $('#token').val();

                const dados =  {
                    title: titulo, text: texto, _token: token
                };

                console.log(dados);

                if ($.trim(titulo).length == 0 || $.trim(texto).length == 0){
                    $('#mensagem').html('Todos os campos são de preenchimento obrigatório!');
                } else {

                    $.ajax({
                        method: 'post',
                        url: 'dash',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(dados),
                        success: function (data) {
                            console.log(data);
                            $('#mensagem').html(data.mensagem);
                            $('#title').val('');
                            $('#text').val('');
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
