<section class="content-header">
    <h1>
        <?php echo __('Dashboard');?>
        <small><?php echo __('Control pannel');?></small>
    </h1>
    <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>-->
</section>
<section class="content">
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    00
                </h3>
                <p>
                    <?php echo __('Orders');?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
                <?php echo __('More info');?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <?php echo $users; ?>
                </h3>
                <p>
                    <?php echo __('Users');?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">
                <?php echo __('More info');?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->  
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    <?php echo $companies_total; ?>
                </h3>
                <p>
                    <?php echo __('Companies');?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-ios7-briefcase-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
                <?php echo __('More info');?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?php echo $coupons; ?>
                </h3>
                <p>
                    <?php echo __('Coupons');?>
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-ios7-pricetag-outline"></i>
            </div>
            <a href="#" class="small-box-footer">
                <?php echo __('More info');?> <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>


      
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <div class="box-body">

      <div class="row">
        <div class="col-xs-6 col-sm-4">
          <h4>Orders</h4>
          <span class="text-muted">Total: <b><?php echo $nbr_sells; ?></b></span><br />
          <span class="text-muted">1 year: <b><?php echo $nbr_plan1; ?></b></span><br />
          <span class="text-muted">2 years: <b><?php echo $nbr_plan2; ?></b></span><br />
          <span class="text-muted">3 years: <b><?php echo $nbr_plan3; ?></b></span><br /><br />

        <?php echo $this->Html->link('Export', '/admin/export_orders/', array('class' => 'btn btn-sm btn-primary', 'target' => '_blank')); ?>
        </div>
        <div class="col-xs-6 col-sm-4 placeholder">
          <h4>Users</h4>
          <span class="text-muted">Total: <b><?php echo $users; ?></b></span><br />
          <span class="text-muted">Paying: <b><?php echo $users_paying; ?></b></span><br />
          <span class="text-muted">With access: <b><?php echo $users_with_access; ?></b></span><br /><br />
          <?php echo $this->Html->link('Export', '/admin/export_users/', array('class' => 'btn btn-sm btn-primary', 'target' => '_blank')); ?>
        </div>
        <div class="col-xs-6 col-sm-4 placeholder">
           <h4>Companies</h4>
          <span class="text-muted">companies: <b><?php echo $companies; ?></b> / test: <b><?php echo $companies_test; ?></b> / total: <b><?php echo $companies_total; ?></b></span><br />

          <span class="text-muted">avg. Users with access/company: <b><?php echo $avg_users; ?></b></span><br />
          <span class="text-muted">avg. Booking/company: <b><?php echo $avg_bookings; ?></b></span><br /><br />
          <?php echo $this->Html->link('Export', '/admin/export_companies/', array('class' => 'btn btn-sm btn-primary', 'target' => '_blank')); ?>
        </div>
        </div>
      </div>
    </div>

</section>
