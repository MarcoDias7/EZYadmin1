<div id="step-progress">
    <div class="row">
        <div class="col-xs-3">
            <div class="smpl-step-info text-center">
                <?php
                    echo $this->Html->link(__('Choose customer'), array('action' => 'step1'));
                ?>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="smpl-step-info text-center">
                <?php

                    echo __('Invoice informations');

                ?>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="smpl-step-info text-center">
                <?php

                    echo __('Products / services');

                ?>
            </div>
        </div>


        <div class="col-xs-3">
            <div class="smpl-step-info text-center">
                <?php

                    echo __('Confirmation');

                ?>
            </div>
        </div>


    </div>
    <div class="row smpl-step">

        <div class="col-xs-3 smpl-step-step active" id="step1-header">
            <div class="progress">
                <div class="progress-bar"></div>
            </div>
            <?php echo $this->Html->link('1', array('action' => 'step1'), array('class' => 'smpl-step-icon')); ?>
        </div>

        <div class="col-xs-3 smpl-step-step disabled" id="step2-header">
            <div class="progress">
                <div class="progress-bar"></div>
            </div>
            <?php
                if (!empty($currentCompany) && $currentCompany['Company']['current_step'] >= 0) {
            echo $this->Html->link('2', array('action' => 'step2'), array('class' => 'smpl-step-icon'));
            }
            else {
            ?>
            <a class="smpl-step-icon"><?php echo '2'; ?></a>
            <?php
                }
            ?>
        </div>


        <div class="col-xs-3 smpl-step-step disabled" id="step3-header">
            <div class="progress">
                <div class="progress-bar"></div>
            </div>
            <?php
                if (!empty($currentCompany) && $currentCompany['Company']['current_step'] >= 1) {
            echo $this->Html->link('3', array('action' => 'step3'), array('class' => 'smpl-step-icon'));
            }
            else {
            ?>
            <a class="smpl-step-icon"><?php echo '3'; ?></a>
            <?php
                }
            ?>
        </div>

        <div class="col-xs-3 smpl-step-step disabled" id="step4-header">

            <div class="progress">
                <div class="progress-bar"></div>
            </div>
            <?php
                if (!empty($currentCompany) && $currentCompany['Company']['current_step'] >= 2) {
            echo $this->Html->link('4', array('action' => 'step4'), array('class' => 'smpl-step-icon'));
            }
            else {
            ?>
            <a class="smpl-step-icon"><?php echo '4'; ?></a>
            <?php
                }
            ?>
        </div>





    </div>
</div>