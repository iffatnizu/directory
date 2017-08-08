<header>
    <div id="headerLogo">
        <div class="logo">
            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo" title="<?php //echo $title                          ?>"/></a>
            <span class="slogan">Your Local Catering</span>
        </div>
        <div class="contactandsearch" style="margin-left: 70px;">
            <div class="iconphone">
                &nbsp;
            </div>
            <div class="contactDetails">
                One Call Gets All Your Party Needs<br/>
                <span>1-555-555-555</span>
            </div>
        </div>
        <div class="logingetlisted">
            <?php if ($this->session->userdata('userLogin')) { ?>
                <ul class="nav nav-pills" style="float: left;">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;" style="font-weight: bold;"><i class="icon-user"></i> My Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE); ?>"><i class="icon-edit"></i> Edit Profile</a></li>
                            <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_CHANGE_PASSWORD); ?>"><i class="icon-edit"></i> Change Password</a></li>
                            <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_MANAGE_RATING); ?>"><i class="icon-bookmark"></i> Rating and Review </a></li>
                        </ul>
                    </li>
                </ul>
                <?php
            }
            ?>
            <ul id="usermenu" style="margin-left: 4px;">
                <?php if ($this->session->userdata('userLogin')) { ?>

                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_FAVORITE) ?>"><i class="icon-bookmark"></i> Favorite</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_INBOX) ?>"><i class="icon-envelope"></i> Inbox</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOG_OUT) ?>"><i class="icon-signout"></i> Logout</a></li>
                    <?php
                } else if (!$this->session->userdata('userLogin')) {
                    ?>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN) ?>"><i class="icon-key"></i> User Login</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGNUP) ?>"><i class="icon-lock"></i> User Signup</a></li>
                    <?php
                }
                ?>
                <?php
                if ($this->session->userdata('_userLogin')){
                    ?>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR) ?>"><i class="icon-dashboard"></i> Vendor Panel</a></li>
                    <?php
                }
                ?>
                <?php
                if (!$this->session->userdata('_userLogin') && !$this->session->userdata('userLogin')) {
                    ?>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_LOGIN) ?>"><i class="icon-lock"></i> Vendor Login</a></li>

                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_REGISTRATION) ?>"><i class="icon-key"></i> Get Listed</a></li>
                    <?php
                } else if ($this->session->userdata('_userLogin')) {
                    ?>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="navbar">
            <div class="menubar">
                <ul>
                    <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_HOW_IT_WORKS); ?>">How it Works</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DIRECTORY); ?>">Directory</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_ABOUT); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_FAQ); ?>">FAQ</a></li>
                    <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_CONTACT); ?>">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>