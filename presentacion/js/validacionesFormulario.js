/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



window.addEventListener('load', inicio, false);

function inicio() {
    document.formulario.addEventListener('submit', validar, false);
}

function validar(evt) {

    var clave = document.formulario.clave.value
    var confirmacionClave = document.formulario.confirmarClave.value

    var identificacion = document.formulario.identificacion
    var registroIdentificacion = document.formulario.registroIdentificacion.value
    var identifiacionAnterior = document.formulario.identificacionAnterior.value

    var email = document.formulario.email
    var registroEmail = document.formulario.registroEmail.value
    var emailAnterior = document.formulario.emailAnterior.value

    if (registroIdentificacion !== 'nan') {
        if (identificacion.value !== identifiacionAnterior) {
            alert('La IDENTIFIACIÓN ya existe')
            identificacion.focus()
            evt.preventDefault()
        }
    }

    if (registroEmail !== 'nan') {
        if (email.value !== emailAnterior) {
            alert('El EMAIL ya existe')
            email.focus()
            evt.preventDefault()
        }
    }

    if (clave !== confirmacionClave) {
        alert('Las claves ingresadas son distintas')
        email.focus()
        evt.preventDefault()
    }

}

function validarRegistro(tabla, campo, valor, consulta, receptor, servidor) {
    cargar = document.getElementById('carga')
    //declaramos la variable que tendrá la conexión
    var xmlhttp;
    //verificamos la version del navegador para asignar una conexión
    if (window.XMLHttpRequest) {//en caso de que sean navegadores modernos
        xmlhttp = new XMLHttpRequest();
    } else {//en caso de que se un navegador no moderno
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var valores = "tabla=" + tabla + "&campo=" + campo + '&valor=' + valor + '&consulta=' + consulta;
    xmlhttp.onreadystatechange = function () {

        //carga.className = "loader"
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {//verificamos que todo se correcto
            var mensaje = xmlhttp.responseText
            document.getElementById(receptor).value = mensaje.trim()
            //document.formulario.datos.value = mensaje
        }

    }

    xmlhttp.open("POST", servidor, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(valores);

}




function cambiarContrasenia() {

    if (document.formulario.EClave.checked) {
        document.getElementById('clave').style.display = 'block';
        document.getElementById('confirmarClave').style.display = 'block'
    } else {
        document.getElementById('clave').style.display = 'none';
        document.getElementById('confirmarClave').style.display = 'none'
    }


}

function validarContrasenia() {

    var contrasenia = document.formulario.clave.value;
    var confirmacionClave = document.formulario.confirmarClave.value;
    if (contrasenia == confirmacionClave) {
        document.getElementById('confirmacion').innerHTML = "";
    } else
        document.getElementById('confirmacion').innerHTML = "<div id='confirmacion' class='alert alert-warning form-group col-md-6 col-md-offset-3 text-center' role='alert'>Las cotraseñas no coninciden</div>";

}

/*$("#idCentroDeFormacion").change(function(event) {
 if($(this)[0].selectedIndex==0)
 {
 $(this).prop('required',true);
 $("#txtFin").val('');
 }
 else
 {
 $(this).prop('required',false);
 $("#txtFin").val($("#idCentroDeFormacion option:selected").val());
 }
 });
 
 time()
 function time() {
 setTimeout(function(){
 document.getElementById("alerta").style.display = "none";
 }, 5000);
 }*/



