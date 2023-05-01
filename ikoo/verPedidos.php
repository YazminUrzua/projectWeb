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
        $id_usuario = $row['id'];
    }

    else {
        $sesion = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKOO.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="tstyle.css">
    <link rel="indexform" href="indexform.html">

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
                    
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">Inicio</a>
                    </li>

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
                              
                           </li>
                           <li class='nav-item'>
                           <a href='productosUs.php' class='nav-link'>Productos</a>
                            </li>";
                   }

                        }  else {
                            echo "<li class='nav-item'>     
                           <li class='nav-item'>
                           <a href='indexform.html' class='nav-link'>Sign up</a>
                       </li>
                       <li class='nav-item'>
                           <a href='login.html' class='nav-link '>Iniciar sesión</a>
                       </li>
                       <li class='nav-item'>
                       <a href='productosUs.php' class='nav-link'>Productos</a>
                   </li> "  ;
                        }
                            
                }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container1">
        <table >
            <thead>
            <tr>
                <th>id producto</th>
                <th>Fecha de entrega</th>
                <th>Pedido</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>

            </thead>
                <tbody>
                <?php
                $query = $conected->query("SELECT * FROM pedidos");
                
                while($row = $query->fetch_array()) { ?>
                    <tr>
                        <td><?php echo $row['id_pedido']; ?></td>
                        <td><?php echo $row['fecha_entrega']; ?></td>
                        <td><?php echo $row['producto']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                    </tr>
            <?php }
                ?>
            </tbody>
        </table>  
    </div>



    
</body>
</html>