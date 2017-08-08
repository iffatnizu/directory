<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> Step <?php echo $st ?> of <?php echo $this->session->userdata('sizeofStep'); ?>: Reception Halls </h2>
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>script/core/jquery-ui.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                var today = new Date();
                var tomorrow = new Date();
                tomorrow.setDate(today.getDate()+1);
                var pickerOpts0 = {
                    minDate: 0,
                    dateFormat: 'yy-mm-dd'
                };
                var pickerOpts = {
                    minDate: tomorrow,
                    dateFormat: 'yy-mm-dd'
                };
                    
                $("#eventStartDate").datepicker(pickerOpts0);
                $("#eventEndDate").datepicker(pickerOpts);
            });
            
            function removeAllEventInfo(){
                var ans = confirm('Are you sure?\nIf then your entered all event information will remove');
                if(ans) {
                    window.location.href='<?php echo site_url(); ?>';
                }
            }
        </script>
        <br clear="all"/>
        <section id="business-query">
            <div style="float: left; width: 260px; position: static;">
                <div class="cateringCategory" style="margin-left: 0px;">
                    <?php echo $this->load->view(siteConfig::MOD_LEFT_MENU); ?>
                </div>
                &nbsp;
            </div>
            <div class="quetoArea">
                <div class="removeEve" onclick="return removeAllEventInfo()">
                    <i class="icon-remove btn-danger btn-large"></i>
                </div>
                <br class="clear"/>
                <br class="clear"/>
                <br class="clear"/>
                <form method="post" id="business-query-form" style="margin-left: 15px;" class="form-a" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_DECORATION); ?>">
                    <table style="width: auto;">
                        <tr>
                            <td style="width: 200px;">Event Start Date:</td>
                            <td><input type="text" id="eventStartDate" name="recepStartDate" value="<?php echo set_value('recepStartDate'); ?><?php echo ($this->session->userdata('recepStartDate')) ? date('Y-m-d', $this->session->userdata('recepStartDate')):''; ?>" /></td>
                            <td style="width: 200px;"><?php echo form_error('recepStartDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. Start Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('recepStartTime')) {
                                    $sh = date('h', $this->session->userdata('recepStartTime'));
                                    $sm = date('i', $this->session->userdata('recepStartTime'));
                                    $se = date('A', $this->session->userdata('recepStartTime'));
                                }
                                ?>
                                <select name="recepHours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($sh) && $sh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="recepMinute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($sm) && $sm == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="recepExt" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($se) && $se == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($se) && $se == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Event End Date:</td>
                            <td><input type="text" id="eventEndDate" name="recepEndDate" value="<?php echo set_value('recepEndDate'); ?><?php echo ($this->session->userdata('recepEndDate')) ? date('Y-m-d', $this->session->userdata('recepEndDate')):''; ?>" /></td>
                            <td><?php echo form_error('recepEndDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. End Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('recepEndTime')) {
                                    $eh = date('h', $this->session->userdata('recepEndTime'));
                                    $em = date('i', $this->session->userdata('recepEndTime'));
                                    $ee = date('A', $this->session->userdata('recepEndTime'));
                                }
                                ?>
                                <select name="recepEndhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($eh) && $eh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="recepEndminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($em) && $em == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="recepEndext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($ee) && $ee == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($ee) && $ee == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Are dates flexible?</td>
                            <td>
                                <select name="recepDateFlexibl">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('recepDateFlexibl', '1'); ?> <?php  echo ($this->session->userdata('recepDateFlexibl') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('recepDateFlexibl', '2'); ?> <?php  echo ($this->session->userdata('recepDateFlexibl') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('recepDateFlexibl'); ?></td>
                        </tr>
                        <tr>
                            <td>Number of guests service required for:</td>
                            <td><input name="recepGuestNumber" type="text" value="<?php echo set_value('recepGuestNumber') ?><?php echo ($this->session->userdata('recepGuestNumber')) ? $this->session->userdata('recepGuestNumber'):''; ?>" /></td>
                            <td><?php echo form_error('recepGuestNumber'); ?></td>
                        </tr>
                        <tr>
                            <td>Service Requested:</td>
                            <td>
                                <select name="recepService" >
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allServices)) {
                                        foreach ($allServices as $service) {
                                            ?>
                                            <option value="<?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]; ?>" <?php echo set_select('recepService', $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]); ?> <?php  echo ($this->session->userdata('recepService') == $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('recepService'); ?></td>
                        </tr>
                        <tr>
                            <td>Type of amenities:</td>
                            <td>
                                <div>
                                    <?php
                                    if($this->session->userdata('amenitesTypes'))
                                        $amenTypes = explode(',', $this->session->userdata('amenitesTypes'));
                                    
                                    if (!empty($allAmenitiesType)) {
                                        foreach ($allAmenitiesType as $amenitiesType) {
                                            ?>
                                            <div>
                                                <?php 
                                                $checked = '';
                                                if(!empty ($amenTypes)) {
                                                    for($i = 0; $i < sizeof($amenTypes); $i++) {
                                                        if($amenTypes[$i] == $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE_ID])
                                                            $checked = 'checked=""';
                                                    }
                                                }
                                                ?>
                                                <input type="checkbox" name="amenitesTypes[]" value="<?php echo $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE_ID]; ?>" <?php echo set_checkbox('amenitesTypes[]', $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE_ID]); ?> <?php echo $checked; ?> /> <?php echo $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE]; ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td><?php echo form_error('amenitesTypes[]'); ?></td>
                        </tr>
                        <tr>
                            <td>Additional Comments:</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="recepComments"><?php echo ($this->session->userdata('recepComments')) ? $this->session->userdata('recepComments'):''; ?></textarea></td>
                            <td></td>
                        </tr>
                        <tr>
                            
                            <td>
                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE.SiteConfig::METHOD_QUOTE_REMOVE_SERVICES.'/2'); ?>">
                                    <input name="" class="btn btn-danger" type="button" value="REMOVE THIS SERVICE" />
                                </a>
                            </td>
                            <td style="float: right;">
                                <input name="" class="btn-large btn-success" type="submit" value="Next" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    </div>
</div>