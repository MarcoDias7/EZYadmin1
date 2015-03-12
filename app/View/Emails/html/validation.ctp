<tr align="left" width="558" style="border-collapse: collapse; border-spacing: 0;">
    <td width="548" height="110" colspan="2" style="border: 1px solid #ccc; padding: 25px">
        <h1 style="color: #f9ab25; font-size: 20px;"><?php echo __('Validate your account'); ?></h1>
        <p style="color: #686868; margin-bottom: 30px"><?php echo __('Hello %s,', h(ucfirst($firstname))); ?><br /><br />
        <?php echo __('To complete your registration to EZYcount, please click on the link below to activate your account:'); ?><br />
        <?php echo $this->Html->link(__('Validate my email'), array('controller' => 'users', 'action' => 'validation', $userid, $validationkey, 'full_base' => true)); ?><br /><br />
        <?php echo __('Thank you.'); ?><br /><br />
        <?php echo __('The EZYcount team'); ?>
        </p>
        
    </td>
</tr>