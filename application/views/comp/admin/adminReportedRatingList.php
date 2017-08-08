<div id=main role=main>
    <div id=main-content>
        <h1><?php echo $title ?></h1>


        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>

                    <link href="<?php echo base_url() ?>script/plugins/datatable/css/demo_table_jui.css" rel="stylesheet" type="text/css"/>
                    <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>

                    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>script/plugins/datatable/js/jquery.js"></script>
                    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>script/plugins/datatable/js/jquery.dataTables.js"></script>
                    <script type="text/javascript" charset="utf-8">
                        $(document).ready(function() {
                            var oTable = $('#example').dataTable( {                               
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers"
                                
                            });
                        } );
                    </script>
                    <style>
                        .ui-icon{
                            float: right;
                            margin-top: 4px;
                        }
                        .dataTables_info{
                            font-size: small;
                        }
                    </style>
                    <div id="dynamic">
                        <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                            <thead>
                                <tr>
                                    <td width="15%">Rate By</td>
                                    <td width="20%">Rating</td>
                                    <td width="20%">Review</td>
                                    <td width="20%">Reported Vendor Name</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($reportedRatings)) {
                                    foreach ($reportedRatings as $row) {
                                        if ($row[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_STATUS] == '0') {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['uName'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ratebar'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['vName'] ?>
                                                </td>
                                                <td>
                                                    <input onclick="directory.deleteRatingReview('<?php echo $row[DBConfig::TABLE_VENDOR_RATING_ATT_VENDOR_ID] ?>','<?php echo $row[DBConfig::TABLE_VENDOR_RATING_ATT_USER_ID] ?>','<?php echo $row[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_ID] ?>');" type="button" class="btn btn-danger" name="delete" value="Delete"/>
                                                    <input onclick="directory.reportMarkAsInvalid('<?php echo $row[DBConfig::TABLE_VENDOR_REPORT_RATING_ATT_REPORT_ID] ?>');" type="button" class="btn btn-warning" name="invalid" value="Report is invalid"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
