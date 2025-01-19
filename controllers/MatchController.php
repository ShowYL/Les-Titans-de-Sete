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

    public function getForm($isEdit = false, $match = null) {
        $form = new createForm($isEdit ? 'Modifier un match' : 'Ajouter un match', 'MatchController.php');
        $form->addHiddenInput('id');
        $form->addInput('Date', 'date', 'date', $match ? $match['Date_Match'] : '', 'min="' . date('Y-m-d') . '"');
        $form->addInput('Heure', 'time', 'heure', $match ? $match['Heure_Match'] : '');
        $form->addInput('Adversaire', 'text', 'adversaire', $match ? $match['Equipe_Adverse'] : '');
        $form->addSelect('Lieu', 'lieu', ['Domicile', 'Extérieur'], $match ? $match['Lieu'] : '');
        $form->addSelect('Résultat', 'resultat', ['Victoire', 'Défaite', 'Nul'], $match ? $match['Résultat'] : '');
        $form->addButton('Valider');
        $this->formHTML = $form->getForm();
        return $this->formHTML;
    }

    public function isPastMatch($id) {
        $match = $this->getMatch($id);
        if (strtotime($match['Date_Match']) < strtotime(date('Y-m-d'))) {
            return true;
        }
        return false;
    }


    public function updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id) {
        $match = $this->getMatch($id);
        if (strtotime($match['Date_Match']) < strtotime(date('Y-m-d'))) {
            return "date";
            exit();
        }

        if ($this->matchModel->updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id)) {
            header('Location: ../views/match.php');
        } else {
            return "Error: Unable to update match";
        }
    }

    public function updateMatchResult($resultat, $id) {
        $match = $this->getMatch($id);
        if (strtotime($match['Date_Match']) > strtotime(date('Y-m-d'))) {
            return "date";
            exit();
        }

        if ($this->matchModel->updateMatchResult($resultat, $id)) {
            header('Location: ../views/match.php');
        } else {
            return "Error: Unable to update match result";
        }
    }

    public function deleteMatch($id) {
        $match = $this->getMatch($id);
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        // Validate date and time
        if ((strtotime($match['Date_Match']) < strtotime($currentDate)) || (strtotime($match['Date_Match']) == strtotime($currentDate) && strtotime($match['Heure_Match']) < strtotime($currentTime))) {
            return "date";
            exit();
        } ;

        if ($this->matchModel->deleteMatch($id)) {
            header('Location: ../views/match.php');
            return true;
        }
    }

    public function closeConnection() {
        $this->matchModel->closeConnection();
    }


    public function getMatchStats() {
        return $this->matchModel->getMatchStats();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $adversaire = $_POST['adversaire'];
    $lieu = $_POST['lieu'];
    $resultat = $_POST['resultat'];

    $controller = new MatchController();

    if ($date == null){
        $error = $controller->updateMatchResult($resultat, $id);
    }else {
        $error = $controller->updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id);
    }

    $controller->closeConnection();
    
    if (isset($error)) {
        echo $error;
    } else {
        echo "Match modifié avec succès";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'add') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $adversaire = $_POST['adversaire'];
    $lieu = $_POST['lieu'];
    $resultat = $_POST['resultat'];
    

    $controller = new MatchController();
    $error = $controller->createMatch($date, $heure, $adversaire, $lieu, $resultat);

    if (isset($error)) {
        echo $error;
    } else {
        echo "Match créé avec succès";
    }
}

?>
