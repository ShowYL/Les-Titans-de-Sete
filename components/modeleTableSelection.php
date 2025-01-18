<?php

class createTable
{

    private $string = '';

    public function __construct(array $dataMatch, array $dataJoueurs)
    {
        $this->string = '<div>';
        foreach ($dataMatch as $index => $match) {
            $dataId = $match[0];
            $dataDate = $match[1];
            $dataAdversaire = $match[2];
            $this->string .= "<details name='matchs'><summary>match du $dataDate contre $dataAdversaire (id : $dataId)</summary>";
            if (!empty($dataJoueurs[$index][0])) {
                $this->string .= '<input class="search-input" type="text" placeholder="Search..." style="margin:5px;">';
                $this->string .= '<button class="btn" id="addBtn" style="margin:5px;">Ajouter</button>';
                $this->string .= '<button class="btn" id="edit-button" type="button" style="margin:5px;">Modifier</button>';
                $this->string .= '<button class="btn" id="delete-button" type="button" style="margin:5px;">Supprimer</button>';
                $this->string .= '<table class="table-search" style="margin:5px;width:99%;">';
                $this->string .= '<thead><tr><th>ID Joueur</th><th>Nom</th><th>Prénom</th></tr></thead>';
                $this->string .= '<tbody>';
                foreach ($dataJoueurs[$index] as $joueur) {
                    if (!empty($joueur)) {
                        $joueurID = $joueur[0];
                        $joueurNom = $joueur[1];
                        $joueurPrenom = $joueur[2];
                        $this->string .= "<tr><td>$joueurID</td><td>$joueurNom</td><td>$joueurPrenom</td></tr>";
                    }
                }
                $this->string .= "</tbody></table></details>";
            } else {
                $this->string .= '<button class="btn" id="addBtn" style="margin:5px;">Ajouter</button>';
                $this->string .= '<p style="margin-left:5px;">Vous n\'avez pas de joueurs affectés à ce match</p></details>';
            }
        }
    }

    public function getTable()
    {
        return $this->string .= "</div><script type='text/javascript' src='../scripts/tableSelection.js'></script>";
    }
}

?>