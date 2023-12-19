<?php
require_once 'CrudOperations.php';

// Verifica si se proporciona un ID para eliminar
if (isset($_GET['idPaciente'])) {
    $id = $_GET['idPaciente'];

    // Instancia la clase CrudOperations
    $crud = new CrudOperations();

    // Intenta eliminar el dato con el ID proporcionado
    if ($crud->eliminarDato($id)) {
        echo "Dato eliminado con éxito.";
    } else {
        echo "Error al intentar eliminar el dato.";
    }
} else {
    echo "ID no proporcionado para eliminar.";
}

header("Location: index.php");
?>
