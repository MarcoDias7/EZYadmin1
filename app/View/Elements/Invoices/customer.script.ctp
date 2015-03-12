<script>

$("#addCustomerButton").click(function(){

    $("#CustomerAddBlock").show();
    $("#CustomerChooseBlock").hide();

    $("#next1").text("Save");
    $("#next1").attr("data-is-new-customer", "true");

    $("#chooseCustomerButton").show();

});

$("#chooseCustomerButton").click(function() {

    $("#CustomerAddBlock").hide();
    $("#CustomerChooseBlock").show();

    $("#next1").attr("data-is-new-customer", "false");
    $("#next1").text("Next");

});

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}


function newCustomer(){


        $('#errors-customer').empty();

        //serialize form data
        var formData = $("#CustomerAddForm").serialize();
        //get form action
        var formUrl =  '<?php echo Router::url("/customers/add_by_webservice.json"); ?>';

        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(data,textStatus,xhr){

                var responseJSON = data;

                console.log(responseJSON);

                //if no error
                if (isNumber(responseJSON)) {


                    //clear
                    $("#errors-customer").empty();


                    // get value of the customer
                    var customerName = $("#CustomerCustomerName").val();
                    var customerNum = $("#CustomerCustomerNum").val();
                    var customerStreet1 = $("#CustomerStreet1").val();
                    var customerZip = $("#CustomerZip").val();
                    var customerCity = $("#CustomerCity").val();

                    $("#CustomerCustomerId").append('<option value="' + responseJSON + '" ' +
                                                    'data-num="' + customerNum + '" data-name="' + customerName + '"' +
                                                    ' data-street1="' + customerStreet1 + '" data-zip="' + customerZip + '" ' +
                                                    'data-city="' + customerCity + '">' + customerNum + ' - ' + customerName + '</option>');
                    $("#CustomerCustomerId").val(responseJSON);


                    // the hidden input for the form
                    $("#CustomerID").val(responseJSON);

                    // update preview
                    updatePreview();

                    // simulate click on "cancel" button
                    $("#chooseCustomerButton").trigger("click");

                    // go to the next step (navigation.script)
                    step1CustomerIsOk();


                }
                //If errors
                else {


                    //clear
                    $("#errors-customer").empty();

                    // display errors
                    $.each(responseJSON, function (key, data) {

                        $("#errors-customer").append('<div id="flashMessage" class="alert alert-danger">' +  responseJSON[key] + '</div>');

                    });


                }

            },
            error: function(xhr,textStatus,error){
                console.log("error");
                console.log(textStatus);
            }
        });



}




$("#CustomerCustomerNum").change(function() {

    var objData = {customer_num: $(this).val()};

    $("#isLoading").show();
    $("#isUnique").hide();
    $("#isNotUnique").hide();

    $.ajax({
        url: '<?php echo Router::url("/customers/customer_num_is_unique.json"); ?>',
        dataType: 'json',
        data: objData,
        success: function (data) {

            $("#isLoading").hide();

            if(data == true)
                $("#isUnique").show();
            else
                $("#isNotUnique").show();

        }
    });
});

$("#setCustomNumCustomer").click(function(){

    if($("#setCustomNumCustomer").hasClass('custom-no')){

        $("#CustomerCustomerNum").removeAttr('readonly');

        $("#setCustomNumCustomer").removeClass('custom-no');
        $("#setCustomNumCustomer").text('<?php echo __('Generate for me') ?>');

    }else{

        $("#CustomerCustomerNum").attr('readonly', 'readonly');
        <?php  if ($this->action == 'add') {  ?>
        $("#CustomerCustomerNum").val('<?php echo $lastCustomerNum + 1 ; ?>');
        <?php } ?>


        $("#setCustomNumCustomer").addClass('custom-no');
        $("#setCustomNumCustomer").text('<?php echo __('Set custom num customer') ?>');

    }




});



</script>