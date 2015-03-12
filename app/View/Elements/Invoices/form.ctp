
<!--  data-spy="scroll" data-target="#invoiceWizard"> -->

        <div class="container" style="width: 100%;">

            <div class="row">



                <!-- Invoice wizard at right -->
                <div class="col-md-6" id="invoiceWizardBlock"> <!--data-spy="affix" data-offset-top="0">-->

                    <?php echo $this->element('Invoices/header'); ?>

                    <?php echo $this->element('Invoices/step1'); ?>

                    <?php

                    echo $this->Form->create('Invoice', array(
                        'inputDefaults' => array(
                            'div' => 'form-group',
                            'label' => array(
                                'class' => 'col col-md-4 control-label'
                            ),
                            'wrapInput' => 'col col-md-6',
                            'class' => 'form-control'
                        ),
                        'type' => 'file',
                        'class' => 'form-horizontal'

                    )); ?>


                    <input id="CustomerID" name="customer_id" type="hidden" value="" />

                    <?php echo $this->element('Invoices/step2'); ?>
                    <?php echo $this->element('Invoices/step3'); ?>
                    <?php echo $this->element('Invoices/step4'); ?>


                    <?php //echo $this->Form->end('Invoice'); ?>

                    <hr/>

                </div>

                <!-- Preview at right -->
                <div class="col-md-6 border-orange-left " id="invoicePreviewBlock">

                    <?php echo $this->element('Invoices/preview'); ?>

                </div>



            </div>


    </div>




<?php echo $this->element('Invoices/navigation.script'); ?>
<?php echo $this->element('Invoices/preview.script'); ?>
<?php echo $this->element('Invoices/products.script'); ?>

<?php echo $this->element('Invoices/customer.script'); ?>
<?php echo $this->element('autocompleteCity.script', array("cityElement" => "#CustomerCity",  "zipElement" => "#CustomerZip")); ?>


<script>


    $("#next4").click(function(){


        $('#errors-customer').empty();

        //serialize form data
        var formData = $("#InvoiceAddForm").serialize();


        //TODO gérer quand on créer
        var customerID = $("#CustomerID").val();
        //formData = formData + "&data%5BInvoice%5D%5Bcustomer_idd%5D=" + customerID;

        //get form action
        var formUrl =  '<?php echo Router::url("/invoice/add_by_webservice.json"); ?>';


        console.log(formData);


        // open pdf and submitTVA
        openPDF();
        $( "#InvoiceAddForm" ).submit();





    });




</script>

