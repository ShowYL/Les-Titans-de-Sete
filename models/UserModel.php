<?php
require_once 'db_lestitansdesete.php';

/**
 * Class UserModel
 *
 * This class represents the model for user-related operations.
 * It interacts with the database to perform CRUD operations on user data.
 *
 * @package Les-Titans-de-Sete\models
 */
class UserModel {
    private $conn;

    /**
     * UserModel constructor.
     * Initializes a new instance of the UserModel class.
     */
    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    /**
     * Creates a new user with the given username and password.
     *
     * @param string $nomUtilisateur The username of the new user.
     * @param string $password The password for the new user.
     * @return bool Returns true if the user was created successfully, false otherwise.
     */
    public function createUser($nomUtilisateur, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO User (Password, Nom_Utilisateur) VALUES (?, ?)");
        $stmt->bind_param("ss", $hashed_password, $nomUtilisateur);
        $result = $stmt->execute();
        $stmt->close();
        $this->conn->close();
        return $result;
    }

    /**
     * Retrieve user information based on the username.
     *
     * @param string $nomUtilisateur The username of the user to retrieve.
     * @return array|null The user information as an associative array, or null if the user is not found.
     */
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