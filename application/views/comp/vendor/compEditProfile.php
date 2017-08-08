<script>
    var cityUrl = '<?php echo SiteConfig::CONTROLLER_HOME.SiteConfig::METHOD_HOME_GET_CITY ?>';
</script>
<script src="<?php echo base_url() ?>script/site/getCity.js" type="text/javascript"></script>
<div class="commonpages">
    <div>
        <h2><i class="icon-user"></i> Edit Profile</h2>
        <?php
        //debugPrint($userdata);
        if ($this->session->userdata('successMsg')) {
            echo $this->session->userdata('successMsg');

            $data['successMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <form class="form-edit-profile" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_EDIT_PROFILE); ?>">
            <table>
                <tr>
                    <td style="width: 300px;">Business Name:</td>
                    <td><input type="text" id="txtbusinessname" maxlength="70" name="txtbusinessname" value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_BUSINESS_NAME] ?>"/> *</td>
                    <td><?php echo form_error('txtbusinessname') ?></td>
                </tr>
                <tr>
                    <td>Your Name:</td>
                    <td><input type="text" id="txtName" maxlength="50" name="txtName" value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] ?>"/> *</td>							
                    <td><?php echo form_error('txtName') ?></td>
                </tr>

                <tr>
                    <td>Phone:</td>
                    <td>
                        <input type="text" id="txtPhoneno" maxlength="50" name="txtPhoneno" value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_PHONE] ?>"/>									
                    </td>
                    <td>&nbsp;</td>
                </tr>

                <tr>

                    <td>Street Address:</td>
                    <td><input type="text" id="txtAddress" maxlength="70" name="txtAddress" value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_ADDRESS] ?>"/> *</td>							
                    <td><?php echo form_error('txtAddress') ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>
                        <select name="stateId" onchange="return directory.cityByState(this.value)">
                            <option value="">-Choose</option>
                            <?php
                            foreach ($state as $s) {
                                if ($s[DBConfig::TABLE_STATE_ATT_STATE_ID]==$userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID]) {
                                    $checked = 'selected="selected"';
                                }
                                echo '<option '.$checked.' value="' . $s[DBConfig::TABLE_STATE_ATT_STATE_ID] . '">' . $s[DBConfig::TABLE_STATE_ATT_STATE_NAME] . '</option>';
                            }
                            ?>
                        </select>
                        *
                    </td>
                    <td><?php echo form_error('stateId') ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <select name="cityId">
                            <option value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID] ?>" selected=""><?php echo $userdata['cityname'] ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Zip Code:</td>
                    <td><input type="text" id="txtzip" maxlength="5" name="txtzip" value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_ZIP] ?>"/> *</td>							
                    <td><?php echo form_error('txtzip') ?></td>
                </tr>
                <tr>
                    <td>Website URL:</td>

                    <td><input type="text" id="txtURL" maxlength="100" name="txtURL" value="<?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_WEB_URL] ?>"/></td>							
                </tr>
                <tr>
                    <td colspan="2">                              
                        <h5>Which types of leads do you wish to receive?</h5>
                        <?php
                        foreach ($category as $c) {
                            if (in_array($c[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID], $userdata['wb']) == true) {
                                $checked = 'checked="checked"';
                            } else {
                                $checked = "";
                            }
                            ?>
                            <input type="checkbox" <?php echo $checked; ?> value="<?php echo $c[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] ?>" name="services[]"/> <?php echo $c[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME] ?><br/>
                            <?php
                        }
                        ?>

                    </td>
                    <td>&nbsp;</td>
                </tr>


                <tr class="apply_now_button">
                    <td>
                        <input type="submit" value="Submit" name="vendorsubmit" class="btn btn-large btn-info"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>