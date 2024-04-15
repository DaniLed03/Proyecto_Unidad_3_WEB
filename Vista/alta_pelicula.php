<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Película</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/forms.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="menu.html"><img src="img/logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="menu.html">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Clientes
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="alta_cliente.html">Registro de cliente</a>
            <a class="dropdown-item" href="listado_clientes.php">Clientes</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Empleados
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="alta_empleado.html">Registro de empleados</a>
            <a class="dropdown-item" href="listado_empleados.php">Empleados</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Generos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="alta_genero.html">Registro de generos</a>
            <a class="dropdown-item" href="listado_generos.php">Generos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Peliculas
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="alta_pelicula.php">Registro de peliculas</a>
            <a class="dropdown-item" href="listado_peliculas.php">Peliculas</a>
            <a class="dropdown-item" href="venta_boletos.php">Venta de Boletos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Productos 
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="alta_producto.html">Registro de productos</a>
            <a class="dropdown-item" href="listado_productos.php">Productos</a>
            <a class="dropdown-item" href="venta_snack.php">Venta de Snack</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Ventas 
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="reporte_productos.php">Ventas Productos</a>
            <a class="dropdown-item" href="reporte_peliculas.php">Ventas Peliculas</a>
            <a class="dropdown-item" href="reporte_totales.php">Totales</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
      
    <div class="container mt-5">
      <div class="container-form" style="background-color: #001834; padding: 20px;">
          <h2 class="mb-4">Alta de Película</h2>
          <form id="altaPeliculaForm" action="../Controladores/PeliculasController.php?action=alta" method="post">
            <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
              </div>
              <div class="form-group">
                  <label for="sinopsis">Sinopsis:</label>
                  <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3" required></textarea>
              </div>
              <div class="form-group">
                  <label for="id_genero">Género:</label>
                  <select class="form-control" id="id_genero" name="id_genero" required>
                    <option value="">Seleccione</option>
                    <?php
                    require_once('../Modelo/Genero.php');
                    
                    $genero = new Genero();
                    $generos = $genero->listarGeneros(); // Función para obtener los géneros de la base de datos
                    
                    foreach ($generos as $genero) {
                        echo "<option value='" . $genero['id_genero'] . "'>" . $genero['nombre'] . "</option>";
                    }
                    ?>
                  </select>
              </div>
              <div class="form-group">
                  <label for="fecha_inicio_cartelera">Fecha de Inicio en Cartelera:</label>
                  <input type="date" class="form-control" id="fecha_inicio_cartelera" name="fecha_inicio_cartelera"
                      required>
              </div>
              <div class="form-group">
                  <label for="fecha_fin_cartelera">Fecha de Fin en Cartelera:</label>
                  <input type="date" class="form-control" id="fecha_fin_cartelera" name="fecha_fin_cartelera" required>
              </div>
              <div class="form-group">
                  <label for="boletos">Boletos:</label>
                  <input type="number" class="form-control" id="boletos" name="boletos" required>
              </div>
              <button type="button" class="btn btn-primary" onclick="confirmarGuardar()">Guardar</button>
              <a href="menu.html" class="btn btn-secondary ml-2">Regresar</a>
            </form>
      </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      // Función para mostrar la alerta de confirmación antes de enviar el formulario
      function confirmarGuardar() {
        var nombre = document.getElementById('nombre').value;
        var sinopsis = document.getElementById('sinopsis').value;
        var id_genero = document.getElementById('id_genero').value;
        var fecha_inicio_cartelera = document.getElementById('fecha_inicio_cartelera').value;
        var fecha_fin_cartelera = document.getElementById('fecha_fin_cartelera').value;
        var boletos = document.getElementById('boletos').value;

        if (nombre === '') {
            Swal.fire({
                title: "Error",
                text: "El campo de nombre de la película no puede estar vacío",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        } else if (sinopsis === '') {
            Swal.fire({
                title: "Error",
                text: "El campo de sinopsis de la película no puede estar vacío",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        } else if (id_genero === '') {
            Swal.fire({
                title: "Error",
                text: "Debe seleccionar un género para la película",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        } else if (fecha_inicio_cartelera === '') {
            Swal.fire({
                title: "Error",
                text: "Debe seleccionar una fecha de inicio en cartelera para la película",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        } else if (fecha_fin_cartelera === '') {
            Swal.fire({
                title: "Error",
                text: "Debe seleccionar una fecha de fin en cartelera para la película",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        }  else if (boletos === '') {
            Swal.fire({
                title: "Error",
                text: "Debes seleccionar la cantidad de boletos disponibles para la película",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        } else {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¿Quieres guardar esta película?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, guardar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("altaPeliculaForm").submit();
                }
            });
        }
    }
  </script>
</body>

</html>
