
</script>
<noscript>
<div style="display:inline;">

</div>
</noscript>


<?php $titles = $this->EZYCount->title_array(); ?>

<div class="container">

	<div class="centered">
		<h3><?php echo __('Welcome to EZYcount !'); ?></h3>
		<p class="lead"><?php echo __('Before using our service, you need to add your company.'); ?></p>
		<br />

	    <div class="container">
	        <?php echo $this->Html->link(__('Create your Company\'s<br /> Accounting'), '/companies/step1', array('class' => 'btn btn-lg btn-primary', 'escape' => false)); ?>
	        &nbsp;&nbsp;&nbsp;<i><?php echo __('OR'); ?></i>&nbsp;&nbsp;&nbsp;
	        <?php echo $this->Html->link(__('Try with an Example<br />&nbsp;'), '/companies/import_example', array('class' => 'btn btn-lg btn-success', 'escape' => false)); ?>
	        <br /><br />
	    </div>
	</div>
    <br /><br />

	    <div class="col col-md-8 col-md-offset-2 text-centered border-bottom-orange">
        <h4 class="big-orange-font"><?php echo __('Our features'); ?></h4>
    </div>


    <div class="row feature-table">
        <div class="col col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col col-md-1">
                    <span class="glyphicon glyphicon-user big-icon"></span>
                </div>
                <div class="col col-md-5">
                    <h4><?php echo __('Unlimited users'); ?></h4>
                    <? echo __('Share your accounting with as many users as you want.'); ?>
                </div>

               <div class="col col-md-1">
                    <span class="glyphicon glyphicon-briefcase big-icon"></span>
                </div>
                <div class="col col-md-5">
                    <h4><?php echo __('Booking w/ VAT & visual T-Help'); ?></h4>
                    <? echo __('Avoid basic accounting mistakes with visual help.'); ?>
                </div>
            </div>
            <div class="row">

                <div class="col col-md-1">
                    <span class="glyphicon glyphicon-calendar big-icon"></span>
                </div>
                <div class="col col-md-5">
                    <h4><?php echo __('365 days per year access'); ?></h4>
                    <? echo __('Access your accounting anytime with a simple internet connection.'); ?>
                </div>

               <div class="col col-md-1">
                    <span class="glyphicon glyphicon-eye-open big-icon"></span>
                </div>
                <div class="col col-md-5">
                    <h4><?php echo __('All accounting reports'); ?></h4>
                    <? echo __('Balance sheet, income statement, account statement and VAT reports.'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-1">
                    <span class="glyphicon glyphicon-inbox big-icon"></span>
                </div>
                <div class="col col-md-5">
                    <h4><?php echo __('Full access to support website'); ?></h4>
                    <? echo __('Help and examples guide you through EZYcount.'); ?>
                </div>

               <div class="col col-md-1">
                    <span class="glyphicon glyphicon-floppy-saved big-icon"></span>
                </div>
                <div class="col col-md-5">
                    <h4><?php echo __('Daily automated back-up'); ?></h4>
                    <? echo __('Your data is stored confidentially on secure Swiss servers.'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

