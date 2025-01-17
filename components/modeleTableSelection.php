<?php

class createTable
{

    private $string = '';

    public function __construct(array $dataMatch, array $dataJoueurs)
    {
        $this->string = '<div>';
        foreach ($dataMatch as $index => $match) {
            $dataDate = $match[1];
            $dataAdversaire = $match[2];
            $this->string .= "<details name='matchs'><summary>match du $dataDate contre $dataAdversaire</summary>";
            if (!empty($dataJoueurs[$index][0])) {
                $this->string .= '<input class="search-input" type="text" placeholder="Search..." style="margin:5px;">';
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
                $this->string .= "<p>Vous n'avez pas de joueurs affectés à ce match</p></details>";
            }
        }
    }

    public function getTable()
    {
        return $this->string .= "</div><script type='text/javascript' src='../scripts/tableSelection.js'></script>";
    }
}

?>