
<div id="step1">
    <div class="row">
        <div class="col-xs-12">


            <fieldset>


                <div id="errors-customer" class="col col-md-9 col-md-offset-2"></div>

                <!-- Add Customer Block -->
                <div id="CustomerAddBlock" hidden="hidden">


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
                        'class' => 'form-horizontal'));;



                    ?>



                        <div class="form-group required">

                            <?php

                            echo $this->Form->input('customer_name', array('label' => array('text' => __('Customer name').' <span class="field-required">*</span>')));
                            ?>
                        </div>

                        <div class="form-group required">

                            <?php


                                echo $this->Form->input('customer_num', array(
                                    'type' => 'text',
                                    'div' => false,
                                    'readonly' => 'readonly',
                                    'wrapInput' => 'col col-md-3',
                                    'value' => $lastCustomerNum + 1,
                                    'label' => array('text' => __('Customer number').' <span class="field-required">*</span>')));

                                ?>

                                <span>
                                    <a id="setCustomNumCustomer" class="btn btn-success custom-no" href="#"><?php echo __('Set customer number') ?></a>
                                </span>


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




                </div>


                </form>

                <?php

                       //echo $this->Form->end('Customer');

                ?>


                <!-- choose customer block -->


                <div id="CustomerChooseBlock" class="form-group required">


                    <?php


                    $options = array();
                    foreach ($customers as $item) {


                        $options[$item['Customer']['id']] = array(
                            'value' => $item['Customer']['id'],
                            'name' => $item['Customer']['customer_num'].' - '.$item['Customer']['customer_name'],
                            'data-num' => $item['Customer']['customer_num'],
                            'data-name' => $item['Customer']['customer_name'],
                            'data-street1' => $item['Customer']['street1'],
                            'data-zip' => $item['Customer']['zip'],
                            'data-city' => $item['Customer']['city']
                        );
                        asort($options);

                    }


                    echo $this->Form->input('customer_id', array(
                        'empty' => __('Choose a customer'),
                        'options' => $options,
                        'between'=> '<label class="col col-md-4 control-label" align="right">'.  __('Customer'). '<span class="field-required">*</span></label>' ,
                        'label' => false
                        )
                    );

                    ?>

                    <div class="form-group">

                        <br/>
                        <br/>

                        <a id="addCustomerButton" href="#" class="btn btn-success col col-md-2 col-md-offset-8"><?php echo __('New customer'); ?></a>

                        <br/>
                        <br/>

                    </div>

                </div>

                <div class="col col-md-6 col-md-offset-5">

                    <button id="chooseCustomerButton" type="button" class="btn btn-default"><?php echo __('Cancel'); ?></button>
                    <a id="next1" data-is-new-customer="false" href="#" class="btn btn-primary"><?php echo __('Next'); ?></a>

                </div>



            </fieldset>



        </div>

    </div>
</div>
