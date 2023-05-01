<?php
    include "conectar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <link rel="stylesheet" href="tstyle.css">
</head>
<body>
    
<header>
        <div class="container">
            <nav class="nav">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </div>
                <a href="panel.html" class="logo">IKOO</a>
                
                <ul class="nav-list">    
                    <li class="nav-item">
                        <a href="panel.html" class="nav-link active">Volver</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class ="buscador">
    <form action="" method="get">
    
        <input type= "text" name="busqueda"><br>
        <input type="submit" name="enviar" value="Buscar">
    </form>

    <?php
    if(isset($_GET['enviar'])){
        $busqueda = $_GET['busqueda'];
        $query = $conected->query("SELECT * FROM productos  WHERE id_prod LIKE '%$busqueda%'");

        while ($row = $query->fetch_array()) {
            echo $row['id_prod'].'<br>';
            ?>
                <tr>
                    <td><?php echo $row['id_prod']; ?></td>
                    <td><?php echo $row['nombre_prod']; ?></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><img src="<?php echo $row['imagen']; ?>" width="20px" height="20px"></td>
                    <td><?php echo $row['descripcion']; ?></td>

                    <td><a href="eliminar.php?ID=<?php echo $row['id_prod']; ?>">Borrar</a></td>
                    <td><a href="formMod.php?ID=<?php echo $row['id_prod']; ?>">Modificar</a></td>
                </tr>
        <?php
        }
         }
           ?> 
           
    </div> 

    <div class="container1">
    <table >
        <thead>
          <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Eliminar</th>
            <th>Modificar</th>
          </tr>

        </thead>
            <tbody>
            <?php
            $query = $conected->query("SELECT * FROM productos");
            
            while($row = $query->fetch_array()) { ?>
                <tr>
                    <td><?php echo $row['id_prod']; ?></td>
                    <td><?php echo $row['nombre_prod']; ?></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><img src="<?php echo $row['imagen']; ?>" width="20px" height="20px"></td>
                    <td><?php echo $row['descripcion']; ?></td>

                    <td><a href="eliminar.php?ID=<?php echo $row['id_prod']; ?>">Borrar</a></td>
                    <td><a href="formMod.php?ID=<?php echo $row['id_prod']; ?>">Modificar</a></td>
                </tr>
        <?php }
            ?>
            </tbody>
            </table>
            
</div>

</body>

                
                    
</html>