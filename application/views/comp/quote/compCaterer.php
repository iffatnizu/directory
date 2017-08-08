<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> Step <?php echo $st ?> of <?php echo $this->session->userdata('sizeofStep'); ?>: Caterers </h2>
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
                <form method="post" id="business-query-form" style="margin-left: 15px;" class="form-a" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_CATERER); ?>">
                    <table style="width: auto;">
                        <tr>
                            <td style="width: 200px;">Event Start Date:</td>
                            <td><input type="text" id="eventStartDate" name="catStartDate" value="<?php echo set_value('catStartDate'); ?><?php echo ($this->session->userdata('catStartDate')) ? date('Y-m-d', $this->session->userdata('catStartDate')):  set_value('catStartDate'); ?>" /></td>
                            <td style="width: 200px;"><?php echo form_error('catStartDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. Start Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('catStartTime')) {
                                    $sh = date('h', $this->session->userdata('catStartTime'));
                                    $sm = date('i', $this->session->userdata('catStartTime'));
                                    $se = date('A', $this->session->userdata('catStartTime'));
                                }
                                ?>
                                <select name="startHours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                    <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($sh) && $sh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="startMinute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($sm) && $sm == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="startExt" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($se) && $se == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($se) && $se == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Event End Date:</td>
                            <td><input type="text" id="eventEndDate" name="catEndDate" value="<?php echo set_value('catEndDate'); ?><?php echo ($this->session->userdata('catEndDate')) ? date('Y-m-d', $this->session->userdata('catEndDate')):set_value('catEndDate'); ?>" /></td>
                            <td><?php echo form_error('catEndDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. End Time:</td>
                            <td>
                                <?php  
                                if($this->session->userdata('catEndTime')) {
                                    $eh = date('h', $this->session->userdata('catEndTime'));
                                    $em = date('i', $this->session->userdata('catEndTime'));
                                    $ee = date('A', $this->session->userdata('catEndTime'));
                                }
                                ?>
                                <select name="endHours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset ($eh) && $eh == $i) ? 'selected=""':''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="endMinute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset ($em) && $em == $j) ? 'selected=""':''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="endExt" style="width: 70px;">
                                    <option value="AM" <?php echo (isset ($ee) && $ee == 'AM') ? 'selected=""':''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset ($ee) && $ee == 'PM') ? 'selected=""':''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>Are dates flexible?</td>
                            <td>
                                <select name="catDateFlexibl">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('catDateFlexibl', '1'); ?><?php  echo ($this->session->userdata('catDateFlexibl') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('catDateFlexibl', '2'); ?> <?php  echo ($this->session->userdata('catDateFlexibl') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('catDateFlexibl'); ?></td>
                        </tr>
                        <tr>
                            <td>Number of guests service required for:</td>
                            <td><input name="catGuestNumber" type="text" value="<?php echo set_value('catGuestNumber'); ?><?php echo ($this->session->userdata('catGuestNumber')) ? $this->session->userdata('catGuestNumber'):set_value('catGuestNumber'); ?>" /></td>
                            <td><?php echo form_error('catGuestNumber'); ?></td>
                        </tr>
                        <tr>
                            <td>Service Requested:</td>
                            <td>
                                <select name="catService" >
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allServices)) {
                                        foreach ($allServices as $service) {
                                            ?>
                                            <option value="<?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]; ?>" <?php echo set_select('catService', $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]); ?><?php  echo ($this->session->userdata('catService') == $service[DBConfig::TABLE_SERVICE_ATT_SERVICE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $service[DBConfig::TABLE_SERVICE_ATT_SERVICE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('catService'); ?></td>
                        </tr>
                        <tr>
                            <td>Type of Cuisine:</td>
                            <td>
                                <select name="catCuisine">
                                    <option value="">Please Select...</option>
                                    <?php
                                    if (!empty($allFoodTypes)) {
                                        foreach ($allFoodTypes as $foodTypes) {
                                            ?>
                                            <option value="<?php echo $foodTypes[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE_ID]; ?>" <?php echo set_select('catCuisine', $foodTypes[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE_ID]); ?><?php  echo ($this->session->userdata('catCuisine') == $foodTypes[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $foodTypes[DBConfig::TABLE_FOOD_TYPE_ATT_FOOD_TYPE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('catCuisine'); ?></td>
                        </tr>
                        <tr>
                            <td>If Other, Please Specify:</td>
                            <td><input type="text" name="otherCatCuisine" <?php  echo ($this->session->userdata('otherCatCuisine')) ? $this->session->userdata('otherCatCuisine'):  set_value('otherCatCuisine'); ?> /></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Courses Required:</td>
                            <td>
                                <?php
                                    if($this->session->userdata('catCourses'))
                                        $courses = explode(',', $this->session->userdata('catCourses'));
//                                    debugPrint($courses);
                                ?>
                                <div>
                                    <div>
                                        <?php 
                                            $checked1 = '';
                                            if(!empty ($courses)) {
                                                for($i = 0; $i < sizeof($courses); $i++) {
                                                    if($courses[$i] == '1')
                                                        $checked1 = 'checked=""';
                                                }
                                            }
                                        ?>
                                        <input type="checkbox" name="catCourses[]" value="1" <?php echo set_checkbox('catCourses[]', '1'); ?> <?php echo $checked1; ?> />  Hors d'Oeuvres
                                    </div>
                                    <div>
                                        <?php 
                                            $checked2 = '';
                                            if(!empty ($courses)) {
                                                for($i = 0; $i < sizeof($courses); $i++) {
                                                    if($courses[$i] == '2')
                                                        $checked2 = 'checked=""';
                                                }
                                            }
                                        ?>
                                        <input type="checkbox" name="catCourses[]" value="2" <?php echo set_checkbox('catCourses[]', '2'); ?> <?php echo $checked2; ?> />  Mains
                                    </div>
                                    <div>
                                        <?php 
                                            $checked3 = '';
                                            if(!empty ($courses)) {
                                                for($i = 0; $i < sizeof($courses); $i++) {
                                                    if($courses[$i] == '3')
                                                        $checked3 = 'checked=""';
                                                }
                                            }
                                        ?>
                                        <input type="checkbox" name="catCourses[]" value="3" <?php echo set_checkbox('catCourses[]', '3'); ?> <?php echo $checked3; ?> />  Entrees
                                    </div>
                                    <div>
                                        <?php 
                                            $checked4 = '';
                                            if(!empty ($courses)) {
                                                for($i = 0; $i < sizeof($courses); $i++) {
                                                    if($courses[$i] == '4')
                                                        $checked4 = 'checked=""';
                                                }
                                            }
                                        ?>
                                        <input type="checkbox" name="catCourses[]" value="4" <?php echo set_checkbox('catCourses[]', '4'); ?> <?php echo $checked4; ?> />  Desserts
                                    </div>
                                </div>
                                <span class="Small">Depending on your selection <br/>you may need to specify more information.<br/> The relevant fields will appear below.</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Indicate Catering Equipment Required:</td>
                            <td>
                                <div style="float: left;width: 100%;">
                                    <?php
                                    if($this->session->userdata('catEquipment'))
                                        $equipments = explode(',', $this->session->userdata('catEquipment'));
//                                    debugPrint($equipments);
                                
                                    if (!empty($allEquipment)) {
                                        foreach ($allEquipment as $equipment) {
                                            ?>
                                            <div>
                                                <?php 
                                                $checkedEqp = '';
                                                if(!empty ($equipments)) {
                                                    for($i = 0; $i < sizeof($equipments); $i++) {
                                                        if($equipments[$i] == $equipment[DBConfig::TABLE_EQUIPMENT_ATT_EQUIPMENT_ID])
                                                            $checkedEqp = 'checked=""';
                                                    }
                                                }
                                                ?>
                                                <input type="checkbox" name="catEquipment[]" value="<?php echo $equipment[DBConfig::TABLE_EQUIPMENT_ATT_EQUIPMENT_ID]; ?>" <?php echo set_checkbox('catEquipment[]', $equipment[DBConfig::TABLE_EQUIPMENT_ATT_EQUIPMENT_ID]); ?><?php echo $checkedEqp; ?> /> <?php echo $equipment[DBConfig::TABLE_EQUIPMENT_ATT_EQUIPMENT_NAME]; ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td valign="top"><?php echo form_error('catEquipment[]'); ?></td>
                        </tr>
                        <tr>
                            <td>If Other, Please Specify:</td>
                            <td><input type="text" name="otherEquipment" value="<?php  echo ($this->session->userdata('otherEquipment')) ? $this->session->userdata('otherEquipment'):  set_value('otherEquipment'); ?>" /></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Additional Services:</td>
                            <td>
                                <div>
                                    <?php
                                    if($this->session->userdata('catAddServices'))
                                        $addServices = explode(',', $this->session->userdata('catAddServices'));
//                                    debugPrint($equipments);
                                    if (!empty($allAdditionalServices)) {
                                        foreach ($allAdditionalServices as $additionalServices) {
                                            ?>
                                            <div>
                                                <?php 
                                                $checkedAdd = '';
                                                if(!empty ($addServices)) {
                                                    for($i = 0; $i < sizeof($addServices); $i++) {
                                                        if($addServices[$i] == $additionalServices[DBConfig::TABLE_ADDITIONAL_SERVICE_ATT_ADDITIONAL_SERVICE_ID])
                                                            $checkedAdd = 'checked=""';
                                                    }
                                                }
                                                ?>
                                                <input type="checkbox" name="catAddServices[]" value="<?php echo $additionalServices[DBConfig::TABLE_ADDITIONAL_SERVICE_ATT_ADDITIONAL_SERVICE_ID]; ?>" <?php echo $checkedAdd; ?> /> <?php echo $additionalServices[DBConfig::TABLE_ADDITIONAL_SERVICE_ATT_ADDITIONAL_SERVICE]; ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                            <td><?php echo form_error(); ?></td>
                        </tr>
                        <tr>
                            <td>If Other, Please Specify:</td>
                            <td><input type="text" name="otherCatServices" class="textbox" value="<?php  echo ($this->session->userdata('otherCatServices')) ? $this->session->userdata('otherCatServices'):  set_value('otherCatServices'); ?>" /></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Do you have an Event Location selected yet?</td>
                            <td><select id="" name="catHaveLocation">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('catHaveLocation', '1'); ?> <?php  echo ($this->session->userdata('catHaveLocation') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('catHaveLocation', '2'); ?> <?php  echo ($this->session->userdata('catHaveLocation') == '2') ? 'selected=""':''; ?>>No, please suggest a location</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>If Yes, please specify type of Venue:</td>
                            <td>
                                <select id="" name="catVenue">
                                    <option value=""></option>
                                    <?php
                                    if (!empty($allVenueType)) {
                                        foreach ($allVenueType as $venueType) {
                                            ?>
                                            <option value="<?php echo $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID]; ?>" <?php echo set_select('catVenue', $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID]); ?> <?php  echo ($this->session->userdata('catVenue') == $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td><td></td>
                        </tr>
                        <tr>
                            <td>Is there a kitchen available for food preparation?</td>
                            <td>
                                <select style="width:100px;" id="" name="catKitchen">
                                    <option value=""></option>
                                    <option value="3" <?php echo set_select('catKitchen','3'); ?>  <?php  echo ($this->session->userdata('catKitchen') == '3') ? 'selected=""':''; ?>>Unsure</option>
                                    <option value="1" <?php echo set_select('catKitchen','1'); ?>  <?php  echo ($this->session->userdata('catKitchen') == '1') ? 'selected=""':''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('catKitchen','2'); ?>  <?php  echo ($this->session->userdata('catKitchen') == '2') ? 'selected=""':''; ?>>No</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Catering Budget per person:</td>
                            <td>
                                <select id="" name="catBudgetPerson">
                                    <option value="" selected="selected"></option>
                                    <?php
                                    if (!empty($budgetPerPerson)) {
                                        foreach ($budgetPerPerson as $budget) {
                                            ?>
                                            <option value="<?php echo $budget[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON_ID]; ?>" <?php echo set_select('catBudgetPerson',$budget[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON_ID]); ?> <?php  echo ($this->session->userdata('catBudgetPerson') == $budget[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON_ID]) ? 'selected=""':''; ?>>
                                                <?php echo $budget[DBConfig::TABLE_BUDGET_PER_PERSON_ATT_BUDGET_PER_PERSON]; ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><?php echo form_error('catBudgetPerson'); ?></td>
                        </tr>
                        <tr>
                            <td>Additional Comments:</td>
                            <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="catComments"><?php  echo ($this->session->userdata('catComments')) ? $this->session->userdata('catComments'):  set_value('catComments'); ?></textarea></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE.SiteConfig::METHOD_QUOTE_REMOVE_SERVICES.'/1'); ?>">
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