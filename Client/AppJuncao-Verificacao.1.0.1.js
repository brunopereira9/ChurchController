$(document).ready(function(){
    if (getToken().length != 0){
        verificaLogin();
    }else{
        // $(window.document.location).attr('href','http://localhost:63342/Client/');
    }
});
function verificaLogin() {

    var settings = {
        "dataType": "json",
        "async": true,
        "crossDomain": true,
        "url": apiHost('login')+"9fb29051f2217270a7b253a39f820310d85a78f0/"+getToken(),
        "method": "GET"
    }

    $.ajax(settings)
        .done(function(data) {
            setToken(data.remember_token);
            $('#usuario_nome').append(data.login);
        })
        .fail(function (data) {
            console.log(data);
        });

}