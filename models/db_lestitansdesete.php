<?php


/**
 * Class ConnectionBD
 *
 * This class is responsible for managing the database connection for the Les Titans de Sete application.
 * It provides methods to establish and close the connection to the database.
 *
 * @package Les-Titans-de-Sete
 */
class ConnectionBD {
    private $conn;
    private $servername = "mysql-lestitansdesete.alwaysdata.net";
    private $username = "385432";
    private $password = "\$iutinfo";
    private $dbname = "lestitansdesete_bd";

    /**
     * Constructor for the database connection.
     *
     * This constructor initializes the connection to the database using the
     * provided credentials. If the connection fails, it throws an error.
     */
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("La connexion a échoué: " . $this->conn->connect_error);
        }
    }

    /**
     * Returns the database connection.
     *
     * This method returns the connection to the database to allow other classes
     * to execute queries on the database.
     *
     * @return mysqli The connection to the database.
     */
    public function getConnection() {
        return $this->conn;
    }

    /**
     * Closes the database connection.
     *
     * This method is responsible for closing the connection to the database
     * to free up resources and ensure that no further queries can be executed
     * on this connection.
     *
     * @return void
     */
    public function closeConnection() {
        $this->conn->close();
    }
}
?>