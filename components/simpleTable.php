<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/Les-Titans-de-Sete/components/simpleTable.php

class SimpleTable {
    private $string;
    private $nbColonnes;

    /**
     * This constructor initializes the table model with the provided data and index.
     * It checks if the provided data matches the structure of the table, otherwise it throws an exception.
     * It also creates the header of the table using the provided index and fills the table with the provided data.
     *
     * @param array $data The data to be used to fill the table. Each element in the array represents a row in the table.
     * @param array $index The index representing the structure of the table. Each element in the array represents a column header.
     * @param string $data_type The type of data in the table (e.g., 'joueur', 'match').
     *
     * @throws Exception If the number of columns in the provided data does not match the number of columns in the provided index.
     */
    public function __construct(array $data, array $index, string $data_type){
        // Checks if the provided data matches the structure of the table otherwise throw an exception
        foreach ($data as $ligne){
            if(count($ligne)!=count($index)){
                throw new Exception('Le nombre de colonnes dans les données prodiguées et la structure du tableau prodiguée n\'est pas la même.');
            }
        }

        $this->nbColonnes = count($index); // save the column size

        // create the "header" of the table with $index
        $this->string = '<table><thead><tr>';
        foreach ($index as $value){
            $this->string.='<th>'.$value.'</th>';
        }
        $this->string.='</tr></thead><tbody>';

        // fill the table with the data
        foreach ($data as $id => $ligne){
            $this->string.='<tr data-id="'.$id.'" data-type="'.$data_type.'">';
            foreach ($ligne as $cell){
                $this->string.='<td>'.$cell.'</td>';
            }
            $this->string.='</tr>';
        }
        $this->string.='</tbody></table>';
    }

    /**
     * Get the HTML string of the table.
     *
     * @return string The HTML string of the table.
     */
    public function getTable() {
        return $this->string;
    }
}
?>