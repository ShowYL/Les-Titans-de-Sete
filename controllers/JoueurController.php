<?php
require_once '../components/modeleTable.php';
require_once '../components/modeleForm.php';
require_once __DIR__ . '/../models/JoueurModel.php';

/**
 * JoueurController class
 * 
 * This controller handles the operations related to the "Joueur" (Player) entity.
 * It includes methods for creating, reading, updating, and deleting player records.
 * 
 * @package Les-Titans-de-Sete
 * @subpackage Controllers
 */
class JoueurController{
    private $joueurModel;
    private $table;
    private $tableHTML;
    private $formHTML;
    private $index = ['ID', 'Licence', 'Nom', 'Prenom', 'Taille', 'Poids', 'Date de naissance', 'Statut'];

    /**
     * JoueurController constructor.
     * Initializes a new instance of the JoueurController class.
     */
    public function __construct() {
        $this->joueurModel = new JoueurModel();
    }

    /**
     * Create a new joueur (player) entry.
     *
     * @param string $licence The licence number of the joueur.
     * @param string $nom The last name of the joueur.
     * @param string $prenom The first name of the joueur.
     * @param float $taille The height of the joueur in meters.
     * @param float $poids The weight of the joueur in kilograms.
     * @param string $date_naissance The birth date of the joueur in YYYY-MM-DD format.
     * @param string $statut The status of the joueur (e.g., active, injured).
     * @param string $commentaire Additional comments about the joueur.
     * @return void
     */
    public function createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire) {
        if ($this->joueurModel->createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire)) {
            header('Location: ../views/joueur.php');
        } else {
            return "Error: Unable to create joueur";
        }
    }

    /**
     * Retrieve all players.
     *
     * This method fetches all players from the database.
     *
     * @return array An array of player objects.
     */
    public function getAllJoueurs() {
        $joueurs = $this->joueurModel->getAllJoueurs();
        return $joueurs;
    }

    /**
     * Generates and returns the HTML table representation of the data.
     *
     * @return string The HTML table as a string.
     */
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

    /**
     * Retrieve a player's information based on their ID.
     *
     * @param int $id The ID of the player to retrieve.
     * @return mixed The player's information, or null if not found.
     */
    public function getJoueur($id) {
        $joueur = $this->joueurModel->getJoueur($id);
        return $joueur;
    }

    /**
     * Updates the details of a joueur (player) in the database.
     *
     * @param string $licence The licence number of the joueur.
     * @param string $nom The last name of the joueur.
     * @param string $prenom The first name of the joueur.
     * @param float $taille The height of the joueur in meters.
     * @param float $poids The weight of the joueur in kilograms.
     * @param string $date_naissance The birth date of the joueur in YYYY-MM-DD format.
     * @param string $statut The status of the joueur (e.g., active, injured).
     * @param string $commentaire Additional comments about the joueur.
     * @param int $id The unique identifier of the joueur in the database.
     * @return void
     */
    public function getForm() {
        $form = new createForm('Ajouter un Joueur', 'addJoueurController.php');
        $form->addHiddenInput('id');
        $form->addInput('Licence', 'text', 'licence', true);
        $form->addInput('Nom', 'text', 'nom', true);
        $form->addInput('Prénom', 'text', 'prenom', true);
        $form->addInput('Taille', 'number', 'taille', true);
        $form->addInput('Poids', 'number', 'poids', true);
        $form->addInput('Date de naissance', 'date', 'date_naissance', true);
        $form->addSelect('Statut', 'statut', ['Actif', 'Blessé', 'Absent', 'Suspendu']);
        $form->addTextarea('Commentaire', 'commentaire');
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
        $this->joueurModel->closeConnection();
    }
}
?>