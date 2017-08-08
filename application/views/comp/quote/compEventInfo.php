<script type="text/javascript" src="<?php echo base_url() ?>script/site/checkbox.js"></script>
<article>
    <div class="container">
        <link rel="stylesheet" href="<?php echo base_url(); ?>script/plugins/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>script/plugins/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
        <div id="dslider">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    <img src="<?php echo base_url(); ?>assets/public/slider/1.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/public/slider/2.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/public/slider/3.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/public/slider/4.jpg" alt=""/>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>script/plugins/nivo-slider/jquery.nivo.slider.js"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            
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
                        $('select[id=city]').html('');
                        $('select[id=city]').append('<option value="" >Please Select ...</option>');
                        $.each(obj, function(key, val) {
                            $('select[id=city]').append('<option value="' + val.cityId + '" >'+ val.cityName+'</option>');
                        });
                    }
                });
            }
            
            function hideThisArea(){
                var ans = confirm('Are you sure?');
                if(ans) {
                    window.location.href='<?php echo site_url(); ?>';
                }
            }
        </script>

        <div class="cateringCategory">
            <?php echo $this->load->view(siteConfig::MOD_LEFT_MENU); ?>
        </div>
        <div class="cateringCategory" id="rightFormArea" style="float: left; margin-left: 340px; width:600px;">
            <div style="float: right; margin-top: 1.5%; cursor: pointer;" onclick="return hideThisArea()">
                <i class="icon-remove btn-danger btn-large"></i>
            </div>
            <h2 style="margin-left: 20px; color: #fff;">Step 1 of <?php echo $this->session->userdata('sizeofStep'); ?>: Event Information</h2>
            <form id="eventForm" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_EVENT_INFO.'/'.$this->session->userdata('eventInfoId')); ?>">
                <table style="color: #fff; margin-left: 20px;">
                    <tr>
                        <td style="width: 200px;">Type of Event:</td>
                        <td>
                            <select name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                                <option value=""></option>
                                <?php
                                if (!empty($allEventType)) {
                                    foreach ($allEventType as $eventType) {
                                        ?>
                                        <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo ($eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID] == $this->session->userdata(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID)) ? 'selected=""' : set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                            <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td style="width: 200px;"><?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?></td>
                    </tr>
                    <tr>
                        <td>If Other please specify:</td>
                        <td><input name="otherEvent" type="text" value="<?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE)) ? $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_OTHER_EVENT_TYPE):set_value('otherEvent'); ?>" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Formal or Casual Event:</td>
                        <td>
                            <select name="eventStatus">
                                <option value=""></option>
                                <option value="1" <?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY) == '1') ? 'selected=""':set_select('eventStatus', '1'); ?>>Black Tie</option>
                                <option value="2" <?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY) == '2') ? 'selected=""':set_select('eventStatus', '2'); ?>>Casual</option>
                                <option value="3" <?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY) == '3') ? 'selected=""':set_select('eventStatus', '3'); ?>>Formal</option>
                                <option value="4" <?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_CATEGORY) == '4') ? 'selected=""':set_select('eventStatus', '4'); ?>>Semiformal</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Name of Event</td>
                        <td><input name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" type="text" value="<?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME)) ? $this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME):set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" /></td>
                        <td><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?></td>
                    </tr>
                    <tr>
                        <td>Event State:</td>
                        <td>
                            <select name="stateId" onchange="getCityByStateId(this.value);">
                                <option value="">Please Select...</option>
                                <?php
                                if (!empty($allState)) {
                                    foreach ($allState as $state) {
                                        ?>
                                        <option value="<?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_ID]; ?>" <?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_STATE_ID) == $state[DBConfig::TABLE_STATE_ATT_STATE_ID]) ? 'selected=""':set_select('stateId', $state[DBConfig::TABLE_STATE_ATT_STATE_ID]) ?>>
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
                        <td>Event Suburb:</td>
                        <td>
                            <select name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>" id="city">
                                <option value="">Select One</option>
                                <?php
                                if (!empty($allCity)) {
                                    foreach ($allCity as $city) {
                                        ?>
                                        <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo ($this->session->userdata(DBConfig::TABLE_EVENT_INFO_ATT_CITY_ID) == $city[DBConfig::TABLE_CITY_ATT_CITY_ID]) ? 'selected=""':set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                            <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?></td>
                    </tr>
                    <tr>                        
                        <td>&nbsp;</td>
                        <td><input name="" class="btn btn-danger" type="submit" value="Next" /></td>
                        <td>&nbsp;</td>                        
                    </tr>
                </table>
            </form>
        </div>

    </div>

    
    
    
</article>