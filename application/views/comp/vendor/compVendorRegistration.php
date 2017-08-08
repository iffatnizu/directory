<div class="commonpages">
    <div>

        <?php
        if ($this->session->userdata('successMsg')) {
            echo $this->session->userdata('successMsg');

            $data['successMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>

        <h2><i class="icon-user"></i> Fill out form to get listed for <strong>FREE</strong></h2>


        <div class="getListed">
            <h4 class="fill-out-form"></h4>
            <div class="getListedContent">

                <div class="getListedRight">
                    <ul class="getList">
                        <li><i class="icon-ok"></i> Free personal webpage</li>
                        <li><i class="icon-ok"></i> Receive daily leads for events</li>
                        <li><i class="icon-ok"></i> Select the leads you want</li>
                        <li><i class="icon-ok"></i> Pay only $5 per lead</li>

                        <li><i class="icon-ok"></i>  No monthly fees</li>
                    </ul>
                    <style>
                        .commonpages table tr {
                            border: none;
                        }
                    </style>
                    <form id="vendor-registration" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <table style="width: 650px;float: left;margin-right: 20px;">
                            <tr>
                                <td>Business Name:</td>
                                <td><input type="text" id="txtbusinessname" maxlength="70" name="txtbusinessname" value="<?php echo set_value('txtbusinessname') ?>"/> *</td>
                                <td><?php echo form_error('txtbusinessname') ?></td>
                            </tr>
                            <tr>
                                <td>Your Name:</td>
                                <td><input type="text" id="txtName" maxlength="50" name="txtName" value="<?php echo set_value('txtName') ?>"/> *</td>							
                                <td><?php echo form_error('txtName') ?></td>
                            </tr>

                            <tr>
                                <td>Phone:</td>
                                <td>
                                    <input type="text" id="txtPhoneno" maxlength="50" name="txtPhoneno" value="<?php echo set_value('txtPhoneno') ?>"/>									
                                </td>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td>Email:</td>
                                <td><input type="text" id="txtEmail" maxlength="70" name="txtEmail" value="<?php echo set_value('txtEmail') ?>"/> *</td>							
                                <td><?php echo form_error('txtEmail') ?></td>
                            </tr>

                            <tr>
                                <td>Password:</td>
                                <td><input type="password" id="txtPassword" name="txtPassword" value="<?php echo set_value('txtPassword') ?>"/> *</td>							
                                <td><?php echo form_error('txtPassword') ?></td>
                            </tr>

                            <tr>

                                <td>Street Address:</td>
                                <td><input type="text" id="txtAddress" maxlength="70" name="txtAddress" value="<?php echo set_value('txtAddress') ?>"/> *</td>							
                                <td><?php echo form_error('txtAddress') ?></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>
                                    <select name="stateId" onchange="return directory.cityByState(this.value)">
                                        <option value="">-Choose</option>
                                        <?php
                                        foreach ($state as $s) {
                                            echo '<option value="' . $s[DBConfig::TABLE_STATE_ATT_STATE_ID] . '">' . $s[DBConfig::TABLE_STATE_ATT_STATE_NAME] . '</option>';
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
                                        <option value="">-Choose</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Zip Code:</td>
                                <td><input type="text" id="txtzip" maxlength="5" name="txtzip" value="<?php echo set_value('txtzip') ?>"/> *</td>							
                                <td><?php echo form_error('txtzip') ?></td>
                            </tr>
                            <tr>
                                <td>Website URL:</td>

                                <td><input type="text" id="txtURL" maxlength="100" name="txtURL" value="<?php echo set_value('txtURL') ?>"/></td>							
                            </tr>
                            <tr>
                                <td colspan="2">                              
                                    <h5>Which types of leads do you wish to receive?</h5>
                                    <?php
                                    foreach ($category as $c) {
                                        ?>
                                        <input type="checkbox" value="<?php echo $c[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] ?>" <?php echo set_checkbox('services[]',$c[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]); ?>  name="services[]"/> <?php echo $c[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME] ?><br/>
                                        <?php
                                    }
                                    ?>

                                </td>
                                <td><?php echo form_error('services[]'); ?></td>
                            </tr>


                            <tr class="apply_now_button">
                                <td>
                                    <input type="submit" value="Submit" name="vendorsubmit" class="btn btn-large btn-info"/>
                                </td>
                            </tr>
                        </table>
<!--                        <table style="width: 510px;float: left;">
                            <tr>
                                <td align="center" colspan="3"> <h4> <i class="icon-money"></i> Master Card Info</h4></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="txtCardName" value="<?php echo set_value('txtCardName') ?>"/></td>
                                <td><?php echo form_error('txtCardName') ?></td>
                            </tr>
                            <tr>
                                <td>Card Number</td>
                                <td><input type="text" name="txtCardNumber"/></td>
                                <td><?php echo form_error('txtCardNumber') ?></td>
                            </tr>
                            <tr>
                                <td>CVV Number</td>
                                <td><input type="text" name="txtCardCVV"/></td>
                                <td><?php echo form_error('txtCardCVV') ?></td>
                            </tr>
                            <tr>
                                <td>Exp.Date </td>
                                <td>
                                    <select name="txtCardExpMonth" style="width: 110px;float: left;">
                                        <?php
                                        foreach (allmonth() as $key => $month) {
                                            ?>
                                            <option value="<?php echo $key ?>"><?php echo $month ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select name="txtCardExpYear" style="width: 100px;float: right;">
                                        <?php
                                        for($i=date("Y");$i<=2030;$i++) {
                                            ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><?php echo form_error('txtCardExpMonth') ?><?php echo form_error('txtCardExpYear') ?></td>
                            </tr>
                        </table>-->
                    </form>
                </div>
            </div>				
        </div>

    </div>
</div>