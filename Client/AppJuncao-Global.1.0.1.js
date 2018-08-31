function apiHost(controlador) {
    var host = 'http://localhost:8000/api/';

    if (controlador == 'login'){
        return host + 'd56b699830e77ba53855679cb1d252da/';
    }
    if (controlador == 'usuario'){
        return host + 'f8032d5cae3de20fcec887f395ec9a6a/';
    }
    if (controlador == 'departamentos'){
        return host + 'f7b391b19acafeb16ba6f1e4676a617e/';
    }
    if (controlador == 'pessoa') {
        return host + '5b9f3257ab6a7a150f20f7d4f228559b/';
    }
    if (controlador == 'visitante') {
        return host + 'cab5a031f5506b862b7487f987edbd68/';
    }
}

function getToken(){
    var token = Cookies.get('token');
    return token;
}

function setToken(token){
    Cookies.set('token',token);
}