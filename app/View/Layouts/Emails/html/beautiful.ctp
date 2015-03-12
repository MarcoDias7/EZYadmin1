<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html style="margin-top: 0px !important; padding-top: 0px !important; width: 100%">
<head>
<style type="text/css">
	html, body{ width:100%; margin-top: 0px !important; padding-top: 0px !important; }
	body{ background-color:#FFFFFF; margin-top: 0px !important; padding-top: 0px !important; font-family:sans-serif; }
	table{ margin-top: 0px !important; padding-top: 0px !important; }
	body {
	width: 100%; margin-top: 0px !important; padding-top: 0px !important;
	margin-left: 20px !important}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background: #FFFFFF; font-family: sans-serif; margin: 0px 0 0 0px; padding: 0px 0 0; width: 100%" bgcolor="#FFFFFF">


<table width="550px" align="center" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse; border-spacing: 0; border: 0; margin: 0px 0 0; padding: 0px 0 0">
<tbody>

	<tr align="left" style="border-collapse: collapse; border-spacing: 0; border: 0; height: 120px">
		<td width="250">
			<img src="<?php echo $this->html->url('/', true); ?>/img/mail/ezy_logo.png" style="width: 125px" />
		</td>
		
		<td width="300" style="text-align: right">
			<?php echo $this->Html->link(__('Access EZYcount'), array('controller' => '/', 'full_base' => true), array('style' => 'color: #fff; padding: 10px 25px; background: #f9ab25; border-radius: 8px; -moz-border-radius: 8px; text-decoration: none; display: inline-block; text-align:center;')); ?>
		</td>
		
	</tr>
	<tr align="left" style="border-collapse: collapse; border-spacing: 0; border: 0">
		<td width="550" height="110" colspan="2" style="background: url('<?php echo $this->html->url('/', true); ?>/img/mail/mail_top.jpg')"></td>
	</tr>

	<?php echo $this->fetch('content'); ?>
	
	<tr align="left" style="border-collapse: collapse; border-spacing: 0; border: 0">
		<td width="550" height="60" colspan="2" style="background-color: #a89d94; padding-right: 10px">
			<p style="text-align: right; color: #fff">&copy; <?php echo __('Copyright 2014 SuperVX AG') ;?></p>
		</td>
	</tr>
	
	<tr align="left" style="border-collapse: collapse; border-spacing: 0; border: 0">
		<td width="550" height="70" colspan="2" style="padding: 0 15px 0 15px">
			<p style="text-align: center; color: #a6a6a6; font-size: 12px; margin-top: 0"><?php if (isset($email)) { echo __('You receive this email because you are registered with "%s" on http://www.ezycount.ch. EZYcount simplify your accounting.', $email); } ?><br />
			&copy; <?php echo __('EZYcount is a service of superVX AG, registered company in 3012 Bern'); ?><br />
			<?php echo $this->Html->link(__('Our Terms of Services'), array('controller' => 'pages', 'action' => 'termsofservices', 'full_base' => true)); ?></p>
		</td>
	</tr> 
	
</tbody>
</table>


</body>
</html>


