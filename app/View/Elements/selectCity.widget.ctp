<?php

    /*
     * SelectCity widget is a input for form, for select the city and zip
     *
     * Parameters :
     *
     * city, the city field
     * zip, the zip field
     *
     * Exemple :
     *
     * echo $this->element('SelectCity.widget', array(
        "city" => "Company.city",
        "zip" => "Company.zip"
        )
       );
     *
     */

    if ($can_write){
        echo $this->Form->input($zip, array(
            'type' => 'text', 'div' => false, 'wrapInput' => 'col col-md-2', 'label' => array('text' => __('ZIP / City').' <span class="field-required">*</span>')));

        echo $this->Form->input($city, array('div' => false, 'wrapInput' => 'col col-md-4', 'label' => false));
    }
    else{
        echo $this->Form->input($zip, array('disabled' => 'disabled',
            'type' => 'text', 'div' => false, 'wrapInput' => 'col col-md-2', 'label' => array('text' => __('ZIP / City').' <span class="field-required">*</span>')));

        echo $this->Form->input($city, array('disabled' => 'disabled', 'div' => false, 'wrapInput' => 'col col-md-4', 'label' => false));
    }
?>