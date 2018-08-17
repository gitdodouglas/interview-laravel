<form id="form-cadastro">
    <input id="name" type="text" placeholder="Nome"><br><br>
    <input id="nickname" type="text" placeholder="Apelido"><br><br>
    <input id="email" type="email" placeholder="E-mail"><br><br>
    <input id="password" type="password" placeholder="Senha"><br><br>
    <input id="token" type="hidden" value="{{ Session::token() }}">
    <input type="submit" value="Cadastrar">
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#form-cadastro').submit(function(){
            const nome = $('#name').val();
            const apelido = $('#nickname').val();
            const email = $('#email').val();
            const senha = $('#password').val();
            const token = $('#token').val();

            const dados =  {
                name: nome, nickname: apelido, email: email, password: senha, _token: token
            };

            console.log(dados);

            $.ajax({
                method: 'post',
                url: 'cadastro',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify(dados),
                success: function(data){
                    console.log(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                }
            });

            return false;
        });
    });
</script>
