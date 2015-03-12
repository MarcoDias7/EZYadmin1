<div class="container">
    <div class="col col-md-4 col-md-offset-4"  id="login-box">
        <div class="text-center" id="logo">
            <?php echo $this->Html->image('ezy_logo.png', array('alt' => '', 'height' => 80)); ?>
        </div>
    <?php 
            echo $this->Form->create('User', array(
                'inputDefaults' => array(
                    'div' => 'form-group',
                    'wrapInput' => 'col col-md-12',
                    'class' => 'form-control'
                    ),
                'class' => 'form-horizontal'));
        ?>
			<?php echo $this->Form->input('User.email', array('label' => false, 'placeholder' => __('Email'))); ?>
			<?php echo $this->Form->input('User.password', array('label' => false, 'placeholder' => __('Password'))); ?>
			<div class="text-center">
                <?php echo $this->Html->link(__('Forgot password'), array('controller' => 'users', 'action' => 'forgot'), array('class' => 'btn btn-default')); ?>
                <?php echo $this->Form->button(__('Log in'), array('class' => 'btn btn-primary')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
</div>