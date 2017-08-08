<div class="commonpages">
    <div>
        <?php if ($this->session->userdata('eventSuccess')) { ?>
            <br clear="all"/>
            <div class="loginstatus btn-success" style="margin-bottom: 10px;text-align: center;">
                <h3>You event successfully added.</h3>
            </div>
            <?php
            $data['eventSuccess'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <br clear="all"/>
        <div>
            <?php if ($this->session->userdata('eventInfoId')) { ?>
            <h4>Need to edit services <i class="icon-question"></i> go back </h4>
                <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ADD_REMOVE_SERVICES); ?>">
                    <input name="" class="btn btn-danger" type="button" value="Back To Edit Services" />
                </a>
            <?php } ?>
        </div>


        <?php if ($this->session->userdata('loginSuccess')) { ?>
            <div class="loginstatus btn-success" style="margin-bottom: 10px;text-align: center;">
                <?php //echo $this->session->userdata('loginSuccess'); ?>
            </div>
            <?php
            $data['loginSuccess'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <?php if ($this->session->userdata('loginBlocked')) { ?>
            <div class="loginstatus btn-warning" style="margin-bottom: 10px;text-align: center;">
                <?php echo $this->session->userdata('loginBlocked'); ?>
            </div>
            <?php
            $data['loginBlocked'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <?php if ($this->session->userdata('loginError')) { ?>
            <div class="loginstatus btn-danger" style="margin-bottom: 10px;text-align: center;">
                <?php echo $this->session->userdata('loginError'); ?>
            </div>
            <?php
            $data['loginError'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <?php if ($this->session->userdata('successMsg')) { ?>
            <div class="loginstatus btn-success" style="margin-bottom: 10px;text-align: center;">
                <?php echo $this->session->userdata('successMsg'); ?>
            </div>
            <?php
            $data['successMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <?php if (!$this->session->userdata('userId')) { ?>
            <img src="<?php echo base_url() ?>assets/images/Keys-icon.png" alt="keys" style="float: left;"/>
            <div class="signincontainer" style="width: 45%;">
                <h2><i class="icon-lock"></i> Please sign in</h2>
                <form class="" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN); ?>">
                    <table>
                        <tr>
                            <td><input type="text" name="<?php echo DBConfig::TABLE_USER_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_USER_ATT_EMAIL); ?>"  placeholder="Email address" /></td>
                            <td><?php echo form_error(DBConfig::TABLE_USER_ATT_EMAIL); ?></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="<?php echo DBConfig::TABLE_USER_ATT_PASSWORD; ?>" value="<?php echo set_value(DBConfig::TABLE_USER_ATT_PASSWORD); ?>" placeholder="Password" /></td>
                            <td><?php echo form_error(DBConfig::TABLE_USER_ATT_PASSWORD); ?></td>
                        </tr>
                    </table>
                    <label class="checkbox">
                        <input name="remeberme" type="checkbox" value="1"/> Remember me
                    </label>
                    <input name="signin" class="btn btn-primary" type="submit" value="Sign in"/>
                </form>
            </div>

            <div class="signincontainer">
                <a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGNUP); ?>" style="font-size: 14px;">
                    Not registered yet?
                </a>
            </div>
        <?php }
        ?>
    </div>
</div>
