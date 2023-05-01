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
    
    $nombre_prod = $_POST["nombre_prod"];
    $marca = $_POST["marca"];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
   
    

    //consulta
    $insert="INSERT INTO productos( id_prod, nombre_prod, marca, precio, imagen, descripcion)
        values ('0', '$nombre_prod',  '$marca', '$precio', '$imagen', '$descripcion')";

        $ir=mysqli_query($con, $insert);
        if($ir){
            echo"<script>
                    alert('se ha registrado con exito');
                    location.href = 'panel.html';
                </script>";
        }else{
            echo"Hay un error";
        }
 ?>