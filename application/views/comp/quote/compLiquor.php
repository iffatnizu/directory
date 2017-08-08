<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> Step <?php echo $st ?> of <?php echo $this->session->userdata('sizeofStep'); ?>: Liquor </h2>
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
                <form method="post" id="business-query-form" style="margin-left: 15px;" class="form-a" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR); ?>">
                    <table style="width: auto;">
                        <tr>
                            <td style="width: 200px;">Event Start Date:</td>
                            <td><input type="text" id="eventStartDate" name="liqStartDate" value="<?php echo set_value('liqStartDate'); ?><?php echo ($this->session->userdata('liqStartDate')) ? date('Y-m-d', $this->session->userdata('liqStartDate')):''; ?>" /></td>
                            <td style="width: 200px;"><?php echo form_error('liqStartDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. Start Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('liqStartTime')) {
                                    $sh = date('h', $this->session->userdata('liqStartTime'));
                                    $sm = date('i', $this->session->userdata('liqStartTime'));
                                    $se = date('A', $this->session->userdata('liqStartTime'));
                                }
                                ?>
                                <select name="liqhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($sh) && $sh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="liqminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($sm) && $sm == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="liqext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($se) && $se == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($se) && $se == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?></td>
                        </tr>
                        <tr>
                            <td>Event End Date:</td>
                            <td><input type="text" id="eventEndDate" name="liqEndDate" value="<?php echo set_value('liqEndDate'); ?><?php echo ($this->session->userdata('liqEndDate')) ? date('Y-m-d', $this->session->userdata('liqEndDate')):''; ?>" /></td>
                            <td><?php echo form_error('liqEndDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. End Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('liqEndTime')) {
                                    $eh = date('h', $this->session->userdata('liqEndTime'));
                                    $em = date('i', $this->session->userdata('liqEndTime'));
                                    $ee = date('A', $this->session->userdata('liqEndTime'));
                                }
                                ?>
                                <select name="liqEndhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($eh) && $eh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="liqEndminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($em) && $em == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="liqEndext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($ee) && $ee == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($ee) && $ee == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Are dates flexible?</td>
                            <td>
                                <select name="liqDateFlexibl">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('liqDateFlexibl', '1'); ?> <?php  echo ($this->session->userdata('liqDateFlexibl') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('liqDateFlexibl', '2'); ?> <?php  echo ($this->session->userdata('liqDateFlexibl') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('liqDateFlexible'); ?></td>
                        </tr>
                        <tr>
                            <td>Number of guests service required for:</td>
                            <td><input name="liqGuestNumber" type="text" value="<?php echo set_value('liqGuestNumber'); ?><?php echo ($this->session->userdata('liqGuestNumber')) ? $this->session->userdata('liqGuestNumber'):''; ?>" /></td>
                            <td><?php echo form_error('liqGuestNumber'); ?></td>
                        </tr>
                        <tr>
                            <td>Service Requested:</td>
                            <td>
                                <select name="liqService">
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allServices)) {
                                        foreach ($allServices as $service) {
                                            ?>
                                            <option value="<?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]; ?>" <?php echo set_select('liqService', $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]); ?> <?php  echo ($this->session->userdata('liqService') == $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('liqService'); ?></td>
                        </tr>
                        <tr>
                            <td>Type of Drinks:</td>
                            <td>
                                <div>
                                    <?php
                                    if($this->session->userdata('drinksType'))
                                        $drinkTypes = explode(',', $this->session->userdata('drinksType'));
                                    
                                    if (!empty($allDrinks)) {
                                        foreach ($allDrinks as $drinksType) {
                                            ?>
                                            <div>
                                                <?php 
                                                $checked = '';
                                                if(!empty ($drinkTypes)) {
                                                    for($i = 0; $i < sizeof($drinkTypes); $i++) {
                                                        if($drinkTypes[$i] == $drinksType[DBConfig::TABLE_DRINKS_TYPE_ATT_DRINKS_TYPE_ID])
                                                            $checked = 'checked=""';
                                                    }
                                                }
                                                ?>
                                                <input type="checkbox" name="drinksType[]" value="<?php echo $drinksType[DBConfig::TABLE_DRINKS_TYPE_ATT_DRINKS_TYPE_ID]; ?>" <?php echo set_checkbox('drinksType[]', $drinksType[DBConfig::TABLE_DRINKS_TYPE_ATT_DRINKS_TYPE_ID]); ?> <?php echo $checked; ?> /> 
                                                    <?php echo $drinksType[DBConfig::TABLE_DRINKS_TYPE_ATT_DRINKS_TYPE]; ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td><?php echo form_error('drinksType[]'); ?></td>
                        </tr>
                        <tr>
                            <td>Would you like to rent glasses?</td>
                            <td>
                                <select name="rentGlasses">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('rentGlasses', '1'); ?> <?php  echo ($this->session->userdata('rentGlasses') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('rentGlasses', '2'); ?> <?php  echo ($this->session->userdata('rentGlasses') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('rentGlasses'); ?></td>
                        </tr>
                        <tr>
                            <td>If Yes, please specify Type and Quantity:</td>
                            <td><input type="text" name="glasseQuantity" value="<?php echo set_value('glasseQuantity'); ?><?php echo ($this->session->userdata('glasseQuantity')) ? $this->session->userdata('glasseQuantity'):''; ?>" /></td>
                            <td><?php echo form_error('glasseQuantity'); ?></td>
                        </tr>
                        <tr>
                            <td>Additional Comments:</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="liqComments"><?php echo ($this->session->userdata('liqComments')) ? $this->session->userdata('liqComments'):''; ?></textarea></td>
                            <td></td>
                        </tr>
                        <tr>
                            
                            <td>
                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_REMOVE_SERVICES . '/6'); ?>">
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