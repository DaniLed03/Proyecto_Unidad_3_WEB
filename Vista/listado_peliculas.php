<!DOCTYPE html>
<html>
<head>
    <title>Listado de Películas</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Vista/css/menu.css">
    <link rel="stylesheet" href="../Vista/css/forms.css">
    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            color: white; 
        }
        th, td {
            color: white; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="menu.html"><img src="Img/logo.png" alt="logo"></a>
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
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
    <div class="container mt-5">
        <div class="container-form" style="background-color: #001834; padding: 20px;">
            <h2 class="mb-4">Listado de Películas</h2>

      	    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formula" id="formula">            
            <label for="desde">Desde:</label>
            <input type="date" id="desde" name="desde">
            <label for="hasta">Hasta:</label>
            <input type="date" id="hasta" name="hasta">
            <button type="submit" name="aplicar" id="aplicar">Apply</button>
	    </form>
            <hr>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Sinopsis</th>
                        <th>Género</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Boletos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de conexión a la base de datos y la definición de la clase Genero
                    require_once('../Modelo/db.php');
                    require_once('../Modelo/Genero.php');

                    // Establecer conexión
                    $conexion = new Conexion();
                    $conn = $conexion->conectar();

                    // Instanciar la clase Genero
                    $genero = new Genero();

                        // Consultar las películas en la base de datos
              if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {  
                      $fechaInicio = $_POST["desde"];
                      $fechaFin = $_POST["hasta"];
                      echo("<P style='text-align:right;'> Fecha Inicio: $fechaInicio");
                      echo("  Fecha Fin: $fechaFin </p>");
                      $query = "SELECT * FROM pelicula where (fecha_inicio_cartelera BETWEEN '$fechaInicio' and '$fechaFin' );";
                  }
		               else
		              {
	                 $query = "SELECT * FROM pelicula;";		        
			            }
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Mostrar las películas en la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id_pelicula'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['sinopsis'] . "</td>";
                            
                            // Consultar el nombre del género usando la clase Genero
                            $nombre_genero = $genero->obtenerNombreGenero($row['id_genero']);
                            echo "<td>" . $nombre_genero . "</td>";
                            
                            echo "<td>" . $row['fecha_inicio_cartelera'] . "</td>";
                            echo "<td>" . $row['fecha_fin_cartelera'] . "</td>";
                            echo "<td>" . $row['boletos'] . "</td>";
                            echo "<td>";
                            echo "<button onclick='confirmarEdicion(" . $row['id_pelicula'] . ")' class='btn btn-primary'>Editar</button>";
                            //echo "<button onclick='confirmarEliminacion(" . $row['id_pelicula'] . ")' class='btn btn-danger'>Eliminar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay películas disponibles.</td></tr>";
                    }

                    // Cerrar la conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Incluir Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Función para filtrar la tabla de géneros
        function filtrarTabla() {
            // Obtener el valor del campo de búsqueda
            var texto = document.getElementById("searchInput").value.toLowerCase();
            // Obtener las filas de la tabla
            var filas = document.querySelectorAll("tbody tr");
            // Iterar sobre las filas y mostrar u ocultar según el texto de búsqueda
            filas.forEach(function(fila) {
                var nombre = fila.getElementsByTagName("td")[1].textContent.toLowerCase();
                if (nombre.includes(texto)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        // Agregar evento keyup al campo de búsqueda
        document.getElementById("searchInput").addEventListener("keyup", filtrarTabla);
    </script>
 
    <script>
	$(function() {
            function validarYAplicarFechas() {
                var desdeVal = $("#desde").val();
                var hastaVal = $("#hasta").val();

                var desdeDate = $.datepicker.parseDate("yy-mm-dd", desdeVal);
                var hastaDate = $.datepicker.parseDate("yy-mm-dd", hastaVal);
                if (hastaDate < desdeDate) {
                    alert("La fecha Hasta no puede ser anterior a la fecha Desde");
                    event.preventDefault();
                    return;
                }
            }

            $("#desde, #hasta").datepicker({
                dateFormat: "yy-mm-dd"
            });

            $("#aplicar").on("click", function() {
                validarYAplicarFechas();
            });
        });

           // Función para mostrar la alerta de eliminación
        function confirmarEliminacion(id_pelicula) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la página de eliminación
                    window.location.href = "../Controladores/PeliculasController.php?action=eliminar&id=" + id_pelicula;
                }
            });
        }
        // Función para mostrar la alerta de edición
        function confirmarEdicion(id_pelicula) {
            Swal.fire({
                title: "¿Quieres editar esta película?",
                text: "¡Estás a punto de editar esta película!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, editar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la página de edición
                    window.location.href = "../Vista/editar_pelicula.php?id=" + id_pelicula;
                }
            });
        }
    </script>

</body>
</html>
