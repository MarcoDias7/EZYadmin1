<div class="row">
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

    <?php echo $this->Form->hidden('User.id'); ?>
        <?php
            echo $this->Form->input('User.email', array('label' => array('text' => __('Email / Login'))));
        ?>
        <?php
            echo $this->Form->input('User.disabled', array('label' => array('text' => __('Disabled'))));
        ?>
        <?php

            echo $this->Form->submit('&nbsp;&nbsp;&nbsp;'.__('Save').'&nbsp;&nbsp;&nbsp;', array(
                            'div' => 'col col-md-6 col-md-offset-5',
                            'class' => 'btn btn-primary',
                            'escape' => false,
                    ));

        ?>
    <?php echo $this->Form->end(); ?>

</div>