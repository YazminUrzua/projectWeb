<?php
	session_start();
	include('conectar.php');

    if(isset($_SESSION['user'])){
        $sesion = true;

        $identificador = $_SESSION['user'];
        $buscarUsuario = $conected->query("SELECT * FROM usuario WHERE nombre='$identificador'");

        $row = $buscarUsuario->fetch_array();
        $usuario = $row['nombre'];
        $tipoUsuario = $row['tipo'];
    }

    else {
        $sesion = false;
    }

    if(isset($_SESSION['carrito'])){
        $carrito_actual = $_SESSION['carrito'];
        $_SESSION['carrito']=$carrito_actual ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Productos</title>
    <link rel="icon" href="image/ImagenLogo.png"alt="" type="imagen/x-con">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,300&display=swap" rel="stylesheet">
</head>
<body>
 
    <header>
        <div class="container">
            <nav class="nav">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </div>
                <a href="index.php" class="logo">IKOO</a>
                
                <ul class="nav-list">
                    


                <?php if(isset($sesion)) {
                    if($sesion) {
                        echo " <li class='nav-item'>
                            <a href='#' class='nav-link '>".$usuario."  <i class='fas fa-user'></i> </a>
                            </li>
                            <li class='nav-item'>
                                <a href='logout.php' class='nav-link '>Cerrar sesión</a>
                            </li>";

                            if($tipoUsuario == "admin") {
                                echo "<li class='nav-item'>
                                    <a href='panel.html' class='nav-link '>Panel admin</a>
                                </li>";
                            } 
                            
                           else if($tipoUsuario == "usuario"){
                                echo "<li class='nav-item'>
                               <a href='pedidos.php' class='nav-link '>Mis pedidos</a>
                           </li>
                           <li class='nav-item'>
                           <a href='productosUs.php' class='nav-link'>Productos</a>
                            </li>
                <li class='nav-item'>
                <a href='#modal' class='nav-link active'>ver carrito</a>
            </li>
                "
                            ;
                   }

                        }  else {
                            echo "<li class='nav-item'>     
                            <li class='nav-item'>
                            <a href='index.php' class='nav-link active'>Volver</a>
                        </li>
                           <li class='nav-item'>
                           <a href='indexform.html' class='nav-link'>Sign up</a>
                       </li>
                       <li class='nav-item'>
                           <a href='login.html' class='nav-link '>Iniciar sesión</a>
                       </li>
                       <li class='nav-item'>
                       <a href='productosUs.php' class='nav-link'>Productos</a>
                   </li> 
                   <li class='nav-item'>
                   <a href='#modal' class='nav-link active'>ver carrito</a>
               </li>
                   "
                           
                           ;
                        }
                            
                }
                    ?>
                </ul>


            </nav>
        </div>
    </header>
    

    <!-- Contenedor de los productos del carrito -->
    <div class="container-carrito" id="modal">
		<div class="popup">
			<a href="#" class="btn-close">X</a>
			<h1>Mi carrito de compras</h1>
			<div class="container-productos-carrito">
	<?php
		if(isset($_SESSION['carrito'])) {
			$total = 0;
			for($i = 0; $i <= count($carrito_actual)-1; $i++) {
				if($carrito_actual[$i] != NULL) { ?>
				<div class="producto-added">
					<div class="container-info-product">
                        <?php echo "<img src=".$carrito_actual[$i]['imagen']." width='100px' height='60px'>"; ?>
                        <br>
						<?php echo $carrito_actual[$i]['lentis']." x".$carrito_actual[$i]['cantidad']; ?>
					</div>
					<div class="conainer-price-product">
						<?php 
                            $total = 0;
                            echo ($total = $total + ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad'])); 
                        ?>
					</div>
				</div>
			<?php 
				}
			}
		}
	?>
			</div>
			<div class="container-opciones-carrito" style=""> 
				<?php
					if(isset($total))
						echo "Total: ".$total;

					else
						echo "Total: 0";
				?>
			</div>
			<div class="container-opciones-carrito">
				<a href="vaciarCarro.php">Vaciar carro</a>
				<a href="#">Seguir comprando</a>
			
                <?php if(isset($sesion)) {
                    if($sesion) {
                       echo "<a href="."hacerPedido.php".">Finalizar compra</a>";
                       
	} else{echo"<a href="."login.html".">¿Quieres iniciar sesión?</a>";
}}else {
    
		echo "<script>
			alert('Es necesario iniciar sesión');
			location.href = 'login.html';
		</script>";
	}?>
			</div>
		</div>
	</div>

    
    <section class="pb" id="pb">
       
        <div class="container">
            <div class="pbtxt">
            <h2 class="h2-sub">Descargas</h2>
            </div>
        </div>
        </div>
    </section>

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



</body>
