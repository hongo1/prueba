<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Archivos y Datos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('fondo.jpg'); /* Imagen de fondo */
            background-size: cover; /* Ajusta el tamaño para cubrir toda la pantalla */
            background-position: center; /* Centra la imagen de fondo */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            min-height: 100vh; /* Asegura que el cuerpo tenga al menos la altura de la ventana */
            color: #FFD700; /* Texto amarillo */
        }
        h2 {
            margin-top: 20px;
            color: #FFD700;
        }
        table {
            background-color: rgba(33, 37, 41, 0.8); /* Color oscuro y semitransparente para la tabla */
            color: #FFD700;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #343a40;
            color: #FFD700;
        }
        .custom-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .custom-header img {
            height: 80px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .btn-danger {
            margin-top: 20px; /* Añade espacio arriba del botón volver */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header con imágenes -->
        <div class="custom-header">
            <a href="index.HTML">
                <img src="abinbev.jpg" alt="AB InBev">
            </a>
            <h2 class="text-center">Consulta de Archivos y Datos</h2>
            <a href="index.HTML">
                <img src="logo gpo modelo.png" alt="Grupo Modelo">
            </a>
        </div>

        <!-- Formulario de búsqueda -->
        <form method="POST" class="mt-4">
            <div class="input-group">
                <input type="text" name="embarque" class="form-control" placeholder="Ingrese el embarque a buscar" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Tabla de datos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped table-dark">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Embarque</th>
                        <th>Archivo 1</th>
                        <th>Archivo 2</th>
                        <th>Archivo 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "archivos";

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Comprobar si se ha enviado el formulario
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $embarqueBuscado = $conn->real_escape_string($_POST['embarque']);
                        $sql = "SELECT * FROM archivos WHERE campo3 = '$embarqueBuscado'";
                    } else {
                        $sql = "SELECT * FROM archivos";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["campo1"]. "</td>
                                    <td>" . $row["campo2"]. "</td>
                                    <td>" . $row["campo3"]. "</td>
                                    <td><a href='" . $row["archivo1"]. "' class='btn btn-warning'>Archivo 1</a></td>
                                    <td><a href='" . $row["archivo2"]. "' class='btn btn-warning'>Archivo 2</a></td>
                                    <td><a href='" . $row["archivo3"]. "' class='btn btn-warning'>Archivo 3</a></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <a href="index.HTML">
            <input type="submit" value="Volver" class="btn btn-danger">
        </a>
        <a href="index.HTML">
            <input type="submit" value="Volver" class="btn btn-danger">
        </a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
