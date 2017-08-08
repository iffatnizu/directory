<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>script/core/jquery-ui.min.js"></script>

<script type="text/javascript">
    jQuery(function(){
        var max = 3;
        var checkboxes = $('input[type="checkbox"]');

        checkboxes.change(function(){
            var current = checkboxes.filter(':checked').length;
            checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
        });
    });
</script>
<div style="float: left;">
    <div style="float: left; margin: 20px 50px;">
        <h2>Get Quotes for Other Services</h2>
        <form method="post" action="<?php //echo site_url(SiteConfig::CONTROLLER_RECEPTION . SiteConfig::METHOD_RECEPTION_OTHER_SERVICES . '/' . $this->uri->segment(3)); ?>">
            <table>
                <tr>
                    <td colspan="3">Would you like to receive quotes on any of the following services?</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        if (!empty($allCategory)) {
                            $i = 0;
                            foreach ($allCategory as $category) {
                                if ($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] != '2') {
                                    ?><input type="checkbox" name="foodTypes[]" id="foodTypes" value="<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" />
                                    <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                                    <br />
                                    <?php
                                }
                            }
                        }
                        ?>
                    </td>
                    <td><?php echo form_error('foodTypes[]'); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="" value="Continue >" style="padding: 5px; font-weight: bold;" /></td>
                    <td><input type="submit" name="" value="Skip and Finish >" style="padding: 5px; font-weight: bold;" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>