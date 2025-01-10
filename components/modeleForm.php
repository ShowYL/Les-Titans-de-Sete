<?php

class createForm{

    private $string = '';

    /**
     * Constructor for the class.
     *
     * @param string $title The title of the form.
     * @param string $controller The controller associated with the form.
     */
    public function __construct(string $title,string $controller){
        $this->string = '<div id="myModal" class="modal">
                            <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <h2>'.$title.'</h2>'
                                    .'<form id="dynamicForm" method="POST" action="../controllers/'.$controller.'">'
                                    .'<input type="hidden" id="formAction" name="action" value="add">';// to kwon if we are adding or editing
    }

    /**
     * Adds an input field to the form.
     *
     * @param string $label The label for the input field.
     * @param string $type The type of the input field (e.g., text, password, email).
     * @param string $name The name attribute for the input field.
     * @param bool $required Optional. Whether the input field is required. Default is false.
     */
    public function addInput(string $label, string $type, string $name, bool $required = false){
        $this->string .= '<div class="form-group">
                            <label for="'.$name.'">'.$label.'</label>
                            <input type="'.$type.'" id="'.$name.'" name="'.$name.'" '.($required ? 'required' : '').'>
                        </div>';
    }

    /**
     * Adds a select dropdown to the form.
     *
     * @param string $label The label for the select dropdown.
     * @param string $name The name attribute for the select dropdown.
     * @param array $options An associative array of options for the select dropdown, 
     *                       where the key is the option value and the value is the option label.
     */
    public function addSelect(string $label, string $name, array $options){
        $this->string .= '<div class="form-group">
                            <label for="'.$name.'">'.$label.'</label>
                            <select id="'.$name.'" name="'.$name.'">';
        foreach ($options as $opt){
            $this->string .= '<option value="'.$opt.'">'.$opt.'</option>';
        }
        $this->string .= '</select>
                        </div>';
    }

    /**
     * Adds a textarea input to the form.
     *
     * @param string $label The label for the textarea.
     * @param string $name The name attribute for the textarea.
     */
    public function addTextarea(string $label, string $name){
        $this->string .= '<div class="form-group">
                            <label for="'.$name.'">'.$label.'</label>
                            <textarea id="'.$name.'" name="'.$name.'"></textarea>
                        </div>';
    }

    /**
     * Adds a button with the specified text.
     *
     * @param string $text The text to display on the button.
     */
    public function addButton(string $text){
        $this->string .= '<button type="submit">'.$text.'</button>';
    }

    /**
     * Adds a hidden input field to the form.
     *
     * @param string $name The name attribute of the hidden input.
     * @param string $value The value attribute of the hidden input. Default is an empty string.
     */
    public function addHiddenInput(string $name, string $value = ''){
        $this->string .= '<input type="hidden" id="'.$name.'" name="'.$name.'" value="'.$value.'">';
    }

    /**
     * Retrieves the form data.
     *
     * @return mixed The form data.
     */
    public function getForm(){
        return $this->string.'</form>
                        </div>
                    </div>
                <script src="../scripts/formSelection.js"></script> ';
    }

}