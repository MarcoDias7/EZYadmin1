<?php $titles = $this->EZYCount->title_array(); ?>
					<?php 


?>

<div class="container" id="myCompMain">

	<h1 id="myCompanies"><?php echo __('My companies'); ?></h1>

	<p><?php echo __('Choose the company you want to work with. Use the menu above to start booking.'); ?></p>

	<div id="dashboard-wrapper">
		<?php foreach ($companies as $item): ?>
			<div class="company-item <?php if (!empty($MenuCurrentCompany) && ($MenuCurrentCompany['Company']['id'] == $item['Company']['id'])): ?>active<?php endif; ?>" id="Permission_<?php echo $item['Permission']['id']; ?>">

				<div class="company-move"><span class="glyphicon glyphicon-move"></span></div>
				<div class="company-logo">
				<?php if (!empty($item['Company']['logo'])): ?>
		                <?php echo $this->Html->image('../files/company/logo/'.$item['Company']['id'].'/'.$item['Company']['logo']); ?>
		        <?php endif; ?>
				</div>

				<div class="company-info">
					<b><?php echo htmlspecialchars($item['Company']['name']); ?></b><br />
					<span class="small">
			  			<?php if ($item['Company']['test']): ?>
			  				<?php echo __('Test'); ?>
			  			<?php elseif ($item['Permission']['admin']): ?>
			  				<?php echo __('Administrator'); ?>
			  			<?php elseif ($item['Permission']['write']): ?>
			  				<?php echo __('Editor'); ?>
			  			<?php else: ?>
			  				<?php echo __('Viewer'); ?>
			  			<?php endif; ?>
					</span>
				</div>

				<?php

					if ($item['Company']['current_step'] == 5) {
					$options = array(
						'' => __('Fast actions'),
					);

			

					



				?>
				<div class="col col-md-10 col-md-offset-1">

					<?php echo $this->Form->input('fast_action', array('label' => false, 'class' => 'form-control fast_action', 'type' => 'select', 'options' => $options, 'data-attr' => $item['Company']['id'])); ?>
				</div>
				<br />
				<br />

				 <br />
				<?php $days_left = ceil((strtotime($item['Company']['expiration_date']) - time()) / (24*3600));

	  			if ($days_left > 0) {

	  				if ($days_left <= 30) {
	  					?>
	  					<span class="error-message">
	  					<?php
	  				}

	  				if ($days_left >= 365) {
	  					echo __('%d year(s) %d day(s) left', floor($days_left / 365), $days_left % 365);
	  				}
	  				else {
						echo __('%d day(s) left', $days_left);
					}

	  				if ($days_left <= 30) {
	  					?>
	  					</span>
	  					<?php
	  				}
				}
				else {
					?>
					<span class="error-message">
					<?php echo __('Expired'); ?>
					</span>

					<?php
				}

				if ($days_left <= 30 && $item['Permission']['admin']) {
					?>
					<br />
					<?php

						foreach ($subscriptions as $sub){
							//Test if an order already payed
					        if (isset($sub['Order']['company_id']) && $sub['Order']['company_id'] == $item['Company']['id'] && $sub['Order']['status'] == "ok"){
					            $done_subscription = true;
					            break;
					        }
					        else{
					        	$done_subscription = false;
							}
						}

				




					
				}

				}
				else {
				?>

				<br />
				<?php
					echo $this->Html->link(__('Continue creation'), '/users/switch_company/'.$item['Company']['id'], array('class' => 'btn btn-primary', 'escape' => false));
				?>
				 <br />
				 <?php
				}
				?>

			</div>
		<?php endforeach; ?>
 		<div class="company-item" id="new-comp">
			<div class="company-info">
				<?php echo $this->Html->link(__('Create a new company'), '/companies/create', array('class' => 'btn btn btn-primary', 'escape' => false)); ?>
				<br />
				<br />
				<?php echo __('or'); ?>
				<br />
				<br />
		        <?php echo $this->Html->link(__('Try with an Example'), '/companies/import_example', array('class' => 'btn btn btn-default', 'id' => 'tryexample', 'escape' => false)); ?>
	        </div>
		</div> 
	</div>

	    <!--     <div style="text-align: center;">
				<table class="table table-bg-white centered table-bordered-alt valign-table">
				  <thead>
					  <tr>
					 	 <th colspan="2">
					 	 	Company name
					 	 </th>
					 	 <th>
					 	 	Status
					 	 </th>
					 	 <th>
					 	 	Last login
					 	 </th>
					 	 <th colspan="2">
					 	 	Subscription
					 	 </th>
					 	 <th>
					 	 	Access right
					 	 </th>
					  </tr>
				  </thead>

				  <tbody>
				  <?php foreach ($companies as $item): ?>
				  	<tr class="<?php if (isset($MenuCurrentCompany) && ($MenuCurrentCompany['Company']['id'] == $item['Company']['id'])) { echo 'success'; } else if ($item['Permission']['admin']) { echo 'color-admin'; } else if ($item['Permission']['write']) { echo 'color-editor'; } else { echo 'color-viewer'; } ?>">
				  			<?php
				  			if (!isset($MenuCurrentCompany) || ($MenuCurrentCompany['Company']['id'] != $item['Company']['id'])) {

				  				?>
				  				<td>
				  				<?php
								 echo $this->Html->link('Enter', '/users/switch_company/'.$item['Company']['id'], array('class' => 'btn btn-sm btn-primary', 'escape' => false));

								 ?>
								 </td>
								 <?php
							}
							?>
				  		<td <?php if (isset($MenuCurrentCompany) && ($MenuCurrentCompany['Company']['id'] == $item['Company']['id'])): ?>colspan="2"<?php endif; ?>><?php echo htmlspecialchars($item['Company']['name']); ?></td>
				  		<td>
				  			<?php if ($item['Company']['test']): ?>
				  				-
				  			<?php elseif ($item['Permission']['admin']): ?>
				  				Administrator
				  			<?php elseif ($item['Permission']['write']): ?>
				  				Editor
				  			<?php else: ?>
				  				Viewer
				  			<?php endif; ?>
				  		</td>
				  		<td><?php if (!empty($item['LastLoggedIn'])) {

				  				if ($item['LastLoggedIn']['User']['id'] != $user['id']) {
				  					echo htmlspecialchars($item['LastLoggedIn']['User']['first_name'].' '.$item['LastLoggedIn']['User']['last_name'].' - ');
				  				}
			  					echo htmlspecialchars($this->EZYCount->dateTimeFromMysql($item['LastLoggedIn']['Log']['created']));

				  			} ?></td>

				  			<td <?php if (!$item['Permission']['admin']): ?>colspan="2"<?php endif; ?> style="text-align: left; padding-left: 30px;">
				  			<?php $days_left = ceil((strtotime($item['Company']['expiration_date']) - time()) / (24*3600));

				  			if ($days_left > 0) {

				  				if ($days_left <= 30) {
				  					?>
				  					<span class="error-message">
				  					<?php
				  				}

				  				if ($days_left >= 365) {
				  					printf(__('Until %s - %d year(s) %d day(s) left'), $this->EZYCount->dateFromMysql($item['Company']['expiration_date']), floor($days_left / 365), $days_left % 365);
				  				}
				  				else {
									printf(__('Until %s - %d day(s) left'), $this->EZYCount->dateFromMysql($item['Company']['expiration_date']), $days_left);
								}

				  				if ($days_left <= 30) {
				  					?>
				  					</span>
				  					<?php
				  				}
							}
							else {
								?>
								<span class="error-message">
								<?php echo _('Expired'); ?>
								</span>
								<?php
							}
							?>
						</td>
					  	<?php if ($item['Company']['test']): ?>
				  			<td colspan="2">
				  				<?php echo _('Free'); ?>
				  			</td>
						<?php elseif ($item['Permission']['admin']): ?>
						<td>
			  				<?php echo $this->Html->link('Renew', '/companies/renew/'.$item['Company']['id'], array('class' => 'btn btn-sm btn-primary', 'escape' => false)); ?>
			  				<?php echo $this->Html->link('Delete', '/companies/delete/'.$item['Company']['id'], array('class' => 'btn btn-sm btn-danger', 'escape' => false), __('Are you sure you want to delete this company ?')); ?>
			  			</td>

			  			<td>
			  				<?php echo $this->Html->link('Remove my access', '/companies/delete_access_right/'.$item['Company']['id'], array('class' => 'btn btn-sm btn-warning', 'escape' => false), __('Are you sure you want to delete your access right ?')); ?>
			  			</td>
			  			<?php endif; ?>
				  	</tr>
				  <?php endforeach; ?>
				  </tbody>
				</table>


	        <br />
	        <?php echo $this->Html->link('Create a new company', '/companies/step1', array('class' => 'btn btn-lg btn-primary', 'escape' => false)); ?>

	        <?php echo $this->Html->link('Try with an Example', '/companies/import_example', array('class' => 'btn btn-lg btn-warning', 'escape' => false)); ?>
	        <br /><br />
	        </div>
	    </div> -->
	</div>


<script type="text/javascript">
	$(document).ready(function () {

	var didTour = <?php echo (isset($doTour) ? 0 : 1); ?>;

	if(didTour==0){
		startIntro();
	}


	$('#startIntro').click(function (e) {
		startIntro();
	});

	function startIntro(){
        var intro = introJs();
          intro.setOptions({
          	showStepNumbers: false,
            steps: [
              { 
              	element: "Welcome",
                intro: "<?php echo __('Welcome on \'My companies\' page.<br/><br/>This tour takes 2min and shows you how to use EZYcount.'); ?>"
              },
              {
                element: document.querySelector('#myCompMain'),
                intro: "<?php echo __('Select which company you want to work with.'); ?>",
                position: 'top'
              },
              {
                element: document.querySelector('#new-comp'),
                intro: "<?php echo __('Add a new company or add a test company to try on.<br/><br/>You will always have 30 days free for a new company.'); ?>",
                position: 'left',
                
              },
              {
                element: document.querySelector('#second-navbar'),
                intro: "<?php echo __('Book, print a report or manage the settings of the company you selected.<br/><br/>On the left you see which company you selected.'); ?>",
                position: 'bottom'
              },
              {
                element: document.querySelector('#reminders'),
                intro: "<?php echo __('This is the link to the reminders.'); ?>",
                position: 'left',
                overlayOpacity:100
              },
              {
                element: document.querySelector('#navTop'),
                intro: "<?php echo __('This is your User menu.'); ?>",
                position: 'bottom'
              },
              {
                element: document.querySelector('#accountMenu'),
                intro: "<?php echo __('Change your password, manage your information or log out.'); ?>",
                position: 'left'
              },
              {
                element: document.querySelector('#supportMenu'),
                intro: "<?php echo __('Go to the support website to find answers to your questions. Don\'t forget, you can always send us an email at support@ezycount.ch and we answer you within 2 days.'); ?>",
                position: 'left'
              },
              {
                element: 'Welcome',
                intro: "<?php echo __('Thank you for following this first short tour. We hope you will enjoy working on EZYcount.'); ?>"
              }
            ]
          });

          intro.start();
     }


		$('.fast_action').click(function (e) {

			item = $(this).val();

			if (item == 'renew') {
				window.location = '<?php echo Router::url('/companies/renew/'); ?>' + $(this).attr('data-attr');
			}
			else if (item == 'access') {
				if (confirm('<?php echo addslashes(__('Are you sure you want to delete your access right ?')); ?>')) {
					window.location = '<?php echo Router::url('/companies/delete_access_right/'); ?>' + $(this).attr('data-attr');
				}
			}
			else if (item == 'delete') {
				if (confirm('<?php echo addslashes(__('Are you sure you want to delete this company ?')); ?>')) {
					window.location = '<?php echo Router::url('/companies/delete/'); ?>' + $(this).attr('data-attr');
				}
			}
		});

		$('#tryexample').click(function (e) {
			$(this).attr('disabled', 'disabled');
		})


	    $('#dashboard-wrapper').sortable({
	        placeholder: "highlight",
        	update: function() {
        		var info = $('#dashboard-wrapper').sortable("serialize");
        		$.ajax({
	            	type: "POST",
	            	url: "<?php echo Router::url('/users/changeorder/'); ?>",
	            	data: info,
	            	context: document.body,
	            	success: function() { }
	    		});
        	}
        });
	});
</script>