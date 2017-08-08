<script type="text/javascript">
    $(document).ready(function(){
        var stateId = $('select[name=stateId]').val();
        getCityByStateId(stateId);
    })
    
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
                var userCity = '<?php echo $userInfo[DBConfig::TABLE_USER_ATT_CITY_ID]; ?>'
                $('select[id=city]').html('');
                $('select[id=city]').append('<option value="" >Select City</option>');
                $.each(obj, function(key, val) {
                    if(userCity == val.cityId) {
                        $('select[id=city]').append('<option value="' + val.cityId + '" selected="">'+ val.cityName+'</option>');
                    } else {
                        $('select[id=city]').append('<option value="' + val.cityId + '" >'+ val.cityName+'</option>');
                    }
                });
            }
        });
    }
</script>
<div class="commonpages">
    <div style="float: left; margin: 20px 50px;">
        <h2>Edit <?php echo $userInfo[DBConfig::TABLE_USER_ATT_NAME]; ?>'s Profile</h2>
        <?php
        if ($this->session->userdata('successUpdateMsg')) {
            echo $this->session->userdata('successUpdateMsg');

            $data['successUpdateMsg'] = FALSE;
            $this->session->unset_userdata($data);
        }
        ?>
        <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE); ?>">
            <table>
                <tr>
                    <td>Name : </td>
                    <td><input type="text" name="<?php echo DBConfig::TABLE_USER_ATT_NAME; ?>" value="<?php echo $userInfo[DBConfig::TABLE_USER_ATT_NAME]; ?>" /></td>
                    <td><?php echo form_error(DBConfig::TABLE_USER_ATT_NAME); ?></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td><input type="text" name="<?php echo DBConfig::TABLE_USER_ATT_EMAIL; ?>" value="<?php echo $userInfo[DBConfig::TABLE_USER_ATT_EMAIL]; ?>" disabled="" /></td>
                    <td><?php //echo form_error(DBConfig::TABLE_USER_ATT_EMAIL);     ?></td>
                </tr>
                <tr>
                    <td>Zip Code:</td>
                    <td><input type="text" name="<?php echo DBConfig::TABLE_USER_ATT_ZIP_CODE; ?>" value="<?php echo $userInfo[DBConfig::TABLE_USER_ATT_ZIP_CODE]; ?>" /></td>
                    <td><?php //echo form_error(DBConfig::TABLE_USER_ATT_ZIP_CODE);   ?></td>
                </tr>
                <tr>
                    <td>State:</td>
                    <td>
                        <select name="<?php echo DBConfig::TABLE_USER_ATT_STATE_ID; ?>" onchange="getCityByStateId(this.value);">
                            <option value="">Please Select...</option>
                            <?php
                            if (!empty($allState)) {
                                foreach ($allState as $state) {
                                    ?>
                                    <option value="<?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_ID]; ?>" <?php echo ($userInfo[DBConfig::TABLE_USER_ATT_STATE_ID] == $state[DBConfig::TABLE_STATE_ATT_STATE_ID]) ? 'selected=""' : ''; ?>>
                                        <?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td><?php echo form_error('stateId'); ?></td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td>
                        <select name="<?php echo DBConfig::TABLE_USER_ATT_CITY_ID; ?>" id="city">
                            <option value="">Select City</option>
                        </select>
                    </td>
                    <td><?php //echo form_error(DBConfig::TABLE_USER_ATT_ZIP_CODE);   ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="" class="btn btn-success btn-primary" value="Update" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>