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
                                    <td width="20%">User Name</td>
                                    <td width="25%">E-mail</td>
                                    <td width="15%">Event Name</td>
                                    <td width="15%">Reported Vendor Name</td>
                                    <td width="15%">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($userList as $list) {
                                    ?>

                                    <tr>
                                        <td width="20%"><?php echo $list['usr'][DBConfig::TABLE_USER_ATT_NAME] ?></td>
                                        <td width="25%"><?php echo $list['usr'][DBConfig::TABLE_USER_ATT_EMAIL] ?></td>
                                        <td width="15%"><?php echo $list['eventDetails'][DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] ?></td>
                                        <td width="15%"><?php echo $list['vendor'][DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] ?></td>
                                        <td width="15%">

                                            <?php
                                            if ($list['usr'][DBConfig::TABLE_USER_ATT_STATUS] == "1") {
                                                echo '<a onclick="directory.blockedUser(\'' . $list['usr'][DBConfig::TABLE_USER_ATT_EMAIL] . '\')" href="javascript:;" class="btn btn-small btn-danger">Block</a>';
                                            } else {
                                                echo '<a onclick="directory.unblockedUser(\'' . $list['usr'][DBConfig::TABLE_USER_ATT_EMAIL] . '\')" href="javascript:;" class="btn btn-small btn-success">UnBlock</a>';
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
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
