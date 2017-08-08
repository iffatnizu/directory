<script>
    var reportUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR.SiteConfig::METHOD_VENDOR_SEND_REPORT_FOR_RATING ?>';
</script>
<script src="<?php echo base_url() ?>script/site/reportRating.js" type="text/javascript"></script>
<div class="commonpages">
    <div>
        <h2><i class="icon-star"></i> <?php echo $title ?> </h2>
        <?php
        if (!empty($rating)) {
            ?>

            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            </div>

            <table>
                <tr>
                    <td>User</td>
                    <td>Rating</td>
                    <td>Review</td>
                    <td>Action</td>
                </tr>
                <?php
                //debugPrint($ratingReview);

                foreach ($rating as $row):
                    ?>
                    <tr>
                        <td><?php echo $row['uName'] ?></td>
                        <td>
                            <?php echo $row['ratebar'] ?>
                        </td>
                        <td>

                            <?php echo $row['review'][DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW] ?>
                        </td>
                        <td><a onclick="directory.reportTheRating('<?php echo $row[DBConfig::TABLE_VENDOR_RATING_ATT_RATING_ID] ?>')" href="#myModal" role="button" class="btn btn-small btn-danger" data-toggle="modal">Report</a></td>
                    </tr>

                    <?php
                endforeach;
                ?>
            </table>

            <?php
        }
        else {
            echo '<h4>Not found</h4>';
        }
        ?>
    </div>
</div>