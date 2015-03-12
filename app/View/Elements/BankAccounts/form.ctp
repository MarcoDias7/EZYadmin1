<div class="container">
    <div class="row">
        <div class="col-xs-8">

            <?php

            echo $this->Form->create('BankAccount', array(
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
                        echo __('Add BankAccount');
                    else
                        echo __('Edit BankAccount');
                    ?>
                </legend>

                <div class="form-group required">
                    <?php

                    echo $this->Form->input('institution', array('label' => array('text' => __('Institute').' <span class="field-required">*</span>')));
                    ?>
                </div>

                <div class="form-group required">
                    <?php

                    echo $this->Form->input('num',
                        array(
                            'div' => false,
                            'wrapInput' => 'col col-md-6',
                            'label' => array('text' => __('Account num').' <span class="field-required">*</span>')));
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
                <p><?php echo __('You can easily manage your different bank/post accounts.'); ?></p>
            </div>
        </div>
    </div>
</div>

<script>



    $("#BankAccountNum").change(function() {

        var objData = {bankAccounts_num: $(this).val()};

        $("#isLoading").show();
        $("#isUnique").hide();
        $("#isNotUnique").hide();

        $.ajax({
            url: '<?php echo Router::url("/bankaccounts/num_is_unique.json"); ?>',
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


</script>

<?php echo $this->element('autocompleteCity.script', array(
    "cityElement" => "#BankAccountCity",
    "zipElement" => "#BankAccountZip",
)); ?>