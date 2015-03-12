<tr align="left" width="558" style="border-collapse: collapse; border-spacing: 0;">
	<td width="548" height="110" colspan="2" style="border: 1px solid #ccc; padding: 25px">
		<h1 style="color: #f9ab25; font-size: 20px;"><?php echo __('Your subscription expires !'); ?></h1>
		<p style="color: #686868; margin-bottom: 30px"><?php echo __('Hello %s,', h(ucfirst($firstname))); ?><br /><br />
		<?php echo __('Your subscription at EZYcount for %s will expire in <b>%d days</b> !', h($company), $expire); ?><br />
		<?php echo __('You can renew it from the end of your current subscription.'); ?><br />
		<?php echo __('Please visit "My account" webpage by clicking on the link below, to discover our packages starting from just CHF 9.90 per month.'); ?><br /><br />
		 <?php echo $this->Html->link(
    __('Renew here'),
    array(
        'controller' => 'users',
        'action' => 'index',
        'full_base' => true
    )
); ?> <br />
		<?php echo __('Note that after the expiration date, you will not be able to edit your acccounting anymore.'); ?><br /><br />
		<?php echo __('Thank you.'); ?><br /><br />
		<?php echo __('The EZYcount team'); ?>
		</p>
		
	</td>
</tr>