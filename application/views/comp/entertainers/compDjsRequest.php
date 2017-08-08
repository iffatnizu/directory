<div class="commonpages">
    <div>
        <h2><i class="icon-ok-sign"></i>DJ Request Quotes</h2>
        <form method="post" name="caterersQuote" action="<?php echo site_url(SiteConfig::CONTROLLER_ENTERTAINERS . SiteConfig::METHOD_ENTERTAINERS_DJS_REQUEST.'/'.$this->uri->segment(3));   ?>">
            <table>
                <tr>
                    <td colspan="3">Please select the type of music you would like:<?php echo form_error('musicTypes[]'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php
                        if (!empty($allMusicType)) {
                            foreach ($allMusicType as $musicType) {
                                ?>
                                <span style="float: left; width: 250px;">
                                    <input type="checkbox" name="musicTypes[]" id="musicTypes" value="<?php echo $musicType[DBConfig::TABLE_MUSIC_TYPE_ATT_MUSIC_TYPE_ID]; ?>" />
                                    <?php echo $musicType[DBConfig::TABLE_MUSIC_TYPE_ATT_MUSIC_TYPE]; ?>
                                </span>
                                <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="25%">Budget for these service:</td>
                    <td width="45%">
                        <select name="<?php echo DBConfig::TABLE_DJ_QUOTES_ATT_SERVICE_BUDGET_ID; ?>">
                            <option value="">Select One</option>
                            <?php
                            if (!empty($allServiceBudget)) {
                                foreach ($allServiceBudget as $serviceBudget) {
                                    ?>
                                    <option value="<?php echo $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]; ?>" <?php echo set_select(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID, $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET_ID]); ?>>
                                        <?php echo $serviceBudget[DBConfig::TABLE_SERVICE_BUDGET_ATT_SERVICE_BUDGET]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td width="30%"><?php echo form_error(DBConfig::TABLE_DJ_QUOTES_ATT_SERVICE_BUDGET_ID); ?></td>
                </tr>
                <tr>
                    <td>Indoor/Outdoor:</td>
                    <td>
                        <select name="<?php echo DBConfig::TABLE_DJ_QUOTES_ATT_DJ_TYPE; ?>">                            
                            <option value="">Make Selection</option>
                            <option value="0">Indoor</option>
                            <option selected="selected" value="1">Outdoor</option>				
                        </select>
                    </td>
                    <td><?php echo form_error(DBConfig::TABLE_DJ_QUOTES_ATT_DJ_TYPE); ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="vertical-align: top;">
                        Event Comments:<br/>
                        <textarea id="eventscomments" rows="5" cols="30" name="<?php echo DBConfig::TABLE_DJ_QUOTES_ATT_EVENT_COMMENTS; ?>"></textarea>
                    </td>
                   
                    
                </tr>
                <tr>
                    <td><input type="submit" name="" value="Continue" class="btn btn-large btn-success"/></td>
                    <td>&nbsp;</td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>