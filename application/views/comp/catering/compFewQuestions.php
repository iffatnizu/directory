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
<div class="commonpages">
    <div>
        <h2><i class="icon-question-sign"></i> Last few questions...</h2>
        <?php
        if ($this->session->userdata('successMsg')) {
            echo $this->session->userdata('successMsg');

            $data['successMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_FEW_QUESTIONS . '/' . $this->uri->segment(3)); ?>">
            <table>
                <tr>
                    <td colspan="3">Type of Venue needed:<?php echo form_error('venueTypes[]'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allVenueType)) {
                            foreach ($allVenueType as $venueType) {
                                ?>
                                <span style="float: left; width: 350px;">
                                    <input type="checkbox" name="venueTypes[]" id="venueTypes" value="<?php echo $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID]; ?>" />
                                    <?php echo $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE]; ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Type of amenities:<?php echo form_error('foodTypes[]'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allAmenitiesType)) {
                            foreach ($allAmenitiesType as $amenitiesType) {
                                ?>
                                <span style="float: left; width: 350px;">
                                    <input type="checkbox" name="foodTypes[]" id="foodTypes" value="<?php echo $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE_ID]; ?>" />
                                    <?php echo $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE]; ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Venue Budget: <select name="">
                            <?php
                            if (!empty($venueBudget)) {
                                foreach ($venueBudget as $budget) {
                                    ?>
                                    <option value="<?php echo $budget[DBConfig::TABLE_VENUE_BUDGET_ATT_VENUE_BUDGET_ID]; ?>">
                                        <?php echo $budget[DBConfig::TABLE_VENUE_BUDGET_ATT_BUDGET_RANGE]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select></td>
                    <td>
                        &nbsp;  
                    </td>
                    <td><?php echo form_error('foodTypes[]'); ?></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="" value="Submit" class="btn btn-large btn-success"/>
                    </td>
                    <td>&nbsp;</td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>