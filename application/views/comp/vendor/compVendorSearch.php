<script type="text/javascript">
    function getCityByStateId(stateId) {
        $.ajax({
            type: "POST",
            url: '<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_GET_CITY_BY_STATE_ID); ?>',
            data: {
                stateId:stateId
            },
            success: function(data) {
                //alert(data);
                var obj = jQuery.parseJSON(data);
                //alert(obj[0].value);
                $('select[name=vendorCityId]').html('');
                $('select[name=vendorCityId]').append('<option value="" >Select City</option>');
                $.each(obj, function(key, val) {
                    $('select[name=vendorCityId]').append('<option value="' + val.cityId + '" >'+ val.cityName+'</option>');
                });
            }
        });
    }
</script>
<div class="commonpages">
    <div>
        <h2><i class="icon-search"></i> Search local vendors for your event</h2>
        <form method="get" action="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_SEARCH); ?>">
            <table>
                <tr>
                    <td colspan="2">
                        Select a State in the field :

                        <select id="vendor" name="<?php echo DBConfig::TABLE_VENDOR_ATT_VENDOR_STATE_ID; ?>" onchange="getCityByStateId(this.value)">
                            <option value="">Select One</option>
                            <?php
                            if (!empty($allState)) {
                                foreach ($allState as $state) {
                                    ?>
                                    <option value="<?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_ID]; ?>">
                                        <?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Select a City in the field :

                        <select id="vendor" name="<?php echo DBConfig::TABLE_VENDOR_ATT_VENDOR_CITY_ID; ?>">
                            <option value="">Select City</option>
                        </select>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="searchVendor" value="Search" class="btn btn-large btn-success"/></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
        <link href="<?php echo base_url() ?>script/plugins/datatable/css/demo_table_jui.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>script/plugins/datatable/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                var oTable = $('#searchResult').dataTable( {                               
                    "bJQueryUI": false,
                    "sPaginationType": "full_numbers",
                    "aaSorting": []
                    
                });
            } );
        </script>
        <?php
        //debugPrint($userList);
        ?>
        <?php if (!empty($userList)) { ?>
        <h3><i class="icon-cogs"></i> Search Result : <small><?php echo $stateName ?>-><?php echo $cityName ?></small></h3>
            <table id="searchResult" style="float: left;">
                <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>City</td>
                        <th>State</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userList as $user) { ?>
                        <tr>
                            <td><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DETAILS . cpr_encode($user[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]) . '/' . makeSeoFriendlyUrl($user[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME])) ?>"><?php echo $user[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME]; ?></a></td>
                            <td><?php echo $user[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?></td>
                            <td><?php echo $user[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?></td>
                            <td>Vote :<?php echo $user['rating']['vote']; ?> <?php echo $user['rating']['ratebar']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>