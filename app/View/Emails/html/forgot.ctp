<tr align="left" width="558" style="border-collapse: collapse; border-spacing: 0;">
	<td width="548" height="110" colspan="2" style="border: 1px solid #ccc; padding: 25px">
		<h1 style="color: #f9ab25; font-size: 20px;"><?php echo __('Forgot password'); ?></h1>
		<p style="color: #686868; margin-bottom: 30px"><?php echo __('Hello %s,',  h(ucfirst($firstname))); ?><br /><br />
		<?php echo __('You requested a password change on EZYcount, to change it please go to the link below that will be available for 2 hours.'); ?><br /><br />
		<?php echo $this->Html->link(__('Change my password'), array('controller' => 'users', 'action' => 'forgot_change', $user_id, $key, 'full_base' => true)); ?><br />
		<?php echo __('If you didn\'t ask to change your password, please contact the EZYcount support.'); ?><br /><br />
		<?php echo __('Thank you.'); ?><br /><br />
		<?php echo __('The EZYcount team'); ?>
		</p>
		
	</td>
</tr>