<?php
require_once __DIR__ . '/../db_lestitansdesete.php';

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("La connexion a échoué: " . $this->conn->connect_error);
        }
    }

    public function createUser($nomUtilisateur, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO User (Password, Nom_Utilisateur) VALUES (?, ?)");
        $stmt->bind_param("ss", $hashed_password, $nomUtilisateur);
        return $stmt->execute();
    }

    public function getUser($nomUtilisateur) {
        $stmt = $this->conn->prepare("SELECT ID_User, password FROM User WHERE Nom_Utilisateur = ?");
        $stmt->bind_param("s", $nomUtilisateur);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>