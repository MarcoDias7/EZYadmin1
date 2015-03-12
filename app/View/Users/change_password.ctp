<div class="container">
    <?php
        echo $this->Form->create('User', array(
            'inputDefaults' => array(
                'div' => 'form-group',
                'label' => array(
                    'class' => 'col col-md-4 control-label'
                    ),
                'wrapInput' => 'col col-md-4',
                'class' => 'form-control'
                ),
            'class' => 'form-horizontal'));
    ?>
        <fieldset>
            <legend><?php echo __('Change my password'); ?></legend>
        <?php
            echo $this->Form->input('User.password', array('label' => array('text' => __('Current password').' <span class="field-required">*</span>')));
            echo $this->Form->input('User.new_password', array('type' => 'password', 'label' => array('text' => __('New password').' <span class="field-required">*</span>')));
            echo $this->Form->input('User.confirm_new_password', array('type' => 'password', 'label' => array('text' => __('Confirm new password').' <span class="field-required">*</span>')));

        ?>
        <?php

            echo $this->Form->submit(__('Save'), array(
                            'div' => 'col col-md-6 col-md-offset-5',
                            'class' => 'btn btn-primary'
            ));
            
        ?>
        </fieldset>
    <?php echo $this->Form->end(); ?>

</div>