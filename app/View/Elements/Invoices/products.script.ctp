


<script>

    var countProducts = 1; // by default

    // change on product it self
    $('#products').on("change", ".Product", function(){

        // unmark the "data-manual" of the sum if set
        $(this).parent().parent().parent().parent().find(".product-result").removeAttr("data-manual");

        // unmark the "data-manual" of the price-unit if set
        $(this).parent().parent().parent().parent().find(".product-price-unit").removeAttr("data-manual");

        update_amounts();

        return false;
    });


    // change on product quantiy
    $('#products').on("change", ".product-quantity", function(){
        update_amounts();
        return false;
    });

    // handle add product line
    $("#addProduct").click(function() {

        var toClone = $('#product-item:last').clone();

        $(toClone).find('.product-unit').text('-');
        $(toClone).find('.product-price-unit').text('0');
        $(toClone).find('.product-result').text('0');
        $(toClone).find('.product-quantity').val('0');
        $(toClone).find(".product-result").removeAttr("data-manual");
        $(toClone).find(".product-price-unit").removeAttr("data-manual");
        $(toClone).find('select').attr("name", "products[]"); // "data[InvoiceProduct][" + countProducts + "][product_id]");


        $('#products').append(toClone);

        countProducts++;

        update_amounts();

    });


    // handle change on price unit
    $("#products").on("change", ".product-price-unit", function(){

        // mark the field "manually change"
        $(this).attr("data-manual", "true");

        // and unmark the sum
        $(this).parent().parent().parent().find(".product-result").removeAttr("data-manual");

        update_amounts();

    });

    // handle change on sum of a product
    $("#products").on("change", ".product-result", function(){


        // mark the field "manually change"
        $(this).attr("data-manual", "true");

        // and unmark the price-unit
        $(this).parent().parent().parent().find(".product-price-unit").removeAttr("data-manual");

        update_amounts();

    });



    // handle remov product line
    $("#products").on("click", "#removeProduct", function(){

        // you can delete if there is less than 1 product
        if(countProducts > 1){

            $(this).parent().parent().remove();
            countProducts--;

            //update
            update_amounts();
        }
        else
            alert('<?php echo __('You must provide a least 1 product !'); ?>');

    });

    // handle up
    $("#products").on("click", "#upProduct", function(){

        // get current and prev blocks
        var currentProductBlock = $(this).parent().parent();
        var prevProductBlock = $(this).parent().parent().prev();

        // only if the prev is a product-item
        // so when we are in the top of the list
        if(prevProductBlock.hasClass("product-item")){

            // get values
            var currentProduct = $(currentProductBlock).find("#InvoiceInvoiceProduct").val();
            var prevProduct = $(prevProductBlock).find("#InvoiceInvoiceProduct").val();

            var currentQuantity = $(currentProductBlock).find("#quantity").val();
            var prevQuantity = $(prevProductBlock).find("#quantity").val();

            var currentPriceUnit = $(currentProductBlock).find("#price-unit").val();
            var prevPriceUnit = $(prevProductBlock).find("#price-unit").val();

            var currentSum = $(currentProductBlock).find("#sums").val();
            var prevSum = $(prevProductBlock).find("#sums").val();


            // switch
            $(currentProductBlock).find("#InvoiceInvoiceProduct").val(prevProduct);
            $(prevProductBlock).find("#InvoiceInvoiceProduct").val(currentProduct);

            $(currentProductBlock).find("#quantity").val(prevQuantity);
            $(prevProductBlock).find("#quantity").val(currentQuantity);

            $(currentProductBlock).find("#price-unit").val(prevPriceUnit);
            $(prevProductBlock).find("#price-unit").val(currentPriceUnit);

            $(currentProductBlock).find("#sums").val(prevSum);
            $(prevProductBlock).find("#sums").val(currentSum);


            // update on the invoice preview
            updateProductsOnPreview();

        }


    });

    // handle up
    $("#products").on("click", "#downProduct", function(){

        // get current and prev blocks
        var currentProductBlock = $(this).parent().parent();
        var nextProductBlock = $(this).parent().parent().next();

        // only if the prev is a product-item
        // so when we are in the bottom of the list
        if(nextProductBlock.hasClass("product-item")){

            // get values
            var currentProduct = $(currentProductBlock).find("#InvoiceInvoiceProduct").val();
            var nextProduct = $(nextProductBlock).find("#InvoiceInvoiceProduct").val();

            var currentQuantity = $(currentProductBlock).find("#quantity").val();
            var nextQuantity = $(nextProductBlock).find("#quantity").val();

            var currentPriceUnit = $(currentProductBlock).find("#price-unit").val();
            var nextPriceUnit = $(nextProductBlock).find("#price-unit").val();

            var currentSum = $(currentProductBlock).find("#sums").val();
            var nextSum = $(nextProductBlock).find("#sums").val();


            // switch
            $(currentProductBlock).find("#InvoiceInvoiceProduct").val(nextProduct);
            $(nextProductBlock).find("#InvoiceInvoiceProduct").val(currentProduct);

            $(currentProductBlock).find("#quantity").val(nextQuantity);
            $(nextProductBlock).find("#quantity").val(currentQuantity);

            $(currentProductBlock).find("#price-unit").val(nextPriceUnit);
            $(nextProductBlock).find("#price-unit").val(currentPriceUnit);

            $(currentProductBlock).find("#sums").val(nextSum);
            $(nextProductBlock).find("#sums").val(currentSum);

            // update on the invoice preview
            updateProductsOnPreview();


        }


    });


    /*
    *
    * TODO redondance dans un fichier à vincent (collectiv booking)
    *
    */

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }


    function numberWithCommas(number) {
        if (!isNumber(number)) {
            return '';
        }

        number = Math.abs(parseFloat(number, 10)).toFixed(2);


        var asString = '' + number;
        var stringLength = asString.indexOf('.');
        if (stringLength == -1) {
            stringLength = asString.length;
        }
        var numberOfUpToThreeCharSubstrings = Math.ceil(stringLength / 3),
            startingLength = stringLength % 3,
            substrings = [],
            isNegative = (number < 0),
            formattedNumber,
            i;

        if (startingLength > 0) {
            substrings.push(asString.substring(0, startingLength));
        }


        for (i=startingLength; i < stringLength; i += 3) {
            substrings.push(asString.substr(i, 3));
        }

        formattedNumber = substrings.join('\'');
        if (isNegative) {
            formattedNumber = '-' + formattedNumber;
        }

        if (asString.indexOf('.') >= 0) {
            formattedNumber += asString.substr(asString.indexOf('.'), asString.length + 1);
        }
        return formattedNumber;
    }



    /*
     * Update products on preview
     *
     */
    function updateProductsOnPreview(){


        $('#productsTable').html('');

        var sumWithoutTVA = 0.0;

        // for each products, update
        $('#products > tbody > .product-item').each(function() {

            // get price / qty / unit
            var unit = $(this).find('option:selected').attr('data-unit');
            var price = $(this).find('option:selected').attr('data-price');
            var product = $(this).find('option:selected').text();
            var qty = $(this).find('input').val();
            var vat = $(this).find('option:selected').attr('data-vat');


            // if the price is set manualy
            if($(this).find('.product-price-unit').attr("data-manual") == "true") {

                price = parseFloat($(this).find('.product-price-unit').val());
            }

            if (typeof unit == 'undefined')
                unit = "-";
            if (typeof price == 'undefined')
                price = "0";


            var amount = (qty*price);

            // if the amount is set manualy
            if($(this).find('.product-result').attr("data-manual") == "true") {

                amount = parseFloat($(this).find('.product-result').val());

                price = $(this).find('.product-price-unit').val();

            }


            if (typeof amount == 'NaN') //if no amount
                amount = "0";

            var products =  "<tr>" +
                            "<td width='10%'>" + qty + "</td>" +
                            "<td width='53%'>" + product + "</td>" +
                            "<td width='15%'>" + price + " / " + unit + "</td>" +
                            "<td width='10%'>"  + vat + "</td>" +
                            "<td width='12%' class='amountProductPreview align-right'>" + numberWithCommas(amount) + "</td>" +
                            "</tr>";

            //TODO gérer les produits sur plusieurs pages
            $('#productsTable').append(products);

            //update total
            sumWithoutTVA+=amount;


        });


        sumWithoutTVA = numberWithCommas(sumWithoutTVA);

        $("#sumWithoutTVAPreview").text(sumWithoutTVA);



    }


    function update_amounts()
    {

        console.log("updating...");

        var sumExclVat = 0.0;
        var sumVats = new Array();
        var sumIncVat = 0.0;
        var vats = new Array();

        // for each products, update
        $('#products > tbody > .product-item').each(function() {


            // get price / qty / unit
            var unit = $(this).find('option:selected').attr('data-unit');
            var price = $(this).find('option:selected').attr('data-price');
            var product = $(this).find('option:selected').val();
            var qty = $(this).find('input').val();
            var vat = $(this).find('option:selected').attr('data-vat');


            // if no value
            if (typeof unit == 'undefined')
                unit = "-";
            if (typeof price == 'undefined')
                price = "0";
            if (typeof vat == 'undefined')
                vat = "0";


            if($(this).find('.product-price-unit').attr("data-manual") == "true") { // if the unit is set manualy


                price = parseFloat($(this).find('.product-price-unit').val());

            }
            else{

                // update price per unit
                $(this).find('.product-price-unit').val('' + price);

            }


            // update unit
            $(this).find('.product-unit').text('' + unit);


            console.log("unit/price/qte " + unit + " " + price + " " + qty);

            // update product amount

            var amount = 0;
            if($(this).find('.product-result').attr("data-manual") == "true"){ // if the amount is set manualy


                amount = parseFloat($(this).find('.product-result').val());

                var computedPrice = amount / qty;
                computedPrice = computedPrice.toFixed(2);

                $(this).find('.product-price-unit').val(computedPrice);


            }
            else{

                amount = (qty*price)
                if (typeof amount == 'NaN') //if no amount
                    amount = "0";
                $(this).find('.product-result').val('' + amount);

            }

            vats.push(vat);

            if(sumVats[vat] == null)
                sumVats[vat] = ( (amount * vat) / 100 ) ;
            else
                sumVats[vat] += ( (amount * vat) / 100 ) ;


            //update total
            sumExclVat += amount;
            sumIncVat += amount + ( (amount * vat) / 100 );


        });


        // update on the invoice preview
        updateProductsOnPreview();


        sumExclVat = numberWithCommas(sumExclVat);
        sumIncVat = numberWithCommas(sumIncVat);

        //just update the total to sum
        $('#products-result-excl-vat').text('' + sumExclVat);
        $('#products-result-incl-vat').text('' + sumIncVat);


        // delete duplicates
        vats = $.unique(vats);
        sumVats = $.unique(sumVats);

        // first we remove all vats
        $(".vats").each(function() {

            $(this).remove();

        });

        // set all vats
        $(vats).each(function() {

           var vatBlock =  $("#vat-result").clone();

            $(vatBlock).addClass("vats");
            $(vatBlock).show();
            $(vatBlock).find(".vatRate").html(this);
            $(vatBlock).find("#products-vat").html(numberWithCommas(sumVats[this]));

            $("#result-excl-vat-block").after(vatBlock); // insert

        });

        console.log(vats);
        console.log(sumVats);





    }

</script>