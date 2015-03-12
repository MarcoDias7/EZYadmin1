<?php $hisher = array('mr' => __('him'), 'mrs' => __('her')); ?>


<tr align="left" width="558" style="border-collapse: collapse; border-spacing: 0;">
	<td width="548" height="110" colspan="2" style="border: 1px solid #ccc; padding: 25px">
		<h1 style="color: #f9ab25; font-size: 20px;"><?php echo __('Invitation'); ?></h1>
		<p style="color: #686868; margin-bottom: 30px"><?php echo __('Hello,'); ?><br /><br />
		<?php echo __('%s %s has invited you to collaborate with %s for the accounting of <b>%s</b> as a &laquo; <b>%s</b> &raquo;.', h(ucfirst($first_name)), h(ucfirst($last_name)), $hisher[$title], h($company_name), h($status)); ?><br /><br />

		<?php if ($notregistered){
				echo __('To access the company’s information, please %s and accept this invitation by clicking on this %s',
						$this->Html->link(__('create an account') , array('controller' => 'users', 'action' => 'subscribe', 'full_base' => true)),
						$this->Html->link(__('link') , array('controller' => 'companies', 'action' => 'activateright', $company_id, $key, 'full_base' => true)));
			}
			else{
				echo __('To access the company’s information, please connect to EZYcount by clicking on this %s',
						$this->Html->link(__('link') , array('controller' => 'users', 'action' => 'login', $company_id, $key, 'full_base' => true)));
			}

		?>
		<br /><br />

		<?php 
echo __('Thank you for your collaboration with EZYcount.');?><br /><br />
<?php echo __('The EZYcount team');?>

		</p>
		
	</td>
</tr>


