<?php

class createTable
{

    private $string = '';

    public function __construct(array $dataMatch, array $dataJoueurs)
    {
        $this->string = "<div>";
        foreach ($dataMatch as $index => $match) {
            $dataDate = $match[1];
            $dataAdversaire = $match[2];
            $this->string .= "<details name='matchs'><summary>match du $dataDate contre $dataAdversaire</summary><table><tr><th>ID Joueur</th><th>Nom</th><th>Prénom</th></tr>";
            foreach ($dataJoueurs[$index] as $joueur) {
                if(!Empty($joueur)){
                    $joueurID = $joueur[0];
                    $joueurNom = $joueur[1];
                    $joueurPrenom = $joueur[2];
                    $this->string .= "<tr><td>$joueurID</td><td>$joueurNom</td><td>$joueurPrenom</td></tr>";
                }
            }
            $this->string .= "</table></details>";
        }
    }

    public function getTable()
    {
        return $this->string .= "</div><script type='text/javascript' src='../scripts/tableSelection.js'></script>";
    }
}

?>