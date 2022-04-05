<?php
    //Realiza la conexión a la base de datos
    /* 
    localhost = host
    root = usuario(es por defecto de xampp)
    "" = contraseña de usuario root(no tiene)
    login_register = la base de datos que creé en mi computadora
    */
    $conexion = mysqli_connect("localhost", "root", "", "inversio");

    /*
    if($conexion){
        echo 'Conexión establecida.';
    }else{
        echo 'No se pudo establecer conexión.';
    }
    */
    
?>