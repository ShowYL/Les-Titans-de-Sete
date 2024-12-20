<?php

class ConnectionBD {
    private $conn;
    private $servername = "mysql-lestitansdesete.alwaysdata.net";
    private $username = "385432";
    private $password = "\$iutinfo";
    private $dbname = "lestitansdesete_bd";

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("La connexion a échoué: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>