<div class="commonpages">
    <div>
        <h2><i class="icon-user"></i> <?php echo $title ?> : <small><?php echo $stateName ?></small></h2>


        <?php if (!empty($vendorList)) { ?>
            <table id="searchResult">
                <tr>
                    <th>Business Name</th>
                    <th>City</td>
                    <th>State</th>
                    <th>Rating</th>
                </tr>
                <?php foreach ($vendorList as $user) { ?>
                    <tr>
                        <td><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DETAILS . cpr_encode($user[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]) . '/' . makeSeoFriendlyUrl($user[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME])) ?>"><?php echo $user[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME]; ?></a></td>
                        <td><?php echo $user[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?></td>
                        <td><?php echo $user[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?></td>
                        <td>Vote :<?php echo $user['rating']['vote']; ?> <?php echo $user['rating']['ratebar']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>

    </div>
</div>