<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Boletos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/forms.css">
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
            <h2 class="mb-4">Venta de Boletos</h2>
            <form id="ventaBoletosForm" action="../Controladores/VentaBoletosController.php?action=venta" method="post">
                <div class="form-group">
                    <label for="id_pelicula">Película:</label>
                    <select class="form-control" id="id_pelicula" name="id_pelicula" required>
                        <?php
                        require_once('../Modelo/Peliculas.php');
                        $pelicula = new Peliculas();
                        $peliculas = $pelicula->obtenerPeliculasDisponibles();
                        foreach ($peliculas as $pelicula) {
                            echo "<option value='" . $pelicula['id_pelicula'] . "'>" . $pelicula['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                </div>
                <div class="form-group">
                    <label for="id_cliente">Cliente:</label>
                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                        <?php
                        require_once('../Modelo/Cliente.php');
                        $cliente = new Cliente();
                        $clientes = $cliente->obtenerClientesDisponibles();
                        foreach ($clientes as $cliente) {
                            echo "<option value='" . $cliente['id_cliente'] . "'>" . $cliente['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_empleado">Empleado:</label>
                    <select class="form-control" id="id_empleado" name="id_empleado" required>
                        <?php
                        require_once('../Modelo/Empleado.php');
                        $empleado = new Empleado();
                        $empleados = $empleado->obtenerEmpleadosDisponibles();
                        foreach ($empleados as $empleado) {
                            echo "<option value='" . $empleado['id_empleado'] . "'>" . $empleado['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                    <!-- Establecer el valor de la fecha como la fecha actual -->
                </div>
                <div class="form-group">
                    <label for="total">Total:</label>
                    <input type="text" class="form-control" id="total" name="total" value="75" required readonly>
                    <!-- El campo "total" es de solo lectura para que el usuario no pueda editarlo manualmente -->
                </div>
                <button type="button" class="btn btn-primary" onclick="confirmarVenta()">Guardar</button>
                <a href="menu.html" class="btn btn-secondary ml-2">Regresar</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      // Función para calcular el total basado en la cantidad de boletos
      function calcularTotal() {
          var cantidad = parseInt(document.getElementById('cantidad').value);
          var total = cantidad * 75; // Multiplicar la cantidad por el precio fijo de 75
          document.getElementById('total').value = total;
      }

      // Evento que se dispara cuando se cambia la cantidad de boletos
      document.getElementById('cantidad').addEventListener('change', calcularTotal);
    </script>
    <script>
    // Función para mostrar la alerta de confirmación antes de enviar el formulario
    function confirmarVenta() {
      // Obtener los valores del formulario
      var id_pelicula = document.getElementById('id_pelicula').value;
      var cantidad = document.getElementById('cantidad').value;

      // Verificar si la cantidad es válida
      if (cantidad <= 0) {
          Swal.fire({
              title: "Error",
              text: "La cantidad debe ser mayor que cero.",
              icon: "error",
              confirmButtonColor: "#3085d6",
              confirmButtonText: "OK"
          });
          return;
    }

    // Enviar solicitud AJAX al servidor
    $.ajax({
            type: "POST",
            url: "../Controladores/VerificarBoletosDisponibles.php",
            data: {
                id_pelicula: id_pelicula,
                cantidad: cantidad
            },
            success: function(response) {
                // Verificar la respuesta del servidor
                if (response === "success") {
                    // Si hay suficientes boletos disponibles, enviar el formulario
                    document.getElementById("ventaBoletosForm").submit();
                } else {
                    // Si no hay suficientes boletos disponibles, mostrar una alerta
                    Swal.fire({
                        title: "Error",
                        text: "No hay suficientes boletos disponibles.",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    });
                }
            }
        });
    }
  </script>
</body>

</html>
