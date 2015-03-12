<div class="container">
    <div class="row">
        <div class="col-xs-8">

            <?php

            echo $this->Form->create('Product', array(
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
                        echo __('Add Product');
                    else
                        echo __('Edit Product');
                    ?>
                </legend>

                <div class="form-group required">
                    <?php

                    echo $this->Form->input('product_name', array('label' => array('text' => __('Product name').' <span class="field-required">*</span>')));
                    ?>
                </div>

                <div class="form-group required">

                    <?php

                    if ($this->action == 'edit') {

                        echo $this->Form->input('product_num', array(
                            'type' => 'text',
                            'div' => false,
                            'wrapInput' => 'col col-md-3',
                            'label' => array('text' => __('Product number').' <span class="field-required">*</span>')));


                    }else{

                        echo $this->Form->input('product_num', array(
                            'type' => 'text',
                            'div' => false,
                            'readonly' => 'readonly',
                            'wrapInput' => 'col col-md-3',
                            'value' => $lastProductNum + 1,
                            'label' => array('text' => __('Product number').' <span class="field-required">*</span>')));

                    ?>

                        <span>
                            <a id="setProductNumProduct" class="btn btn-primary custom-no" href="#"><?php echo __('Set custom num product') ?></a>
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
                    <?php echo $this->Form->input('product_quantity', array('label' => array('text' => __('Product quantity'.' <span class="field-required">*</span>')))); ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('product_unit', array('label' => array('text' => __('Product unit'.' <span class="field-required">*</span>')))); ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('product_price_unity', array('label' => array('text' => __('Product price/unit'.' <span class="field-required">*</span>')))); ?>
                </div>

                <div class="form-group required">
                    <?php

                    $options = array('all' => __('All Account'));
                    foreach ($productAccounts as $item) {

                       $options[$item['Account']['id']] = $item['Account']['number'].' - '.$item['Account']['title'];
                       asort($options);

                    }

                     echo $this->Form->input('Product.id_account', array('options' => $options,
                        'div' => false,
                        'label' => array('text' => __('Account '.' <span class="field-required">*</span>'))));

                    ?>



                </div>

                <div class="form-group required">
                    <?php

                    $options = array('all' => __('All VatAccount'));
                    foreach ($accounts as $item) {

                       $options[$item['VatAccount']['id']] = $item['VatAccount']['code'].' - '.$item['VatAccount']['name'];
                       asort($options);

                    }

                     echo $this->Form->input('Product.vat_account_id', array('options' => $options,
                        'div' => false,
                        'label' => array('text' => __('TVA Code'.' <span class="field-required">*</span>'))));

                    ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('product_description', array('label' => array('text' => __('Description')))); ?>
                </div>

                <div class="form-group required">
                    <?php echo $this->Form->input('product_is_service', array('label' => array('text' => __('Service')))); ?>
                </div>


                <div class="form-group required">
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
                <p><?php echo __('The product number is automatically generated, but you can specify your own.'); ?></p>
            </div>
        </div>
    </div>
</div>

<script>

    $("#ProductProductNum").change(function() {

        var objData = {product_num: $(this).val()};

        $("#isLoading").show();
        $("#isUnique").hide();
        $("#isNotUnique").hide();

        $.ajax({
            url: '<?php echo Router::url("/products/product_num_is_unique.json"); ?>',
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

    $("#setProductNumProduct").click(function(){

        if($("#setProductNumProduct").hasClass('custom-no')){

            $("#ProductProductNum").removeAttr('readonly');

            $("#setProductNumProduct").removeClass('custom-no');
            $("#setProductNumProduct").text('<?php echo __('Generate for me') ?>');

        }else{

            $("#ProductProductNum").attr('readonly', 'readonly');
            <?php  if ($this->action == 'add') {  ?>
            $("#ProductProductNum").val('<?php echo $lastProductNum + 1 ; ?>');
            <?php } ?>


            $("#setProductNumProduct").addClass('custom-no');
            $("#setProductNumProduct").text('<?php echo __('Define product number ') ?>');

        }




    });

</script>

