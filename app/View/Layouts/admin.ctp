
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <title>
      EZYcount :
      Admin    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="/supervx/favicon.ico" type="image/x-icon" rel="icon" />

        <!-- jQuery 2 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        
    <!-- bootstrap 3.0.2 -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/bootstrap.min.css" />
    <!-- font Awesome -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/font-awesome.min.css" />
    <!-- Ionicons -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/ionicons.min.css" />
    <!-- DATA TABLES -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/datatables/dataTables.bootstrap.css" />
    <!-- Morris chart -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/bootstrap.min.css" />
    <!-- jvectormap -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/morris/morris.css" />
    <!-- Date Picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/datepicker/datepicker3.css" />
    <!-- Daterange picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/font-awesome.min.css" />
    <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" />
    <!-- Theme style -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>admin_template/css/AdminLTE.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header" style="position:absolute;">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                EZYcount
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="menubar_lang nav navbar-nav navbar-right">
                <li><?php echo $this->Html->link(__('EN'), '/users/language/en'); ?></li>
                <li><?php echo $this->Html->link(__('FR'), '/users/language/fr'); ?></li>
                <li><?php echo $this->Html->link(__('DE'), '/users/language/de'); ?></li>
            </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar" style="position:relative; padding:0px;">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span><?php echo __('Users'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>' . __('List'), '/admin/users', array('class' => 'treeview', 'escape' => false)); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-truck"></i>
                                <span><?php echo __('Companies'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>' . __('List'), '/admin/companies', array('class' => 'treeview', 'escape' => false)); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-ticket"></i>
                                <span><?php echo __('Coupons'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>' . __('List'), '/admin/coupons', array('class' => 'treeview', 'escape' => false)); ?>
                                </li>
                                <li><?php echo $this->Html->link('<i class="fa fa-angle-double-right"></i>' . __('Add'), '/admin/coupon_create', array('class' => 'treeview', 'escape' => false)); ?>
                                </li>
                            </ul>
                            
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            <br/><br/><br/>
                
            <?php echo $this->fetch('content'); ?>
                 
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

        <!-- Bootstrap -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/bootstrap.min.js" type="text/javascript"></script>

         <!-- DATA TABLES SCRIPT -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- Morris.js charts -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/raphael-min.js"></script>
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        


        <!-- AdminLTE App -->
        <script src="<?php echo $this->webroot; ?>admin_template/js/AdminLTE/app.js" type="text/javascript"></script>

    </body>


    <script type="text/javascript">
          $(function() {
              $("#example1").dataTable();
              $('#example2').dataTable({
                  "bPaginate": true,
                  "bLengthChange": false,
                  "bFilter": false,
                  "bSort": true,
                  "bInfo": true,
                  "bAutoWidth": false
              });
          });
      </script>
</html>