<?php
	session_start();
	include('conectar.php');
	session_destroy();
?>
<script type="text/javascript">
	alert("Sesion cerrada");
	location.href = 'index.php';
</script>