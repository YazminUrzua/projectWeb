<?php
session_start();
include('conectar.php');
require 'vendor/autoload.php';

use Dompdf\Dompdf;

//traemos el carrito para sacar los productos
if (isset($_SESSION['carrito']))
    $carrito_actual = $_SESSION['carrito'];

//identificamos el usuario que hará elpedido
$identificador = $_SESSION['user'];
$buscarUsuario = $conected->query("SELECT * FROM usuario WHERE nombre='$identificador'");

$row = $buscarUsuario->fetch_array();
$id_usuario = $row['id'];

//identificamos la fecha de entrega
$fechaActual = date("m");
$mesDeEntrega = calculoEntrega($fechaActual);

$fechaEntrega = date("d") . "/" . $mesDeEntrega . "/" . date("y");

//Damos formato al pedido | Tomamos el total de productos | Sacamos el total
$cadenaPedido = "";
$cantidadTotal = 0;
$totalPrecio = 0;

for ($i = 0; $i <= count($carrito_actual) - 1; $i++) {
    if ($carrito_actual[$i] != NULL) {
        $cadenaPedido = $cadenaPedido . "" . $carrito_actual[$i]['lentis'] . " x" . $carrito_actual[$i]['cantidad'] . " ";

        $cantidadTotal += $carrito_actual[$i]['cantidad'];

        $totalPrecio += ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad']);
    }
}


$addPedido = $conected->query("INSERT INTO pedidos VALUES (0, '$fechaEntrega', '$cadenaPedido', '$cantidadTotal', '$totalPrecio', '$id_usuario')");

if ($addPedido) {

    //////////////////////
    $dompdf = new Dompdf();

    $html = '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <style>
            .container-titulo {
                width: 100%;
                height: auto;

                padding: 50px 0;
                background: red;
            }

            .container-titulo h1 {
                color: white;
                font-family: Arial, Helvetica, sans-serif;
            }

            .container-general {

                display: grid;
            }
        </style>
    
        <title>Ticket</title>
    </head>
    <body>
        <nav class="container-titulo">
            <h1>Tiket de compra</h1>
        </nav>
    
        <div class="container-general">
            <p>Gracias por tu compra :)</p>'; 

            for($i = 0; $i < sizeof($carrito_actual); $i++) {
               // if($carrito_actual[$i] != NULL) {
                    $html .= "<p>Producto: ".$carrito_actual[$i]['lentis']."</p>";
                    //$html .= "<p>Fecha entrega: ".$carrito_actual[$i]['fecha_entrega']."</p>";
                    $html .= "<p>Cantidad: ".$carrito_actual[$i]['cantidad']."</p>";
                    $html .= "<p>Subtotal: ".($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad'])."</p>";
                    $html .= "<hr>";
                }
         

    $html .= '</div>
    </body>
    </html>';

    // Cargar el contenido HTML en Dompdf
    $dompdf->loadHtml($html);

    // Renderizar el contenido HTML como PDF
    $dompdf->render();

    // Generar el archivo PDF y enviarlo al navegador
    $dompdf->stream('ticket.pdf');
    /*
        echo "<script>
               alert('Tu pedido fue registrado con exito!!!');
            location.href = 'index.php';
              </script>";
*/
    //unset($_SESSION['carrito']);
}




function calculoEntrega($dato)
{
    if (($dato + 1) > 12)
        return 1;

    else
        return $dato;
}
