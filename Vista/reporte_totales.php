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
          .ui-datepicker {
            background: #ffffff;
            color: #000000; /* letras negras */
        }
    </style>
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
            <h2 class="mb-4">Venta de Productos y Boletos Por Rango de Fechas</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formula" id="formula">            
            <label for="desde">Desde:</label>
            <input type="date" id="desde" name="desde">
            <label for="hasta">Hasta:</label>
            <input type="date" id="hasta" name="hasta">
            <button type="submit" name="aplicar" id="aplicar">Apply</button>
	          </form>
            <hr>
            <table class="table">
              <h3>Productos</h3>
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Total</th>
                        <th>Unidades</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Fecha de Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de conexión a la base de datos y la definición de la clase cliente, producto y empleado
                    require_once('../Modelo/db.php');
                    require_once('../Modelo/cliente.php');
                    require_once('../Modelo/Productos.php');
                    require_once('../Modelo/Empleado.php');

                    // Establecer conexión
                    $conexion = new Conexion();
                    $conn = $conexion->conectar();

                    // Instanciar la clase cliente, producto, empleado y pelicula
                    $producto = new Producto();
                    $cliente = new Cliente();
                    $empleado = new Empleado();


                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {  
                          $fechaInicio = $_POST["desde"];
                          $fechaFin = $_POST["hasta"];
                          echo("<script>console.log('PHP: " . $fechaInicio . "');</script>");
                          echo("<P style='text-align:right;'> Fecha Inicio: $fechaInicio");
                          echo("  Fecha Fin: $fechaFin </p>");
                          $query = "SELECT tk.id_cliente cliente, tk.id_empleado empleado, tk.total total, tkp.id_ticket_snack id_snack, tkp.id_producto producto, tkp.cantidad cantidad, tkp.fecha fecha FROM ticket_producto_producto tkp INNER JOIN ticket_producto tk ON tk.id_ticket_snack = tkp.id_ticket_snack WHERE tkp.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
                    }
                  else
                    {
                         $query = "SELECT tk.id_cliente cliente, tk.id_empleado empleado, tk.total total, tkp.id_ticket_snack id_snack, tkp.id_producto producto, tkp.cantidad cantidad, tkp.fecha fecha FROM ticket_producto_producto tkp INNER JOIN ticket_producto tk ON tk.id_ticket_snack = tkp.id_ticket_snack";
                    }
                    // Consultar los tickets de producto en la base de datos
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Mostrar los tickets del producto
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            //consultar el nombre del producto
                            $nombre_producto = $producto->obtenerNombreProducto($row['producto']);
                            echo "<td>" . $nombre_producto . "</td>";
                            echo "<td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['cantidad'] . "</td>";
                            //consultar el nombre del cliente
                            $nombre_cliente = $cliente->obtenerNombreCliete($row['cliente']);
                            echo "<td>" . $nombre_cliente . "</td>";

                            //consultar el nombre del empleado
                            $nombre_empleado = $empleado->obtenerNombreEmpleado($row['empleado']);
                            echo "<td>" . $nombre_empleado . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay productos disponibles.</td></tr>";
                    }
                   // Cerrar la conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <hr>
            <table class="table">
              <h3>Peliculas</h3>
                <thead class="thead-dark">
                    <tr>
                        <th>Peliculas</th>
                        <th>Total</th>
                        <th>Unidades</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Fecha de Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de conexión a la base de datos y la definición de la clase cliente, peliculas y empleado
                    require_once('../Modelo/db.php');
                    require_once('../Modelo/cliente.php');
                    require_once('../Modelo/Empleado.php');
                    require_once('../Modelo/Peliculas.php');
                    // Establecer conexión
                    $conexion = new Conexion();
                    $conn = $conexion->conectar();

                    // Instanciar la clase cliente, pelicula y empleado
                    $pelicula = new Peliculas();
                    $cliente = new Cliente();
                    $empleado = new Empleado();

                    // Consultar los tickets de pelicula en la base de datos

                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {  
                          $fechaInicio = $_POST["desde"];
                          $fechaFin = $_POST["hasta"];
                          echo("<script>console.log('PHP: " . $fechaInicio . "');</script>");
                          echo("<P style='text-align:right;'> Fecha Inicio: $fechaInicio");
                          echo("  Fecha Fin: $fechaFin </p>");
                          $query = "SELECT * FROM ticket_pelicula WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
                    }
                  else
                    {
                          $query = "SELECT * FROM ticket_pelicula";
                    
                    }
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Mostrar los tickets de la pelicula
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            //consultar el nombre del producto
                            $nombre_pelicula = $pelicula->obtenerNombrePelicula($row['id_pelicula']);
                            echo "<td>" . $nombre_pelicula . "</td>";
                            echo "<td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['cantidad'] . "</td>";
                            //consultar el nombre del cliente
                            $nombre_cliente = $cliente->obtenerNombreCliete($row['id_cliente']);
                            echo "<td>" . $nombre_cliente . "</td>";

                            //consultar el nombre del empleado
                            $nombre_empleado = $empleado->obtenerNombreEmpleado($row['id_empleado']);
                            echo "<td>" . $nombre_empleado . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay peliculas disponibles.</td></tr>";
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
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

    $( function() {
            function validarYAplicarFechas() {
                var desdeVal = $("#desde").val();
                var hastaVal = $("#hasta").val();

                var desdeDate = $.datepicker.parseDate("yy-mm-dd", desdeVal);
                var hastaDate = $.datepicker.parseDate("yy-mm-dd", hastaVal);
                if (hastaDate < desdeDate) {
                    alert("La fecha Hasta no puede ser anterior a la fecha Desde");
                    event.preventDefault();
                    return;
                } else
                {
		   var form = document.getElementById("formula");
		   document.getElementById("aplicar").addEventListener("click", function () {
		   form.submit();
		   });
                }               
	      }
            $( "#aplicar" ).on("click", function() {
                validarYAplicarFechas();
            });
        });
    </script>
</body>
</html>
