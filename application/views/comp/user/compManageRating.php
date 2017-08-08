<script>
    var updateVendorRatingReviewUrl = '<?php echo SiteConfig::CONTROLLER_USER.SiteConfig::METHOD_USER_UPDATE_VENDOR_RATING_REVIEW ?>';
</script>
<script src="<?php echo base_url() ?>script/site/userRating.js" type="text/javascript"></script>
<div class="commonpages">
    <div>
        <h2><i class="icon-list"></i> Manage Rating</h2>

        <?php
        if (!empty($ratingReview)){
        ?>
        <table>
            <tr>
                <td>Vendor</td>
                <td>Rating</td>
                <td>Review</td>
                <td>Action</td>
            </tr>
            <?php
            
                foreach ($ratingReview as $row):
                    ?>
                    <tr>
                        <td><?php echo $row['vName'] ?></td>
                        <td style="width: 120px;">
                            <?php
                            for ($i = 1; $i <= 5; $i++):
                                $checked = "";
                                if ($row[DBConfig::TABLE_VENDOR_RATING_ATT_RATING] == $i):
                                    $checked = 'checked="checked"';

                                endif;
                                ?>
                            <span class="drate"><?php echo $i ?> <input style="margin: -16px 0 0 3px;" <?php echo $checked ?> type="radio" name="rating_<?php echo $row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] ?>" value="<?php echo $i ?>"/></span>

                                <?php
                            endfor;
                            ?>
                        </td>
                        <td>
                            
                            <textarea style="height: 63px;width: 532px;" name="review_<?php echo $row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] ?>"><?php echo $row['review'][DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW] ?></textarea>
                        </td>
                        <td><input type="button" name="update" class="btn btn-small btn-success" value="Update" onclick="directory.updateVendorRatingReview('<?php echo $row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] ?>')"/></td>
                    </tr>

                    <?php
                endforeach;
            ?>
        </table>
        <?php
        }
        else {
            echo '<h4>You did give any rating to vendor. You can rate them from vendor profile</h4>';
        }
        ?>
    </div>
</div>
