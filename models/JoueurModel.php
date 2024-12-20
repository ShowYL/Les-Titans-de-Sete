<?php
require_once 'db_lestitansdesete.php';

class JoueurModel{
    private $conn;

    public function __construct() {
        $db = new ConnectionBD();
        $this->conn = $db->getConnection();
    }

    public function createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire) {
        $stmt = $this->conn->prepare("INSERT INTO Joueur (Licence, Nom, Prénom, Taille, Poids, Date_Naissance, Statut, Commentaire) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssddsss", $licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire);
        $result = $stmt->execute();
        $stmt->close();
        $this->conn->close();
        return $result;
    }


    public function getAllJoueurs(){
        $stmt = $this->conn->prepare("SELECT ID_Joueur, Licence, Nom, Prénom, Taille, Poids, Date_Naissance, Statut FROM Joueur");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // fetch_all() retourne un tableau contenant toute les ligne de résultat
        $stmt->close();
        $this->conn->close();
        return $result;
    }
}

?>