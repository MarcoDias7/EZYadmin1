<!DOCTYPE html>
<html>
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
      EZYcount :
      <?php echo $title_for_layout; ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
      echo $this->Html->meta('icon');
      echo $this->fetch('meta');
      echo $this->fetch('css');
      echo $this->fetch('script');
      echo $this->Html->css('jquery-ui.min');
      echo $this->Html->css('bootstrap.min');
      //echo $this->Html->css('bootstrapnew.min');
      echo $this->Html->css('bootstrap-theme');
      echo $this->Html->css('login');
      echo $this->Html->script('bootstrap.min');

    ?>
      <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
      <?php echo $this->Html->css('ie_style'); ?>
      <script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
      <![endif]-->

      <style>
/* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -160px;
      }

      /* Set the fixed height of the footer here */
      #push {
        height: 200px;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }


      </style>
  </head>
  <body>
   <div id="wrap">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55188311-1', 'auto');
  ga('send', 'pageview');

</script>

  <div id="wrapper">
      <div class="container">
        <?php echo $this->Session->flash(); ?>
      </div>

      <?php echo $this->fetch('content'); ?>


</div>
<div id="push"></div>
</div>
<div class="container-full hidden-print">
        <div class="footer col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="footer_block col-lg-3 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-3 col-sm-offset-1 col-xs-6 ">
              <ul>
                  <li>
                      <b><?php echo __('Learn about EzyCount'); ?></b>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__('Why EZYcount ?'), '/'); ?>
                  </li>
                  <li>
                      <?php echo $this->Html->link(__('Features'), '/pages/solution'); ?>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__('Terms of services'), '/pages/termsofservices'); ?>
                  </li>
                  <li>
                    <?php if($this->Session->read('language')=='fr'){
                      echo $this->Html->link(__('Support'), 'http://support.ezycount.ch/ezycount-support-bienvenu/', array('fullbase' => true, 'target' => '_blank'));
                    }
                    elseif ($this->Session->read('language')=='de'){
                      echo $this->Html->link(__('Support'), 'http://support.ezycount.ch/ezycount-willkommen/', array('fullbase' => true, 'target' => '_blank'));
                    }
                    else{
                      echo $this->Html->link(__('Support'), 'http://support.ezycount.ch/ezycount-support-welcome/', array('fullbase' => true, 'target' => '_blank'));
                    }
                ?>
                  </li>
              </ul>
          </div>
          <div class="footer_block col-lg-2 col-lg-offset-0 col-md-2 col-sm-2 col-xs-6">
              <ul>
                  <li>
                      <b><?php echo __('Contact and Info'); ?></b>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__('Contact & About us'), '/contacts/index'); ?>
                  </li>
                  <li>
                    <?php echo $this->Html->link(__('Trustees'), '/contacts/trustees'); ?>
                  </li>
              </ul>
              <div class="social">
                  <a href="https://twitter.com/EZYcountsuisse"  target="_blank"><?php echo $this->Html->image('bird_icon.png', array("alt" => "EZYcount Twitter")); ?></a>
                  <a href="https://www.facebook.com/ezycount" target="_blank"><?php echo $this->Html->image('fb_icon.png', array("alt" => "EZYcount Facebook")); ?></a>
                  <?php echo $this->Html->link($this->Html->image('letter_icon.png', array("alt" => "EZYcount Contact")), '/contacts/index', array('escape' => false)); ?>
                  <a href="https://www.linkedin.com/company/ezycount" target="_blank"><?php echo $this->Html->image('linkedin.png', array("alt" => "EZYcount Linkedin")); ?></a>
                   <a href="https://www.youtube.com/user/EZYcountCH" target="_blank"><?php echo $this->Html->image('youtube.png', array("alt" => "EZYcount youtube")); ?></a>
                  <a href="https://plus.google.com/114044533746911577306" rel="publisher"></a>
              </div>
          </div>
          <div class="footer_block col-lg-3 col-md-4 col-sm-3 col-xs-10">
              <div class="copyright">
                  <?php echo __('Copyright 2014 SuperVX AG All rights reserved \'EZYcount\' is a Trademark of SuperVX AG'); ?>
              </div>
          </div>      
        </div>
    
    </div>
  </body>
</html>
