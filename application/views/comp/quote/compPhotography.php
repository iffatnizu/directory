<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> Step <?php echo $st ?> of <?php echo $this->session->userdata('sizeofStep'); ?>: Photography </h2>
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
                <form method="post" id="business-query-form" style="margin-left: 15px;" class="form-a" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY); ?>">
                    <table style="width: auto;">
                        <tr>
                            <td style="width: 200px;">Event Start Date:</td>
                            <td><input type="text" id="eventStartDate" name="photoStartDate" value="<?php echo set_value('photoStartDate'); ?><?php echo ($this->session->userdata('photoStartDate')) ? date('Y-m-d', $this->session->userdata('photoStartDate')):''; ?>" /></td>
                            <td style="width: 200px;"><?php echo form_error('photoStartDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. Start Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('photoStartTime')) {
                                    $sh = date('h', $this->session->userdata('photoStartTime'));
                                    $sm = date('i', $this->session->userdata('photoStartTime'));
                                    $se = date('A', $this->session->userdata('photoStartTime'));
                                }
                                ?>
                                <select name="photohours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($sh) && $sh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="photominute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($sm) && $sm == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="photoext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($se) && $se == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($se) && $se == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Event End Date:</td>
                            <td><input type="text" id="eventEndDate" name="photoEndDate" value="<?php echo set_value('photoEndDate'); ?> <?php echo ($this->session->userdata('photoEndDate')) ? date('Y-m-d', $this->session->userdata('photoEndDate')):''; ?>" /></td>
                            <td><?php echo form_error('photoEndDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. End Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('photoEndTime')) {
                                    $eh = date('h', $this->session->userdata('photoEndTime'));
                                    $em = date('i', $this->session->userdata('photoEndTime'));
                                    $ee = date('A', $this->session->userdata('photoEndTime'));
                                }
                                ?>
                                <select name="photoEndhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($eh) && $eh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="photoEndminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($em) && $em == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="photoEndext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($ee) && $ee == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($ee) && $ee == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Are dates flexible?</td>
                            <td>
                                <select name="photoDateFlexibl">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('photoDateFlexibl', '1'); ?> <?php  echo ($this->session->userdata('photoDateFlexibl') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('photoDateFlexibl', '2'); ?> <?php  echo ($this->session->userdata('photoDateFlexibl') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('photoDateFlexibl'); ?></td>
                        </tr>
                        <tr>
                            <td>Number of guests service required for:</td>
                            <td><input name="photoGuestNumber" type="text" value="<?php echo set_value('photoGuestNumber'); ?><?php echo ($this->session->userdata('photoGuestNumber')) ? $this->session->userdata('photoGuestNumber'):''; ?>" /></td>
                            <td><?php echo form_error('photoGuestNumber'); ?></td>
                        </tr>
                        <tr>
                            <td>Style of Photography:</td>
                            <td>
                                <select name="photoStyle">
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allPhotoStyle)) {
                                        foreach ($allPhotoStyle as $style) {
                                            ?>
                                            <option value="<?php echo $style[DBConfig::TABLE_PHOTOGRAPHY_STYLE_ATT_STYLE_ID]; ?>" <?php echo set_select('photoStyle', $style[DBConfig::TABLE_PHOTOGRAPHY_STYLE_ATT_STYLE_ID]); ?><?php  echo ($this->session->userdata('photoStyle') == $style[DBConfig::TABLE_PHOTOGRAPHY_STYLE_ATT_STYLE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $style[DBConfig::TABLE_PHOTOGRAPHY_STYLE_ATT_STYLE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('photoStyle'); ?></td>
                        </tr>
                        <tr>
                            <td>Setting Type:</td>
                            <td>
                                <select name="photoSettingType">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('photoSettingType','1'); ?> <?php  echo ($this->session->userdata('photoSettingType') == '1') ? 'selected=""':''; ?>>Indoors</option>
                                    <option value="2" <?php echo set_select('photoSettingType','2'); ?> <?php  echo ($this->session->userdata('photoSettingType') == '2') ? 'selected=""':''; ?>>Outdoors</option>
                                    <option value="3" <?php echo set_select('photoSettingType','3'); ?> <?php  echo ($this->session->userdata('photoSettingType') == '3') ? 'selected=""':''; ?>>Both</option>
                                </select>
                            </td>
                            <td><?php echo form_error('photoSettingType'); ?></td>
                        </tr>
                        <tr>
                            <td>Setting Location(s):</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="PhotoLocation"><?php echo ($this->session->userdata('PhotoLocation')) ? $this->session->userdata('PhotoLocation'):''; ?><?php echo set_value('PhotoLocation'); ?></textarea></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Post-Production Requirements:</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="PhotoRequirements"><?php echo ($this->session->userdata('PhotoRequirements')) ? $this->session->userdata('PhotoRequirements'):''; ?><?php echo set_value('PhotoRequirements'); ?></textarea></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total Budget for Photography:</td>
                            <td>
                                <select name="photoBudget">
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allServiceBudget)) {
                                        foreach ($allServiceBudget as $serviceBudget) {
                                            ?>
                                            <option value="<?php echo $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]; ?>" <?php echo set_select('photoBudget',$serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]); ?><?php  echo ($this->session->userdata('photoBudget') == $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('photoBudget'); ?></td>
                        </tr>
                        <tr>
                            <td>Additional Comments:</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="photoComments"><?php echo ($this->session->userdata('photoComments')) ? $this->session->userdata('photoComments'):''; ?></textarea></td>
                            <td></td>
                        </tr>
                        <tr>
                            
                            <td>
                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_REMOVE_SERVICES . '/5'); ?>">
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