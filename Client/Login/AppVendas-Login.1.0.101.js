$(document).ready(function(){
    $("#form-login").submit(function(){
        var appLogin = $('#app-login').val();
        var appSenha = $('#app-senha').val();
        var settings = {
            "dataType": "json",
            "async": true,
            "crossDomain": true,
            "url": apiHost('login')+"9b7c68a918b17eb053809b198d7c9abfc142f30a",
            "method": "POST",
            "data": {
                login: appLogin,
                senha: appSenha
            }
        }

        $.ajax(settings)
            .done(function(data) {
                setToken(data.remember_token);
                $(window.document.location).attr('href','pages/index.html');
            })
            .fail(function() {
                alert( "Usuário ou senha incorretos." );
            });
        return false;
    });
});