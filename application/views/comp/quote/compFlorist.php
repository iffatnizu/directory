<div class="commonpages">
    <div>
        <h2><i class="icon-coffee"></i> Step <?php echo $st ?> of <?php echo $this->session->userdata('sizeofStep'); ?>: Florists </h2>
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
                <form method="post" id="floristForm" style="margin-left: 15px;" class="form-a" action="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST); ?>">
                    <table style="width: auto;">
                        <tr>
                            <td style="width: 200px;">Event Start Date:</td>
                            <td><input type="text" id="eventStartDate" name="florStartDate" value="<?php echo set_value('florStartDate'); ?><?php echo ($this->session->userdata('florStartDate')) ? date('Y-m-d', $this->session->userdata('florStartDate')) : ''; ?>" /></td>
                            <td style="width: 200px;"><?php echo form_error('florStartDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. Start Time:</td>
                            <td>
                                <?php
                                if ($this->session->userdata('florStartTime')) {
                                    $sh = date('h', $this->session->userdata('florStartTime'));
                                    $sm = date('i', $this->session->userdata('florStartTime'));
                                    $se = date('A', $this->session->userdata('florStartTime'));
                                }
                                ?>
                                <select name="florhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset($sh) && $sh == $i) ? 'selected=""' : ''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="florminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset($sm) && $sm == $j) ? 'selected=""' : ''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="florext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset($se) && $se == 'AM') ? 'selected=""' : ''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset($se) && $se == 'PM') ? 'selected=""' : ''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?></td>
                        </tr>
                        <tr>
                            <td>Event End Date:</td>
                            <td><input type="text" id="eventEndDate" name="florEndDate" value="<?php echo set_value('florEndDate');  ?><?php echo ($this->session->userdata('florEndDate')) ? date('Y-m-d', $this->session->userdata('florEndDate')) : ''; ?>" /></td>
                            <td><?php echo form_error('florEndDate'); ?></td>
                        </tr>
                        <tr>
                            <td>Approx. End Time:</td>
                            <td>
                                <?php
                                if ($this->session->userdata('florEndTime')) {
                                    $eh = date('h', $this->session->userdata('florEndTime'));
                                    $em = date('i', $this->session->userdata('florEndTime'));
                                    $ee = date('A', $this->session->userdata('florEndTime'));
                                }
                                ?>
                                <select name="florEndhours" style="width: 70px;">
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>" <?php echo (isset($eh) && $eh == $i) ? 'selected=""' : ''; ?>>
                                            <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="florEndminute" style="width: 70px;">
                                    <?php for ($j = 0; $j < 60; $j++) { ?>
                                        <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>" <?php echo (isset($em) && $em == $j) ? 'selected=""' : ''; ?>>
                                            <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <select name="florEndext" style="width: 70px;">
                                    <option value="AM" <?php echo (isset($ee) && $ee == 'AM') ? 'selected=""' : ''; ?>>AM</option>
                                    <option value="PM" <?php echo (isset($ee) && $ee == 'PM') ? 'selected=""' : ''; ?>>PM</option>
                                </select>
                            </td>
                            <td><?php echo form_error(''); ?></td>
                        </tr>
                        <tr>
                            <td>Are dates flexible?</td>
                            <td>
                                <select name="florDatesFlexibl">
                                    <option value=""></option>
                                    <option value="1" <?php echo set_select('florDatesFlexibl', '1'); ?> <?php echo ($this->session->userdata('florDatesFlexibl') == '1') ? 'selected=""' : ''; ?>>Yes</option>
                                    <option value="2" <?php echo set_select('florDatesFlexibl', '2'); ?><?php echo ($this->session->userdata('florDatesFlexibl') == '2') ? 'selected=""' : ''; ?>>No</option>
                                </select>
                            </td>
                            <td><?php echo form_error('florDatesFlexibl'); ?></td>
                        </tr>
                        <tr>
                            <td>Number of guests service required for:</td>
                            <td><input name="florGuestNumber" type="text" value="<?php echo set_value('florGuestNumber'); ?><?php echo ($this->session->userdata('florGuestNumber')) ? $this->session->userdata('florGuestNumber') : ''; ?>" /></td>
                            <td><?php echo form_error('florGuestNumber'); ?></td>
                        </tr>
                        <tr>
                            <td>Service Requested:</td>
                            <td>
                                <select id="" name="florService">
                                    <option value="" selected="selected"></option>
                                    <option value="1" <?php echo set_select('florService', '1'); ?><?php echo ($this->session->userdata('florService') == '1') ? 'selected=""' : ''; ?>>Delivery</option>
                                    <option value="2" <?php echo set_select('florService', '2'); ?><?php echo ($this->session->userdata('florService') == '2') ? 'selected=""' : ''; ?>>Delivery &amp; Set-up</option>
                                    <option value="3" <?php echo set_select('florService', '3'); ?><?php echo ($this->session->userdata('florService') == '3') ? 'selected=""' : ''; ?>>Pick-Up</option>
                                </select>
                            </td>
                            <td><?php echo form_error('florService'); ?></td>
                        </tr>
                    </table>
                    <table class="FormTable" style="width: 652px;">
                        <tbody>

                            <tr>
                                <td style="width: 200px;">Flowers/Décor:</td>
                                <td>
                                    <div>
                                        <table cellspacing="0" border="0" id="brandtable">
                                            <tbody>
                                                <tr>
                                                    <th scope="col">&nbsp;</th>
                                                    <th scope="col">Type of Flower/Decor</th>
                                                    <th scope="col">Type of Arrangement</th>
                                                    <th scope="col">&nbsp;Details:</th>
                                                    <th scope="col">&nbsp;</th>
                                                </tr>
                                                <?php
                                                if ($this->session->userdata('florFlowerType'))
                                                    $flowerTypes = explode(',', $this->session->userdata('florFlowerType'));
                                                if ($this->session->userdata('florArrangementType'))
                                                    $arrengeTypes = explode(',', $this->session->userdata('florArrangementType'));
                                                if ($this->session->userdata('florDetails'))
                                                    $flowersDetails = explode('|', $this->session->userdata('florDetails'));
//                                                debugPrint($flowerTypes);
                                                if (!empty($flowerTypes)) {
                                                    $selectedId = '';
                                                    $selectedId1 = '';
                                                    for ($s = 1; $s <= sizeof($flowerTypes); $s++) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $s; ?></td>
                                                            <td>
                                                                <select id="" name="florFlowerType[]">
                                                                    <option value=""></option>
                                                                    <option value="0">Not Decided</option>
                                                                    <?php
                                                                    $flowSelected = '';
                                                                    $selectedStatus = 0;
                                                                    if (!empty($allFlowerType)) {
                                                                        foreach ($allFlowerType as $flowerType) {
                                                                            if ($selectedStatus == 0 && $selectedId != $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID]) {
                                                                                if (in_array($flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID], $flowerTypes)) {
                                                                                    $flowSelected = 'selected=""';
                                                                                    $selectedStatus = 1;
                                                                                    $selectedId = $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID];
                                                                                }
                                                                            } else {
                                                                                $flowSelected = '';
                                                                            }
                                                                            ?>
                                                                            <option value="<?php echo $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID]; ?>" <?php echo $flowSelected; ?>>
                                                                                <?php echo $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE]; ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select id="" name="florArrangementType[]">
                                                                    <option value=""></option>
                                                                    <option value="0">Not Decided</option>
                                                                    <?php
                                                                    $flowSelected1 = '';
                                                                    $selectedStatus1 = 0;
                                                                    if (!empty($allArrangementType)) {
                                                                        foreach ($allArrangementType as $arrangementType) {
                                                                            if ($selectedStatus1 == 0 && $selectedId1 != $arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE_ID]) {
                                                                                if (in_array($arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE_ID], $arrengeTypes)) {
                                                                                    $flowSelected1 = 'selected=""';
                                                                                    $selectedStatus1 = 1;
                                                                                    $selectedId1 = $arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE_ID];
                                                                                }
                                                                            } else {
                                                                                $flowSelected1 = '';
                                                                            }
                                                                            ?>
                                                                            <option value="<?php echo $arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE_ID]; ?>" <?php echo $flowSelected1; ?>>
                                                                                <?php echo $arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE]; ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if (!empty($flowersDetails)) {
                                                                    for ($k = 1; $k <= sizeof($flowersDetails); $k++) {
                                                                        if ($s == $k) {
                                                                            ?>
                                                                            <input type="text" id="" name="florDetails[]" value="<?php echo $flowersDetails[$k - 1]; ?>">
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><a href="javascript:;"  onclick="deleteRow(this)" id="remove">clear</a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <select id="" name="florFlowerType[]">
                                                                <option value=""></option>
                                                                <option value="0">Not Decided</option>
                                                                <?php
                                                                if (!empty($allFlowerType)) {
                                                                    foreach ($allFlowerType as $flowerType) {
                                                                        ?>
                                                                        <option value="<?php echo $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE_ID]; ?>">
                                                                            <?php echo $flowerType[DBConfig::TABLE_FLOWERS_TYPE_ATT_FLOWERS_TYPE]; ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="" name="florArrangementType[]">
                                                                <option value=""></option>
                                                                <option value="0">Not Decided</option>
                                                                <?php
                                                                if (!empty($allArrangementType)) {
                                                                    foreach ($allArrangementType as $arrangementType) {
                                                                        ?>
                                                                        <option value="<?php echo $arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE_ID]; ?>">
                                                                            <?php echo $arrangementType[DBConfig::TABLE_ARRANGMENT_TYPE_ATT_ARRANGMENT_TYPE]; ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" id="" name="florDetails[]"></td>
                                                        <td><a href="javascript:;"  onclick="deleteRow(this)" id="remove">clear</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br/>
                                    <a href="javascript:;" class="" id="" onclick="addNewRow()">Add more rows</a>
                                    <script type="text/javascript">
                                        function deleteRow(row) {
                                            var i=row.parentNode.parentNode.rowIndex;
                                            if(i > 1)
                                                document.getElementById('brandtable').deleteRow(i);
                                        }
                                        function addNewRow(){
                                            var x=document.getElementById('brandtable');
                                                                                                                                                                                                                    
                                            var new_row = x.rows[1].cloneNode(true);
                                            var len = x.rows.length;
                                            new_row.cells[0].innerHTML = len;
                                                                                                                                                                                                                                                
                                            var inp1 = new_row.cells[1].getElementsByTagName('select')[0];
                                            inp1.id += len;
                                            inp1.value = '';
                                                                                                                                                                                                                    
                                            var inp2 = new_row.cells[2].getElementsByTagName('select')[0];
                                            inp2.id += len;
                                            inp2.value = '';
                                            x.appendChild( new_row );
                                        }
                                    </script>
                                </td>
                                <td style="width: 200px;">
                                    <?php echo form_error('florFlowerType[]'); ?>
                                    <?php echo form_error('florArrangementType[]'); ?>
                                    <?php echo form_error('florDetails[]'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Budget for Florist:</td>
                                <td>
                                    <select name="florBudget" >
                                        <option value="">Please Select...</option>
                                        <?php
                                        if (!empty($allEntertainmentBudget)) {
                                            foreach ($allEntertainmentBudget as $budget) {
                                                ?>
                                                <option value="<?php echo $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_ID]; ?>" <?php echo set_select('florBudget', $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_ID]); ?> <?php echo ($this->session->userdata('florBudget') == $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_ID]) ? 'selected=""' : ''; ?>>
                                                    <?php echo $budget[DBConfig::TABLE_ENTERTAINMENT_BUDGET_ATT_BUDGET_RANGE]; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><?php echo form_error('florBudget'); ?></td>
                            </tr>
                            <tr>
                                <td>Additional Comments:</td>
                                <td><textarea style="height:54px;width:206px;" class="textbox" id="" cols="20" rows="4" name="florComments"><?php echo ($this->session->userdata('florComments')) ? $this->session->userdata('florComments') : ''; ?></textarea>
                                </td><td></td>
                            </tr>
                            <tr>

                                <td>
                                    <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_REMOVE_SERVICES . '/4'); ?>">
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