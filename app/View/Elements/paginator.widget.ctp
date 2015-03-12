<?php

/*
 * Paginator for lists
 *
 * Parameters :
 * None.
 *
 * Exemple :
 *
 * echo $this->element('paginator.widget');
 *
 */

?>

<div class="pull-right">

    <?php echo $this->Paginator->pagination(array(
        'ul' => 'pagination'
    )); ?>

</div>