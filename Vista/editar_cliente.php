<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
    <!-- Incluyendo Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Vista/css/menu.css">
    <link rel="stylesheet" href="../Vista/css/forms.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            <h2 class="mb-4">Editar Cliente</h2>
            <form id="editarClienteForm" action="../Controladores/clienteController.php?action=editar" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre del Cliente:</label>
                    <?php
                    // Incluir el archivo de conexión a la base de datos
                    require_once('../Modelo/db.php');

                    // Establecer conexión
                    $conexion = new Conexion();
                    $conn = $conexion->conectar();

                    // Obtener el ID del cliente de la URL
                    $id_cliente = $_GET['id'];

                    // Consultar los datos del cliente en la base de datos
                    $query = "SELECT * FROM cliente WHERE id_cliente = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id_cliente);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $cliente = $result->fetch_assoc();

                    // Mostrar el nombre del cliente en el campo de texto
                    echo "<input type='hidden' name='id_cliente' value='" . $cliente['id_cliente'] . "'>";
                    echo "<input type='text' class='form-control' id='nombre' name='nombre' value='" . $cliente['nombre'] . "' required>";
                    // Cerrar la conexión
                    $conn->close();
                    ?>
                </div>
                <div class="form-group">
                    <label for="edad">Edad del Cliente:</label>
                    <?php
                    // Mostrar la edad del cliente en el campo de texto
                    echo "<input type='number' class='form-control' id='edad' name='edad' value='" . $cliente['edad'] . "' required>";
                    ?>
                </div>
                <button type="button" class="btn btn-primary" onclick="confirmarEditar()">Actualizar</button>
                <a href="../Vista/listado_clientes.php" class="btn btn-secondary">Cancelar</a><!-- Botón de cancelar -->
            </form>
        </div>
    </div>
    <!-- Incluyendo Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Función para mostrar la alerta de confirmación antes de enviar el formulario de edición
        function confirmarEditar() {
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
                    document.getElementById("editarClienteForm").submit();
                }
            });
        }
    </script>
</body>
</html>
