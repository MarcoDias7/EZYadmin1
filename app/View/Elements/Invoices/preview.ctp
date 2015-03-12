<div id="preview">


    <h3> <?php echo __('Editable preview'); ?> <i class="glyphicon glyphicon-pencil" style="font-size: 70%"></i></h3>

    <hr/>

    <div class="mybuttons">

        <h5><?php echo __('Dynamic fields'); ?> : </h5>

        <button id="bankAccountButton" type="button" class="btn btn-primary"><?php echo __('BankAccount'); ?></button>

        <button id="numInvoiceButton" type="button" class="btn btn-primary"><?php echo __('Invoice number'); ?></button>

        <button id="dateInvoiceButton" type="button" class="btn btn-primary"><?php echo __('Invoice date'); ?></button>

        <!-- Single button -->
        <div class="btn-group">
            <button id="customerButton" type="button" class="btn btn-primary"><?php echo __('Customer'); ?></button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a id="customerNameButton" href="#"><?php echo __('Name'); ?></a></li>
                <li><a id="customerAddress1Button" href="#"><?php echo __('Address'); ?></a></li>
                <li><a id="customerCityZipButton" href="#"><?php echo __('Locality'); ?></a></li>
            </ul>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-primary"><?php echo __('Total'); ?></button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#"><?php echo __('Total excl. VAT'); ?></a></li>
                <li><a href="#"><?php echo __('Total incl. VAT'); ?></a></li>
            </ul>
        </div>


        <!-- Button trigger modal -->
        <button id="chooseTemplateButton" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal1">
            <?php echo __('Template'); ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo __('Choose the template'); ?> : </h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <?php echo $this->Form->input('model_invoice_id',  array(
                                'div' => 'col col-md-6 col-md-offset-3',
                                'label' => false,
                                'wrapInput' => 'col col-md-12',
                                'class' => 'btn btn-primary form-control'));
                            ?>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __('Ok'); ?></button>
                    </div>
                </div>
            </div>
        </div>



        <hr/>

    </div>

    <div class="mytoolbar"></div>

    <div id="invoicePreview1" class="invoice effect-paper">

        <div id="headerPreview1" class="headerInvoice editable">Header</div>

        <div id="bodyPreview1" class="bodyInvoice editable">Body</div>

        <div id="productsPreview1" class="productsInvoice editable">Products</div>

        <div id="footerPreview1" class="footerInvoice editable">Footer</div>

    </div>

    <div id="editor"></div>



</div>

<script>



    $("#bankAccountButton").click(function() {


        var editorContent = tinyMCE.activeEditor;
        console.log(editorContent);

        var bankAccountHtml = "<span id=\"bankAccountPreview\" class='data-element mceNonEditable' " +
        "data-toggle='tooltip' data-placement='top' title='Tooltip on left'>" + $("#InvoiceBankAccountId option:selected").text() + "</span>";

        tinymce.activeEditor.insertContent(bankAccountHtml);

    });

    $("#numInvoiceButton").click(function() {

        var numInvoiceHtml = "<span id=\"numInvoicePreview\" class='data-element mceNonEditable' " +
            "data-toggle='tooltip' data-placement='top' title='Tooltip on left'>" + $("#InvoiceNum").val() + "</span>";

        tinymce.activeEditor.insertContent(numInvoiceHtml);

    });


    $("#customerButton").click(function(){

        var customerName = $("#CustomerCustomerId option:selected").attr("data-name");
        var customerNameHtml = "<span id=\"customerNamePreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>"
            + customerName + "</span>";

        var customerStreet1 = $("#CustomerCustomerId option:selected").attr("data-street1");
        var customerStreet1Html = "<span id=\"customerStreet1Preview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>"
            + customerStreet1 + "</span>";

        var customerZip = $("#CustomerCustomerId option:selected").attr("data-zip");
        var customerCity = $("#CustomerCustomerId option:selected").attr("data-city");

        var customerZipHtml = "<span id=\"customerZipPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerZip + "</span>";
        var customerCityHtml = "<span id=\"customerCityPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerCity + "</span>";

        tinymce.activeEditor.insertContent(customerNameHtml + "<br/>" + customerStreet1Html + "<br/>" + customerZipHtml + " " + customerCityHtml);


    });


    $("#customerNameButton").click(function() {

        var customerName = $("#CustomerCustomerId option:selected").attr("data-name");
        var customerNameHtml = "<span id=\"customerNamePreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>"
                                + customerName + "</span>";

        tinymce.activeEditor.insertContent(customerNameHtml);

    });



    $("#customerAddress1Button").click(function() {

        var customerStreet1 = $("#CustomerCustomerId option:selected").attr("data-street1");
        var customerStreet1Html = "<span id=\"customerStreet1Preview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>"
            + customerStreet1 + "</span>";

        tinymce.activeEditor.insertContent(customerStreet1Html);

    });



    $("#customerCityZipButton").click(function() {

        var customerZip = $("#CustomerCustomerId option:selected").attr("data-zip");
        var customerCity = $("#CustomerCustomerId option:selected").attr("data-city");

        var customerZipHtml = "<span id=\"customerZipPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerZip + "</span>";
        var customerCityHtml = "<span id=\"customerCityPreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + customerCity + "</span>";

        tinymce.activeEditor.insertContent(customerZipHtml + " " + customerCityHtml);

    });


    $("#dateInvoiceButton").click(function() {

        var todayDate = getTodayDateSwissFormat();
        var todayDateHtml = "<span id=\"todayDatePreview\" class='data-element mceNonEditable' data-mce-contenteditable='false'>" + todayDate + "</span>";

        tinymce.activeEditor.insertContent(todayDateHtml);

    });






</script>


<style>

    .mce-edit-focus{

        border-right: thick double #FAAC25 !important;

        width:643px !important;
    }
    /*
    .editable{

        border-style: solid !important;
        border-left: 0px !important;
        border-top: 0px !important;
        border-bottom: 0px !important;
    }


    .headerInvoice{

        border-right: thick double #ff0000 !important;
    }

    .bodyInvoice{

        border-right: thick double forestgreen !important;
    }

    .productsInvoice{

        border-right: thick double deepskyblue !important;
    }

    .footerInvoice{

        border-right: thick double #ff0000 !important;
    }
    */

    .invoice{

        background-color: #f8f3f0;

        width:794px !important;
        height:1122px !important;
        padding-left: 94px !important;
        padding-right: 57px !important;
        padding-top: 75px !important;
        padding-bottom: 76px !important;

        font-size:11pt;
        font-family:arial, helvetica, sans-serif;

        position: relative;
        margin-bottom: 20px;


    }

    .footerInvoice{

            position: absolute;
            bottom: 30px;
            left: 94px !important
            width: 643px;
    }



    .effect-paper {
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        margin: 26px auto 0;

        padding: 24px;
        position: relative;
        width: 80%;
    }
    .effect-paper:before, .effect-paper:after {
        content: "";
        height: 98%;
        position: absolute;
        width: 100%;
        z-index: -1;
    }
    .effect-paper:before {
        background: #fafafa;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
        left: -5px;
        top: 4px;
        transform: rotate(-2.5deg);
    }
    .effect-paper:after {
        background: #f6f6f6;
        box-shadow: 0 0 3px rgba(0,0,0,0.2);
        right: -3px;
        top: 1px;
        transform: rotate(1.4deg);
    }

    .effect-paper2{
        -webkit-box-shadow: 0 10px 6px -6px #777;
        -moz-box-shadow: 0 10px 6px -6px #777;
        box-shadow: 0 10px 6px -6px #777;
    }


</style>

