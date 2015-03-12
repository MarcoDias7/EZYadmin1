<?php $user = AuthComponent::user(); ?>

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

		<?php if($this->Session->read('language')=='fr'){
			echo "<meta name='language' content='fr'>";
		}
		else if($this->Session->read('language')=='de'){
			echo "<meta name='language' content='de'>";
		}
		else{
			echo "<meta name='language' content='en'>";
		}

		?>
		
		<meta name="description" content="EZYcount est un programme de comptabilité Suisse accessible par internet pour les petites entreprises.">
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
			echo $this->Html->css('jquery-ui.min');
			echo $this->Html->css('bootstrap.min');
			//echo $this->Html->css('bootstrapnew.min');
			echo $this->Html->css('jquery.dataTables');
			echo $this->Html->css('bootstrap-theme');
			echo $this->Html->css('datepicker');
			echo $this->Html->css('../select2/select2');
			echo $this->Html->css('../select2/select2-bootstrap');
			echo $this->Html->css('calendar.min');
			echo $this->Html->css('lightbox');
			echo $this->Html->css('supervx');
			echo $this->Html->css('introjs');

			echo $this->Html->script('jquery');

		?>
	    <!--[if lt IE 9]>
	    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	    <?php echo $this->Html->css('ie_style'); ?>
	    <script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
	    <![endif]-->
	</head>
	

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55188311-1', 'auto');
  ga('send', 'pageview');

</script>

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


	.menubar_logo {
		height: 90px;
		margin-top: -15px;
	}

	.menubar_links {
		margin-top: 40px;
		font-family: 'rams_l', Arial, sans-serif;
  		font-size: 16px;
	}

	.menubar_links li > a.active {
		color: #ee9911;
	}

	.menubar_links li > a {
	  	padding-left:7px;
	  	padding-right:7px;
	}

	.menubar_links li:last-child > a{
		font-size: 18px;
		font-weight: bold;
	}

	.menubar_orange_link {
		margin-top: 30px;
  		font-size: 16px;
	}

	.button_link a {
		color: #ffffff;
		font-family: 'archer_bi', Arial, sans-serif;  font-size: 15pt;
	}

	.menubar_lang li > a {
		margin-top: 40px;
		font-family: 'rams_l', Arial, sans-serif;
  		font-size: 16px;
  		padding-left: 5px;
  		padding-right: 5px;
	}

</style>
 <div id="wrap">
<noscript><div class="buorg"><div style="text-align:center;"><?php echo __('Please enable Javascript for better browser functionality'); ?></div></div></noscript>

<?php if (empty($user)): ?>
<body style="padding-top: 94px;">

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  style="margin-bottom:0px; border: 0px solid; background-color:#ffffff; border-bottom:3px solid #eba028;">
	  <div class="container-fluid col-lg-8 col-lg-offset-2 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0" style="min-height:94px;">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <?php $logo = 'ezy_logo.png'; ?>
			<a class="navbar-brand" rel="home" href="#" title="EZYcount">
		       <?php echo $this->Html->link($this->Html->image($logo, array('alt' => 'ezycount logo', 'class' => 'menubar_logo', 'title' => __('Homepage'))), '/', array('escape' => false, 'class' => 'navbar-brand')); ?>
		    </a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="min-height:94px;">
	      	<ul class="menubar_links nav navbar-nav">
	        	<li><?php echo $this->Html->link(__('Home'), '/', array('class' => ($this->name == 'Pages' && isset($page) && $page == 'home') ? 'active' : '')); ?></li>
	        	<li> <?php echo $this->Html->link(__('Product'), '/pages/solution', array('class' => ($this->name == 'Pages' && isset($page) &&  $page == 'solution') ? 'active' : '')); ?></li>
	        	<li><?php echo $this->Html->link(__('Trustees'), '/contacts/trustees', array('class' => ($this->name == 'Pages' && isset($page) && $page == 'trustees') ? 'active' : '')); ?></li>
	        	<li><?php echo $this->Html->link(__('Login'), '/users/login', array('class' => ($this->name == 'Users' && $this->action == 'login') ? 'active' : '')); ?></li>
	      	</ul>
			<ul class="menubar_orange_link nav navbar-nav hidden-sm hidden-xs" style="margin-left:10%">
				<li>
					<div class="button_link">
				      	<?php 
				      		//homepage
				      		if (Router::url('/') == $this->here){
				      			echo $this->Html->link(__('Try for free'), '#try');
				      		}
				      		else{ //not homepage
				      			echo $this->Html->link(__('Try for free'), '/#try');
				      		}
				      	?>
					</div>
				</li>
			</ul>
			<ul class="menubar_orange_link nav navbar-nav hidden-lg hidden-md hidden-xs" style="margin-left:5%">
				<li>
					<div class="button_link">
				      	<?php 
				      		//homepage
				      		if (Router::url('/') == $this->here){
				      			echo $this->Html->link(__('Try for free'), '#try');
				      		}
				      		else{ //not homepage
			      				echo $this->Html->link(__('Try for free'), '/#try');
				      		}
				      	?>
					</div>
				</li>
			</ul>
			<ul class="menubar_orange_link nav navbar-nav hidden-lg hidden-md hidden-sm">
				<li>
					<div class="button_link">
				      	<?php 
					  		//homepage
					  		if (Router::url('/') == $this->here){
					  			echo $this->Html->link(__('Try for free'), '#try');
					  		}
					  		else{ //not homepage
				  				echo $this->Html->link(__('Try for free'), '/#try');
					  		}
					  	?>
					</div>
				</li>
			</ul>
			<ul class="menubar_lang nav navbar-nav navbar-right">
				<li><?php echo $this->Html->link(__('EN'), '/users/language/en'); ?></li>
				<li><?php echo $this->Html->link(__('FR'), '/users/language/fr'); ?></li>
				<li><?php echo $this->Html->link(__('DE'), '/users/language/de'); ?></li>
			</ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>




<?php else: ?>
<body>

<nav class="navbar navbar-default" role="navigation" id="main-navbar" style="margin-bottom:0px; border: 0px solid; background-color:#ffffff; border-bottom:3px solid #eba028;">
  <div class="container-fluid col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0" id="navTop" style="min-height:94px;"> <!--style="min-height:94px;"-->
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php $logo = 'ezy_logo.png'; ?>
		<a class="navbar-brand" style="margin-left:-60px;" rel="home" href="#" title="EZYcount">
	       <?php echo $this->Html->link($this->Html->image($logo, array('alt' => 'ezycount logo', 'class' => 'menubar_logo', 'title' => __('Homepage'))), '/', array('escape' => false, 'class' => 'navbar-brand')); ?>
	    </a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1"  style="border: 0px solid;">
		<!-- Left menu -->
		<ul class="nav navbar-nav navbar-left">
			<li <?php if ($this->name == 'Users' && $this->action == 'index') echo 'class="active"'; ?>><?php echo $this->Html->link(__('My companies'), '/users/index'); ?></li>
			  	<?php if ($this->name == 'Pages'): ?>
			    <li class="<?php if ($this->name == 'Pages' && isset($page) &&  $page == 'solution'): ?>active<?php endif; ?>"><?php echo $this->Html->link(__('Product'), '/pages/solution'); ?></li>
		   <?php endif; ?>
		</ul>

		<!-- Right menu -->
		<ul class="nav navbar-nav navbar-right" style="margin-right:0px;" >
			<li class="dropdown" id="accountMenu" style"position: absolute; z-index: 100000;">
				<?php

				//echo $MenuCurrentCompany['User']['id'];
					if ($is_admin){
						echo $this->Html->link(htmlspecialchars($user['first_name'].' '.substr($user['last_name'],0,1).'.') . " (".__('Admin').")".' <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'escape' => false));
					}
					elseif ($can_write){
						echo $this->Html->link(htmlspecialchars($user['first_name'].' '.$user['last_name']) . " (".__('Writer').")".' <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'escape' => false));
					}
					else {
						 echo $this->Html->link(htmlspecialchars($user['first_name'].' '.$user['last_name']) . " (".__('Viewer').")".' <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'escape' => false));
					}
				?>
				<ul class="dropdown-menu"  style"position: absolute; z-index: 100000;">
					<li><?php echo $this->Html->link(__('Change my password'), '/users/change_password'); ?></li>
					<li><?php echo $this->Html->link(__('Log out'), '/users/logout'); ?></li>
				</ul>
			</li>

			<li class="dropdown" id="supportMenu" style"z-index: 100000;">
				<?php 
					echo $this->Html->link(__('Support').' <span class="glyphicon glyphicon-question-sign"></span> <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'escape' => false));
				?>
				<ul class="dropdown-menu"  style"position: absolute; z-index: 100000;">
					<li>
						<?php
								if($this->Session->read('language')=='fr'){
									echo $this->Html->link(__('Support website'), 'http://support.ezycount.ch/ezycount-support-bienvenu/', array('fullbase' => true, 'target' => '_blank', 'class' => 'help-sign', 'escape' => false));
								}
								elseif ($this->Session->read('language')=='de'){
									echo $this->Html->link(__('Support website'), 'http://support.ezycount.ch/ezycount-willkommen/', array('fullbase' => true, 'target' => '_blank', 'class' => 'help-sign', 'escape' => false));
								}
								else{
									echo $this->Html->link(__('Support website'), 'http://support.ezycount.ch/ezycount-support-welcome/', array('fullbase' => true, 'target' => '_blank', 'class' => 'help-sign', 'escape' => false));
								}
						?>
					</li>
					
				</ul>
			</li>
			<li class="lang_link"><?php echo $this->Html->link(__('EN'), '/users/language/en'); ?></li>
			<li class="lang_link"><?php echo $this->Html->link(__('FR'), '/users/language/fr'); ?></li>
			<li class="lang_link"><?php echo $this->Html->link(__('DE'), '/users/language/de'); ?></li>
		</ul>
		
	</div>
  </div><!-- /.container-fluid -->
</nav>




			<?php if (isset($MenuCurrentCompany) && !empty($MenuCurrentCompany) && $MenuCurrentCompany['Company']['current_step'] == 5): ?>
				<div class="navbar navbar-default" id="second-navbar">
					<div class="container" id="brownNav">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							
							<div class="navbar-brand">
							<?php echo $this->Html->link($MenuCurrentCompany['Company']['name'], '/users/index'); ?>
							</div>
						</div>

						<div class="navbar-collapse collapse"  id="navbar-collapse-2">
							<ul class="nav navbar-nav">
<!-- 
								<li class="menu-dashboard <?php if ($this->name == 'Companies' && $this->action == 'dashboard') echo 'active'; ?>"><?php echo $this->Html->link('Dashboard'.((isset($notifReminder) && $notifReminder > 0) ? ' <span class="badge">'.$notifReminder.'</span>' : ''), '/companies/dashboard', array('escape' => false)); ?></li>
-->
								
							</ul>

						</div>

					</div>
				</div>
			
			<?php else: ?>
			
			<?php endif; ?>

	


<?php endif; ?>

		<?php if (!isset($no_flash)): ?>
			<div class="container">
				<?php echo $this->Session->flash(); ?>
			</div>
		<?php endif; ?>

		<?php echo $this->fetch('content'); ?>
	<div id="push"></div>
</div>
			<div class="container-full hidden-print">
				<div class="footer col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="footer_block col-lg-2 col-lg-offset-3">
					    <ul>
					        <li>
					            <b><?php echo __('Learn about EzyCount'); ?></b>
					        </li>
					        <li>
					        	<?php echo $this->Html->link(__('Home'), '/'); ?>
					        </li>
					        <li>
					            <?php echo $this->Html->link(__('Solution'), '/pages/solution'); ?>
					        </li>
					        <li>
					        	<?php echo $this->Html->link(__('Trustees'), '/contacts/trustees'); ?>
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
					<div class="footer_block col-lg-2">
					    <ul>
					        <li>
					            <b><?php echo __('Contact and Info'); ?></b>
					        </li>
					        <li>
					        	<?php echo $this->Html->link(__('Contact & About us'), '/contacts/index'); ?>
					        </li>
					    </ul>
					    <br><br>
					    <div class="social">
					        <a href="https://twitter.com/EZYcountsuisse"  target="_blank"><?php echo $this->Html->image('bird_icon.png', array("alt" => "EZYcount Twitter")); ?></a>
					        <a href="https://www.facebook.com/ezycount" target="_blank"><?php echo $this->Html->image('fb_icon.png', array("alt" => "EZYcount Facebook")); ?></a>
					        <?php echo $this->Html->link($this->Html->image('letter_icon.png', array("alt" => "EZYcount Contact")), '/contacts/index', array('escape' => false)); ?>
					        <a href="https://www.linkedin.com/company/ezycount" target="_blank"><?php echo $this->Html->image('linkedin.png', array("alt" => "EZYcount Linkedin")); ?></a>
					         <a href="https://www.youtube.com/user/EZYcountCH" target="_blank"><?php echo $this->Html->image('youtube.png', array("alt" => "EZYcount youtube")); ?></a>
					        <a href="https://plus.google.com/114044533746911577306" rel="publisher"></a>
					    </div>
					</div>
					<div class="footer_block col-lg-2">

						<div>
							<ul><li><b><?php echo __('Payments possible by'); ?></b></li></ul>
							<?php echo $this->Html->image('eurocard_choice.jpg', array("alt" => "Eurocard")); ?>&nbsp;
							<?php echo $this->Html->image('VISA_choice.jpg', array("alt" => "VISA")); ?>&nbsp;
							<?php echo $this->Html->image('Debit_Direct_1_choice.jpg', array("alt" => "Direct Debit")); ?>&nbsp;
							<?php echo $this->Html->image('yellownet_1_choice.jpg', array("alt" => "Post Finance")); ?>
						</div>
					    <div class="copyright">
					        <?php echo __('Copyright 2014 SuperVX AG All rights reserved \'EZYcount\' is a Trademark of SuperVX AG'); ?>
					    </div>
					</div>      
				</div>
		
		</div>



		        <div class="clearfix"></div>
		<div class="hidden-print">
			<?php echo $this->element('sql_dump'); ?>
		</div>
	
		


		<?php

			echo $this->Html->script('jquery.min');
			echo $this->Html->script('jquery-ui.min');
			echo $this->Html->script('bootstrap.min');
			echo $this->Html->script('jquery.dataTables');
			echo $this->Html->script('../select2/select2.min');
			echo $this->Html->script('bootstrap-datepicker');
			echo $this->Html->script('jquery.easing-1.3.min');
			echo $this->Html->script('jquery.scrollTo-1.4.3.1-min');
			echo $this->Html->script('lightbox.min');
			echo $this->Html->script('intro');
			echo $this->Html->script('spin.min');
echo $this->Html->script('language/fr-FR.js');
echo $this->Html->script('language/de-DE.js');

			echo $this->Html->script('calendar.js');
			echo $this->Html->script('underscore-min');

			echo $this->Html->script('/tinymce/js/tinymce/tinymce.min.js');
		?>


	<script>


		tinymce.init({
			selector:'textarea.tinymce',
			plugins: 'validatable'
		});

		/*
		 * Adding startWith for String type in javascript
		 *
		 */
		String.prototype.startsWith = function(prefix) {
			return this.indexOf(prefix) === 0;
		}

		// NB of pages in the invoice preview
		var nbPages = 1;

		// the invoice height
		var heightInvoice = 1035;

		/*
		 * Initliaze tinyMce
		 *
		 */
		function setupTiny(){

			/* For invoices */
			tinymce.init({
				selector: "div.editable",
				inline: true,
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table paste pagebreak noneditable"
				],
				noneditable_leave_contenteditable: true,
				pagebreak_separator: "<!-- pagebreak -->",
				toolbar: "bold italic | styleselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | table visualblocks pagebreak",
				menubar: false,
				fixed_toolbar_container: ".mytoolbar",
				//event_root: "#invoicePreview",
				setup : function(ed) {

					ed.on('focus', function(e) {
						//$(".mybuttons").show(); //TODO pose problème
					});

					ed.on('blur', function(e) {
						//$(".mybuttons").hide(); //TODO pose problème
					});

					// Event CHANGE
					ed.on('change', function(e) {

						var activElement = tinymce.activeEditor.getParam('id');
						var contentHTML = tinymce.activeEditor.getContent({format : 'html'});

						// Update HEADERS
						if(activElement.startsWith("header")){

							// Update headers
							for(var i = 1; i <= nbPages ; i++){

								// Replace the content, but not the current
								if(activElement != "headerPreview" + i)
									$('#headerPreview' + i).html(contentHTML);

							}

						}

						// Update FOOTERS
						if(activElement.startsWith("footer")){

							// Update all footers
							for(var i = 1; i <= nbPages ; i++){

								// Replace the content, but not the current
								if(activElement != "footerPreview" + i)
									$('#footerPreview' + i).html(contentHTML);

							}

						}

					});

					// Event KEYUP
					ed.on('keyup', function(e) {


						// get the activPageID by getting the num in the id param
						var activPageID = tinymce.activeEditor.getParam('id');
						activPageID = activPageID.replace(/\D/g,'');

						// get the activElementType
						var activElementType = tinymce.activeEditor.getParam('id');
						activElementType = activElementType.replace(/[0-9]/g, "")

						// get all height blocks (footer-body-product-footer)
						// WARNING : height of block in the CURRENT page
						var headerHeight = $(tinymce.get("headerPreview" + activPageID).getBody()).height();
						var footerHeight = $(tinymce.get("footerPreview" + activPageID).getBody()).height();

						var bodyHeight = 0;
						if(tinymce.get("bodyPreview" + activPageID) != null)
							bodyHeight = $(tinymce.get("bodyPreview" + activPageID).getBody()).height();

						var productsHeight = 0;
						if(tinymce.get("productsPreview" + activPageID) != null)
							productsHeight = $(tinymce.get("productsPreview" + activPageID).getBody()).height();

						console.log("element : " + activElementType);
						console.log("activePage : " + activPageID);

						// handle key press
						enterKeyHandle(e, activPageID, activElementType, headerHeight, bodyHeight, productsHeight, footerHeight);
						backspaceKeyHandle(e, activPageID, activElementType, headerHeight, bodyHeight, productsHeight, footerHeight);

						// handle update of the products sum when typing
						updateSumProducts();



					});
				}
			});


		}

		// setting up at start
		setupTiny();




		function updateSumProducts(){

			var sumWithoutTVA = 0.0;

			// for each product line
			$('#productsTable > tr > .amountProductPreview').each(function() {

				//update total
				sumWithoutTVA += parseFloat($(this).text());


			});

			// update sum without TVA
			$("#sumWithoutTVAPreview").text(sumWithoutTVA);


		}

		/*
		 * Handle enter key
		 *
		 */
		function enterKeyHandle(e, activPageID, activElementType, headerHeight, bodyHeight, productsHeight, footerHeight ){

			// when the key "ENTER" is pressed
			if(e.keyCode == 13){

				// if header of footer, we limit the height of them
				if(activElementType == "headerPreview"){

					if(headerHeight > 50){

						tinymce.activeEditor.undoManager.undo();
						return ;
					}

				}
				// if header of footer, we limit the height of them
				if(activElementType == "footerPreview"){

					if(footerHeight > 50){

						tinymce.activeEditor.undoManager.undo();
						return ;
					}

				}


				// check if more page is needed
				var morePageNeeded = isMorePagesNeeded(headerHeight, bodyHeight, productsHeight, footerHeight);

				// if more page needed
				if(morePageNeeded == 1){

					// adding pages
					addPages(activPageID, activElementType);

				}

			}
		}

		/*
		 * Handle backspace key
		 *
		 */
		function backspaceKeyHandle(e, activPageID, activElementType, headerHeight, bodyHeight, productsHeight, footerHeight ){

			// when the key "BACKSPACE" is pressed
			if(e.keyCode == 8){


				// check if less page is needed
				var lessPageNeeded = isLessPagesNeeded(activPageID, activElementType, headerHeight, bodyHeight, productsHeight, footerHeight);

				// if less page needed
				if(lessPageNeeded == 1){

					// remove pages
					removePages(activPageID, activElementType);

				}

			}
		}


		/*
		 * Check if more pages needed
		 *
		 */
		function isMorePagesNeeded(headerHeight, bodyHeight, productsHeight, footerHeight){

			// calculate how many page needed
			var blocksHeight = headerHeight + bodyHeight + productsHeight + footerHeight;
			var morePageNeeded = ( blocksHeight / heightInvoice );
			morePageNeeded = Math.floor(morePageNeeded);

			console.log("morePageNeeded ? : " + morePageNeeded);

			return morePageNeeded;

		}


		/*
		 * Add a new page
		 *
		 */
		function addPages(activPageID, activElementType){


			//check if this is body that call this
			if(activElementType == "bodyPreview"){

				// if there is more than 1 page
				if(nbPages != 1){
					tinymce.activeEditor.undoManager.undo();
					return;
				}

			}

			nbPages++;

			console.log("ADDING PAGE " + nbPages  );

			// new page
			$("#invoicePreview" + activPageID).after("<div id='invoicePreview" + nbPages + "' class='invoice effect-paper'></div>");

			// adding blocks
			$("#invoicePreview" + nbPages).append("<div id='headerPreview" + nbPages + "' class='headerInvoice editable'>" + $("#headerPreview1").html() + "</div>");
			$("#invoicePreview" + nbPages).append("<div id='productsPreview" + nbPages + "' class='productsInvoice editable'></div>");
			$("#invoicePreview" + nbPages).append("<div id='footerPreview" + nbPages + "' class='footerInvoice editable'>" + $("#footerPreview1").html() + "</div>");


			//if the activ element is body, we need to do something special
			// the body is only for the 1rst page, so we push the products block in the second page
			if(activElementType == "bodyPreview"){

				$("#productsPreview" + nbPages).html($("#productsPreview1").html());
				$("#productsPreview1").remove();

			}


			// reload tinyMce (for the new div.editable)
			setupTiny();

			// jump into the new body div.editable
			tinymce.editors["productsPreview" + nbPages].focus();

		}

		/*
		 * Check if less pages needed
		 *
		 */
		function isLessPagesNeeded(activPageID, activElementType, headerHeight, bodyHeight, productsHeight, footerHeight){

			// only if there is a next page
			if(activPageID != nbPages){


				// calculate how many page needed
				var currentBlocksHeight = headerHeight + bodyHeight + productsHeight + footerHeight;
				var nextProductPreviewHeight = $(tinymce.get("productsPreview" + (parseInt(activPageID) + 1)).getBody()).height();
				currentBlocksHeight = currentBlocksHeight + nextProductPreviewHeight;
				var lessPageNeeded = 0;
				if(currentBlocksHeight <= heightInvoice)
					lessPageNeeded = 1;

				console.log("lessPageNeeded ? : " + lessPageNeeded);

				return lessPageNeeded;

			}

		}


		/*
		 * Remove the last page
		 *
		 */
		function removePages(activPageID, activElementType){

			console.log("REMOVE PAGE " + nbPages    );

			nbPages--;

			// getting next product block
			var nextProductPreviewHTML = $(tinymce.get("productsPreview" + (parseInt(activPageID) + 1)).getBody());
			$(nextProductPreviewHTML).attr("id", "productsPreview" + nbPages);

			// adding in previous page
			$("#footerPreview" + nbPages).before(nextProductPreviewHTML);

			// remove the last page
			$("#invoicePreview" + (parseInt(nbPages) + 1)).remove();

			// reload tinyMce (for the new div.editable)
			setupTiny();

			//TODO le cas ou c'est pas body
			if(activElementType == "bodyPreview")
				tinymce.editors["bodyPreview" + nbPages].focus();
			else
				tinymce.editors["productsPreview" + nbPages].focus();



		}

		$(document).ready(function () {

			$('.mceNonEditable').tooltip(); //TODO

		});

	</script>


		<script type="text/javascript">
			var $buoop = {};
			$buoop.ol = window.onload; 
			window.onload=function(){ 
			 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
			 var e = document.createElement("script"); 
			 e.setAttribute("type", "text/javascript"); 
			 e.setAttribute("src", "//browser-update.org/update.js"); 
			 document.body.appendChild(e); 
			} 
			$(document).ready(function() {
				$('.datepicker').datepicker({
					format: 'dd.mm.yyyy'
				});
				$('.datepicker').on('changeDate', function (e) {
					$(this).datepicker('hide');
				});
				$('.datepicker-light').datepicker({
					format: 'dd.mm'
				});
				$('.datepicker-light').on('changeDate', function (e) {
					$(this).datepicker('hide');
				});

				$('#ChangeCompCompanyId').change(function (e) {
					$('#changeCompForm').submit();
				});

				$('[data-toggle=tooltip]').tooltip();

			});

	        var calendar = $("#calendar").calendar(
	                {
	                	language: "<?php echo __('en_EN'); ?>",
	                    tmpl_path: "<?php echo Router::url('/tmpls/'); ?>",
	                    events_source: "<?php echo Router::url('/companies/notif_ajax'); ?>",
	                    first_day: 1,
	                    views: { 
	                        week: { enable: 0},
	                        day: { enable: 0 }
	                    },
	                });   

	        $('.btn-group button[data-calendar-nav]').each(function() {
	            var $this = $(this);
	            $this.click(function() {
	                calendar.navigate($this.data('calendar-nav'));
	            });
	        });

	        $('#navigation-custom').click(function() {
	            if ($(this).attr('data-calendar-view') == 'month') {
	                calendar.view('year');
	            }
	            else {
	                calendar.view('month');
	            }
	        });

		</script>
	</body>
</html>
