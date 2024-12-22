<?php 
require_once 'db_lestitansdesete.php';

class MatchModel{
    private $conn;

    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    public function createMatch($date, $heure, $adversaire, $lieu, $resultat) {
        $stmt = $this->conn->prepare("INSERT INTO `Match` (Date_Match, Heure_Match, Equipe_Adverse, Lieu, Résultat) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $date, $heure, $adversaire, $lieu, $resultat);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getAllMatchs(){
        $stmt = $this->conn->prepare("SELECT ID_Match, Date_Match, Heure_Match, Equipe_Adverse, Lieu, Résultat FROM `Match`");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id) {
        $stmt = $this->conn->prepare("UPDATE `Match` SET Date_Match = ?, Heure_Match = ?, Equipe_Adverse = ?, Lieu = ?, Résultat = ? WHERE ID_Match = ?");
        $stmt->bind_param("sssssi", $date, $heure, $adversaire, $lieu, $resultat ,$id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteMatch($id) {
        $stmt = $this->conn->prepare("DELETE FROM `Match` WHERE ID_Match = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function closeConnection(){
        $this->conn->close();
    }
}
?>