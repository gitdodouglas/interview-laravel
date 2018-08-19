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
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1 id="perfil"></h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto post-box">
            <!-- -->
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

        $.ajax({
            method: 'post',
            url: window.location.pathname,
            dataType: 'json',
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

                if (data.objeto != null){
                    $("#perfil").html('@' + data.objeto[0].user_nickname);
                } else {
                    $("#perfil").html(data.mensagem);
                }

                $.each(data.objeto.reverse(), function(idx, post){
                    console.log(post);
                    $(".post-box").append(
                        '<div class="post-preview">' +
                        '<a href="/@' + post.user_nickname + '/post=' + post.id + '">' +
                        '<h2 class="post-title">' + post.title + '</h2>' +
                        '</a>' +
                        '<p class="post-meta">Postado por ' +
                        '<a href="/@' + post.user_nickname + '">' + post.user_nickname + '</a>' +
                        ' em ' + post.created_at + '</p>' +
                        '</div>' +
                        '<hr>'
                    );
                });

            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        })

    });
</script>
</body>
</html>
