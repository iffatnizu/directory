<script>
    var loginUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR.SiteConfig::METHOD_VENDOR_DO_LOGIN ?>';
</script>
<script src="<?php echo base_url() ?>script/site/vendorLogin.js" type="text/javascript"></script>
<div id=main role=main>

    <div id=main-content>
        <span style="font-size: 15px;color: green;">
            <?php
                
            if ($this->session->userdata('successMsg')) {
                echo $this->session->userdata('successMsg');

                $data['successMsg'] = FALSE;
                $this->session->unset_userdata($data);
            }
            ?>
        </span>
        <?php
        if (!$this->session->userdata('_userLogin')) {
            ?>
            <p>Please Login To Access Vendor Panel</p>

            <div class=grid_12>
                <div class=block-border>
                    <div class=block-content>

                        <form class="form-signin" method="post">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <div class="loginstatus" style="text-align: left;color: red;">

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">Vendor ID</td>
                                    <td><input name="email" type="text"  placeholder="Email address"/></td>
                                </tr>
                                <tr>
                                    <td valign="top">Password</td>
                                    <td><input name="password" type="password" placeholder="Password"/></td>
                                </tr>
                                <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td>
                                        <label class="checkbox">
                                            <input name="remeberme" type="checkbox" value="1"/> Remember me
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input name="signin" class="btn btn-info" type="submit" value="Sign in"/></td>
                                </tr>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>
