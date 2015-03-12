<?php

/*
 * Autocomplete for city and zip
 *
 * Parameters :
 *
 * cityElement, selector css of the field city
 * zipElement, selector css of the field zip
 *
 * Exemple :
 *
 * echo $this->element('autocomplete_city.script', array(
    "cityElement" => "#CustomerCity",
    "zipElement" => "#CustomerZip",)
   );
 *
 */

?>
<script type="text/javascript">

    $(document).ready(function() {


        $('<?php echo $cityElement ?>').autocomplete({
            minLength: 3,
            delay: 600,
            source: function (request, response) {
                var objData = {country: 'CH', city: request.term};
                $.ajax({
                    url: '<?php echo Router::url("/cities/index.json"); ?>',
                    dataType: 'json',
                    data: objData,
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.zip + ", " + item.city,
                                value: function () {
                                    $('<?php echo $zipElement ?>').val(item.zip);
                                    return item.city;
                                }
                            }
                        }));
                    }
                });
            }
        });

        $('<?php echo $zipElement ?>').autocomplete({
            minLength: 2,
            delay: 600,
            source: function (request, response) {
                var objData = {country: 'CH', zip: request.term};
                $.ajax({
                    url: '<?php echo Router::url("/cities/index.json"); ?>',
                    dataType: 'json',
                    data: objData,
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.zip + ", " + item.city,
                                value: function () {
                                    $('<?php echo $cityElement ?>').val(item.city);
                                    return item.zip;
                                }
                            }
                        }));
                    }
                });
            }
        });

    });

</script>