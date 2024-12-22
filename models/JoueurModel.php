<?php
require_once 'db_lestitansdesete.php';

/**
 * Class JoueurModel
 *
 * This class represents the model for a player (joueur) in the application.
 * It is responsible for handling data operations related to players.
 *
 * @package Les-Titans-de-Sete\models
 */
class JoueurModel{
    private $conn;

    
    /**
     * JoueurModel constructor.
     * Initializes a new instance of the JoueurModel class.
     */
    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    /**
     * Create a new joueur (player) record in the database.
     *
     * @param string $licence The licence number of the joueur.
     * @param string $nom The last name of the joueur.
     * @param string $prenom The first name of the joueur.
     * @param float $taille The height of the joueur in meters.
     * @param float $poids The weight of the joueur in kilograms.
     * @param string $date_naissance The birth date of the joueur in YYYY-MM-DD format.
     * @param string $statut The status of the joueur (e.g., active, inactive).
     * @param string $commentaire Additional comments about the joueur.
     * @return void
     */
    public function createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire) {
        $stmt = $this->conn->prepare("INSERT INTO Joueur (Licence, Nom, Prénom, Taille, Poids, Date_Naissance, Statut, Commentaire) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssddsss", $licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }


    /**
     * Retrieve all players from the database.
     *
     * @return array An array of all players.
     */
    public function getAllJoueurs(){
        $stmt = $this->conn->prepare("SELECT ID_Joueur, Licence, Nom, Prénom, Taille, Poids, Date_Naissance, Statut FROM Joueur");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // fetch_all() retourne un tableau contenant toute les ligne de résultat
        $stmt->close();
        return $result;
    }

    /**
     * Retrieve a player's information based on their ID.
     *
     * @param int $id The ID of the player.
     * @return array|null The player's information as an associative array, or null if not found.
     */
    public function getJoueur($id){
        $stmt = $this->conn->prepare("SELECT ID_Joueur, Licence, Nom, Prénom, Taille, Poids, Date_Naissance, Statut, Commentaire FROM Joueur WHERE ID_Joueur = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc(); 
        $stmt->close();
        return $result;
    }

    public function updateJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire, $id){
        $stmt = $this->conn->prepare("UPDATE Joueur SET Licence = ?, Nom = ?, Prénom = ?, Taille = ?, Poids = ?, Date_Naissance = ?, Statut = ?, Commentaire = ? WHERE ID_Joueur = ?");
        $stmt->bind_param("sssddsssi", $licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Supprime un joueur de la base de données.
     *
     * @param int $id L'identifiant du joueur à supprimer.
     * @return bool Retourne true si la suppression a réussi, false sinon.
     */
    public function supprimerJoueur($id){
        $stmt = $this->conn->prepare("DELETE FROM Joueur WHERE ID_Joueur = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Closes the database connection.
     *
     * This method is responsible for properly closing the database connection
     * to free up resources and ensure that no further queries can be executed
     * on this connection.
     *
     * @return void
     */
    public function closeConnection(){
        $this->conn->close();
    }
}

?>