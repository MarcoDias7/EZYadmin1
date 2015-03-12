<tr align="left" width="558" style="border-collapse: collapse; border-spacing: 0;">
	<td width="548" height="110" colspan="2" style="border: 1px solid #ccc; padding: 25px; color: #686868;">
<div style="font-size: 15px;">
<div style="text-align: right;">
	<img src="<?php echo $this->html->url('/', true); ?>/img/ezy_logo.png" alt="logo" height="120" />
	<br />
	<br />
	<br />
	<br />
	<br />
</div>

<div style="float: left;">
	<u><?php echo __('Billing address:'); ?></u><br />
	<br />
	<?php echo h(ucfirst($name)); ?><br />
	<?php echo h($street); ?><br />
	<?php echo h($zip.' '.$city); ?><br />
	<?php echo h($country); ?><br />
</div>

<div style="float: right;">
	<u><?php echo __('Provider'); ?></u><br />
	<br />
	<?php echo __('EZYcount'); ?><br />
	<?php echo __('superVX AG'); ?><br />
	<?php echo __('neufeldstrasse 134'); ?><br />
	<?php echo __('3012 Bern'); ?><br /><br /><br />

	<?php echo __('VAT: CHE_481.185.632 TVA'); ?><br />
	<br />
	<?php echo __('Date: %s', $date); ?>
</div>

<div style="clear: both;"></div>

<h2 style="color: #f9ab25;"><?php echo __('Invoice number %s', h($order_id)); ?></h2>
<br />
<p><?php echo __('Hello %s', h(ucfirst($first_name))); ?><br />
<br />
<?php echo __('Thank you very much for your purchase. We hope you will enjoy working with EZYcount.'); ?><br /><br />
<?php echo __('EZYcount Team'); ?>

<br /><br />
</p>
<table width="100%" border="0" cellspacing="0">
	<tr>
		<td>&bull; <?php echo __('%s year(s) subscription for %s', $plan, h($company_name)); ?><br />
		&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Valid until: %s.', h($end_date)); ?><br /><br /></td>
		<td></td>
		<td style="text-align: right;">
			<?php echo __('CHF %s', h($totalHT)); ?>
		</td>
	</tr>

	<tr>
		<td></td>
		<td style="border-bottom: 1px solid black;"><?php echo __('+8% VAT'); ?></td>
		<td style="text-align: right; border-bottom: 1px solid black;"><?php echo __('CHF %s', h($totalVAT)); ?></td>
	</tr>

	<tr>
		<td></td>
		<td><b><?php echo __('Total'); ?></b></td>
		<td style="text-align: right;"><b>
		<?php echo __('CHF %s', h($total)); ?></b></td>
	</tr>
</table>
</div>
		
	</td>
</tr>