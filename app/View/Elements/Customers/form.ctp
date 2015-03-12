<div class="container">
    <div class="row">
        <div class="col-xs-8">

            <?php

            echo $this->Form->create('Customer', array(
                'inputDefaults' => array(
                    'div' => 'form-group',
                    'label' => array(
                        'class' => 'col col-md-4 control-label'
                    ),
                    'wrapInput' => 'col col-md-6',
                    'class' => 'form-control'
                ),
                'type' => 'file',
                'class' => 'form-horizontal'));; ?>

            <fieldset>

                <legend><?php

                    if ($this->action == 'add')
                        echo __('Add Customer');
                    else
                        echo __('Edit Customer');
                    ?>
                </legend>

                <div class="form-group required">
                    <?php

                    echo $this->Form->input('customer_name', array('label' => array('text' => __('Customer name').' <span class="field-required">*</span>')));
                    ?>
                </div>

                <div class="form-group required">

                    <?php

                    if ($this->action == 'edit') {

                        echo $this->Form->input('customer_num', array(
                            'type' => 'text',
                            'div' => false,
                            'wrapInput' => 'col col-md-3',
                            'label' => array('text' => __('Customer number').' <span class="field-required">*</span>')));


                    }else{

                        echo $this->Form->input('customer_num', array(
                            'type' => 'text',
                            'div' => false,
                            'readonly' => 'readonly',
                            'wrapInput' => 'col col-md-3',
                            'value' => $lastCustomerNum + 1,
                            'label' => array('text' => __('Customer number').' <span class="field-required">*</span>')));

                    ?>

                        <span>
                            <a id="setCustomNumCustomer" class="btn btn-primary custom-no" href="#"><?php echo __('Set customer number') ?></a>
                        </span>


                    <?php

                    }

                    ?>

                    <span id="isLoading" hidden="hidden">
                        <img src="<?php echo $this->webroot; ?>img/loading.gif" height="16px" / >
                    </span>
                    <span id="isUnique" hidden="hidden">
                        <img src="<?php echo $this->webroot; ?>img/test-pass-icon.png" height="16px" / >
                    </span>
                    <span id="isNotUnique" hidden="hidden">
                        <img src="<?php echo $this->webroot; ?>img/test-fail-icon.png" height="16px" / >
                    </span>
                </div>


                <div class="form-group required">
                    <?php echo $this->Form->input('street1', array('label' => array('text' => __('Main street')))); ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('street2', array('label' => array('text' => __('Second street')))); ?>
                </div>

                <div class="form-group required">
                    <?php

                    echo $this->element('selectCity.widget', array(
                            "city" => "city",
                            "zip" => "zip"
                        )
                    );

                    ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->element('selectCountry.widget', array(
                            "inputName" => "country"
                        )
                    ); ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('phone'); ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('email'); ?>
                </div>


                <div class="form-group">
                    <?php


                        if ($this->action == 'edit') {echo $this->Form->input('id');}

                        echo $this->Form->submit(__('Save and continue'), array( 'div' => 'col col-md-6 col-md-offset-5', 'class' => 'btn btn-primary', 'id' => 'submitForm'));

                    ?>
                </div>

            </fieldset>

        </div>

        <div class="col-xs-4">
            <div class="bs-callout bs-callout-info">
                <h4><?php echo __('Tips'); ?></h4>
                <p><?php echo __('The customer number is automatically generated, but you can specify your own.'); ?></p>
            </div>
        </div>
    </div>
</div>

<script>



    $("#CustomerCustomerNum").change(function() {

        var objData = {customer_num: $(this).val()};

        $("#isLoading").show();
        $("#isUnique").hide();
        $("#isNotUnique").hide();

        $.ajax({
            url: '<?php echo Router::url("/customers/customer_num_is_unique.json"); ?>',
            dataType: 'json',
            data: objData,
            success: function (data) {

                $("#isLoading").hide();

                if(data == true)
                    $("#isUnique").show();
                else
                    $("#isNotUnique").show();

            }
        });
    });

    $("#setCustomNumCustomer").click(function(){

        if($("#setCustomNumCustomer").hasClass('custom-no')){

            $("#CustomerCustomerNum").removeAttr('readonly');

            $("#setCustomNumCustomer").removeClass('custom-no');
            $("#setCustomNumCustomer").text('<?php echo __('Generate for me') ?>');

        }else{

            $("#CustomerCustomerNum").attr('readonly', 'readonly');
            <?php  if ($this->action == 'add') {  ?>
            $("#CustomerCustomerNum").val('<?php echo $lastCustomerNum + 1 ; ?>');
            <?php } ?>


            $("#setCustomNumCustomer").addClass('custom-no');
            $("#setCustomNumCustomer").text('<?php echo __('Set customer number') ?>');

        }




    });



</script>

<?php echo $this->element('autocompleteCity.script', array(
    "cityElement" => "#CustomerCity",
    "zipElement" => "#CustomerZip",
)); ?>