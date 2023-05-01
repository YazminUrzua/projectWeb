<?php

    $db_host="localhost";
    $db_user="root";
    $db_password="";
    $db_name="formulario";

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if(!$con){
        die("Error". mysqli_connect_error());
    }

    echo "conectando...";

    //Información
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST['pass'];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    

    //consulta
    $insert="INSERT INTO usuario( id, nombre, correo, pass, telefono, direccion)
        values ('0', '$nombre',  '$correo', '$password', '$telefono', '$direccion')";

        $ir=mysqli_query($con, $insert);
        if($ir){
            echo"<script>
                    alert('se ha registrado con exito');
                    location.href = 'login.html';
                </script>";
        }else{
            echo"Hay un error";
        }
 ?>