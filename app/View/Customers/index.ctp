<div class="container">

    <div class="customers index">

        <h2><?php echo __('Customers'); ?></h2>

        <div class="pull-left">

            <?php echo $this->Html->link(
                __('New Customer'),
                array('action' => 'add'),
                array('class' => 'btn btn-primary')); ?>

        </div>


        <?php

            // Show paginator
            echo $this->element('paginator.widget');

        ?>

        <table class="table table-striped">
        <thead class="orange">
        <tr>
                <th><?php echo $this->Paginator->sort('customer_num'); ?><?php echo __('#'); ?></th>
                <th><?php echo $this->Paginator->sort('customer_name'); ?></th>
                <th><?php echo $this->Paginator->sort('city'); ?></th>
                <th class="actions"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
        <tr>

            <td class="customerNumRow"><?php echo h($customer['Customer']['customer_num']); ?>&nbsp;</td>
            <td><?php echo h($customer['Customer']['customer_name']); ?>&nbsp;</td>
            <td><?php echo h($customer['Customer']['zip']); ?>&nbsp; <?php echo h($customer['Customer']['city']); ?>&nbsp; </td>
            <td class="actions">
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $customer['Customer']['id']),  array('class' => 'btn btn-primary')); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $customer['Customer']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        </table>

        <?php

            // Show paginator
            echo $this->element('paginator.widget');

        ?>

    </div>

</div>