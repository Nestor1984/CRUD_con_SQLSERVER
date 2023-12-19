<?php
class Database
{
    private $serverName;
    private $connectionOptions;

    public function __construct()
    {
        $this->serverName = "DESKTOP-5RD274N\SQLEXPRESS";
        $this->connectionOptions = array(
            "Database" => "miBase",
            "Uid" => "nestor-prueba",
            "PWD" => "12345",
            "Encrypt" => true,
            "TrustServerCertificate" => true
        );
    }

    public function openConnection()
    {
        $conn = sqlsrv_connect($this->serverName, $this->connectionOptions);
        if (!$conn) {
            echo print_r(sqlsrv_errors(), true);
        }
        return $conn;
    }
}
?>
