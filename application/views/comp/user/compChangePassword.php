<div class="commonpages">
    <div style="float: left; margin: 20px 50px;">
        <h2>Change Password</h2>
        <?php 
        if($this->session->userdata('passwordUpdateMsg')) { 
            echo $this->session->userdata('passwordUpdateMsg');
            
            $data['passwordUpdateMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_CHANGE_PASSWORD); ?>">
            <table>
                <tr>
                    <td>Old Password : </td>
                    <td><input type="password" name="oldPassword" /></td>
                    <td><?php echo form_error('oldPassword'); ?></td>
                </tr>
                <tr>
                    <td>New Password : </td>
                    <td><input type="password" name="newPassword" /></td>
                    <td><?php echo form_error('newPassword'); ?></td>
                </tr>
                <tr>
                    <td>Confirm New Password : </td>
                    <td><input type="password" name="confirmNewPassword" /></td>
                    <td><?php echo form_error('confirmNewPassword'); ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" class="btn btn-large btn-success" value="Change Password" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>