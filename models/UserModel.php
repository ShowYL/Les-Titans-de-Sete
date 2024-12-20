<?php
require_once 'db_lestitansdesete.php';

class UserModel {
    private $conn;

    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    public function createUser($nomUtilisateur, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO User (Password, Nom_Utilisateur) VALUES (?, ?)");
        $stmt->bind_param("ss", $hashed_password, $nomUtilisateur);
        $result = $stmt->execute();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

    public function getUser($nomUtilisateur) {
        $stmt = $this->conn->prepare("SELECT ID_User, password FROM User WHERE Nom_Utilisateur = ?");
        $stmt->bind_param("s", $nomUtilisateur);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $this->conn->close();
        return $result;
    }
}
?>