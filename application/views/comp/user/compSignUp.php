<div class="commonpages">
    <div class="signupCotainer">
        <h2>Sign up</h2>
        <?php
//                if ($this->session->userdata('successMsg')) {
//                    echo $this->session->userdata('successMsg');
//
//                    $data['successMsg'] = FALSE;
//                    $this->session->unset_userdata($data);
//                }
        ?>
        <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGNUP); ?>">
            <table>
                <tr>
                    <td style="width: 250px;">Name : </td>
                    <td><input type="text" name="<?php echo DBConfig::TABLE_USER_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_USER_ATT_NAME); ?>" /> *</td>
                    <td style="width: 400px;"><?php echo form_error(DBConfig::TABLE_USER_ATT_NAME); ?></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td><input type="text" name="<?php echo DBConfig::TABLE_USER_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_USER_ATT_EMAIL); ?>" /> *</td>
                    <td><?php echo form_error(DBConfig::TABLE_USER_ATT_EMAIL); ?></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="<?php echo DBConfig::TABLE_USER_ATT_PASSWORD; ?>" value="" /> *</td>
                    <td><?php echo form_error(DBConfig::TABLE_USER_ATT_PASSWORD); ?></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirmPassword" value="" /> *</td>
                    <td><?php echo form_error('confirmPassword'); ?></td>
                </tr>
<!--                <tr>
                    <td>Zip Code:</td>
                    <td><input type="text" name="<?php //echo DBConfig::TABLE_USER_ATT_ZIP_CODE;   ?>" value="<?php //echo set_value(DBConfig::TABLE_USER_ATT_ZIP_CODE);   ?>" /></td>
                    <td><?php //echo form_error(DBConfig::TABLE_USER_ATT_ZIP_CODE);   ?></td>
                </tr>-->
                <tr>
                    <td colspan="3">Which best describes you: (check all that apply) *</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="checkbox" name="whichBest[]" value="1" <?php echo set_checkbox('whichBest[]','1'); ?>/>
                        I am responsible for ordering food for my office
                        <br/>
                        <input type="checkbox" name="whichBest[]" value="2" <?php echo set_checkbox('whichBest[]','2'); ?>/>
                        I am responsible for planning events 
                        <br/>
                        <input type="checkbox" name="whichBest[]" value="3" <?php echo set_checkbox('whichBest[]','3'); ?>/>
                        I typically eat out a few times per week during lunch time 
                        <br/>
                        <input type="checkbox" name="whichBest[]" value="4" <?php echo set_checkbox('whichBest[]','4'); ?>/>
                        I rarely use catering services 
                    </td>
                    <td><?php echo form_error('whichBest[]'); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="" class="btn-large btn-success" value="Submit" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>