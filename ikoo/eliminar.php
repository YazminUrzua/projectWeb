<?php
    include "conectar.php";

    $id = $_GET['ID'];
    
    $query = $conected->query("DELETE FROM productos WHERE id_prod='$id'");

    if($query) {
        echo '<script>
                alert("Se borró con exito");
                location.href = "listado.php";
              </script>';
    }

    else {
        echo '<script>
                alert("No se pudo UnU");
                location.href = "listado.php";
              </script>';
    }
?>