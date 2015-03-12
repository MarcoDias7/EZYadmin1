
<div  id="step3" hidden="hidden">
    <div class="row">
        <div class="col-xs-12">


            <fieldset>

            <div class="row" style="margin-left: 20px">

            <div id="products-block" class="col-lg-12">


                <table class="table table-striped firstChildBold" id="products">

                    <thead>
                    <tr>
                        <th><?php echo __('Qte'); ?></th>
                        <th><?php echo __('Product'); ?></th>
                        <th><?php echo __('Unit price'); ?></th>
                        <th><?php echo __('Total'); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>


                    <tr id="product-item" class="product-item">

                        <td class="col-md-1" style="vertical-align:middle;">

                            <input name="quantity[]" id="quantity" type="name" value="0" class="form-control product-quantity" />


                        </td>

                        <td class="col-md-4" style="vertical-align:middle;">

                            <?php

                            $options = array();
                            foreach ($products as $item) {

                                $options[$item['Product']['id']] = array(
                                    'value' => $item['Product']['id'],
                                    'name' => $item['Product']['product_num'].' - '.$item['Product']['product_name'],
                                    'data-price' => $item['Product']['product_price_unity'],
                                    'data-unit' => $item['Product']['product_unit'],
                                    'data-vat' => $item['VatAccount']['rate'],

                                );

                                asort($options);

                            }

                            echo $this->Form->input('InvoiceProduct', array(
                                'empty' => 'Choose a product',
                                'class' => 'Product form-control',
                                'options' => $options,
                                'name' => 'products[]',
                                'label' => false,
                                'div' => false,
                                'style' => 'style="vertical-align:middle;"',
                                'wrapInput' => false));

                            ?>

                        </td>

                        <td class="col-md-3" style="vertical-align:middle;">

                            <div class="input-group">
                                <div class="input-group-addon">CHF</div>
                                <input name="quantity-price-unit[]" id="price-unit" type="name" value="0" class="form-control product-price-unit text-right" />
                                <div class="input-group-addon"> / <span class="product-unit">-</span></div>
                            </div>

                        </td>

                        <td class="col-md-2" style="vertical-align:middle;">

                            <div class="input-group">
                                <div class="input-group-addon">CHF</div>
                                <input name="sums[]" id="sums" type="name" value="0" class="form-control product-result text-right" />

                            </div>
                        </td>

                        <td class="col-md-1" style="vertical-align:middle;">
                            <a href="#" id="removeProduct"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                            <a href="#" id="upProduct"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
                            <a href="#" id="downProduct"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <button id="addProduct" type="button" class="btn btn-success"><?php echo __('Add a product'); ?></button>

            </div>


            <br>
            <br>


            <div class="col-lg-5 col-lg-offset-7">
                <table id="tblTotalSummary" class="table table-striped">
                <thead>
                <tr>
                    <th width="50%"></th>
                    <th></th>
                </tr>
                </thead>
                    <tbody>

                    <tr id="result-excl-vat-block">
                        <td><b><?php echo __('Total excl. VAT'); ?> :</b></td>
                        <td colspan="2" align="right"><span id="products-result-excl-vat">0.00</span> CHF</td>
                    </tr>
                    <tr>
                        <td><b><?php echo __('Total incl. VAT'); ?> :</b></td>
                        <td colspan="2" align="right"><span id="products-result-incl-vat">0.00</span> CHF</td>
                    </tr>
                    <tr id="vat-result" hidden="hidden">
                        <td><b><?php echo __('Total VAT'); ?> <span class="vatRate"></span> :</b></td>
                        <td colspan="2" align="right"><span id="products-vat">0.00</span> CHF</td>
                    </tr>

                    </tbody>
                </table>
            </div>


            <div class="col col-md-6 col-md-offset-5">

                <a id="prev3" href="#" class="btn btn-default"><?php echo __('Previous'); ?></a>
                <a id="next3" href="#" class="btn btn-primary"><?php echo __('Next'); ?></a>

            </div>

            </div>

            </fieldset>


        </div>

    </div>
</div>