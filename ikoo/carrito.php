<?php
    session_start();

    if(isset($_SESSION['carrito'])){
        $carrito_actual = $_SESSION['carrito'];

        if(isset($_POST['lentis'])){
            $lentes=$_POST['lentis'];
            $imagen=$_POST['imagen'];
            $precio=$_POST['precio'];
            $cantidad=$_POST['cantidad'];

            $carrito_actual[] = array("lentis" =>$lentes,
                                    "imagen" =>$imagen,
                                    "precio" =>$precio,
                                    "cantidad" =>$cantidad);
        }

    }

    else{
        $lentes=$_POST['lentis'];
        $imagen=$_POST['imagen'];
        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];

        $carrito_actual[] = array("lentis" =>$lentes,
                                "imagen" =>$imagen,
                                "precio" =>$precio,
                                "cantidad" =>$cantidad);
    }
    
    $_SESSION['carrito'] = $carrito_actual;
    header("Location:" .$_SERVER['HTTP_REFERER']);

