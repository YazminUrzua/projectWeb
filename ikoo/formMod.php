<?php
    $id = $_GET['ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Modificar</title>
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
                    
                    <li class="nav-item">
                        <a href="listado.php" class="nav-link active">Volver</a>
                    </li>
                    
                </ul>
            </nav>
        </div>
    </header>

    <form action="modificar.php" method="POST">


        <p>
            <label for="nombre_prod">Tipo </label><br/>
            <input type="text" name="nombre_prod" id="nombre_prod" required="obligatorio" placeholder="Ingrese su nombre de usuario" class="field">
        </p>

        <p>
            <label for="marca">Marca </label><br/>
            <input type="text" name="marca" id="marca" required="obligatorio" placeholder="Ingrese la marca"class="field">
        </p>  

        <p>
            <label for="precio">Precio</label><br/>
            <input type="text" name="precio" id="precio" required="obligatorio" placeholder="Ingrese el precio" class="field">
        </p>

        <p>
            <label for="imagen">Imagen </label><br/>
            <input type="text" name="imagen" id="imagen" required="obligatorio" placeholder="Ingrese la url"class="field">
        </p>  
        <p>
            <label for="descripcion">Descripcion </label><br/>
            <input type="text" name="descripcion" id="descripcion" required="obligatorio" placeholder="Ingrese la descripción"class="field">
        </p>  <br><br/>
        <br><br/>

        <p>
            <input type="hidden" name="id" value="<?php echo $id; ?>" class="field">
        </p> 

        <button type="submit" class="btn cta-btn">Modificar</button>
       
    </form>
</body>
</html>