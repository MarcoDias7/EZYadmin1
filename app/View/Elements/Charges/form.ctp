<div class="container">
    <div class="row">
        <div class="col-xs-8">

            <?php

            echo $this->Form->create('Charge', array(
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
                        echo __('Add other charge');
                    else
                        echo __('Edit other charge');
                    ?>
                </legend>

                <div class="form-group required">
                    <?php

                    echo $this->Form->input('name', array('label' => array('text' => __('Other charge name').' <span class="field-required">*</span>')));
                    ?>
                </div>

                <div class="form-group required">

                    <?php

                    if ($this->action == 'edit') {

                        echo $this->Form->input('code', array(
                            'type' => 'text',
                            'div' => false,
                            'wrapInput' => 'col col-md-3',
                            'label' => array('text' => __('Code').' <span class="field-required">*</span>')));


                    }else{

                        echo $this->Form->input('code', array(
                            'type' => 'text',
                            'div' => false,
                            'readonly' => 'readonly',
                            'wrapInput' => 'col col-md-3',
                            'value' => $lastCode + 1,
                            'label' => array('text' => __('Code').' <span class="field-required">*</span>')));

                    ?>

                        <span>
                            <a id="setCustomCodeCharge" class="btn btn-primary custom-no" href="#"><?php echo __('Set custom code other charge') ?></a>
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
                    <?php echo $this->Form->input('value', array('label' => array('text' => __('Rate').' <span class="field-required">*</span>'))); ?>
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
                <p><?php echo __('The other charge number is automatically generated, but you can specify your own.'); ?></p>
            </div>
        </div>
    </div>
</div>

<script>



    $("#ChargeCode").change(function() {

        var objData = {charge_num: $(this).val()};

        $("#isLoading").show();
        $("#isUnique").hide();
        $("#isNotUnique").hide();

        $.ajax({
            url: '<?php echo Router::url("/charges/code_is_unique.json"); ?>',
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

    $("#setCustomCodeCharge").click(function(){

        if($("#setCustomCodeCharge").hasClass('custom-no')){

            $("#ChargeCode").removeAttr('readonly');

            $("#setCustomCodeCharge").removeClass('custom-no');
            $("#setCustomCodeCharge").text('<?php echo __('Generate for me') ?>');

        }else{

            $("#ChargeCode").attr('readonly', 'readonly');
            <?php  if ($this->action == 'add') {  ?>
            $("#ChargeCode").val('<?php echo $lastCode + 1 ; ?>');
            <?php } ?>


            $("#setCustomCodeCharge").addClass('custom-no');
            $("#setCustomCodeCharge").text('<?php echo __('Set other charge number') ?>');

        }




    });



</script>

