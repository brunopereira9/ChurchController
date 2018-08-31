function logout() {

    var settings = {
        "dataType": "json",
        "async": true,
        "crossDomain": true,
        "url": apiHost('login')+"6870010883a79e8b2a508909dc21a05cc8ff73b8/"+getToken(),
        "method": "DELETE"
    }

    $.ajax(settings)
        .done(function() {
            $(window.document.location).attr('href','../index.html');
        })
        .fail(function(response) {
            alert( "Erro ao finalizar usuário." );
            $(window.document.location).attr('href','../index.html');
        });
    return false;
}