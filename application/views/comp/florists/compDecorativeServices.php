<div style="float: left;">
    <div style="float: left; margin: 20px 50px;">
        <h2>Florist & Decorative Services</h2>
        <?php
        if ($this->session->userdata('successMsg')) {
            echo $this->session->userdata('successMsg');

            $data['successMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <form method="post" name="caterersQuote" action="<?php //echo site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_FOOD_PREFERENCE.'/'.$this->uri->segment(3));   ?>">
            <table>
                <tr>
                    <td width="25%">Budget for these service:</td>
                    <td width="50%">
                        <select name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>" style="width: 150px;">
                            <option value="">Select One</option>
                            <?php
                            if (!empty($allServiceBudget)) {
                                foreach ($allServiceBudget as $serviceBudget) {
                                    ?>
                                    <option value="<?php echo $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]); ?>>
                                        <?php echo $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td width="25%"><?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?></td>
                </tr>
                <tr>
                    <td colspan="3">What types of flowers or arrangements do you need?</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allFlowerType)) {
                            foreach ($allFlowerType as $flowerType) {
                                ?>
                                <span style="float: left; width: 250px;">
                                    <input type="checkbox" name="ckb" id="foodTypes" value="<?php echo $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID]; ?>" <?php echo set_checkbox(DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID, $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID]); ?>>
                                    <?php echo $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE]; ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="vertical-align: top;">
                        Event Comments:<br/>
                        <textarea rows="5" cols="30" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="" value="Continue" class="btn btn-large btn-success"/></td>
                    <td>&nbsp;</td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>