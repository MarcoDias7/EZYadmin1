    <div class="container-full <?php if (isset($MenuCurrentCompany) && !empty($MenuCurrentCompany)): ?>margin-top-fix<?php endif; ?>">
        <div class="wrapper">
            <div class="row">

                <div class="header col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:0px; padding-right:0px;">
                    <div class="but_image hidden-sm hidden-xs"></div>
                    <div class="grey_box text">
                        EZYcount is an <b>online accounting</b> system developed in Switzerland for small Swiss companies
                    </div>
                    <div class="bikes_image">
                       <div class="tip hidden-xs">
                            <div class="text_tip">
                                "I have more time to do the things I love!"
                            </div>
                        </div>
                        <div class="corner_t hidden-xs corner_t_reverse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home_links">
        <div class="col-lg-3 col-lg-offset-2 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-sm-12">
            <a href="#easy" >
               
                   Easy,&nbsp;Safe,&nbsp;everywhere
             
            </a>
        </div>
        <div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-sm-12">
            <a href="#des">
             
                    Designed&nbsp;for&nbsp;small&nbsp;companies
            
            </a>
        </div>
        <div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-sm-12">
            <a href="#one">
               
                    From&nbsp;CHF&nbsp;9.90&nbsp;/&nbsp;month
              
            </a>
        </div>
    </div>
  



        <div class="info_block"><br/>
        <a id="easy" class="anchor"></a>

            <div class="image_part col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <?php echo $this->Html->image('image_1.png', array("alt" => "EZYcount facile et sûr")); ?>
            </div>
            <div class="text_part col-lg-4 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <h2>Easy. Safe. <span>Everywhere.</span></h2>

                <div>
                   Intuitive functions and straightforward support make accounting smooth. Your accounting information
                    is
                    stored solely on servers in Switzerland with the latest security technology.
                    The online accounting system is accessible with any device such as PC, tablets, and smart phones
                    through the Internet.<br><br>
                </div>
                <?php echo $this->Html->link('SEE MORE', '/pages/solution#availability', array('class' => 'see_more')); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="info_block"><a id="des" class="anchor"></a>
           <div
                class="image_part hidden-lg hidden-md hidden-sm col-xs-10 col-xs-offset-1">
                <?php echo $this->Html->image('image_2.jpg'); ?>
            </div>
            <div
                class="text_part col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-0 col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <h2>Designed for<span> small companies<br>and start-ups.</span></h2>

                <div>
                    EZYcount provides the essentials: bookings, reports, VAT, and multiple user access. Help boxes and tips guide you through EZYcount.
                    You are able to personalise your reports and share them with as many users as you like.<br><br>
                </div>
                <?php echo $this->Html->link('SEE MORE', '/pages/solution', array('class' => 'see_more')); ?>
            </div>
            <div
                class="image_part col-lg-4 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-5 col-sm-offset-1 hidden-xs">
                <?php echo $this->Html->image('image_2.jpg', array("alt" => "EZYcount facile et sur")); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <br/>
        <div class="info_block">
            <a id="one" class="anchor"></a>
            <div
                class="image_part col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <?php echo $this->Html->image('image_3.jpg', array("alt" => "EZYcount economique")); ?>
            </div>
            <div class="text_part col-lg-4 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-5 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <h2><span>Save Money:</span> from <span>CHF 9.90</span> for the full solution.</h2>

                <div>
                    EZYcount <b>rewards</b> users for their <b>fidelity</b>: Subscribe for 1, 2 or 3 years and pay between <b>CHF 12.49</b> and <b>CHF 9.90</b> per <b>month</b>.<br />No extra fees apply for adding more users or devices. Register today and receive a <b>30-day free trial.</b></b><br/><br/>
                </div>
                <?php echo $this->Html->link('SEE MORE', '/pages/solution#price', array('class' => 'see_more')); ?>
            </div>
        </div>

<br/>



        <div class="clearfix"></div><br/><br/>
        <div class="span12" style="text-align:center;">
        <h2 align="middle" id="try">Try <span style="color: #ee9911;">for free</span></h2><br/>
        </div>
            <div class="panel panel-default col-lg-4 col-lg-offset-4 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1" style="box-shadow:0 2px 3px rgba(0, 0, 0, 0.15);">

                <div class="panel-body">
                    <?php
                        echo $this->Form->create('User', array(
                            'url' => array( 
                                'action' => 'subscribe' ),
                            'inputDefaults' => array(
                                'div' => 'false',
                                'class' => 'form-control'
                                ),
                            'class' => 'form-horizontal'));
                    ?>
                        <fieldset>

                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->input('User.title', array('label' => false, 'required'=>false,  'options' => array('' => __('Title')) + $this->EZYCount->title_array())); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Form->input('User.first_name', array('label' => false, 'required'=>false, 'placeholder'=>__('First name'))); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Form->input('User.last_name', array('label' => false, 'required'=>false, 'placeholder'=>__('Last name'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php echo $this->Form->input('User.country', array('label' => false, 'required'=>false, 'placeholder'=>__('Country of residence'), 'options' => $this->EZYCount->countryList($language))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php echo $this->Form->input('User.email', array('label' => false, 'required'=>false, 'placeholder'=>__('Email / Login'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Form->input('User.password', array('label' => false, 'required'=>false, 'required'=>false, 'placeholder'=>__('Password'))); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <?php echo $this->Form->input('User.confirm_password', array('type' => 'password', 'required'=>false, 'label' => false, 'placeholder'=>__('Confirm Password'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <?php echo $this->Form->input('User.tos', array(
                                    'type' => 'checkbox',
                                    'label' => __('I accept the EZYcount\'s %s', $this->Html->link(__('Terms of Services'), '/pages/termsofservices', array('target' => '_blank', 'class' => 'underline'))),
                                    'class' => false
                                )); 
                                ?>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <?php
                                    echo $this->Form->submit(__('Register'), array(
                                                    'class' => 'btn btn-primary',
                                                    'style' => 'float: right;'
                                            ));

                                ?>
                            </div>
                        </div>
                        </fieldset>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>


<script type="text/javascript">



  $(document).ready(function(){
     // Scroll page with easing effect
     /*
    $('.brown_buttons a').bind('click', function(e) {
        e.preventDefault();
        target = this.hash;
        $.scrollTo(target+50, 1500, { 
          easing: 'easeOutCubic'
        });
    });*/

    //Affix stuff
    $('#nav').affix({
          offset: {

            top: $('header').height()+$('.navi').height()
          }
    });

    $(function() {
        var $affixElement = $('#nav');
        $affixElement.width(100+'%');
    });

    $('.navbar a').click(function (event) {
        var scrollPos = jQuery('body').find($(this).attr('href')).offset().top - $('#nav').height();
        $('body,html').animate({ scrollTop: scrollPos}, 500, function () {});
        return false;
    });


    //Form stuff
    var checkEmpty = function (e) {
            if (!$(this).val()) {
                $(this).parent().addClass('has-error');
                $(this).parent().removeClass('has-success');
            }
            else {
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }
        };

        $('#UserFirstName').focusout(checkEmpty);
        $('#UserLastName').focusout(checkEmpty);
        $('#UserEmail').focusout(function (e) {
            if (!$(this).val() || $(this).val().indexOf('@') == -1) {
                $(this).parent().addClass('has-error');
                $(this).parent().removeClass('has-success');
            }
            else {
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }
        });

        $('#UserPassword').focusout(function (e) {
            if (!$(this).val() || $(this).val().length < 6) {
                $(this).parent().addClass('has-error');
                $(this).parent().removeClass('has-success');
            }
            else {
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }
        });

        $('#UserConfirmPassword').focusout(function (e) {
            if (!$(this).val() || $(this).val() != $('#UserPassword').val()) {
                $(this).parent().addClass('has-error');
                $(this).parent().removeClass('has-success');
            }
            else {
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');
            }
        });
      });
</script>


