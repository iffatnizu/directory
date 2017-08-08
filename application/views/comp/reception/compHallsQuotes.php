<div class="commonpages">
    <div>
        <h2><i class="icon-ok-sign"></i>Reception Halls Request Quotes</h2>
        <form method="post" name="caterersQuote" action="<?php echo site_url(SiteConfig::CONTROLLER_RECEPTION . SiteConfig::METHOD_RECEPTION_HALLS_QUOTES . '/' . $this->uri->segment(3)); ?>">
            <table>
                <tr>
                    <td width="25%">Formal/Informal:</td>
                    <td width="50%">
                        <select name="<?php echo DBConfig::TABLE_HALLS_QUOTES_ATT_HALLS_TYPE; ?>">
                            <option value="1">Formal</option>
                            <option value="0">Informal</option>
                        </select>
                    </td>
                    <td width="25%"><?php echo form_error(DBConfig::TABLE_HALLS_QUOTES_ATT_HALLS_TYPE); ?></td>
                </tr>
                <tr>
                    <td>Start Time:</td>
                    <td>
                        <select name="sHours" style="width: 80px;">
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>">
                                    <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <select name="sMinute" style="width: 80px;">
                            <?php for ($j = 0; $j < 60; $j++) { ?>
                                <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>">
                                    <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <select name="sExtension" style="width: 80px;">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>End Time:</td>
                    <td>
                        <select name="eHours" style="width: 80px;">
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?php echo ($i < 10) ? '0' . $i : $i; ?>">
                                    <?php echo ($i < 10) ? '0' . $i : $i; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <select name="eMinute" style="width: 80px;">
                            <?php for ($j = 0; $j < 60; $j++) { ?>
                                <option value="<?php echo ($j < 10) ? '0' . $j : $j; ?>">
                                    <?php echo ($j < 10) ? '0' . $j : $j; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <select name="eExtension" style="width: 80px;">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="25%">Do you need catering?</td>
                    <td width="50%">
                        <select name="<?php echo DBConfig::TABLE_HALLS_QUOTES_ATT_NEED_CATERING; ?>" style="width: 280px;">
                            <option value="1" selected="">Yes, I Want the venue to provide catering</option>
                            <option value="2">I already have a caterer</option>
                            <option value="0">No caterer needed</option>
                        </select>
                    </td>
                    <td width="25%"><?php echo form_error(DBConfig::TABLE_HALLS_QUOTES_ATT_NEED_CATERING); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Venue Choice: <?php echo form_error('venueTypes[]'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allVenueType)) {
                            foreach ($allVenueType as $venueType) {
                                ?>
                                <span style="float: left; width: 150px;">
                                    <input type="checkbox" name="venueTypes[]" id="venueTypes" value="<?php echo $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE_ID]; ?>" />
                                    <?php echo $venueType[DBConfig::TABLE_VENUE_TYPE_ATT_VENUE_TYPE]; ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Type of amenities: <?php echo form_error('amenitiesTypes[]'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allAmenitiesType)) {
                            foreach ($allAmenitiesType as $amenitiesType) {
                                ?>
                                <span style="float: left; width: 350px;">
                                    <input type="checkbox" name="amenitiesTypes[]" id="amenitiesTypes" value="<?php echo $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE_ID]; ?>" />
                                    <?php echo $amenitiesType[DBConfig::TABLE_AMENITIES_TYPE_ATT_AMENITIES_TYPE]; ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="vertical-align: top;">
                        Event Comments:
                        <br/>
                        <textarea id="eventscomments" rows="5" cols="30" name="<?php echo DBConfig::TABLE_HALLS_QUOTES_ATT_EVENT_COMMENTS; ?>"></textarea>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="submit" name="" value="Continue" class="btn btn-large btn-success"/></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </form>
    </div>
</div>