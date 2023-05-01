<?php
	$db_host="localhost";
    $db_user="root";
    $db_password="";
    $db_name="formulario";

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if(!$con){
        die("Error". mysqli_connect_error());
    }

    echo "conectando...";

	$nombre = $_POST['username'];
	$password = $_POST['contraseña'];
	$consulta = "SELECT * FROM usuario WHERE nombre='$nombre' AND pass='$password'";

	$query = mysqli_query($con, $consulta);
	$filas = mysqli_num_rows($query);

	if($filas) {
		session_start();
		$_SESSION['user'] = $nombre;
		echo "<script>
			location.href = 'index.php';
		</script>";
	}
	else {
		echo "<script>
			alert('Nombre o contraseña incorrectos, intenta de nuevo');
			location.href = 'login.html';
		</script>";
	}
?>