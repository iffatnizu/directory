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
        <h2><i class="icon-ok-sign"></i> You are almost done!</h2>
        <?php
        if ($this->session->userdata('successMsg')) {
            echo $this->session->userdata('successMsg');

            $data['successMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_FOOD_PREFERENCE . '/' . $this->uri->segment(3)); ?>">
            <table>
                <tr>
                    <td width="25%">Catering Service:</td>
                    <td width="50%">
                        <select name="<?php echo DBConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID; ?>">
                            <option value="">Select One</option>
                            <?php
                            if (!empty($allService)) {
                                foreach ($allService as $service) {
                                    ?>
                                    <option value="<?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]; ?>" <?php echo set_select(DBConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID, $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]); ?>>
                                        <?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td width="25%"><?php echo form_error(DBConfig::TABLE_FOOD_PREFERENCE_ATT_SERVICE_ID); ?></td>
                </tr>
                <tr>
                    <td>Catering Budget Per Person:</td>
                    <td>
                        <select name="<?php echo DBConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID; ?>">
                            <option value="">Select One</option>
                            <?php
                            if (!empty($allBudgetRange)) {
                                foreach ($allBudgetRange as $budgetRange) {
                                    ?>
                                    <option value="<?php echo $budgetRange[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON_ID]; ?>" <?php echo set_select(DBConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID, $budgetRange[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON_ID]); ?>>
                                        <?php echo $budgetRange[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td><?php echo form_error(DBConfig::TABLE_FOOD_PREFERENCE_ATT_BUDGET_PET_PERSON_ID); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Type of food (maximum 3):<?php echo form_error('foodTypes[]'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allFoodType)) {
                            $i = 0;
                            foreach ($allFoodType as $foodType) {
                                ?>
                                <span style="float: left; width: 150px;">
                                    <input type="checkbox" name="foodTypes[]" id="foodTypes" value="<?php echo $foodType[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE_ID]; ?>" />
                                    <?php
                                    echo $foodType[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE];
                                    $i++;
                                    ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php if ($eventDetails[DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION] == '2') { ?>
                    <tr>
                        <td style="vertical-align: top;" colspan="3">Venue Name:
                            <input style="width: 150px;" type="text" name="<?php echo DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME); ?>" />
                            <span style="margin-left: 10px;">Does Venue have Commercial Kitchen?</span>
                            <input type="radio" name="<?php echo DBConfig::TABLE_FOOD_PREFERENCE_ATT_KITCHEN; ?>" value="1" <?php echo set_radio(DBConfig::TABLE_FOOD_PREFERENCE_ATT_KITCHEN, '1'); ?> />
                            <span>Yes</span>
                            <input type="radio" name="<?php echo DBConfig::TABLE_FOOD_PREFERENCE_ATT_KITCHEN; ?>" value="0" <?php echo set_radio(DBConfig::TABLE_FOOD_PREFERENCE_ATT_KITCHEN, '0'); ?> />
                            <span>No</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;" colspan="3">
                            <?php echo form_error(DBConfig::TABLE_FOOD_PREFERENCE_ATT_VENUE_NAME); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3">
                        <strong>Please tell us about your event. This will help caterers with their quote:</strong><br/>
                        (theme, items you would like to see on menu, etc.)</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea id="aboutEvent" cols="80" name="<?php echo DBConfig::TABLE_FOOD_PREFERENCE_ATT_ABOUT_EVENT; ?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="eventLocation" value="<?php echo $eventDetails[DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION]; ?>" style="padding: 5px; font-weight: bold;" />
                        <input class="btn btn-large btn-success" type="submit" name="" value="Submit"/>
                    </td>
                    <td>&nbsp;</td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>