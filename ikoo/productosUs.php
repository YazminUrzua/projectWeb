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
            $subtotal = 0;
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
                            $subtotal = 0;
                            echo ($subtotal += ($carrito_actual[$i]['precio'] * $carrito_actual[$i]['cantidad'])); 
                            $total += $subtotal;
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
            <h2 class="h2-sub">Productos</h2>
            </div>
        </div>
        </div>
    </section>


<div class="conteParent">
     
<?php
    $selectProductos = $conected->query("SELECT * FROM productos");
    while($row = $selectProductos->fetch_array()){ ?>

    <section>
        <div class="conte">
            <div class="card gafas">
            <img src="<?php echo $row["imagen"]; ?>" alt="" >
        </div>

        <div class="informacion">
            <h1><?php echo $row["nombre_prod"]; ?></h1>
            <p><?php echo $row["descripcion"]; ?></p>
        </div>

        <div class="precio">
            <div class="box-precio">
                <span class="precio1">$<b><?php echo $row["precio"]; ?></b></span>
                <form action="carrito.php" method="POST">
                    <input type="hidden" name="lentis" value="<?php echo $row["nombre_prod"]; ?>">
                    <input type="hidden" name="imagen" value="<?php echo $row["imagen"]; ?>">
                    <input type="hidden" name="precio" value="<?php echo $row["precio"]; ?>">

                    <select name="cantidad">
                <?php
                    for($i = 1; $i < 100; $i++){
                        echo "<option name=".$i.">".$i."</option>";
                    }
                ?>
                    </select>
                   
                    <button class="btn cta-btn">comprar</button>
                  
                </form>
            </div>
            </div>
    </section>

<?php }
?>

</body>
