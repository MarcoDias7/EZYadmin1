<section class="content">
<div class="row">
    <div class="col-xs-12">
      
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title"><?php echo __('Users');?></h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
          <table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
            <thead>
                <tr role="row">
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('#'); ?>
                  <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 297px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                     <?php echo __('Email'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 424px;" aria-label="Browser: activate to sort column ascending">
                    <?php echo __('First name'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Last name'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Import'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Registration date'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Last connection'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Language'); ?>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Disable'); ?>
                  </th>
                  <th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 379px;" aria-label="Platform(s): activate to sort column ascending">
                    <?php echo __('Action'); ?>
                  </th>
                </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all">
              <?php $id = '' ?>
              <?php foreach ($usersList as $item): ?> 
                  <?php if ($id != $item['User']['id'] && $item['User']['id'] != null): ?>
                    <tr>
                      <td><?php echo h($item['User']['id']); ?></td>
                      <td><?php echo h($item['User']['email']); ?></td>
                      <td><?php echo h($item['User']['first_name']); ?></td>
                      <td><?php echo h($item['User']['last_name']); ?></td>
                    <!--  <td><?php echo h($item['User']['hasImport']); ?></td> -->
                      <td><?php echo h($item['User']['created']); ?></td>
                      <td><?php echo h($item['Log']['created']); ?></td>
                      <td><?php echo h($item['User']['language']); ?></td>
                      <td><?php echo h($item['User']['disabled'] ? 'yes' : 'no'); ?></td>
                      <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', '/admin/edit_user/'.$item['User']['id'],
                      array('escape' => false)); ?></td>
                    </tr>
                    <?php $id = $item['User']['id']; ?>
                  <?php endif; ?>
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