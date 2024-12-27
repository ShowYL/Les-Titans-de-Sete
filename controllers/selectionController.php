<?php
require_once '../components/modeleTable.php';
require_once '../components/modeleForm.php';
require_once __DIR__ . '/../models/SelectionModel.php';

/**
 * selectionController class
 * 
 * This controller handles the operations related to the "Selection" (Selection) entity.
 * It includes methods for creating, reading, updating, and deleting Selection records.
 * 
 * @package Les-Titans-de-Sete
 * @subpackage Controllers
 */
class selectionController{
    private $selectionModel;
    private $table;
    private $tableHTML;
    private $formHTML;
    private $index = ['ID', 'idJoueur', 'idMatch', 'Titulaire', 'Poste'];

    /**
     * selectionController constructor.
     * Initializes a new instance of the selectionController class.
     */
    public function __construct() {
        $this->selectionModel = new SelectionModel();
    }

    public function createSelection($idJoueur, $idMatch, $titulaire, $poste) {
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
    public function updateSelection($id, $idJoueur, $idMatch, $titulaire, $poste) {
        if ($this->selectionModel->updateSelection($id, $idJoueur, $idMatch, $titulaire, $poste)) {
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
    public function deleteSelection($id) {
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
    public function getAllSelection() {
        $selection = $this->selectionModel->getAllSelection();
        return $selection;
    }

    /**
     * Generates and returns the HTML table representation of the data.
     *
     * @return string The HTML table as a string.
     */
    public function getTableHTML() {
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
    public function getSelection($id) {
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
        $form->addInput('ID_Joueur', 'text', 'ID_Joueur', true);
        $form->addInput('ID_Match', 'text', 'ID_Match', true);
        $form->addInput('Titulaire', 'text', 'Titulaire', true);
        $form->addInput('Poste', 'text', 'Poste', true);
        $form->addButton('Valider');
        $this->formHTML = $form->getForm();
        return $form->getForm();
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
    public function closeConnection() {
        $this->selectionModel->closeConnection();
    }
}
?>