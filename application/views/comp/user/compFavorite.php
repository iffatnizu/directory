<div class="commonpages">
    <div>
        <h2><i class="icon-list"></i> User Favorite List</h2>

        <?php if ($this->session->userdata('userId')) { ?>
            <?php
            if (!empty($favoriteList)) {
                ?>
                <table id="searchResult">
                    <tr>
                        <th>SN</th>
                        <th>Vendor Name</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($favoriteList as $favorite) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>            
                            <td>
                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DETAILS . cpr_encode($favorite[DBConfig::TABLE_FAVORITE_ATT_VENDOR_ID]) . '/' . makeSeoFriendlyUrl($favorite['vendorName'])) ?>">
                                    <?php echo $favorite['vendorName'] ?>
                                </a>
                            </td>
                            <td><?php echo date("dS F Y", $favorite[DBConfig::TABLE_FAVORITE_ATT_FAVORITE_DATE]); ?></td>            
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            } else {
                echo '<h4>You have no favorite vendor. You can add them from vendor profile</h4>';
            }
        }
        ?>
    </div>
</div>
