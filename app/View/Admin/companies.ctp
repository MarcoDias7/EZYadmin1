
<section class="content">
<div class="row">
    <div class="col-xs-12">
      
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Companies');?></h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
          <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
            <thead>
                <tr role="row">
                  <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 297px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                     <?php echo __('Name'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 424px;" aria-label="Browser: activate to sort column ascending">
                    <?php echo __('Owner'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Disabled'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Created'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Action'); ?>
                  </th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                    <?php foreach ($companiesList as $item): ?> 
                      <tr>
                      
                      <td><?php echo h($item['Company']['name']); ?></td>
                      <td><?php echo h($item['User']['first_name'].' '.$item['User']['last_name']); ?></td>
                      <td><?php echo h($item['Company']['disabled'] ? 'yes' : 'no'); ?></td>
                      <td><?php echo $this->Html->link($item['Company']['disabled'] ? 'Enable' : 'Disable', '/admin/disable_company/'.$item['Company']['id'], array('class' => 'btn btn-primary')); ?></td>

                 
                        <td>
                          <?php echo $this->Html->link('<i class="fa fa-edit"></i>', '/admin/coupon_edit/'.$item['Company']['id'],
                          array('escape' => false)); ?>
                          <?php echo $this->Html->link('<i class="fa fa-eraser"></i>', '#', array('data-href'=>'coupon_delete/'.$item['Company']['id'], 'escape' => false, 'data-toggle'=>'modal', 'data-target'=>'#confirm-delete')); ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>




<!-- Modal redirection -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php echo __('Delete coupon'); ?>
            </div>
            <div class="modal-body">
                <?php echo __('Are you sure you want to delete this coupon ?'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger"><?php echo __('OK'); ?></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

 $(document).ready(function(){

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });

  });


  $(function() {
      $("#example1").dataTable();
  });

</script>
        
