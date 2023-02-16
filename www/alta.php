<?php

include 'conexionbd.php';

$error = FALSE;
$nombre = 'class="entrada_datos"';
$apellidos = 'class="entrada_datos"';
$email = 'class="entrada_datos"';
$fecha = 'class="entrada_datos"';

if (isset($_POST['comprobacion'])) {

	if (isset($_POST['nombre'])) {
		if (comprobar_introduccion_string($_POST['nombre']) == TRUE) {
			$error = TRUE;
			$nombre = 'class="entrada_datos error"';
		}
	} else {
		$error = TRUE;
	}

	if (isset($_POST['apellidos'])) {
		if (comprobar_introduccion_string_vacio($_POST['apellidos']) == TRUE) {
			$error = TRUE;
			$apellidos = 'class="entrada_datos error"';
		}
	}

	if (isset($_POST['fecha'])) {
		if (comprobar_introduccion_fecha($_POST['fecha']) == TRUE) {
			$error = TRUE;
			$fecha = 'class="entrada_datos error"';
		}
	}
	if (isset($_POST['email'])) {
		if (comprobar_introduccion_email($_POST['email']) == TRUE) {
			$error = TRUE;
			$email = 'class="entrada_datos error"';
		}
	} else {
		$error = TRUE;
	}


	if ($error == FALSE) {
		insertar_usuario($_POST['email'], $_POST['nombre'], $_POST['fecha'], $_POST['apellidos']);
		header("location:./index.php");
	}
}

function comprobar_introduccion_string($campo)
{
	$error = comprobar_sql_injection($campo);
	if ($error == FALSE) {
		if (strlen($campo) > 100) {
			$error = TRUE;
		} else if ($campo == "") {
			$error = TRUE;
		}
	}
	return $error;
}

function comprobar_introduccion_string_vacio($campo)
{
	$error = comprobar_sql_injection($campo);
	if ($error == FALSE) {
		if (strlen($campo) > 100) {
			$error = TRUE;
		}
	}
	return $error;
}

function comprobar_introduccion_email($campo)
{
	$error = comprobar_sql_injection($campo);

	if ($error == FALSE) {
		if (!filter_var($campo, FILTER_VALIDATE_EMAIL)) {
			$error = TRUE;
		}
	} else {
		echo ("Email invalido");
	}
	return $error;
}
function comprobar_introduccion_fecha($campo)
{
	$error = comprobar_sql_injection($campo);
	if ($error == FALSE) {
		if ($campo == "") {
			$error = TRUE;
		} else {
			$segundos_fecha = strtotime($campo);
			$segundos_fecha_actual = time();
			if ($segundos_fecha_actual - $segundos_fecha <= 0) {
				echo ("error en la fecha");
				$error = TRUE;
			}
		}
	}
	return $error;
}

function comprobar_sql_injection($valor)
{
	$error = FALSE;
	if (strpos($valor, "'") == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '"') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, ';') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '<') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '>') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '/') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '&') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '--') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '/*') == TRUE) {
		$error = TRUE;
	} else if (strpos($valor, '*/') == TRUE) {
		$error = TRUE;
	}
	return $error;
}

function mostrar_campo($nombre)
{
	global $error;
	if ($error == TRUE) {
		echo ('"' . $_POST[$nombre] . '"');
	} else {
		echo ('""');
	}
}


function insertar_usuario($email, $nombre, $fecha, $apellido)
{
	$con = conexion();
	$sql = 'INSERT INTO USUARIOS VALUES ("' . $email . '", "' . $nombre . '", "' . $fecha . '", "' . $apellido . '", NULL, NULL);';
	$resultado = mysqli_multi_query($con, $sql);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/alta.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Solway&display=swap" rel="stylesheet">
	<title>Alta</title>
</head>

<body class="bg-secondary d-flex align-items-center min-vh-100">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">PRACTICA 3 HLC</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="records.php">Records</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="usuarios.php">Iniciar Sesion</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<form action="./alta.php" method="post" class="justify-content-center">
		<div class="container">
			<fieldset id="formulario_alta" class="border p-3 my-3">
				<legend id="hola" class="text-center fw-bold fs-3 mb-3">Nuevo jugador</legend>
				<table class="table table-bordered">
					<tr>
						<td>
							<label for="nombre" class="form-label">Nombre</label>
							<input id="nombre" type="text" name="nombre" class="form-control" <?php echo ($nombre); ?> value=<?php mostrar_campo('nombre'); ?> />
						</td>
						<td>
							<label for="apellidos" class="form-label">Apellidos</label>
							<input id="apellidos" type="text" name="apellidos" class="form-control" <?php echo ($apellidos); ?> value=<?php mostrar_campo('apellidos'); ?> />
						</td>
					</tr>
					<tr>
						<td>
							<label for="email" class="form-label">Email</label>
							<input id="email" type="text" name="email" class="form-control" <?php echo ($email); ?> value=<?php mostrar_campo('email'); ?> />
						</td>
						<td>
							<label for="fecha" class="form-label">Fecha de Nacimiento</label>
							<input id="fecha" type="date" name="fecha" class="form-control" <?php echo ($fecha); ?> value=<?php mostrar_campo('fecha'); ?> />
						</td>
					</tr>
				</table>
				<div id="caja_boton" class="text-center">
					<input id="enviar" type="submit" value="Crear" class="btn btn-primary">
				</div>
			</fieldset>
		</div>
		<input id="comprobacion" type="hidden" name="comprobacion" value="ok" />
	</form>
	<footer class="bg-success text-light p-3 mt-5 fixed-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p class="text-center mb-0">Daniel Martín Pérez de Leon | José Manuel Fernández Vizcaíno</p>
				</div>
			</div>
		</div>
	</footer>
</body>

</html>