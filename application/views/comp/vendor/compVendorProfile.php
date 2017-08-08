<div class="commonpages">
    <div>
        <h2><i class="icon-user"></i> User profile </h2>
        <?php
        //debugPrint($userdata);
        ?>
        <table>
            <tr>
                <td>Business Name : </td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_BUSINESS_NAME] ?></td>

            </tr>
            <tr>
                <td>Business Logo : </td>
                <td>
                    <?php
                    if ($userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE]) {
                        $vlogo = base_url() . 'assets/public/vendor/' . $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE];
                    } else {
                        $vlogo = base_url() . 'assets/public/vendor/' . getDefaultVendorLogo();
                    }
                    ?>
                    <img src="<?php echo $vlogo; ?>" alt="logo" width="60" height="60"/>
                </td>

            </tr>
            <tr>
                <td>Name : </td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] ?></td>

            </tr>
            <tr>
                <td>Phone : </td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_PHONE] ?></td>

            </tr>
            <tr>
                <td>Email : </td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL] ?></td>

            </tr>

            <tr>
                <td>State : </td>
                <td><?php echo $userdata['statename'] ?></td>

            </tr>
            <tr>
                <td>City : </td>
                <td><?php echo $userdata['cityname'] ?></td>

            </tr>

            <tr>
                <td>Zip Code:</td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_ZIP] ?></td>

            </tr>
            <tr>
                <td>Address : </td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_ADDRESS] ?></td>
            </tr>

            <tr>
                <td>Web site : </td>
                <td><?php echo $userdata[DBConfig::TABLE_VENDOR_ATT_VENDOR_WEB_URL] ?></td>
            </tr>

            <tr>
                <td colspan="2">
                    Which services i choose : <br/>

<?php
foreach ($userdata['list'] as $val) {
    ?>
                        <?php echo '<i class="icon-ok"></i> ' . $val ?>
                        <br/>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="<?php echo base_url() . SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_EDIT_PROFILE ?>" class="btn btn-info">Edit Profile</a>
                </td>

            </tr>

        </table>
    </div>
</div>