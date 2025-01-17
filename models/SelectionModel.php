<?php
require_once 'db_lestitansdesete.php';

/**
 * Class SelectionModel
 *
 * This class represents the model for a selection (selection) in the application.
 * It is responsible for handling data operations related to selection.
 *
 * @package Les-Titans-de-Sete\models
 */
class SelectionModel
{
    /**
     * @var PDO $conn The database connection object.
     */
    private $conn;

    /**
     * Constructor initializes the database connection.
     */
    public function __construct()
    {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    /**
     * Creates a new selection record in the database.
     *
     * @param int $idJoueur The ID of the player.
     * @param int $idMatch The ID of the match.
     * @param bool $titulaire Whether the player is a starter.
     * @param string $poste The position of the player.
     * @return bool Returns true on success, false on failure.
     */
    public function createSelection($idJoueur, $idMatch, $titulaire, $poste)
    {
        $stmt = $this->conn->prepare("INSERT INTO Selection (ID_Joueur, ID_Match, Titulaire, Poste) VALUES (:ID_Joueur, :ID_Match, :Titulaire, :Poste)");
        $stmt->bindParam(':ID_Joueur', $idJoueur);
        $stmt->bindParam(':ID_Match', $idMatch);
        $stmt->bindParam(':Titulaire', $titulaire);
        $stmt->bindParam(':Poste', $poste);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Retrieves all selection records from the database.
     *
     * @return array An associative array of all selection records.
     */
    public function getAllSelection()
    {
        $stmt = $this->conn->prepare("SELECT ID_Selection, ID_Joueur, ID_Match, Titulaire, Poste FROM Selection");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Retrieves a specific selection record by ID.
     *
     * @param int $id The ID of the selection.
     * @return array An associative array of the selection record.
     */
    public function getSelection($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM Selection WHERE ID_Selection = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Updates an existing selection record in the database.
     *
     * @param int $id The ID of the selection.
     * @param int $idJoueur The ID of the player.
     * @param int $idMatch The ID of the match.
     * @param bool $titulaire Whether the player is a starter.
     * @param string $poste The position of the player.
     * @return bool Returns true on success, false on failure.
     */
    public function updateSelection($id, $idJoueur, $idMatch, $titulaire, $poste)
    {
        $stmt = $this->conn->prepare("UPDATE Selection SET ID_Joueur = :idJoueur, ID_Match = :idMatch, Titulaire = :titulaire, Poste = :poste WHERE ID_Selection = :id");
        $stmt->bindParam(':idJoueur', $idJoueur);
        $stmt->bindParam(':idMatch', $idMatch);
        $stmt->bindParam(':titulaire', $titulaire);
        $stmt->bindParam(':poste', $poste);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return $result;
    }

    /**
     * Deletes a selection record from the database.
     *
     * @param int $id The ID of the selection.
     * @return bool Returns true on success, false on failure.
     */
    public function deleteSelection($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM Selection WHERE ID_Selection = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
    }

    /**
     * Retrieves the list of players for a given match.
     *
     * @param int $idMatch The ID of the match.
     * @return array An associative array containing the IDs of the players.
     */
    public function getPlayersByMatch($idMatch)
    {
        $stmt = $this->conn->prepare("SELECT ID_Joueur FROM Selection WHERE ID_Match = :id_match");
        $stmt->bindParam(':id_match', $idMatch);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    /**
     * Closes the database connection.
     */
    public function closeConnection()
    {
        $this->conn = null;
    }
}
?>