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
        </script>
        <div class="tab">
            <div class="tabbar">
                <?php echo $this->load->view(siteConfig::MOD_TOP_MENUS); ?>
            </div>
            <div class="taboption">
                <br clear="all"/>
                <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
                <script src="<?php echo base_url(); ?>script/core/jquery-ui.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        var today = new Date();
                        var tomorrow = new Date();
                        tomorrow.setDate(today.getDate()+1);
                        var pickerOpts = {
                            minDate: tomorrow,
                            dateFormat: 'yy-mm-dd'
                        };
                    
                        $("#eventDate").datepicker(pickerOpts);
                        $("#recepEventDate").datepicker(pickerOpts);
                        $("#enterEventDate").datepicker(pickerOpts);
                        $("#florEventDate").datepicker(pickerOpts);
                        $("#photoEventDate").datepicker(pickerOpts);
                        $("#limoEventDate").datepicker(pickerOpts);
                    });
                            
                    function showCateringForm(){
                        $('#catering').show();
                        $('#receptionHall').hide();
                        $('#entertainers').hide();
                        $('#florists').hide();
                        $('#photographers').hide();
                        $('#limousine').hide();
                                
                        $('li').removeClass('active');
                        $('li').removeClass('active1');
                        $('li').removeClass('active2');
                        $('li#cateringMenu').addClass('active');
                    }
                    function showReceptionForm(){
                        $('#catering').hide();
                        $('#receptionHall').show();
                        $('#entertainers').hide();
                        $('#florists').hide();
                        $('#photographers').hide();
                        $('#limousine').hide();
                                
                        $('li').removeClass('active');
                        $('li').removeClass('active1');
                        $('li').removeClass('active2');
                        $('li.receptionMenu').addClass('active2');
                    }
                    function showEntertainersForm(){
                        $('#catering').hide();
                        $('#receptionHall').hide();
                        $('#entertainers').show();
                        $('#florists').hide();
                        $('#photographers').hide();
                        $('#limousine').hide();
                                
                        $('li').removeClass('active');
                        $('li').removeClass('active1');
                        $('li').removeClass('active2');
                        $('li.entertainersMenu').addClass('active2');
                    }
                    function showFloristsForm(){
                        $('#catering').hide();
                        $('#receptionHall').hide();
                        $('#entertainers').hide();
                        $('#florists').show();
                        $('#photographers').hide();
                        $('#limousine').hide();
                                
                        $('li').removeClass('active');
                        $('li').removeClass('active1');
                        $('li').removeClass('active2');
                        $('li#floristsMenu').addClass('active');
                    }
                    function showPhotographersForm(){
                        $('#catering').hide();
                        $('#receptionHall').hide();
                        $('#entertainers').hide();
                        $('#florists').hide();
                        $('#photographers').show();
                        $('#limousine').hide();
                                
                        $('li').removeClass('active');
                        $('li').removeClass('active1');
                        $('li').removeClass('active2');
                        $('li.photographersMenu').addClass('active');
                    }
                    function showLimosForm(){
                        $('#catering').hide();
                        $('#receptionHall').hide();
                        $('#entertainers').hide();
                        $('#florists').hide();
                        $('#photographers').hide();
                        $('#limousine').show();
                                
                        $('li').removeClass('active');
                        $('li').removeClass('active1');
                        $('li').removeClass('active2');
                        $('li#limosMenu').addClass('active');
                    }
                            
                    function validateCateringFrom(){
                        var eventDate = $('#eventDate').val();
                        var catEventCity = $('select#catEventCity option:selected').val();
                        var catEventType = $('select#catEventType option:selected').val();
                        var catGuestNumber = $('#catGuestNumber').val();
                        var catName = $('#catName').val();
                        var catCcode = $('#catCcode').val();
                        var catPcode = $('#catPcode').val();
                        var catPhone = $('#catPhone').val();
                        var catEmail = $('#catEmail').val();
                        //                        alert();
                        var error = 0;
                                
                        if(eventDate == '') {
                            $('#eventDate').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#eventDate').css('border','1px solid #ccc');
                        }
                                
                        if(catEventCity == '') {
                            $('#catEventCity').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catEventCity').css('border','1px solid #ccc');
                        }
                                
                        if(catEventType == '') {
                            $('#catEventType').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catEventType').css('border','1px solid #ccc');
                        }
                                
                        if(isNaN(parseInt(catGuestNumber)) || catGuestNumber == '') {
                            $('#catGuestNumber').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catGuestNumber').css('border','1px solid #ccc');
                        }
                                
                        if(catName == '') {
                            $('#catName').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catName').css('border','1px solid #ccc');
                        }
                                
                        if(isNaN(catCcode) || catCcode == '') {
                            $('#catCcode').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catCcode').css('border','1px solid #ccc');
                        }
                                
                        if(isNaN(catPcode) || catPcode == '') {
                            $('#catPcode').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catPcode').css('border','1px solid #ccc');
                        }
                                
                        if(isNaN(catPhone) || catPhone == '') {
                            $('#catPhone').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catPhone').css('border','1px solid #ccc');
                        }
                                
                        if(!isValidEmail(catEmail) || catEmail == '') {
                            $('#catEmail').css('border','1px solid #f00');
                            error = 1;
                        } else {
                            $('#catEmail').css('border','1px solid #ccc');
                        }
                                
                        if(error == 1) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                            
                    function isValidEmail(emailAddress) {
                        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        return re.test(emailAddress);
                    }
                </script>
                <div id="catering">
                    <form style="margin: 0px;" onsubmit="return validateCateringFrom();" action="<?php echo site_url(SiteConfig::CONTROLLER_CATERING . SiteConfig::METHOD_CATERING_GET_QUOTES); ?>" method="post">
                        <table class="">
                            <tr>
                                <th>Date of Event:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="eventDate" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_DATE; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Event City:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>" id="catEventCity">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allCity)) {
                                            foreach ($allCity as $city) {
                                                ?>
                                                <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                                    <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table>
                            <tr>
                                <th>Event Type:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="catEventType" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allEventType)) {
                                            foreach ($allEventType as $eventType) {
                                                ?>
                                                <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                                    <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Guests:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="catGuestNumber" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="">
                            <tr>
                                <th>Event Location :</th>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" checked="" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION; ?>" value="1" <?php echo set_radio(DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION, '1'); ?> />
                                    I need a location<br/>
                                    <input type="radio" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION; ?>" value="2" <?php echo set_radio(DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION, '2'); ?> />
                                    I already have a location
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;<?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION); ?></td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="info">
                            <tr>
                                <th valign="top">Name :</th>
                                <td>&nbsp;<input type="text" id="catName" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Phone :</th>
                                <td>&nbsp;<input type="text" id="catCcode" maxlength="3" name="cCode" style="width: 25px;" /> 
                                    <input type="text" maxlength="3" id="catPcode" name="pCode" style="width: 25px;"/> 
                                    <input type="text" maxlength="4" id="catPhone" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                    Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Email :</th>
                                <td>&nbsp;<input type="text" id="catEmail" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                                </td>
                            </tr>

                        </table>
                        <br clear="all"/>
                        <input type="submit" name="advsearch" value="Get Catering Quotes Now"/>
                    </form>
                </div>
                <div id="receptionHall" style="display: none;">
                    <script type="text/javascript">
                                
                        function validateReceptionFrom(){
                            var recepEventDate = $('#recepEventDate').val();
                            var recepCityId = $('select#recepCityId option:selected').val();
                            var recepEventType = $('select#recepEventType option:selected').val();
                            var recepGuestNumber = $('#recepGuestNumber').val();
                            var recepBudget = $('select#recepBudget option:selected').val();
                            var recepName = $('#recepName').val();
                            var recepCcode = $('#recepCcode').val();
                            var recepPcode = $('#recepPcode').val();
                            var recepPhone = $('#recepPhone').val();
                            var recepEmail = $('#recepEmail').val();
                            //                        alert();
                            var error = 0;
                                
                            if(recepEventDate == '') {
                                $('#recepEventDate').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepEventDate').css('border','1px solid #ccc');
                            }
                                
                            if(recepCityId == '') {
                                $('#recepCityId').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepCityId').css('border','1px solid #ccc');
                            }
                                
                            if(recepEventType == '') {
                                $('#recepEventType').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepEventType').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(parseInt(recepGuestNumber)) || recepGuestNumber == '') {
                                $('#recepGuestNumber').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepGuestNumber').css('border','1px solid #ccc');
                            }
                                    
                            if(recepBudget == '') {
                                $('#recepBudget').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepBudget').css('border','1px solid #ccc');
                            }
                                    
                            if(recepName == '') {
                                $('#recepName').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepName').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(recepCcode) || recepCcode == '') {
                                $('#recepCcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepCcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(recepPcode) || recepPcode == '') {
                                $('#recepPcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepPcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(recepPhone) || recepPhone == '') {
                                $('#recepPhone').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepPhone').css('border','1px solid #ccc');
                            }
                                
                            if(!isValidEmail(recepEmail) || recepEmail == '') {
                                $('#recepEmail').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#recepEmail').css('border','1px solid #ccc');
                            }
                                
                            if(error == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <form method="post" onsubmit="return validateReceptionFrom();" action="<?php echo site_url(SiteConfig::CONTROLLER_RECEPTION . SiteConfig::METHOD_RECEPTION_HALLS); ?>">
                        <table class="">
                            <tr>
                                <th>Date of Event:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="recepEventDate" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_DATE; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Event City:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>" id="recepCityId">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allCity)) {
                                            foreach ($allCity as $city) {
                                                ?>
                                                <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                                    <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table>
                            <tr>
                                <th>Event Type:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>" id="recepEventType">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allEventType)) {
                                            foreach ($allEventType as $eventType) {
                                                ?>
                                                <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                                    <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Guests:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="recepGuestNumber" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="">
                            <tr>
                                <th>Budget for Venue:</th>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="<?php echo DBConfig::TABLE_EVENT_ATT_VENUE_BUDGET_ID; ?>" id="recepBudget" style="width: 170px;">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allBudget)) {
                                            foreach ($allBudget as $budget) {
                                                ?>
                                                <option value="<?php echo $budget[DBConfig::TABLE_VENUE_BUDGET_ATT_VENUE_BUDGET_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_VENUE_BUDGET_ID, $budget[DBConfig::TABLE_VENUE_BUDGET_ATT_VENUE_BUDGET_ID]); ?>>
                                                    <?php echo $budget[DBConfig::TABLE_VENUE_BUDGET_ATT_BUDGET_RANGE]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_VENUE_BUDGET_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="info">
                            <tr>
                                <th valign="top">Name :</th>
                                <td>&nbsp;<input type="text" id="recepName" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Phone:</th>
                                <td>&nbsp;<input type="text" maxlength="3" id="recepCcode" name="cCode" style="width: 25px;" /> 
                                    <input type="text" maxlength="3" id="recepPcode" name="pCode" style="width: 25px;"/> 
                                    <input type="text" maxlength="4" id="recepPhone" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                    Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                                </td>
                            </tr>                    
                            <tr>
                                <th valign="top">Email:</th>
                                <td>&nbsp;<input type="text" id="recepEmail" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                                </td>
                            </tr>
                        </table>
                        <br clear="all"/>
                        <input type="submit" name="advsearch" value="Get Venue Quotes"/>
                    </form>
                </div>
                <div id="entertainers" style="display: none;">
                    <script type="text/javascript">
                                
                        function validateEntertainersFrom(){
                            var enterEventDate = $('#enterEventDate').val();
                            var enterCityId = $('select#enterCityId option:selected').val();
                            var enterEventType = $('select#enterEventType option:selected').val();
                            var enterGuestNumber = $('#enterGuestNumber').val();
                            var enterName = $('#enterName').val();
                            var enterCcode = $('#enterCcode').val();
                            var enterPcode = $('#enterPcode').val();
                            var enterPhone = $('#enterPhone').val();
                            var enterEmail = $('#enterEmail').val();
                            //                        alert();
                            var error = 0;
                                
                            if(enterEventDate == '') {
                                $('#enterEventDate').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterEventDate').css('border','1px solid #ccc');
                            }
                                
                            if(enterCityId == '') {
                                $('#enterCityId').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterCityId').css('border','1px solid #ccc');
                            }
                                
                            if(enterEventType == '') {
                                $('#enterEventType').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterEventType').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(parseInt(enterGuestNumber)) || enterGuestNumber == '') {
                                $('#enterGuestNumber').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterGuestNumber').css('border','1px solid #ccc');
                            }
                                    
                            if(enterName == '') {
                                $('#enterName').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterName').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(enterCcode) || enterCcode == '') {
                                $('#enterCcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterCcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(enterPcode) || enterPcode == '') {
                                $('#enterPcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterPcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(enterPhone) || enterPhone == '') {
                                $('#enterPhone').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterPhone').css('border','1px solid #ccc');
                            }
                                
                            if(!isValidEmail(enterEmail) || enterEmail == '') {
                                $('#enterEmail').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#enterEmail').css('border','1px solid #ccc');
                            }
                                
                            if(error == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <form onsubmit="return validateEntertainersFrom()" action="<?php echo site_url(SiteConfig::CONTROLLER_ENTERTAINERS . SiteConfig::METHOD_ENTERTAINERS_DJS); ?>" method="post">
                        <table class="">
                            <tr>
                                <th>Date of Event:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="enterEventDate" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_DATE; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Event City:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="enterCityId" name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allCity)) {
                                            foreach ($allCity as $city) {
                                                ?>
                                                <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                                    <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table>
                            <tr>
                                <th>Event Type:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="enterEventType" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allEventType)) {
                                            foreach ($allEventType as $eventType) {
                                                ?>
                                                <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                                    <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Guests:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input id="enterGuestNumber" type="text" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="">
                            <tr>
                                <th>Start Time:</th>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="hours" style="width: 55px;">
                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>">
                                                <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <select name="minute" style="width: 55px;">
                                        <?php for ($j = 0; $j < 60; $j++) { ?>
                                            <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>">
                                                <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <select name="extension" style="width: 60px;">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;<?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_LOCATION); ?></td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="info">
                            <tr>
                                <th valign="top">Name :</th>
                                <td>&nbsp;<input type="text" id="enterName" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Phone :</th>
                                <td>&nbsp;<input type="text" maxlength="3" id="enterCcode" name="cCode" style="width: 25px;" /> 
                                    <input type="text" maxlength="3" id="enterPcode" name="pCode" style="width: 25px;"/> 
                                    <input type="text" maxlength="4" id="enterPhone" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                    Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Email :</th>
                                <td>&nbsp;<input type="text" id="enterEmail" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                                </td>
                            </tr>

                        </table>
                        <br clear="all"/>
                        <input type="submit" name="advsearch" value="Get DJ / Entertainers Quotes"/>
                    </form>
                </div>
                <div id="florists" style="display: none;">
                    <script type="text/javascript">
                                
                        function validateFloristsFrom(){
                            var florEventDate = $('#florEventDate').val();
                            var florCityId = $('select#florCityId option:selected').val();
                            var florEventType = $('select#florEventType option:selected').val();
                            var florGuestNumber = $('#florGuestNumber').val();
                            var florName = $('#florName').val();
                            var florCcode = $('#florCcode').val();
                            var florPcode = $('#florPcode').val();
                            var florPhone = $('#florPhone').val();
                            var florEmail = $('#florEmail').val();
                            //                        alert();
                            var error = 0;
                                
                            if(florEventDate == '') {
                                $('#florEventDate').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florEventDate').css('border','1px solid #ccc');
                            }
                                
                            if(florCityId == '') {
                                $('#florCityId').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florCityId').css('border','1px solid #ccc');
                            }
                                
                            if(florEventType == '') {
                                $('#florEventType').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florEventType').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(parseInt(florGuestNumber)) || florGuestNumber == '') {
                                $('#florGuestNumber').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florGuestNumber').css('border','1px solid #ccc');
                            }
                                    
                            if(florName == '') {
                                $('#florName').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florName').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(florCcode) || florCcode == '') {
                                $('#florCcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florCcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(florPcode) || florPcode == '') {
                                $('#florPcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florPcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(florPhone) || florPhone == '') {
                                $('#florPhone').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florPhone').css('border','1px solid #ccc');
                            }
                                
                            if(!isValidEmail(florEmail) || florEmail == '') {
                                $('#florEmail').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#florEmail').css('border','1px solid #ccc');
                            }
                                
                            if(error == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <form onsubmit="return validateFloristsFrom();" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_FLORISTS . SiteConfig::METHOD_FLORISTS_REQUEST); ?>">
                        <table class="">
                            <tr>
                                <th>Date of Event:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="florEventDate" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_DATE; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Event City:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="florCityId" name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allCity)) {
                                            foreach ($allCity as $city) {
                                                ?>
                                                <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                                    <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table>
                            <tr>
                                <th>Event Type:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="florEventType" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allEventType)) {
                                            foreach ($allEventType as $eventType) {
                                                ?>
                                                <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                                    <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Guests:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="florGuestNumber" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="info">
                            <tr>
                                <th valign="top">Name :</th>
                                <td>&nbsp;<input type="text" id="florName" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Phone :</th>
                                <td>&nbsp;<input type="text" id="florCcode" maxlength="3" name="cCode" style="width: 25px;" /> 
                                    <input type="text" maxlength="3" id="florPcode" name="pCode" style="width: 25px;"/> 
                                    <input type="text" maxlength="4" id="florPhone" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                    Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Email :</th>
                                <td>&nbsp;<input type="text" id="florEmail" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                                </td>
                            </tr>

                        </table>
                        <br clear="all"/>
                        <input type="submit" name="advsearch" value="Get Florists Quotes"/>
                    </form>
                </div>
                <div id="photographers" style="display: none;">
                    <script type="text/javascript">
                                
                        function validatePhotographersFrom(){
                            var photoEventDate = $('#photoEventDate').val();
                            var photoCityId = $('select#photoCityId option:selected').val();
                            var photoEventType = $('select#photoEventType option:selected').val();
                            var photoGuestNumber = $('#photoGuestNumber').val();
                            var photoName = $('#photoName').val();
                            var photoCcode = $('#photoCcode').val();
                            var photoPcode = $('#photoPcode').val();
                            var photoPhone = $('#photoPhone').val();
                            var photoEmail = $('#photoEmail').val();
                            //                        alert();
                            var error = 0;
                                
                            if(photoEventDate == '') {
                                $('#photoEventDate').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoEventDate').css('border','1px solid #ccc');
                            }
                                
                            if(photoCityId == '') {
                                $('#photoCityId').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoCityId').css('border','1px solid #ccc');
                            }
                                
                            if(photoEventType == '') {
                                $('#photoEventType').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoEventType').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(parseInt(photoGuestNumber)) || photoGuestNumber == '') {
                                $('#photoGuestNumber').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoGuestNumber').css('border','1px solid #ccc');
                            }
                                    
                            if(photoName == '') {
                                $('#photoName').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoName').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(photoCcode) || photoCcode == '') {
                                $('#photoCcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoCcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(photoPcode) || photoPcode == '') {
                                $('#photoPcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoPcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(photoPhone) || photoPhone == '') {
                                $('#photoPhone').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoPhone').css('border','1px solid #ccc');
                            }
                                
                            if(!isValidEmail(photoEmail) || photoEmail == '') {
                                $('#photoEmail').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#photoEmail').css('border','1px solid #ccc');
                            }
                                
                            if(error == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <form onsubmit="return validatePhotographersFrom();" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_PHOTOGRAPHERS . SiteConfig::METHOD_PHOTOGRAPHERS_PHOTOGRAPHY); ?>">
                        <table class="">
                            <tr>
                                <th>Date of Event:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="photoEventDate" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_DATE; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Event City:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="photoCityId" name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allCity)) {
                                            foreach ($allCity as $city) {
                                                ?>
                                                <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                                    <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table>
                            <tr>
                                <th>Event Type:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="photoEventType" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allEventType)) {
                                            foreach ($allEventType as $eventType) {
                                                ?>
                                                <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                                    <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Guests:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="photoGuestNumber" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="info">
                            <tr>
                                <th valign="top">Name :</th>
                                <td>&nbsp;<input type="text" id="photoName" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Phone :</th>
                                <td>&nbsp;<input type="text" id="photoCcode" maxlength="3" name="cCode" style="width: 25px;" /> 
                                    <input type="text" maxlength="3" id="photoPcode" name="pCode" style="width: 25px;"/> 
                                    <input type="text" maxlength="4" id="photoPhone" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                    Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Email :</th>
                                <td>&nbsp;<input type="text" id="photoEmail" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                                </td>
                            </tr>

                        </table>
                        <br clear="all"/>
                        <input type="submit" name="advsearch" value="Get Photographers Quotes"/>
                    </form>
                </div>
                <div id="limousine" style="display: none;">
                    <script type="text/javascript">
                                
                        function validateLimousineFrom(){
                            var limoEventDate = $('#limoEventDate').val();
                            var limoCityId = $('select#limoCityId option:selected').val();
                            var limoEventType = $('select#limoEventType option:selected').val();
                            var limoGuestNumber = $('#limoGuestNumber').val();
                            var limoName = $('#limoName').val();
                            var limoCcode = $('#limoCcode').val();
                            var limoPcode = $('#limoPcode').val();
                            var limoPhone = $('#limoPhone').val();
                            var limoEmail = $('#limoEmail').val();
                            //                        alert();
                            var error = 0;
                                
                            if(limoEventDate == '') {
                                $('#limoEventDate').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoEventDate').css('border','1px solid #ccc');
                            }
                                
                            if(limoCityId == '') {
                                $('#limoCityId').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoCityId').css('border','1px solid #ccc');
                            }
                                
                            if(limoEventType == '') {
                                $('#limoEventType').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoEventType').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(parseInt(limoGuestNumber)) || limoGuestNumber == '') {
                                $('#limoGuestNumber').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoGuestNumber').css('border','1px solid #ccc');
                            }
                                    
                            if(limoName == '') {
                                $('#limoName').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoName').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(limoCcode) || limoCcode == '') {
                                $('#limoCcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoCcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(limoPcode) || limoPcode == '') {
                                $('#limoPcode').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoPcode').css('border','1px solid #ccc');
                            }
                                
                            if(isNaN(limoPhone) || limoPhone == '') {
                                $('#limoPhone').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoPhone').css('border','1px solid #ccc');
                            }
                                
                            if(!isValidEmail(limoEmail) || limoEmail == '') {
                                $('#limoEmail').css('border','1px solid #f00');
                                error = 1;
                            } else {
                                $('#limoEmail').css('border','1px solid #ccc');
                            }
                                
                            if(error == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <form onsubmit="return validateLimousineFrom();" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_LIMOS . SiteConfig::METHOD_LIMOS_LIMOUSINE); ?>">
                        <table class="">
                            <tr>
                                <th>Date of Event:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="limoEventDate" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_DATE; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_DATE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Event City:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="limoCityId" name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allCity)) {
                                            foreach ($allCity as $city) {
                                                ?>
                                                <option value="<?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_CITY_ID, $city[DBConfig::TABLE_CITY_ATT_CITY_ID]); ?>>
                                                    <?php echo $city[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table>
                            <tr>
                                <th>Event Type:</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="limoEventType" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                                        <option value="">Select One</option>
                                        <?php
                                        if (!empty($allEventType)) {
                                            foreach ($allEventType as $eventType) {
                                                ?>
                                                <option value="<?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID]); ?>>
                                                    <?php echo $eventType[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Number of Guests:</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" id="limoGuestNumber" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>
                                </td>
                            </tr>
                        </table>
                        <span class="separator"></span>
                        <table class="info">
                            <tr>
                                <th valign="top">Name :</th>
                                <td>&nbsp;<input type="text" id="limoName" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                                    <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Phone :</th>
                                <td>&nbsp;<input type="text" id="limoCcode" maxlength="3" name="cCode" style="width: 25px;" /> 
                                    <input type="text" maxlength="3" id="limoPcode" name="pCode" style="width: 25px;"/> 
                                    <input type="text" maxlength="4" id="limoPhone" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                    Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">Email :</th>
                                <td>&nbsp;<input type="text" id="limoEmail" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                                    <br />
                                    <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                                </td>
                            </tr>

                        </table>
                        <br clear="all"/>
                        <input type="submit" name="advsearch" value="Get Limousines Quotes"/>
                    </form>
                </div>
            </div>
        </div>




    </div>

    <div class="container">
        <div class="cateringEvent">
            <div class="catering">
                <img src="<?php echo base_url() ?>assets/images/pic_1.png" alt="wed"/>
                <h3>Catering and events article</h3>
                <p>
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
            </div>
            <div class="events">
                <img src="<?php echo base_url() ?>assets/images/pic_2.png" alt="wed"/>
                <h3>Save on catering</h3>
                <p>
                    Sign up for weekly<br/> catering specials.
                </p>

                <ul>
                    <li><i class="icon-circle-arrow-right"></i> Box Lunch Special</li>
                    <li><i class="icon-circle-arrow-right"></i> Great Deals On Hors</li>
                    <li><i class="icon-circle-arrow-right"></i> Corporate Discount</li>
                </ul>

                <a onclick="directory.subscribeNow()" href="javascript:void(0)" class="btn btn-large btn-info">Subscribe Now <i class="icon-mail-forward"></i></a>
                <div id="boxes">
                    <div class="window" id="weekly-catering-specials">
                        <div class="close_button"><a class="btn btn-danger" href="javascript:;" onclick="directory.removeSubscribe()"><i class="icon-remove"></i></a></div>
                        <h2>Sign up for weekly catering specials</h2>
                        <div class="weekly-specials-content">
                            <ul class="weekly-left-panel">   
                                <li>Box Lunch Specials</li>
                                <li>Great deals on Hors d'oeuvres</li>
                                <li>Corporate Discounts</li>
                            </ul>
                            <br clear="all"/>
                            <form method="post" action="" name="subscribe">
                                <ul class="weekly-right-panel">
                                    <li class="weekly-rightpanel-textbox">
                                        First Name:<br>
                                        <input type="text" class="textbox" name="txtFirstName"/>
                                        <span class="ferror"></span>
                                    </li>
                                    <li class="weekly-rightpanel-textbox">
                                        Email:<br>
                                        <input type="text" class="textbox" name="txtEmail"/>
                                        <span class="emerror"></span>
                                    </li>
                                    <li class="weekly-rightpanel-textbox">
                                        Zip Code:<br>
                                        <input type="text" class="textbox" maxlength="5" name="txtZipCode"/>
                                        <span class="zerror"></span>
                                    </li>
                                    <li class="weekly-rightpanel-describes"><strong>Which best describes you:</strong> (check all that apply)</li>
                                    <?php
                                    foreach ($servicesList as $list):
                                        ?>
                                        <li class="weekly-rightpanel-checkbox">
                                            <input style="margin-top: -3px;margin-right: 5px;" type="checkbox" value="<?php echo $list[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_ID] ?>" name="bestdescribes[]"/><?php echo $list[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_NAME] ?>
                                        </li>
                                        <?php
                                    endforeach;
                                    ?>
                                    <br/>
                                    <li class="weekly-rightpane-button">
                                        <input type="submit" value="Subscribe" class="btn btn-success"/>
                                        <span id="successmsg"></span>
                                    </li>
                                </ul>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="bottominfo">
            <div class="box">
                <h3><i class="icon-anchor"></i> Finding the Best Catering Services for Your Event</h3><br clear="all"/>
                <hr/>
                <p>
                    <img alt="img" src="<?php echo base_url() ?>assets/images/img_1.jpg"/>
                    Things to know when searching for caterers in your city

                    When looking for catering services for your party, wedding caterers for your big day or corporate caterers for your business event, you don't want to spend all of your valuable planning time researching and evaluating caterers in your area. This task can quickly become an overwhelming one, especially if you live in a larger cities and are looking for New York Caterers or Los Angeles caterers, the options can seem endless. This is where LocalCatering.com can help you. Our site enables you to do quick searches for caterers in your area that meet the needs of your particular event.

                    It is important to secure catering services for your event early on. You want to ensure that the guests at your event will be given the best cuisine possible and will leave your party happy and satisfied. LocalCatering.com helps make this happen by getting you quotes fast from local caterers.

                    When filling out the form, be as specific as possible and include any special requirements you might have. Caterers should be able to propose menu options for your special occasion and make estimates as to how much it will cost. The quotes you receive will typically be on a price-per-guest basis and specified to meet the needs of your individual event.

                    Many caterers will provide you with an array of optional catering extras to choose from. You may realize that some of these are exactly what your particular event needs, but remember these are just extras and you may choose to decline them. 
                </p>
            </div>

            <div class="box" style="background: #F6F6F6">
                <h3><i class="icon-beaker"></i> It is important that you clarify with your caterer</h3><br clear="all"/>
                <hr/>
                <p>
                    <img alt="img" src="<?php echo base_url() ?>assets/images/img_2.jpg"/>
                    It is important that you clarify with your caterer what is and is not included in their catering package to make sure you are both on the same page and can avoid any road bumps later on. When looking at caterers for your event, there are several things that you can do to make sure you find the best for your event.

                    Here are a few suggestions:

                    BBB Ratings - Check the caterer's Better Business Bureau rating for additional information on the company.
                    Look at pictures from past events - Pay attention to the presentation of the food and decorations to determine if the caterer's style will fit with your ideas and preferences.
                    References - Check around for additional reviews and references of the catering service and find reviews from previous clients to find out if they were pleased with the services they received.

                    All caterers who are members of LocalCatering.com are held to a certain standard. We collect reviews on our vendors and suspend accounts of those vendor that do not perform at a high quality and that socre high on customer satisfaction.

                    Many caterers will provide you with an array of optional catering extras to choose from. You may realize that some of these are exactly what your particular event needs, but remember these are just extras and you may choose to decline them. 
                </p>
            </div>
            <div class="box">
                <h3><i class="icon-question"></i> Questions to ask Catering Services</h3><br clear="all"/>
                <hr/>
                <p>
                    <img alt="img" src="<?php echo base_url() ?>assets/images/img_3.jpg"/>
                    Whether you need catering for a corporate event in Dallas, a lavish wedding on a San Diego beach or your holiday party in Boston, it's important that you find the perfect catering service that can provide your event with the right cuisine and presentation that fits with the theme of your event. To ensure that you get exactly what you are looking for, there are certain questions that you need to ask as you begin searching out local catering services.

                    What is the catering service's availability on the day of your event and will they be working any other events on the same day? You want to be sure they will be devoting sufficient time to your event.
                    Does the company specialize in any particular types of foods? Catering services should provide you with sample menus to review.
                    Can the caterer schedule a taste-testing of the specific foods you are interested in before hiring them? This is something that most catering services will do.
                    Does the caterer handle all table settings? Will they be putting out place cards and favors? Find out what non-food items of this nature that they will provide and if it is not a part of their service, then will they make arrangements for rentals or is this something you will be responsible for?
                    Does the catering company have a valid license and proper insurance? A license lets you know that catering services have met health department standards and that they have liability insurance should an accident occur.
                    Where will the food be prepared? Will there be on-site facilities that the catering company can use? If the caterer has to bring in their own equipment, will this cost extra?
                    Does the caterer work with top wedding banquet halls in the area? Can they suggest photographers, event florists and entertainers for your event?
                    Does the catering service provide their own wait staff? How many would they recommend for an event the size of yours? What will the servers wear? Many catering services will provide their own wait staff because they understand the catering service's way of doing business.
                    Does the catering company provide alcohol? Is the bar something you can handle on your own? If so, is there a corkage fee?

                    These questions are just a starting place to help you start narrowing down your search. Your event may have several special requirements in which you will need to inquire about. Keeping all of the above in mind will help make choosing a caterer easier. If you find a caterer you like, go with your gut feeling, but don't forget to let your taste buds have a say in the matter too!

                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="categorylist">
            <div class="categoryBox">
                <h3>Most Popular Caterers</h3>
                <hr/>
                <ul>
                    <?php
                    foreach ($vendor as $vlist) {
                        ?>
                        <li>
                            <a href="<?php echo base_url().SiteConfig::CONTROLLER_VENDOR.SiteConfig::METHOD_VENDOR_DETAILS.toBase($vlist[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]).'/'.$vlist[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] ?>"><?php echo $vlist[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME] ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</article>