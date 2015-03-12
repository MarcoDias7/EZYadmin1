
<script>


    var headerContent;
    var bodyContent;
    var productsContent;
    var footerContent;


    var generatePdfURL = '/invoices/generatePDF';



    // At load, load the default invoice model
    $( document ).ready(function() {

        getModel($('#InvoiceModelInvoiceId').val()); //TODO bizarre l'id...

    });


    $("#CustomerCustomerId").change(function(){

        updatePreview();

    });

    $("#InvoiceModelInvoiceId").change(function() {

        if (confirm("Attention, cela écrasera vos modifications actuelles")) { // Clic sur OK
            getModel($(this).val());
        }


    });


    $("#InvoiceNum").change(function() {

        updatePreview();


    });

    $("#InvoiceBankAccountId").change(function() {

        updatePreview();


    });


    function getModel(id){

        var objData = {id: id};

        $.ajax({
            url: '<?php echo Router::url("/model_invoices/get_by_id.json"); ?>',
            dataType: 'json',
            data: objData,
            success: function (data) {

                onComplete(data);

            }
        });


    }

    function onComplete(data) {

        // at loading
        headerContent = data['ModelInvoice'].header_content;
        bodyContent = data['ModelInvoice'].body_content;
        productsContent = data['ModelInvoice'].products_content;
        footerContent = data['ModelInvoice'].footer_content;

        updatePreview(true);
    }

    function getTodayDateSwissFormat(){

        var d = new Date();
        var curr_date = d.getDate();
        var curr_month = d.getMonth();
        var curr_year = d.getFullYear();

        return curr_date + "." + curr_month + "." + curr_year;

    }


    function updatePreview(firstUpdate){

        firstUpdate = typeof firstUpdate !== 'undefined' ? firstUpdate : false;

        console.log(firstUpdate);

        var bankAccount = $( "#InvoiceBankAccountId option:selected").text();
        var logoCompany = $("#logoCompany").clone().removeAttr("hidden");
        var numInvoice = $("#InvoiceNum").val();
        var customerName = $("#CustomerCustomerId option:selected").attr("data-name");
        var customerNum = $("#CustomerCustomerId option:selected").attr("data-num");
        var customerStreet1 = $("#CustomerCustomerId option:selected").attr("data-street1");
        var customerZip = $("#CustomerCustomerId option:selected").attr("data-zip");
        var customerCity = $("#CustomerCustomerId option:selected").attr("data-city");
        var todayDateSwiss = getTodayDateSwissFormat();

        var bankAccountHtml = "<span id=\"bankAccountPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + bankAccount + "</span>";
        var logoCompanyHtml = "<img id='companyLogoPreview' class='data-element mceNonEditable' src=\"" + $(logoCompany).attr("src") + "\" >"
        var numInvoiceHtml = "<span id=\"numInvoicePreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + numInvoice + "</span>";
        var customerNameHtml = "<span id=\"customerNamePreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerName + "</span>";
        var customerNumHtml = "<span id=\"customerNumPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerNum + "</span>";
        var customerStreet1Html = "<span id=\"customerStreet1Preview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerStreet1 + "</span>";
        var customerZipHtml = "<span id=\"customerZipPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerZip + "</span>";
        var customerCityHtml = "<span id=\"customerCityPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerCity + "</span>";
        var todayDateSwissHtml = "<span id=\"todayDatePreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + todayDateSwiss + "</span>";

        //first update
        if(firstUpdate == true){

            console.log($(logoCompany));


            // Initialize table Products
            $('#productsPreview1').html("");
            $('#productsPreview1').append(  "<table id='productsTable1' style='width: 100%' class='mce-item-table mceNonEditable'>" +
                                            "<thead>" +
                                            "<tr>" +
                                            "<th width='10%' ><?php echo __('Quantity'); ?></th>" +
                                            "<th width='53%'><?php echo __('Product'); ?></th>" +
                                            "<th width='15%'><?php echo __('Price'); ?></th>" +
                                            "<th width='10%'><?php echo __('VAT'); ?></th>" +
                                            "<th width='12%'><?php echo __('Amount'); ?></th>" +
                                            "</tr>" +
                                            "</thead><tbody id='productsTable'></tbody></<table>"
            );


            $('#productsTable1').after("<br/><div><strong><?php echo __('Total excl. VAT'); ?> : </strong><span id='sumWithoutTVAPreview'></span> CHF </div>");


            headerContent = headerContent.replace("[[ bankAccount ]]", bankAccountHtml);
            headerContent = headerContent.replace("[[ companyLogo ]]", logoCompanyHtml);
            headerContent = headerContent.replace("[[ numInvoice ]]", numInvoiceHtml);
            headerContent = headerContent.replace("[[ customerName ]]", customerNameHtml);
            headerContent = headerContent.replace("[[ customerNum ]]", customerNumHtml);
            headerContent = headerContent.replace("[[ customerStreet1 ]]", customerStreet1Html);
            headerContent = headerContent.replace("[[ customerZip ]]", customerZipHtml);
            headerContent = headerContent.replace("[[ customerCity ]]", customerCityHtml);
            headerContent = headerContent.replace("[[ invoiceDate ]]", todayDateSwissHtml);

            bodyContent = bodyContent.replace("[[ bankAccount ]]", bankAccountHtml);
            bodyContent = bodyContent.replace("[[ companyLogo ]]", logoCompanyHtml);
            bodyContent = bodyContent.replace("[[ numInvoice ]]", numInvoiceHtml);
            bodyContent = bodyContent.replace("[[ customerName ]]", customerNameHtml);
            bodyContent = bodyContent.replace("[[ customerNum ]]", customerNumHtml);
            bodyContent = bodyContent.replace("[[ customerStreet1 ]]", customerStreet1Html);
            bodyContent = bodyContent.replace("[[ customerZip ]]", customerZipHtml);
            bodyContent = bodyContent.replace("[[ customerCity ]]", customerCityHtml);
            bodyContent = bodyContent.replace("[[ invoiceDate ]]", todayDateSwissHtml);

            footerContent = footerContent.replace("[[ bankAccount ]]", bankAccountHtml);
            footerContent = footerContent.replace("[[ companyLogo ]]", logoCompanyHtml);
            footerContent = footerContent.replace("[[ numInvoice ]]", numInvoiceHtml);
            footerContent = footerContent.replace("[[ customerName ]]", customerNameHtml);
            footerContent = footerContent.replace("[[ customerNum ]]", customerNumHtml);
            footerContent = footerContent.replace("[[ customerStreet1 ]]", customerStreet1Html);
            footerContent = footerContent.replace("[[ customerZip ]]", customerZipHtml);
            footerContent = footerContent.replace("[[ customerCity ]]", customerCityHtml);
            footerContent = footerContent.replace("[[ invoiceDate ]]", todayDateSwissHtml);



            $('#headerPreview1').html(headerContent);
            $('#bodyPreview1').html(bodyContent);
            $('#footerPreview1').html(footerContent);

            // update the products
            updateProductsOnPreview();

        }



        // not first update
        if(firstUpdate == false){

            $("#bankAccountPreview").html(bankAccount);
            $("#numInvoicePreview").html(numInvoice);
            $("#todayDatePreview").html(todayDateSwiss);

            $("#customerNumPreview").html(customerNum);
            $("#customerNamePreview").html(customerName);
            $("#customerStreet1Preview").html(customerStreet1);
            $("#customerZipPreview").html(customerZip);
            $("#customerCityPreview").html(customerCity);


        }


    }



</script>

<style>

    .data-element{

        border: #000000;
        border-radius: 2px;

    }


</style>


<script>


    function openPDF(){

        var url = generatePdfURL
            + "?header=" +  $('#headerPreview1').html().replace(/&nbsp;/g, '') + ""
            //+ "&body=" + $('#bodyPreview1').html().replace(/&nbsp;/g, '') + ""
            //+ "&products=" + $('#productsPreview1').html().replace(/&nbsp;/g, '') + ""
            + "&footer=" + $('#footerPreview1').html().replace(/&nbsp;/g, '')  + ""
            //+ "&invoiceid=" + $('#InvoiceNum').val() +  ""
            //+ "&amount=" + $('#products-result').html()  + ""
            //+ "&customerid=" + $('#InvoiceCustomerId option:selected').val() +  ""
            //+ "&bankaccountid=" + $('#InvoiceBankAccountId option:selected').val()  + ""
            ;


        url = encodeURI(url)

        window.open(url, '_blank');





    }


    $(document).ready(function(){

        $('#previewPDF').click(function () {

            openPDF();

        });

    });


</script>


