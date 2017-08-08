<script>
    var cpassUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR.SiteConfig::METHOD_VENDOR_CHANGE_PASSWORD ?>';
</script>
<script src="<?php echo base_url() ?>script/site/vendorChangePassword.js" type="text/javascript"></script>
<div class="commonpages">
    <div> 
        <div class="chpstatus btn-success" style="margin-bottom: 10px;text-align: center;">

        </div>
        
        <div class="chpcontainer">
            <h2><i class="icon-lock"></i> Update password</h2>
            <form class="form-change-pass" method="post">
                <input name="oldpassword" type="password" placeholder="Old Password"/>
                <span class="eop"></span>
                <br clear="all"/>
                <input name="newpassword" type="password" placeholder="New Password"/>
                <span class="enp"></span>
                <br clear="all"/>
                <input name="connewpassword" type="password" placeholder="Confirm New Password"/>
                <span class="ecnp"></span>
                <br clear="all"/>
                <input name="changePassword" class="btn btn-info" type="submit" value="Update Password"/>
            </form>
        </div>

    </div>
</div>
