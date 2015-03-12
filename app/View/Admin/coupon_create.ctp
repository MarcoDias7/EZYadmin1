<section class="content">
  	<div class="row">
	    <div class="col-xs-6">
			<div class="box box-success">
				<div class="box-header">
				    <h3 class="box-title">Create coupon</h3>
				   	<?php echo $this->Form->create('Coupon'); ?>
				</div><!-- /.box-header -->

				<div class="box-body">
				    <div class="row">
				     	<div class="col-xs-12">
				     		<div class="form-group">
                                <label for="CouponCode"><?php echo __('Code') . ' (' . __('Generate coupon code') ; ?></label> <?php echo $this->Form->checkbox('random', array('required'=>false)); echo ')';?>
				        	<?php echo $this->Form->hidden('rdm', array('value'=>'false', 'required'=>false)); ?>
                                <?php echo $this->Form->input('code', array('class' =>'form-control', 'label' => false, 'required'=>false)); ?>
                            </div>
				      	</div>
				    </div>
				    <br/>
				    <div class="row">
				     	<div class="col-xs-5">
							<div class="input-group">
	                            <div class="input-group-addon">
	                                <i class="fa fa-calendar"></i>
	                            </div>
	                            <?php echo $this->Form->input('valid_from', array('class' =>'form-control', 'type' => 'text', 'label' => false, 'required'=>false, 'placeholder'=>__('Valid from'))); ?>
	                        </div>
				    	</div>
				       	<div class="col-xs-5">
					      <div class="input-group">
		                            <div class="input-group-addon">
		                                <i class="fa fa-calendar"></i>
		                            </div>
		                            <?php echo $this->Form->input('valid_until', array('class' =>'form-control', 'type' => 'text', 'label' => false, 'required'=>false, 'placeholder'=>__('Valid until'))); ?>
		                        </div>
				        </div>
				        <div class="col-xs-2">
					      <div class="input-group">
								<?php echo $this->Form->checkbox('no_until', array('required'=>false)); ?> <label>&nbsp No until</label>
				        	</div>
						</div>
				    </div>
				    <br>
				    <div class="row">
				     	<div class="col-xs-6">
					     	<div class="form-group">
		                        <label for="CouponCreated"><?php echo __('Number of coupons');?></label>
		                        <?php echo $this->Form->input('created', array('class' =>'form-control', 'type' => 'text', 'label' => false, 'required'=>false)); ?>
		                    </div>
				    	</div>
				     	<div class="col-xs-6">
					     	<div class="form-group">
		                        <label for="CouponValidity"><?php echo __('Validity');?></label>
           				        <?php echo $this->Form->input('validity', array('class' =>'form-control', 'label' => false, 'required'=>false,  'options' => array('' => 'Validity') + $this->EZYCount->plan_array())); ?>
		                    </div>
				    	</div>
				    </div>
				    <br/>
				    <div class="row">

				    <div class="col-xs-6">
					     	<div class="form-group">
		                        <label for="CouponType"><?php echo __('Type');?></label>
    				        	<?php echo $this->Form->input('type', array('class' =>'form-control', 'label' => false, 'required'=>false,  'options' => array('' => 'Type') + $this->EZYCount->coupon_array())); ?>
		                    </div>
				    	</div>
				     	<div class="col-xs-6">
					     	<div class="form-group">
		                        <label for="CouponValue"><?php echo __('Value');?></label>
           				        <?php echo $this->Form->input('value', array('class' =>'form-control', 'type' => 'text', 'label' => false, 'required'=>false)); ?>
		                    </div>
				    	</div>
				    </div>
				    <br/>
				    <div class="row">
				     	<div class="col-xs-12">

				     						     	<div class="form-group">
		                        <label for="CouponDescription"><?php echo __('Description');?></label>
           				        
				       		<?php echo $this->Form->input('description', array('style' => 'resize: none;', 'class' =>'form-control', 'label' => false, 'required'=>false)); ?>
		                    </div>
				      	</div>
					</div>
				</div><!-- /.box-body -->


				<div class="box-footer">
						<?php
						echo $this->Form->submit('Sauvegarder le coupon', array('class' => 'btn btn-success'));
						echo $this->Form->end();
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

    $(document).ready(function(){

		$('#CouponRandom').on('ifChanged', function(event){
			
			if(this.checked){
				$('#CouponCode').attr('disabled',this.checked);
		   		$('#CouponCode').val('');
		   		$('#CouponRdm').val('true');
			}
			else{
				$('#CouponCode').attr('disabled',this.checked);
		   		$('#CouponRdm').val('false');
			}

		});

		$('#CouponNoUntil').on('ifChanged', function(event){

			if(this.checked){
				$('#CouponValidUntil').attr('disabled',this.checked);
		   		$('#CouponValidUntil').val('');
			}
			else{
				$('#CouponValidUntil').attr('disabled',this.checked);
			}
			
		});

		$('#random').on('ifClicked', function(event){
			alert("s");
			$('#CouponCode').attr('disabled',this.checked);
			

			if($("#CouponCode").is(':disabled')) { 
		   		$('#CouponCode').val('');
		   		$('#CouponRdm').val(true);
		   	}
		   	else{

		   	}
	
		});

		$('#CouponNoUntil').on('ifChanged', function(event){
			$('#CouponValidUntil').attr('disabled',this.checked);

			if($("#CouponValidUntil").is(':disabled')) { 
		   		$('#CouponValidUntil').val('');
		   } 
		});

		$('#CouponValidFrom').datepicker({
            format: "yyyy/mm/dd"
        });

        $('#CouponValidUntil').datepicker({
            format: "yyyy/mm/dd"
        }); 

	});

</script>