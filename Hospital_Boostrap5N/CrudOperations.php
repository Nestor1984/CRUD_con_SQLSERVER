<?php
require_once 'Database.php';

class CrudOperations
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function mostrarDatos()
    {
        try {
            $conn = $this->database->openConnection();
            $tsql = "SELECT idPaciente, nombres, apePat, apeMat, celular, direccion, telefonoReferencia FROM Paciente";
            $getPacientes = sqlsrv_query($conn, $tsql);

            if ($getPacientes == FALSE) {
                throw new Exception('Error al obtener los datos');
            }

            $data = array();
            while ($row = sqlsrv_fetch_array($getPacientes, SQLSRV_FETCH_ASSOC)) {
                $data[] = (object) $row;
            }

            sqlsrv_free_stmt($getPacientes);
            sqlsrv_close($conn);

            return $data;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function insertarDato($nombres, $apePat, $apeMat, $celular, $direccion, $telefonoReferencia)
    {
        try {
            $conn = $this->database->openConnection();
            $tsql = "INSERT INTO Paciente(nombres, apePat, apeMat, celular, direccion, telefonoReferencia) VALUES (?, ?, ?, ?, ?, ?)";
            $params = array($nombres, $apePat, $apeMat, $celular, $direccion, $telefonoReferencia);
            $stmt = sqlsrv_query($conn, $tsql, $params);

            if ($stmt == FALSE) {
                throw new Exception('Error al insertar el dato');
            }

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarDato($id, $nombres, $apePat, $apeMat, $celular, $direccion, $telefonoReferencia)
    {
        try {
            $conn = $this->database->openConnection();
            $tsql = "UPDATE Paciente SET nombres = ?, apePat = ?, apeMat = ?, celular = ?, direccion = ?, telefonoReferencia = ? WHERE idPaciente = ?";
            $params = array($nombres, $apePat, $apeMat, $celular, $direccion, $telefonoReferencia, $id);
            $stmt = sqlsrv_query($conn, $tsql, $params);

            if ($stmt == FALSE) {
                throw new Exception('Error al actualizar el dato');
            }

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarDato($id)
    {
        try {
            $conn = $this->database->openConnection();
            $tsql = "DELETE FROM Paciente WHERE idPaciente = ?";
            $params = array($id);
            $stmt = sqlsrv_query($conn, $tsql, $params);

            if ($stmt == FALSE) {
                throw new Exception('Error al eliminar el dato');
            }

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            return true;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}
?>
