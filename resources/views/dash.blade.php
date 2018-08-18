<form id="form-dash">
    <input id="title" type="text" placeholder="Título"><br><br>
    <input id="text" type="text" placeholder="Texto"><br><br>
    <input id="token" type="hidden" value="{{ csrf_token() }}">
    <input type="submit" value="Publicar">
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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

            $.ajax({
                method: 'post',
                url: 'dash',
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
