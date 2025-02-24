<?php
require_once '../components/modeleTableSelection.php';
require_once '../components/modeleFormSelection.php';
require_once __DIR__ . '/../models/SelectionModel.php';
require_once __DIR__ . '/../models/MatchModel.php';
require_once __DIR__ . '/../models/JoueurModel.php';

/**
 * selectionController class
 * 
 * This controller handles the operations related to the "Selection" (Selection) entity.
 * It includes methods for creating, reading, updating, and deleting Selection records.
 * 
 * @package Les-Titans-de-Sete
 * @subpackage Controllers
 */
class selectionController
{
    private $selectionModel;
    private $table;
    private $tableHTML;
    private $formHTML;
    private $index = ['ID', 'idJoueur', 'idMatch', 'Titulaire', 'Poste'];

    private $matchModel;
    private $joueurModel;
    private $tableMatch;
    private $tableHTMLMatch;
    private $indexMatch = ['ID', 'Date', 'Heure', 'Adversaire', 'Lieu', 'Résultat'];

    /**
     * selectionController constructor.
     * Initializes a new instance of the selectionController class.
     */
    public function __construct()
    {
        $this->selectionModel = new SelectionModel();
        $this->matchModel = new MatchModel();
        $this->joueurModel = new JoueurModel();
    }

    public function createSelection($idJoueur, $idMatch, $titulaire, $poste) {
        $validPositions = [
            'Pilier Gauche',
            'Pilier Droit', 
            'Talon',
            'Demi de mêlée',
            'Centre',
            'Ailier Gauche',
            'Ailier Droit'
        ];
        
        if (!in_array($poste, $validPositions)) {
            return "Error: Invalid position selected";
        }

        if ($titulaire == 'Oui') {
            $titulaire = 1;
        } else {
            $titulaire = 0;
        }
    
        if ($this->selectionModel->createSelection($idJoueur, $idMatch, $titulaire, $poste)) {
            header('Location: ../views/selection.php');
        } else {
            return "Error: Unable to create selection";
        }
    }

    /**
     * Creates a new selection for a player in a match.
     *
     * @param int $idJoueur The ID of the player.
     * @param int $idMatch The ID of the match.
     * @param bool $titulaire Indicates if the player is a starter (true) or a substitute (false).
     * @param string $poste The position of the player.
     * @return string|void Returns an error message if the selection creation fails, otherwise redirects to the selection view.
     */
    public function updateSelection( $idJoueur, $idMatch, $titulaire, $poste, $note)
    {
        if ($this->selectionModel->updateSelection( $idJoueur, $idMatch, $titulaire, $poste, $note)) {
            header('Location: ../views/selection.php');
        } else {
            return "Error: Unable to update selection";
        }
    }

    /**
     * Deletes a selection (selection) from the database.
     *
     * @param int $id The ID of the selection to be deleted.
     * @return void
     */
    public function deleteSelection($id)
    {
        if ($this->selectionModel->deleteSelection($id)) {
            header('Location: ../views/selection.php');
        } else {
            return "Error: Unable to delete selection";
        }
    }


    /**
     * Retrieve all selections.
     *
     * This method fetches all selections from the database.
     *
     * @return array An array of player objects.
     */
    public function getAllSelection()
    {
        $selection = $this->selectionModel->getAllSelection();
        return $selection;
    }

    /**
     * Generates and returns the HTML table representation of the data.
     *
     * @return string The HTML table as a string.
     */
    public function getTableHTML()
    {
        $selections = $this->getAllSelection();
        $data = [];
        foreach ($selections as $selection) {
            $data[] = [
                $selection['ID_Selection'],
                $selection['ID_Joueur'],
                $selection['ID_Match'],
                $selection['Titulaire'],
                $selection['Poste']
            ];
        }
        $this->table = new createTable($data, $this->index, 'selection');
        $this->tableHTML = $this->table->getTable();
        return $this->tableHTML;
    }

    /**
     * Retrieve a selection's information based on their ID.
     *
     * @param int $id The ID of the selection to retrieve.
     * @return mixed The selection's information, or null if not found.
     */
    public function getSelection($id)
    {
        $selection = $this->selectionModel->getSelection($id);
        return $selection;
    }

    /**
     * Generates the HTML form for adding a new player.
     *
     * @return string The HTML form as a string.
     */
    public function getForm() {
        $form = new createForm('Ajouter une selection', 'addSelectionController.php');
        $form->addHiddenInput('id');
        $activeJoueurs = $this->joueurModel->getActiveJoueurs();
        $options = [];
        foreach ($activeJoueurs as $joueur) {
            $options[$joueur['ID_Joueur']] = $joueur['ID_Joueur'];
        }
        $form->addSelect('ID_Joueur', 'ID_Joueur', $options, true);
        $form->addInput('ID_Match', 'text', 'ID_Match', true);
        $form->addSelect('Titulaire', 'Titulaire', ['Non', 'Oui']);
        $form->addSelect('Poste', 'Poste', [
            'Pilier Gauche',
            'Pilier Droit', 
            'Talon',
            'Demi de mêlée',
            'Centre',
            'Ailier Gauche',
            'Ailier Droit'
        ]);
        $form->addInput('Note', 'text', 'Note', false);
        $form->addButton('Valider');
        $this->formHTML = $form->getForm();
        return $form->getForm();
    }

    public function getAllMatchs()
    {
        $matchs = $this->matchModel->getAllMatchs();
        return $matchs;
    }

    public function getMatch($id)
    {
        $match = $this->matchModel->getMatch($id);
        return $match;
    }


    public function getTableHTMLMatch()
    {
        $matchs = $this->getAllMatchs();
        $dataMatch = [];
        $dataJoueur = [];
        foreach ($matchs as $index => $match) {
            $dataMatch[] = [
                $match['ID_Match'],
                $match['Date_Match'],
                $match['Equipe_Adverse']
            ];
            $temp = $this->selectionModel->getPlayersByMatch($match['ID_Match']);
            if (!empty($temp)) {
                foreach ($temp as $player) {
                    $res = $this->joueurModel->getJoueur($player['ID_Joueur']);
                    if ($res) {
                        $dataJoueur[$index][] = [$res['ID_Joueur'], $res['Nom'], $res['Prénom']];
                    }
                }
            } else {
                $dataJoueur[$index][] = [];
            }
        }
        $this->tableMatch = new createTable($dataMatch, $dataJoueur);
        $this->tableHTMLMatch = $this->tableMatch->getTable();
        return $this->tableHTMLMatch;
    }

    public function deleteSelectionByPlayerAndMatch($idJoueur, $idMatch)
    {
        return $this->selectionModel->deleteSelectionByPlayerAndMatch($idJoueur, $idMatch);
    }

    public function getSelectionByPlayerAndMatch($joueurId, $matchId)
    {
        return $this->selectionModel->getSelectionByPlayerAndMatch($joueurId, $matchId);
    }

    /**
     * Closes the database connection.
     *
     * This method is responsible for properly closing the database connection
     * to free up resources and ensure that no further operations can be performed
     * on the connection.
     *
     * @return void
     */
    public function closeConnection()
    {
        $this->selectionModel->closeConnection();
        $this->matchModel->closeConnection();
    }

}

?>