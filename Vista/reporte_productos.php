<!DOCTYPE html>
<html>
<head>
    <title>Venta de Productos por rango de fechas</title>
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
            <h2 id="modificar">Venta de Productos por rango de fechas</h2>
	    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formula" id="formula">            
            <label for="desde">Desde:</label>
            <input type="date" id="desde" name="desde">
            <label for="hasta">Hasta:</label>
            <input type="date" id="hasta" name="hasta">
            <button type="submit" name="aplicar" id="aplicar">Apply</button>
	    </form>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Producto</th>
                        <th>Costo de Venta</th>
                        <th>Unidades Vendidas</th>
                        <th>Venta_Total</th>
			 <?php
                        if ($_SERVER["REQUEST_METHOD"] != "POST"){
                           echo "<th>Fecha de Venta</th>";
                        }
			?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Incluir el archivo de conexión a la base de datos
                    require_once('../Modelo/db.php');

                    // Establecer conexión
                    $conexion = new Conexion();
                    $conn = $conexion->conectar();


                    // consultar las fechas de venta en base de datos
		   
		    if ($_SERVER["REQUEST_METHOD"] == "POST")
		        {  
   			$fechaInicio = $_POST["desde"];
      			$fechaFin = $_POST["hasta"];
			echo("<script> document.getElementById('modificar').textContent = 'Los 5 Productos Mas Vendidos En El Periodo: $fechaInicio - $fechaFin'; </script>");
                        echo("<P style='text-align:right;'> Fecha Inicio: $fechaInicio");
			echo("  Fecha Fin: $fechaFin </p>");
			$query = "Select ticket.id_producto as ID, producto.nombre as Nombre, producto.costo as Costo, SUM(ticket.cantidad) AS Unidades_Vendidas, (producto.costo * SUM(ticket.cantidad)) as Vental_Total FROM ticket_producto_producto as ticket inner join producto ON producto.id_producto = ticket.id_producto WHERE ticket.fecha BETWEEN '$fechaInicio' AND '$fechaFin' Group by producto.id_producto,producto.nombre,producto.costo Order by Unidades_Vendidas DESC LIMIT 5;";
                        }
		    else
		        {
	                $query = "Select ticket.id_producto as ID, producto.nombre as Nombre, producto.costo as Costo, ticket.cantidad AS Unidades_Vendidas, (producto.costo * ticket.cantidad) as Vental_Total, ticket.fecha as Fecha FROM ticket_producto_producto as ticket inner join producto ON producto.id_producto = ticket.id_producto Order by Unidades_Vendidas;";
		        }
        	     $result = $conn->query($query);

        	            if ($result->num_rows > 0) {
                	        // Mostrar los productos en la tabla
                        	while ($row = $result->fetch_assoc()) {
	                            echo "<tr>";
        	                    echo "<td>" . $row['ID'] . "</td>";
                	            echo "<td>" . $row['Nombre'] . "</td>";
                        	    echo "<td>" . $row['Costo'] . "</td>"; 
				    echo "<td>" . $row['Unidades_Vendidas'] . "</td>"; 
				    echo "<td>" . $row['Vental_Total'] . "</td>"; 
                                    if ($_SERVER["REQUEST_METHOD"] != "POST"){
				         echo "<td>" . $row['Fecha'] . "</td>"; 
				    }
                        	    echo "</tr>";
	                        }
        	            } else {
                	        echo "<tr><td colspan='7'>No hay ventas a mostrar en este rango de fechas.</td></tr>";
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
