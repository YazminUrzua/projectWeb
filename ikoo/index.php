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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKOO.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
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
                <a href="#" class="logo">IKOO</a>
                
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
                            <a href='descargas.php' class='nav-link'>Descargas</a>
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
                            <a href='descargas.php' class='nav-link'>Descargas</a>
                            </li>";
                   }

                        }  else {
                            echo "<li class='nav-item'>     
                           <li class='nav-item'>
                           <a href='indexform.html' class='nav-link'>Sign up</a>
                           <a href='descargas.php' class='nav-link'>Descargas</a>
                       </li>
                       <li class='nav-item'>
                           <a href='login.html' class='nav-link '>Iniciar sesión</a>
                       </li>
                       <li class='nav-item'>
                       <a href='productosUs.php' class='nav-link'>Productos</a>
                   </li> "
                           
                           ;
                        }
                            
                }
                    ?>
                </ul>
            </nav>
        </div>
    </header>


    <section class="hero" id="hero">
       
        <div class="container">

        <img src="images/por.jpg" alt="">
            <h2 class="h2-sub">
                <span class="fil">B</span>ienvenido
            </h2>
            <h1 class="head">Lentes de sol</h1>
            <div class="he-des">
                <h5>Ikoo.com</h5>
                <a href="productosUs.php" class="btn cta-btn">Explora</a>
            </div>
           
        </div>
    </section>

    <section class="dis-sto">
        <div class="container">
            <div class="res-info">
                <div>
                    <img src="images/nosotros.jpg" alt="">
                </div>
            
                <div class="res-des pad-rig">
                    <div class="global">
                        <h2 class="h2-sub">
                            <span class="fil">D</span>escubre
                        </h2>
                        <h1 class="head hea-dark">Nuestra historia</h1>
                        <div class="circle">
                            <i class="fas fa-circle"></i>
                        </div>
                    </div>
                    <p>
                        IKOO surge como una propuesta ante la falta de estilo hay durante el proceso de compra de
                        anteojos (sol o con aumento), así es como nace la idea de unir a la moda con la compra de lentes;
                        así que ya es cosa del pasado tener que ir a aquellas tiendas anticuadas, sino que ahora estamos
                        orgullosos de poder decir que somos distintos a los demás. 
                    </p>
                  <a href="#" class="btn cta-btn">Nosotros</a>
                </div>
               
            </div>
        </div>
    </section>


    <section class="prueba bt">
        <div class="container">
            <div class="global">
                <h2 class="h2-sub">
                    <span class="fil">V</span>isión<br>
                </h2>
            </div>
            <p class="pruebatxt"><br>
                Consolidarnos como la mejor opción para satisfacer las necesidades visuales de nuestros clientes, 
                gracias a nuestros diseños y compromiso. Así como desarrollar exitosamente nuestra marca y distribuirla
                efizcamente a nuestros clientes logrando un servicio integral.
            </p>
         
        </div>

            </div>

        </div>
    </section>


    <section class="disco">
        <div class="container">
            <div class="res-info">
                <div class="res-des">
                    <div class="global">
                        <h2 class="h2-sub">
                            <span class="fil">M</span>isión
                        </h2>
                        <div class="circle">
                            <i class="fas fa-circle"></i>
                        </div>
                    </div>
                    <p><br>
                        Somos una empresa mexicana enfocada en llevar a nuestros clientes las mejores gafas, al mejor 
                        precio, con las mejores opciones de pago y con el mejor estilo.
                    </p>
                </div>
                </div>
                <div class="image-group pad-rig">

                  
        
                </div>

            </div>
        </div>
    </section>

    


    <footer>
        <div class="container">
            <div class="footer-content">

            
                <div class="footer-div">
                    <div class="social-media">
                        <h4>Siguenos</h4>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-facebook-square"></i></a>
                            </li>
                            <li>
                                <a href="#"> <i class="fab fa-instagram"></i></a>
                            </li>
                            
                               
                        </ul>
                    </div>
                   
                </div>

            </div>
        </div>
    </footer>

    <script>

        const selectElement = function(element) {
            return document.querySelector(element);
        }


        let menuToggle = selectElement('.menu-toggle');
        let body = selectElement('body');

        menuToggle.addEventListener('click', function(){
            body.classList.toggle('open');
        })

    </script>

    
</body>
</html>