<div id=main role=main>
    <div id=main-content>

        <h1>Set Vendor Default Logo</h1>
        <div style="margin-bottom: 15px;">
            <img width="120" height="120" src="<?php echo base_url().'assets/public/vendor/'.  getDefaultVendorLogo(); ?>" alt="logo"/>
        </div>
        <div>

            <?php
            if ($this->session->userdata('invalidImage')) {
                echo '<p style="color:red">Please Upload A Valid Image</p>';
            }
            $s['invalidImage'] = false;
            $this->session->unset_userdata($s);
            ?>
            
            <?php
            if ($this->session->userdata('uploadsuccess')) {
                echo '<p style="color:green">Vendor Logo Successfully Changed</p>';
            }
            $s['uploadsuccess'] = false;
            $this->session->unset_userdata($s);
            ?>
            <form enctype="multipart/form-data" class="form-change-logo" method="post" action="<?php echo site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SET_VENDOR_LOGO); ?>">
                <input name="userfile" type="file"/>
                <span class="eop" style="color: red;">
                    <?php
                    if ($this->session->userdata('uploaderror')) {
                        echo 'Please select an image for upload';
                    }
                    $s['uploaderror'] = false;
                    $this->session->unset_userdata($s);
                    ?>
                </span>

                <br clear="all"/>
                <br/>
                <input name="Change-Image" class="btn btn-info" type="submit" value="Change  Image"/>
            </form>


        </div>
    </div>
</div>
