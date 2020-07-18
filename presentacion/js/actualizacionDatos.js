/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function actualizarRegistro(datos) {
        cargar = document.getElementById('carga')
        //declaramos la variable que tendrá la conexión
        var xmlhttp;
        //verificamos la version del navegador para asignar una conexión
        if (window.XMLHttpRequest) {//en caso de que sean navegadores modernos
            xmlhttp = new XMLHttpRequest();
        } else {//en caso de que se un navegador no moderno
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
   
        var valores = datos[0]['datos'];
        xmlhttp.onreadystatechange = function () {

            //carga.className = "loader"
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {//verificamos que todo se correcto
                var mensaje = xmlhttp.responseText
                
           
            }
            else{
               
            }

        }
        
        xmlhttp.open("POST", datos[0]['servidor'], true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(valores);

}
