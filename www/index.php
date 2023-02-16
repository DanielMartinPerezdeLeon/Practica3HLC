<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Menu Principal</title>

	<!-- Bootstrap 5 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Solway&display=swap" rel="stylesheet" />

	<!-- Custom CSS -->
	<link rel="stylesheet" href="./css/index.css" type="text/css" />
</head>

<body class="bg-secondary d-flex align-items-center min-vh-100">
	<header>
		<nav class="navbar navbar-dark bg-success fixed-top">
			<div class="container-fluid justify-content-center">
				<span class="navbar-brand mb-0 h1">PRACTICA 3 HLC</span>
			</div>
		</nav>
	</header>

	<main class="container my-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-lg-6">
				<form method="post">
					<fieldset id="formulario_alta" class="border p-4">
						<legend class="text-center fs-2 mb-4">MENU PRINCIPAL</legend>

						<div class="mb-3">
							<button id="boton_iniciarSesion" class="btn btn-success w-100" name="boton_iniciarSesion">
								INICIAR SESIÓN
							</button>
						</div>

						<div class="mb-3">
							<button id="boton_registro" class="btn btn-success w-100" name="boton_registro">
								REGISTRARSE
							</button>
						</div>

						<div class="mb-3">
							<button id="boton_records" class="btn btn-success w-100" name="boton_records">
								RECORDS
							</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</main>

	<footer class="bg-success py-2 fixed-bottom">
		<div class="container-fluid">
			<p class="text-white text-center mb-0">
				Daniel Martín Pérez de Leon | José Manuel Fernández Vizcaíno
			</p>
		</div>
	</footer>

	<!-- Bootstrap 5 JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php

if (isset($_POST['boton_iniciarSesion'])) {
	header("Location: usuarios.php");
}
if (isset($_POST['boton_registro'])) {
	header("Location: alta.php");
}
if (isset($_POST['boton_records'])) {
	header("Location: records.php");
}

?>