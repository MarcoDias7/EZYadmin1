<?php $titles = array('mr' => 'Mr.', 'mrs' => 'Mrs', 'miss' => 'Miss'); ?>

Dear <?php echo $titles[$title]; ?> <?php echo htmlspecialchars($lastname); ?>,<br />
To complete your registration to EZYcount, please click on the link below to activate your account:
<br /><br />
<?php echo $this->Html->link('This link', array('controller' => 'users', 'action' => 'validation', $userid, $validationkey, 'full_base' => true)); ?><br /><br />
Thank you.<br /><br />
The EZYcount team