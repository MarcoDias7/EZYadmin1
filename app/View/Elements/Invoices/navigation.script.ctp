<script>

    var step = 1;

    function updateHeader(ascending){

        switch(step){

            case 2:

                if(ascending){

                    $('#step1-header').addClass("complete");
                    $('#step1-header').removeClass("active");

                }
                else{
                    $('#step3-header').addClass("disabled");
                    $('#step3-header').removeClass("active");

                }
                $('#step2-header').removeClass("disabled");
                $('#step2-header').addClass("active");
                break;

            case 3:
                if(ascending){

                    $('#step2-header').addClass("complete");
                    $('#step2-header').removeClass("active");

                }
                else{
                    $('#step4-header').addClass("disabled");
                    $('#step4-header').removeClass("active");

                }
                $('#step3-header').removeClass("disabled");
                $('#step3-header').addClass("active");
                break;

            case 4:
                if(ascending){

                    $('#step3-header').addClass("complete");
                    $('#step3-header').removeClass("active");

                }
                else{}
                $('#step4-header').removeClass("disabled");
                $('#step4-header').addClass("active");
                break;

        }

    }

    function step1CustomerIsOk(){

        $('#step1').attr("hidden", "hidden");
        $('#step2').removeAttr("hidden");

        step++;
        updateHeader(true);

    }

    function step2IsOk(){

        $('#step2').attr("hidden", "hidden");
        $('#step3').removeAttr("hidden");

        step++;
        updateHeader(true);

    }

    //NEXT'S BUTTONS =====================================

    $('#next1').click(function(){


        $("#errors-customer").empty();

        // for new customer
        if($(this).attr("data-is-new-customer") == "true"){

            newCustomer();

            // we delegate to the ajax script in customer.script,
            // the responsability to go futher or not (depeding if the customer creation is ok)
            // by calling step1CustomerIsOk();


        }
        else{

            var hasSelectedACustomer = $("#CustomerCustomerId option:selected").val();

            if(hasSelectedACustomer != ""){


                $("#CustomerID").val(hasSelectedACustomer);
                console.log(hasSelectedACustomer);
                step1CustomerIsOk();

            }
            else
                $("#errors-customer").append('<div id="flashMessage" class="alert alert-danger"><?php echo __('Please choose a customer'); ?></div>');

        }


    });

    $('#next2').click(function(){

        $("#errors-step2").empty();

        var hasSelectedAInvoiceNum = $("#InvoiceNum").val();

        if(hasSelectedAInvoiceNum != "")
            step2IsOk();
        else
            $("#errors-step2").append('<div id="flashMessage" class="alert alert-danger"><?php echo __('Invoice number is missing.'); ?></div>');


    });

    $('#next3').click(function(){

        $('#step3').attr("hidden", "hidden");
        $('#step4').removeAttr("hidden");

        step++;
        updateHeader(true);

    });

    //PREV'S BUTTONS =====================================


    $('#prev2').click(function(){

        $('#step2').attr("hidden", "hidden");
        $('#step1').removeAttr("hidden");

        step--;
        updateHeader(false);

    });

    $('#prev3').click(function(){

        $('#step3').attr("hidden", "hidden");
        $('#step2').removeAttr("hidden");

        step--;
        updateHeader(false);

    });

    $('#prev4').click(function(){

        $('#step4').attr("hidden", "hidden");
        $('#step3').removeAttr("hidden");

        step--;
        updateHeader(false);

    });

</script>