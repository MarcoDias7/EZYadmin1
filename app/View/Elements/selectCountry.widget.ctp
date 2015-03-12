<?php


    /*
     * SelectCountry widget is a input for form, for select the country
     *
     * Parameters :
     *
     * inputName, the name of the input or field of class
     *
     * Exemple :
     *
     * echo $this->element('selectCountry.widget', array(
        "inputName" => "country"
        )
       );
     *
     */

    if ($can_write){
        echo $this->Form->input($inputName, array(
            'options' => $this->EZYcount->countryList($language),
            'label' => array(
                'text' => __('Country').' <span class="field-required">*</span>')));
    }
    else{
        echo $this->Form->input($inputName, array(
            'disabled' => 'disabled',
            'options' => $this->EZYcount->countryList($language),
            'label' => array(
                'text' => __('Country').' <span class="field-required">*</span>')));
    }

?>