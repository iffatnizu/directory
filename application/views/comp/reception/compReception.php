<article>
    <div class="container">
        <div id="dslider">
            <img src="<?php echo base_url() ?>assets/images/directory_slider.png" alt="d_slider"/>
        </div>
        <div class="tab">
            <div class="tabbar">
                <?php echo $this->load->view(siteConfig::MOD_TOP_MENUS); ?>
            </div>
            <div class="taboption">
                <br clear="all"/>
                <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
                <script src="<?php echo base_url(); ?>script/core/jquery-ui.min.js"></script>

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
                    });
                </script>
                <?php
                if ($this->session->userdata('successMsg')) {
                    echo $this->session->userdata('successMsg');

                    $data['successMsg'] = FALSE;
                    $this->session->unset_userdata($data);
                }
                ?>
                <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_RECEPTION . SiteConfig::METHOD_RECEPTION_HALLS); ?>">
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
                                <select name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>">
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
                                <select name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
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
                                <input type="text" name="<?php echo DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NUMBER_OF_GUESTS); ?>" />
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
                                <select name="<?php echo DBConfig::TABLE_EVENT_ATT_VENUE_BUDGET_ID; ?>" style="width: 170px;">
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
                            <td>&nbsp;<input type="text" name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                            <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                            </td>
                        </tr>
                        <tr>
                            <th valign="top">Phone:</th>
                            <td>&nbsp;<input type="text" maxlength="3" name="cCode" style="width: 25px;" /> 
                                <input type="text" maxlength="3" name="pCode" style="width: 25px;"/> 
                                <input type="text" maxlength="4" name="<?php echo DBConfig::TABLE_EVENT_ATT_PHONE; ?>" style="width: 35px;"/> 
                                Ext : <input type="text" maxlength="3" name="extension" style="width: 25px;"/>
                            <br /><?php echo form_error(DBConfig::TABLE_EVENT_ATT_PHONE); ?>
                            </td>
                        </tr>                    
                        <tr>
                            <th valign="top">Email:</th>
                            <td>&nbsp;<input type="text" name="<?php echo DBConfig::TABLE_EVENT_ATT_EMAIL; ?>" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>" />
                            <br />
                            <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EMAIL); ?>
                            </td>
                        </tr>
                    </table>
                    <br clear="all"/>
                    <input type="submit" name="advsearch" value="Get Venue Quotes"/>
                </form>
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

                <a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGNUP); ?>" class="btn btn-large btn-warning">Sign Up Now <i class="icon-circle-arrow-right"></i></a>
            </div>
            <hr/>
        </div>
    </div>
</article>