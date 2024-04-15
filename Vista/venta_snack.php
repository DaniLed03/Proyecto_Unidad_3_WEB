<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Snacks</title>
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
            <h2 class="mb-4">Venta de Snacks</h2>
            <form id="ventaSnacksForm" action="../Controladores/VentaSnackController.php?action=venta"
                method="post">
                <div class="form-group">
                    <label for="producto">Producto:</label>
                    <select class="form-control" id="id_producto" name="id_producto" required>
                        <?php
                        // Aquí obtienes los productos disponibles desde la base de datos
                        require_once('../Modelo/Productos.php');
                        $producto = new Producto();
                        $productos = $producto->obtenerProductosDisponibles();
                        foreach ($productos as $producto) {
                            echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre'] . "</option>";
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
                        // Aquí obtienes los clientes disponibles desde la base de datos
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
                        // Aquí obtienes los empleados disponibles desde la base de datos
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
                    <label for="precio">Precio:</label>
                    <input type="text" class="form-control" id="precio" name="precio" required readonly>
                    <!-- El campo "precio" es de solo lectura para que el usuario no pueda editarlo manualmente -->
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
      // Función para calcular el total basado en la cantidad de productos
      function calcularTotal() {
          var cantidad = parseInt(document.getElementById('cantidad').value);
          var precio = parseInt(document.getElementById('precio').value);
          var total = cantidad * precio; // Multiplicar la cantidad por el precio fijo del producto
          document.getElementById('precio').value = total;
      }

      // Evento que se dispara cuando se cambia la cantidad de boletos
      document.getElementById('cantidad').addEventListener('change', calcularTotal);
    </script>
    <script>
        document.getElementById('id_producto').addEventListener('change', function () {
            var id_producto = this.value;
            // Envía una solicitud AJAX para obtener el precio del producto seleccionado
            $.ajax({
                type: "POST",
                url: "../Controladores/obtener_precio_producto.php", // Corrige la ruta del archivo PHP
                data: {
                    id_producto: id_producto
                },
                success: function (response) {
                    // Actualiza el campo de precio con el valor recibido del servidor
                    document.getElementById('precio').value = response;
                }
            });
        });

        // Función para mostrar la alerta de confirmación antes de enviar el formulario
      function confirmarVenta() {
        // Obtener los valores del formulario
        var id_cliente = document.getElementById('id_cliente').value;
        var id_empleado = document.getElementById('id_empleado').value;
        var precio = document.getElementById('precio').value;
        var cantidad = document.getElementById('cantidad').value;
        var id_producto = document.getElementById('id_producto').value;

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

        // Verificar si hay suficiente inventario
        $.ajax({
            type: "POST",
            url: "../Controladores/verificar_inventario.php", // Ruta del archivo PHP para verificar inventario
            data: {
                id_producto: id_producto,
                cantidad: cantidad
            },
            success: function (response) {
                if (response == 'OK') {
                    // Si hay suficiente inventario, mostrar la alerta de confirmación
                    mostrarAlertaConfirmacion(id_cliente, id_empleado, precio);
                } else {
                    // Si no hay suficiente inventario, mostrar alerta de SweetAlert
                    Swal.fire({
                        title: "Error",
                        text: "No hay suficiente inventario para realizar esta venta.",
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    });
                }
            }
        });
    }

    // Función para mostrar la alerta de confirmación después de verificar el inventario
    function mostrarAlertaConfirmacion(id_cliente, id_empleado, precio) {
        // Crear mensaje de confirmación
        var mensaje = "¿Estás seguro de realizar la venta?\n";
        mensaje += "Cliente: " + id_cliente + "\n";
        mensaje += "Empleado: " + id_empleado + "\n";
        mensaje += "Precio: $" + precio;

        // Mostrar la alerta de confirmación
        Swal.fire({
            title: 'Confirmación',
            text: mensaje,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario
                document.getElementById('ventaSnacksForm').submit();
            }
        });
    }

    </script>
</body>

</html>
