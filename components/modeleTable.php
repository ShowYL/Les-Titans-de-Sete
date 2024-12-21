<?php

class createTable{

    private $string = '';
    private $nbColonnes;

    /**
     * Constructor for the table model.
     *
     * This constructor initializes the table model with the provided data and index.
     * It checks if the provided data matches the structure of the table, otherwise it throws an exception.
     * It also creates the header of the table using the provided index and fills the table with the provided data.
     *
     * @param array $data The data to be used to fill the table. Each element in the array represents a row in the table.
     * @param array $index The index representing the structure of the table. Each element in the array represents a column header.
     *
     * @throws Exception If the number of columns in the provided data does not match the number of columns in the provided index.
     */
    public function __construct(array $data, array $index){
        // Checks if the provided data matches the structure of the table otherwise throw an exception
        foreach ($data as $ligne){
            if(count($ligne)!=count($index)){
                throw new Exception('Le nombre de colonnes dans les données prodiguées et la structure du tableau prodiguée n\'est pas la même.');
            }
        }

        $this->nbColonnes = count($index); // save the column size

        // create the "header" of the table with $index
        $this->string = '<div class="toolbar">
                        <input id="search-input" type="text" placeholder="Search..." class="search-input">
                        <button type="button" onclick="deleteSelected()">Supprimer</button>
                        <button type="button" onclick="editSelected()">Modifier</button>
                        <button class="add-btn" id="addBtn">Ajouter</button>
                    </div>
                    <table id="table-search"><tr>';
        foreach ($index as $value){
            $this->string.='<th>'.$value.'</th>';
        }
        $this->string.='</tr>';

        // fill the table with the data
        foreach ($data as $id => $ligne){
            $this->string.='<tr data-id="'.$id.'" onclick="selectRow(this)">';
            foreach ($ligne as $cell){
                $this->string.='<td>'.$cell.'</td>';
            }
            $this->string.='</tr>';
        }
    }

    /**
     * Adds a row to the table with the provided data.
     *
     * This method takes an array of data and adds it as a new row in the table.
     * It first checks if the number of elements in the provided data matches the
     * number of columns in the table. If not, it throws an exception.
     *
     * @param array $data An array containing the data for the new row. The number
     *                    of elements in this array must match the number of columns
     *                    in the table.
     * @throws Exception If the number of elements in the provided data does not
     *                   match the number of columns in the table.
     */
    public function addLigne(array $data){
        
        if (count($data)!=$this->nbColonnes){
            // Checks if the provided data matches the structure of the table otherwise throw an exception
            throw new Exception('Le nombre de colonnes dans les données prodiguées et la structure du tableau prodiguée n\'est pas la même.');
        }

        // fill the table with the data
        $this->string.='<tr>';
        foreach($data as $cell){
            $this->string.='<td>'.$cell.'</td>';
        }
        $this->string.='</tr>';
    }

    /**
     * Adds rows to the table.
     *
     * This method takes an array of data and adds each row to the table.
     * It first checks if the provided data matches the structure of the table.
     * If the number of columns in the provided data does not match the table structure,
     * an exception is thrown.
     *
     * @param array $data An array of rows, where each row is an array of cell values.
     * @throws Exception If the number of columns in the provided data does not match the table structure.
     */
    public function addLignes(array $data){
        // Checks if the provided data matches the structure of the table otherwise throw an exception
        foreach ($data as $ligne){
            if(count($ligne)!=$this->nbColonnes){
                throw new Exception('Le nombre de colonnes dans les données prodiguées et la structure du tableau prodiguée n\'est pas la même.');
            }
        }

        // fill the table with the data
        foreach ($data as $ligne){
            $this->string.='<tr>';
            foreach ($ligne as $cell){
                $this->string.='<td>'.$cell.'</td>';
            }
            $this->string.='</tr>';
        }
    }

    /**
     * Generates the closing tag for an HTML table and appends it to the existing string.
     *
     * @return string The updated string with the closing table tag appended.
     */
    public function getTable(){
        return $this->string.='</table>
                            <script type = "text/javascript" src="../scripts/table.js"></script>';
    }
}

?>