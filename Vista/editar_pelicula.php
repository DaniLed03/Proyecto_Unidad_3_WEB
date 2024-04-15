<!DOCTYPE html>
<html>
<head>
    <title>Editar Película</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="../Vista/css/forms.css">
    <link rel="stylesheet" href="../Vista/css/menu.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="menu.html"><img src="img/Logo.png" alt="Logo"></a>
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
          <h2 class="mb-4">Editar Película</h2>
          <?php
            // Verificar si se recibió un ID de película válido
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $id_pelicula = $_GET['id'];

                // Incluir el archivo de conexión a la base de datos
                require_once('../Modelo/db.php');

                // Establecer conexión
                $conexion = new Conexion();
                $conn = $conexion->conectar();

                // Consultar la película con el ID proporcionado
                $query = "SELECT * FROM pelicula WHERE id_pelicula = $id_pelicula";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $pelicula = $result->fetch_assoc();
          ?>
          <form id="editarPeliculaForm" action="../Controladores/peliculascontroller.php?action=editar" method="post">
            <input type="hidden" name="id" value="<?php echo $id_pelicula; ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $pelicula['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sinopsis">Sinopsis:</label>
                <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3" required><?php echo $pelicula['sinopsis']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="id_genero">Género:</label>
                <select class="form-control" id="id_genero" name="id_genero" required>
                    <option value="">Seleccione</option>
                    <?php
                    // Consultar los géneros disponibles
                    $query_generos = "SELECT * FROM genero";
                    $result_generos = $conn->query($query_generos);
                    
                    if ($result_generos->num_rows > 0) {
                        while ($genero = $result_generos->fetch_assoc()) {
                            echo "<option value='" . $genero['id_genero'] . "'";
                            if ($genero['id_genero'] == $pelicula['id_genero']) {
                                echo " selected";
                            }
                            echo ">" . $genero['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_inicio_cartelera">Fecha de Inicio en Cartelera:</label>
                <input type="date" class="form-control" id="fecha_inicio_cartelera" name="fecha_inicio_cartelera" value="<?php echo $pelicula['fecha_inicio_cartelera']; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin_cartelera">Fecha de Fin en Cartelera:</label>
                <input type="date" class="form-control" id="fecha_fin_cartelera" name="fecha_fin_cartelera" value="<?php echo $pelicula['fecha_fin_cartelera']; ?>" required>
            </div>
            <div class="form-group">
                <label for="boletos">Boletos:</label>
                <input type="number" class="form-control" id="boletos" name="boletos" value="<?php echo $pelicula['boletos']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton">Guardar</button>
            <a href="../Vista/listado_peliculas.php" class="btn btn-secondary">Cancelar</a>
          </form>
          <?php
                } else {
                    // No se encontró ninguna película con el ID proporcionado
                    echo "<p>No se encontró ninguna película.</p>";
                }

                // Cerrar la conexión
                $conn->close();
            } else {
                // No se proporcionó un ID de película válido
                echo "<p>No se proporcionó un ID de película válido.</p>";
            }
          ?>
      </div>
    </div>
    <!-- Incluyendo Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('submitButton').addEventListener('click', function(e) {
          e.preventDefault();
          Swal.fire({
              title: "¿Estás seguro?",
              text: "¿Quieres guardar los cambios?",
              icon: "question",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Sí, guardar",
              cancelButtonText: "Cancelar"
          }).then((result) => {
              if (result.isConfirmed) {
                  // Si se confirma, enviar el formulario de edición
                  document.getElementById("editarPeliculaForm").submit();
              }
          });
      });
    </script>
</body>
</html>
