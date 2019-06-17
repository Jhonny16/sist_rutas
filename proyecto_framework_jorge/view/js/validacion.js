/**
 * Created by tito_ on 20/09/2018.
 */

$(document).ready(function () {
    permisos();
});

function permisos(){
    var tipo_usuario = $("#s_tipo_usuario").val();
    if(tipo_usuario == 2 || tipo_usuario=='2'){
        $("#div_usuario_sistema").attr('style','display:none');
    }

}

function sololetras(e) {

    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key).toLowerCase();
    letras = " abcdefghijklmnopqrstuvwxyz";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }

}

function numeros(e) {

    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = "1234567890";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }

}
function decimales(e) {

    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = " 1234567890.";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }

}
function solonumeros(e) {

    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = " #1234567890-";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }

}

function medida(e) {

    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = " xX1234567890.";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }

}

function dni_ruc(e) {

    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = "1234567890";

    if (letras.indexOf(teclado) === -1) {
        return false;

    }
    espe(e);
}

function espe(e) {
    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = "|!#$%&/(()=?*¨*[];:_'¿´+{},.";

    if (letras.indexOf(teclado) !== -1) {
        return false;
    }
}
function correo(e) {
    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = "|!#$%&/(()=?*¨*[];:'¿´+{},";

    if (letras.indexOf(teclado) !== -1) {
        return false;
    }
}

function medida(e) {
    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = " 1234567890.x";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }
}

function precio(e) {
    key = e.keyCode || e.which; //captura entrada del teclado
    teclado = String.fromCharCode(key);
    letras = "1234567890.";

    if (letras.indexOf(teclado) === -1) {
        return false;
    }
}

function edit() {
    title = "texto al pasar el raton";
}


function validar() {

    var h = "";
    h = $("#txtdr").val();
    if (h === "") {
        alert("dni vacio");

    }
    alert("entrooo");
}


function validarNumeros(evento)
{
    var tecla = (evento.which) ? evento.which : evento.keyCode;
    if (tecla >= 48 && tecla <= 57 || tecla == 46)
    {
        return true;
    }

    return false;
}

