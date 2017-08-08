<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> Step <?php echo $st ?> of <?php echo $this->session->userdata('sizeofStep'); ?>: Entertainment </h2>
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
                <form method="post" id="business-query-form" style="margin-left: 15px;" class="form-a" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER); ?>">
                    <table style="width: auto;">
                        <tr>
                            <td style="width: 200px;">Event Start Date:</td>
                            <td><input type="text" id="eventStartDate" name="enterStartDate" value="<?php echo set_value('enterStartDate'); ?><?php echo ($this->session->userdata('enterStartDate')) ? date('Y-m-d', $this->session->userdata('enterStartDate')):''; ?>" /></td>
                            <td style="width: 200px;"><?php echo form_error('enterStartDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. Start Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('enterStartTime')) {
                                    $sh = date('h', $this->session->userdata('enterStartTime'));
                                    $sm = date('i', $this->session->userdata('enterStartTime'));
                                    $se = date('A', $this->session->userdata('enterStartTime'));
                                }
                                ?>
                                <select name="enterhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($sh) && $sh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="enterminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($sm) && $sm == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="enterext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($se) && $se == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($se) && $se == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(''); ?></td>
                        </tr>
                        <tr>
                            <td>Event End Date:</td>
                            <td><input type="text" id="eventEndDate" name="enterEndDate" value="<?php echo set_value('enterEndDate'); ?> <?php echo ($this->session->userdata('enterEndDate')) ? date('Y-m-d', $this->session->userdata('enterEndDate')):''; ?>" /></td>
                            <td><?php echo form_error('enterEndDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. End Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('enterEndTime')) {
                                    $eh = date('h', $this->session->userdata('enterEndTime'));
                                    $em = date('i', $this->session->userdata('enterEndTime'));
                                    $ee = date('A', $this->session->userdata('enterEndTime'));
                                }
                                ?>
                                <select name="enterEndhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($eh) && $eh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="enterEndminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($em) && $em == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="enterEndext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($ee) && $ee == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($ee) && $ee == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(''); ?></td>
                        </tr>
                        <tr>
                            <td>Are dates flexible?</td>
                            <td>
                                <select name="enterDateFlexibl">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('enterDateFlexibl', '1'); ?><?php  echo ($this->session->userdata('enterDateFlexibl') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('enterDateFlexibl', '2'); ?><?php  echo ($this->session->userdata('enterDateFlexibl') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('enterDateFlexibl'); ?></td>
                        </tr>
                        <tr>
                            <td>Number of guests service required for:</td>
                            <td><input name="enterGuestNumber" type="text" value="<?php echo set_value('enterGuestNumber'); ?><?php echo ($this->session->userdata('enterGuestNumber')) ? $this->session->userdata('enterGuestNumber'):''; ?>" /></td>
                            <td><?php echo form_error('enterGuestNumber'); ?></td>
                        </tr>
                        <tr>
                            <td>Age Range of Guests:</td>
                            <td>
                                <select name="ageRange" >
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allAgeRange)) {
                                        foreach ($allAgeRange as $ageRange) {
                                            ?>
                                            <option value="<?php echo $ageRange[DBConfig::TABLE_AGE_RANGE_ATT_AGE_RANGE_ID]; ?>" <?php echo set_select('ageRange', $ageRange[DBConfig::TABLE_AGE_RANGE_ATT_AGE_RANGE_ID]); ?><?php  echo ($this->session->userdata('ageRange') == $ageRange[DBConfig::TABLE_AGE_RANGE_ATT_AGE_RANGE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $ageRange[DBConfig::TABLE_AGE_RANGE_ATT_AGE_RANGE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error(''); ?></td>
                        </tr>
                        <tr>
                            <td>Event Setting:</td>
                            <td>
                                <select name="eventSetting">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('eventSetting', '1'); ?> <?php  echo ($this->session->userdata('eventSetting') == '1') ? 'selected=""':''; ?>>Unsure</option>
                                    <option value="2" <?php echo set_select('eventSetting', '2'); ?> <?php  echo ($this->session->userdata('eventSetting') == '2') ? 'selected=""':''; ?>>Indoors</option>
                                    <option value="3" <?php echo set_select('eventSetting', '3'); ?> <?php  echo ($this->session->userdata('eventSetting') == '3') ? 'selected=""':''; ?>>Outdoors</option>

                                </select>
                            </td>
                            <td><?php echo form_error(''); ?></td>
                        </tr>
                        <tr>
                            <td>Event Setting Additional Information:</td>
                            <td><input name="settingAdditional" type="text" value="<?php echo set_value('settingAdditional'); ?><?php echo ($this->session->userdata('settingAdditional')) ? $this->session->userdata('settingAdditional'):''; ?>" /></td>
                            <td><?php echo form_error(''); ?></td>
                        </tr>
                        <tr>
                            <td>Type of Entertainment:</td>
                            <td>
                                <div>
                                    <?php
                                    if($this->session->userdata('entertainmentType'))
                                        $enttypes = explode(',', $this->session->userdata('entertainmentType'));
//                                    debugPrint($enttypes);
                                    if (!empty($allEntertainmentType)) {
                                        foreach ($allEntertainmentType as $entertainmentType) {
                                            ?>
                                            <div>
                                                <?php 
                                                $checked = '';
                                                if(!empty ($enttypes)) {
                                                    for($i = 0; $i < sizeof($enttypes); $i++) {
                                                        if($enttypes[$i] == $entertainmentType[DBConfig::TABLE_ENTERTAINMENT_TYPE_ATT_ENTERTAINMENT_TYPE_ID])
                                                            $checked = 'checked=""';
                                                    }
                                                }
                                                ?>
                                                <input type="checkbox" name="entertainmentType[]" value="<?php echo $entertainmentType[DBConfig::TABLE_ENTERTAINMENT_TYPE_ATT_ENTERTAINMENT_TYPE_ID]; ?>" <?php echo set_checkbox('entertainmentType[]', $entertainmentType[DBConfig::TABLE_ENTERTAINMENT_TYPE_ATT_ENTERTAINMENT_TYPE_ID]); ?><?php echo $checked; ?> /> <?php echo $entertainmentType[DBConfig::TABLE_ENTERTAINMENT_TYPE_ATT_ENTERTAINMENT_TYPE]; ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td><?php echo form_error('entertainmentType[]'); ?></td>
                        </tr>
                        <tr>
                            <td>If Other, Please Specify:</td>
                            <td>
                                <input type="text" name="otherEntertainmentType" value="<?php echo set_value('otherEntertainmentType'); ?><?php echo ($this->session->userdata('otherEntertainmentType')) ? $this->session->userdata('otherEntertainmentType'):''; ?>" /><br/>
                                <span>Depending on your selection<br/> you may need to specify more information<br/>. The relevant fields will appear below.</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total Budget for Entertainment:</td>
                            <td>
                                <select name="entertainmentBudget" >
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allEntertainmentBudget)) {
                                        foreach ($allEntertainmentBudget as $budget) {
                                            ?>
                                            <option value="<?php echo $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_ID]; ?>" <?php echo set_select('entertainmentBudget', $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_ID]); ?><?php  echo ($this->session->userdata('entertainmentBudget') == $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_RANGE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('entertainmentBudget'); ?></td>
                        </tr>
                        <tr>
                            <td>Additional Comments:</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="entertainmentComment"><?php echo ($this->session->userdata('entertainmentComment')) ? $this->session->userdata('entertainmentComment'):''; ?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            
                            <td>
                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE.SiteConfig::METHOD_QUOTE_REMOVE_SERVICES.'/3'); ?>">
                                    <input name="" class="btn btn-danger" type="button" value="REMOVE THIS SERVICE" />
                                </a>                                
                            </td>
                            <td style="float: right;">
                                <input name="" class="btn-large btn-success" type="submit" value="Next" />
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    </div>
</div>