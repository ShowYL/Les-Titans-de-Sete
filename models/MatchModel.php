<?php 
require_once 'db_lestitansdesete.php';

/**
 * Class MatchModel
 *
 * This class represents the model for handling match-related data.
 * It interacts with the database to perform CRUD operations related to matches.
 */
class MatchModel{
    /**
     * @var PDO $conn Database connection instance
     */
    private $conn;

    /**
     * MatchModel constructor.
     * Initializes a new instance of the MatchModel class.
     */
    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    /**
     * Creates a new match record in the database.
     *
     * @param string $date The date of the match.
     * @param string $heure The time of the match.
     * @param string $adversaire The opponent team.
     * @param string $lieu The location of the match.
     * @param string $resultat The result of the match.
     * @return bool Returns true on success, false on failure.
     */
    public function createMatch($date, $heure, $adversaire, $lieu, $resultat) {
        $stmt = $this->conn->prepare("INSERT INTO `Match` (Date_Match, Heure_Match, Equipe_Adverse, Lieu, Résultat) VALUES (:date, :heure, :adversaire, :lieu, :resultat)");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':adversaire', $adversaire);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':resultat', $resultat);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Retrieve all matches from the database.
     *
     * @return array An array of matches.
     */
    public function getAllMatchs(){
        $stmt = $this->conn->prepare("SELECT ID_Match, Date_Match, Heure_Match, Equipe_Adverse, Lieu, Résultat FROM `Match`");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Retrieve match details by match ID.
     *
     * @param int $id The ID of the match to retrieve.
     * @return array|null The match details as an associative array, or null if no match is found.
     */
    public function getMatch($id) {
        $stmt = $this->conn->prepare("SELECT * FROM `Match` WHERE ID_Match = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Updates the match details in the database.
     *
     * @param string $date The date of the match.
     * @param string $heure The time of the match.
     * @param string $adversaire The opponent team.
     * @param string $lieu The location of the match.
     * @param string $resultat The result of the match.
     * @param int $id The ID of the match to update.
     * @return bool Returns true on success, false on failure.
     */
    public function updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id) {
        $stmt = $this->conn->prepare("UPDATE `Match` SET Date_Match = :date, Heure_Match = :heure, Equipe_Adverse = :adversaire, Lieu = :lieu, Résultat = :resultat WHERE ID_Match = :id");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':adversaire', $adversaire);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':resultat', $resultat);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Deletes a match from the database.
     *
     * @param int $id The ID of the match to delete.
     * @return bool Returns true on success, false on failure.
     */
    public function delseteMatch($id) {
        $stmt = $this->conn->prepare("DELETE FROM `Match` WHERE ID_Match = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
    }
    
    /**
     * Closes the database connection.
     *
     * This method is responsible for properly closing the connection to the database
     * to free up resources and ensure that no further queries can be executed.
     *
     * @return void
     */
    public function closeConnection() {
        $this->conn = null;
    }
}
?>