<?php
    include "conectar.php";

    $id = $_POST['id'];

    $nombre = $_POST['nombre_prod'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];

    $query = $conected->query("UPDATE productos SET nombre_prod ='$nombre', marca ='$marca', precio ='$precio', imagen ='$imagen', descripcion ='$descripcion' WHERE id_prod='$id'");

    if($query) {
        echo '<script>
                alert("Se  ha modificó");
                location.href = "listado.php";
              </script>';
    }

    else {
        echo '<script>
                alert("No se pudo hacer modificacion");
                location.href = "listado.php";
              </script>';
    }
?>