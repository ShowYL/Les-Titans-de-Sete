<?php 
require_once 'db_lestitansdesete.php';

class MatchModel{
    private $conn;

    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

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

    public function getAllMatchs(){
        $stmt = $this->conn->prepare("SELECT ID_Match, Date_Match, Heure_Match, Equipe_Adverse, Lieu, Résultat FROM `Match`");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMatch($id) {
        $stmt = $this->conn->prepare("SELECT * FROM `Match` WHERE ID_Match = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

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

    public function deleteMatch($id) {
        $stmt = $this->conn->prepare("DELETE FROM `Match` WHERE ID_Match = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>