
<div id="step2"  hidden="hidden">
    <div class="row">
        <div class="col-xs-12">


            <fieldset>



                <div id="errors-step2" class="col col-md-9 col-md-offset-2"></div>


                <div class="form-group required">
                    <?php

		                echo $this->Form->input('num', array('label' => array('text' => __('Invoice number'))));

                    ?>
                </div>


                <div class="form-group required">
                    <?php


                    echo $this->Form->input('condition_id', array('label' => array('text' => __('Payment condition'))));

                    ?>
                </div>

                <div class="form-group required">
                    <?php


                    $options = array();
                    foreach ($bankAccounts as $item) {


                        $options[$item['BankAccount']['id']] = array(
                            'value' => $item['BankAccount']['id'],
                            'name' => $item['BankAccount']['institution'].' - '.$item['BankAccount']['num'],
                        );
                        asort($options);

                    }


                    echo $this->Form->input('bank_account_id', array(
                            'options' => $options,
                        )
                    );

                    ?>
                </div>



                <div class="col col-md-6 col-md-offset-5">


                    <a id="prev2" href="#" class="btn btn-default"><?php echo __('Previous'); ?></a>
                    <a id="next2" href="#" class="btn btn-primary"><?php echo __('Next'); ?></a>

                </div>





            </fieldset>



        </div>

    </div>
</div>
