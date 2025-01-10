<?php
require_once '../components/modeleTable.php';
require_once '../components/modeleForm.php';
require_once __DIR__ . '/../models/MatchModel.php';

class MatchController{
    private $matchModel;
    private $table;
    private $tableHTML;
    private $formHTML;
    private $index = ['ID', 'Date', 'Heure', 'Adversaire', 'Lieu', 'Résultat'];

    public function __construct() {
        $this->matchModel = new MatchModel();
    }

    public function createMatch($date, $heure, $adversaire, $lieu, $resultat) {
        if ($this->matchModel->createMatch($date, $heure, $adversaire, $lieu, $resultat)) {
            header('Location: ../views/match.php');
        } else {
            return "Error: Unable to create match";
        }
    }

    public function getAllMatchs() {
        $matchs = $this->matchModel->getAllMatchs();
        return $matchs;
    }

    public function getMatch($id) {
        $match = $this->matchModel->getMatch($id);
        return $match;
    }

    public function getTableHTML() {
        $matchs = $this->getAllMatchs();
        $data = [];
        foreach ($matchs as $match) {
            $data[] = [
                $match['ID_Match'],
                $match['Date_Match'],
                $match['Heure_Match'],
                $match['Equipe_Adverse'],
                $match['Lieu'],
                $match['Résultat']
            ];
        }
        $this->table = new createTable($data, $this->index, 'match');
        $this->tableHTML = $this->table->getTable();
        return $this->tableHTML;
    }

    public function getForm() {
        $form = new createForm('Ajouter un match', 'addMatchController.php');
        $form->addHiddenInput('id');
        $form->addInput('Date', 'date', 'date');
        $form->addInput('Heure', 'time', 'heure');
        $form->addInput('Adversaire', 'text', 'adversaire');
        $form->addSelect('Lieu', 'lieu', ['Domicile', 'Extérieur']);
        $form->addSelect('Résultat', 'resultat', ['Victoire', 'Défaite', 'Nul']);
        $form->addButton('Valider');
        $this->formHTML = $form->getForm();
        return $this->formHTML;
    }

    public function updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id) {
        if ($this->matchModel->updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id)) {
            header('Location: ../views/match.php');
        } else {
            return "Error: Unable to update match";
        }
    }

    public function deleteMatch($id) {
        if ($this->matchModel->deleteMatch($id)) {
            header('Location: ../views/match.php');
        } else {
            return "Error: Unable to delete match";
        }
    }

    public function closeConnection() {
        $this->matchModel->closeConnection();
    }
}
