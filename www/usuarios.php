<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/lista.css">
</head>

<body class="bg-secondary ">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
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
                            <a class="nav-link" href="alta.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="records.php">Records</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">USUARIOS</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <?php


                            include 'consultasTablaUsuarios.php';

                            $jugadores = obtenerTodosUsuarios();


                            foreach ($jugadores as $jugador) {
                                $segundosEdadUsuario = strtotime($jugador['fecha_nacimiento']);
                                $segundosFechaActual = time();
                                $edad = floor(($segundosFechaActual - $segundosEdadUsuario) / 31536000);
                                $envioJugador = $jugador['email'];

                                echo '<div class="col-md-3">';
                                echo '<div class="card">';
                                echo '<a class="enlace" href="iniciarSesion.php?datosJugador=' . $envioJugador . '"><img class="card-img-bottom" src="./imagenes/jugador.png" alt="Card image cap" id="imgIS"></a>';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . $jugador['nombre'] . ' ' . $jugador['apellido'] . '</h5>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }




                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-success text-light p-3 mt-5">
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
<script>
    function filtrar() {
        var input, filter, ul, h1, a, i, txtValue;
        input = document.getElementById("busqueda");
        filter = input.value.toUpperCase();
        a = document.getElementsByClassName("enlace");
        for (i = 0; i < a.length; i++) {
            h1 = a[i].getElementsByTagName("h1")[0];
            txtValue = h1.textContent || h1.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
</script>
</body>

</html>