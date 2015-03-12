<tr align="left" width="558" style="border-collapse: collapse; border-spacing: 0;">
	<td width="548" height="110" colspan="2" style="border: 1px solid #ccc; padding: 25px">
		<h1 style="color: #f9ab25; font-size: 20px;"><?php echo __('Change of email'); ?></h1>
		<p style="color: #686868; margin-bottom: 30px"><?php echo __('Hello %s,',  h(ucfirst($firstname))); ?><br /><br />
		<?php echo __('To complete the change of your new email address, please click on the link below:'); ?><br /><br />
		<?php echo $this->Html->link(__('Confirm my new email address'), HtmlHelper::url(array('controller' => 'users', 'action' => 'changemail', $newemail), true).'/'); ?><br />
		<?php echo __('If you didn\'t ask to change your email address, please contact the EZYcount support.'); ?><br /><br />
		<?php echo __('Thank you.'); ?><br /><br />
		<?php echo __('The EZYcount team'); ?>
		</p>
		
	</td>
</tr>