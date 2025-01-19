<?php

require_once __DIR__ . '/../models/JoueurModel.php';
require_once __DIR__ . '/../models/SelectionModel.php';
require_once __DIR__ . '/../models/MatchModel.php';
require_once '../components/simpleTable.php';

class AccueilController {
    private $joueurModel;
    private $selectionModel;
    private $matchModel;
    private $table;
    private $tableHTML;
    private $index = ['Nom', 'Statut', 'Poste Préféré', 'Titularisations', 'Remplacements', 'Moyenne des Évaluations', '% Matchs Gagnés', 'Sélections Consécutives'];

    public function __construct() {
        $this->joueurModel = new JoueurModel();
        $this->selectionModel = new SelectionModel();
        $this->matchModel = new MatchModel();
    }

    public function getTableHTML() {
        // Récupérer les données des joueurs
        $joueurs = $this->joueurModel->getAllJoueurs();

        // Préparer les données pour le tableau
        $data = [];
        foreach ($joueurs as $joueur) {
            $stats = $this->selectionModel->getPlayerStats($joueur['ID_Joueur']);
            $consecutiveSelections = $this->selectionModel->getConsecutiveSelections($joueur['ID_Joueur']);
            $preferredPosition = $this->selectionModel->getPreferredPosition($joueur['ID_Joueur']);
            $data[] = [
                $joueur['Nom'],
                $joueur['Statut'],
                $preferredPosition,
                $stats['titularisations'],
                $stats['remplacements'],
                $stats['moyenne_evaluations'],
                $stats['pourcentage_matchs_gagnes'] . '%',
                $consecutiveSelections
            ];
        }

        // Utiliser le composant SimpleTable pour générer la table
        $this->table = new SimpleTable($data, $this->index, 'joueur');
        $this->tableHTML = $this->table->getTable();
        return $this->tableHTML;
    }

    public function getMatchStats() {
        return $this->matchModel->getMatchStats();
    }

    public function closeConnection() {
        $this->joueurModel->closeConnection();
        $this->selectionModel->closeConnection();
        $this->matchModel->closeConnection();
    }
}
?>