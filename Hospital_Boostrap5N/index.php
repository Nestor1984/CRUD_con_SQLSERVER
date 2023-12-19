<?php
require_once 'CrudOperations.php';
// Procesar el formulario para insertar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crud = new CrudOperations();
    $nombres = $_POST["nombres"];
    $apPater = $_POST["ap-pater"];
    $apMater = $_POST['ap-mater'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $telRefe = $_POST['tel-ref'];

    if ($crud->insertarDato($nombres, $apPater, $apMater, $celular, $direccion, $telRefe)) {
        echo "Dato insertado con éxito.";
        header("Location: index.php");
    } else {
        echo "Error al insertar el dato.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital UTB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Hospital -UTB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Paciente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Internacion</a>
                </li>
                <!-- Agrega más elementos de menú según sea necesario -->
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex align-items-center"> <!-- Contenedor flexible -->
        <h6>Estudiante: Nestor Jhoel Mamani Mamani <br>Base de datos 2 <br>Cuarto Semestre <br>Examen final</h6> 
        <h6><h6>
        <img src="imagenes/1631308314915.jpg" alt="logo de la UTB" class="img-fluid mx-auto d-block">
    </div>
    <br>
    <h3>Tabla paciente:</h3>

    <?php
    $crud = new CrudOperations();
    $data = $crud->mostrarDatos();

    if ($data) {
        echo '<table class="table">';
        echo '<thead><tr><th>ID Paciente</th><th>Nombres</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Celular</th><th>Direccion</th><th>Telefono Ref.</th><th>Acciones</th></tr></thead>';
        echo '<tbody>';

        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $row->idPaciente . '</td>';
            echo '<td>' . $row->nombres . '</td>';
            echo '<td>' . $row->apePat . '</td>';
            echo '<td>' . $row->apeMat . '</td>';
            echo '<td>' . $row->celular . '</td>';
            echo '<td>' . $row->direccion . '</td>';
            echo '<td>' . $row->telefonoReferencia . '</td>';
            echo '<td>
                    <a href="editar.php?idPaciente=' . $row->idPaciente . '" class="btn btn-primary btn-sm">Editar</a>
                    <a href="eliminar.php?idPaciente=' . $row->idPaciente . '" class="btn btn-danger btn-sm">Eliminar</a>
                  </td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No se pudo obtener la información.</p>';
    }
    ?>
    <br><br><br>
    <h2 class="text-center">Ingresar nuevo paciente:</h2> <br><br>
    <div class="col-md-6 mx-auto">
    <div class="container mt-5">
    <form method="post" action="">
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres:</label>
            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingresar nombres. Ejemplo: Nestor Jhoel......" required>
        </div>
        <div class="mb-3">
            <label for="ap-pater" class="form-label">Apellido paterno:</label>
            <input type="text" class="form-control" id="ap-pater" name="ap-pater" placeholder="Ingresar apellido paterno. Ejemplo: Mamani......" required>
        </div>
        <div class="mb-3">
            <label for="ap-mater" class="form-label">Apellido materno:</label>
            <input type="text" class="form-control" id="ap-mater" name="ap-mater" placeholder="Ingresar apellido materno. Ejemplo: Mamani......" required>
        </div>
        <div class="mb-3">
            <label for="celular" class="form-label">Celular del paciente:</label>
            <input type="text" class="form-control" id="celular" name="celular" placeholder="Ingresar celular del paciente. Ejemplo: 72065804......" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresar direccion. Ejemplo: Alto las Delicias......" required>
        </div>
        <div class="mb-3">
            <label for="tel-ref" class="form-label">Telefono de referencia:</label>
            <input type="text" class="form-control" id="tel-ref" name="tel-ref" placeholder="Ingresar telefono de referencia. Ejemplo: 71981864......" required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Agregar paciente</button>
        <br><br><br><br><br>
    </form>
    </div>
</div>


<style>

</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>