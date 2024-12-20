<?php
require_once '../components/modeleTable.php';
require_once __DIR__ . '/../models/JoueurModel.php';

class JoueurController{
    private $joueurModel;
    private $table;
    private $tableHTML;
    private $index = ['ID', 'Licence', 'Nom', 'Prenom', 'Taille', 'Poids', 'Date de naissance', 'Statut'];

    public function __construct() {
        $this->joueurModel = new JoueurModel();
    }

    public function createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire) {
        if ($this->joueurModel->createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire)) {
            header('Location: ../views/joueur.php');
        } else {
            return "Error: Unable to create joueur";
        }
    }

    public function getAllJoueurs() {
        $joueurs = $this->joueurModel->getAllJoueurs();
        return $joueurs;
    }

    public function getTableHTML() {
        $joueurs = $this->getAllJoueurs();
        $data = [];
        foreach ($joueurs as $joueur) {
            $data[] = [
                $joueur['ID_Joueur'],
                $joueur['Licence'],
                $joueur['Nom'],
                $joueur['Prénom'],
                $joueur['Taille'],
                $joueur['Poids'],
                $joueur['Date_Naissance'],
                $joueur['Statut']
            ];
        }
        $this->table = new createTable($data, $this->index);
        $this->tableHTML = $this->table->getTable();
        return $this->tableHTML;
    }
}
?>