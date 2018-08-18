<form id="form-login">
    <input id="nickname" type="text" placeholder="Login"><br><br>
    <input id="password" type="password" placeholder="Senha"><br><br>
    <input id="token" type="hidden" value="{{ csrf_token() }}">
    <input type="submit" value="Entrar">
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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

            $.ajax({
                method: 'post',
                url: 'login',
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
