<script>
    var sendMessageToUserUrl = '<?php echo SiteConfig::CONTROLLER_CONVERSATION.SiteConfig::METHOD_CONVERSATION_SEND_MESSAGE ?>';
    var bookmarkserviceUrl = '<?php echo SiteConfig::CONTROLLER_EVENTS.SiteConfig::METHOD_EVENTS_BOOKMARK_SERVICE ?>';
    var removebookmarkserviceUrl = '<?php echo SiteConfig::CONTROLLER_EVENTS.SiteConfig::METHOD_EVENTS_REMOVE_BOOKMARK_SERVICE ?>';
</script>
<script src="<?php echo base_url() ?>script/site/events.js" type="text/javascript"></script>
<div class="commonpages">
    <?php
    //debugPrint($details);
    if (!empty($details)) {
        ?>


        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button id="modalClose" type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 id="myModalLabel"><i class="icon-pencil"></i> Compose new  message</h4>
            </div>
            <div class="modal-body">
                <h5 style="margin-top: 0px;">Subject:</h5>
                <input type="text" name="msgSubject" value="" style="width: 400px"/>
                <input type="hidden" name="msgEid" value="<?php echo $eid ?>"/>

                <h5 style="margin-top: 0px;">Message:</h5>
                <ul id="formateText">
                    <li><a class="btn" href="javascript::"  onclick="changeStyle('bold')"><i class="icon-bold"></i></a></li>
                    <li><a class="btn" href="javascript::"  onclick="changeStyle('italic')"><i class="icon-italic"></i></a></li>
                    <li><a class="btn" href="javascript::"  onclick="changeStyle('underline')"><i class="icon-underline"></i></a></li>                                                                                             
                    <li><a class="btn" href="javascript::" onclick="changeStyle('insertunorderedlist')"><i class="icon-list-ul"></i></a></li>
                    <li><a class="btn" href="javascript::" onclick="changeStyle('indent')"><i class="icon-indent-right"></i></a></li>
                    <li><a class="btn" href="javascript::" onclick="changeStyle('outdent')"><i class="icon-indent-left"></i></a></li>
                    <li><a class="btn" href="javascript::" onclick="changeFontColor()"><i class="icon-pencil"></i></a></li>

                    <li><a class="btn" href="javascript::" onclick="changeLink()"><i class="icon-font"></i></a></li>                    
                    <li><a class="btn" href="javascript::" onclick="changeStyle('justifyleft')"><i class="icon-align-left"></i></a></li>
                    <li><a class="btn" href="javascript::" onclick="changeStyle('justifycenter')"><i class="icon-align-center"></i></a></li>
                    <li><a class="btn" href="javascript::" onclick="changeStyle('justifyright')"><i class="icon-align-right"></i></a></li> 
                    <li><a class="btn" href="javascript::" onclick="changeStyle('justifyfull')"><i class="icon-align-justify"></i></a></li>
                </ul>
                <div id="pageContent" contenteditable="true"></div>
                <script type="text/javascript" src="<?php echo base_url() ?>script/site/cpr_editor.js"></script>
            </div>
            <div class="modal-footer">
                <button style="float: left;" class="btn btn-success" onclick="directory.sendMessageToUser()">Send</button>
                <button style="float: left;" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>              
            </div>
        </div>
        <!---- End modal -->
        <div id="serviseNserviceList">
            <h2>
                <i class="icon-double-angle-right"></i> <?php echo $title ?> of <?php echo $details[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] ?>...
                <a href="#myModal" data-toggle="modal" class="btn btn-small" style="float: right;">Send Message</a>
            </h2>

            <?php
            if (!empty($details['catering'])) {
                ?>
                <h5>catering</h5>
                <ul>
                    <?php
                    foreach ($details['catering'] as $catering) {
                        ?>
                        <li>
                            <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $catering[DBConfig::TABLE_CATERING_ATT_EVENT_START_DATE]) ?></small><br/>
                            <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $catering[DBConfig::TABLE_CATERING_ATT_EVENT_END_DATE]) ?></small><br/>
                            <small> Number of guest : <?php echo $catering[DBConfig::TABLE_CATERING_ATT_GUESTS_NUMBER] ?></small><br/>
                            <small> Additional comments : <?php echo $catering[DBConfig::TABLE_CATERING_ATT_ADDITIONAL_COMMENTS] ?></small><br/>
                            <small> Food type : <?php echo $catering['foodType'] ?></small><br/>
                            <small> Equipment : <?php echo $catering['equipmentname'] ?></small><br/>
                            <small> Venue : <?php echo $catering['venue'] ?></small>

                        </li>
                        <?php
                        if ($catering['isBookmarked'] == '0') {
                            ?>
                            <a href="javascript:;" onclick="directory.bookmarkservice('1','<?php echo $eid ?>','<?php echo $catering[DBConfig::TABLE_CATERING_ATT_CATERING_ID] ?>')" class="btn-small btn-info bookmark">Bookmark</a>

                            <?php
                        } else {
                            ?>
                            <a href="javascript:;" onclick="directory.removebookmarkservice('1','<?php echo $eid ?>','<?php echo $catering[DBConfig::TABLE_CATERING_ATT_CATERING_ID] ?>')" class="btn-small btn-danger bookmark">Remove Bookmark</a>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <hr/>
                <?php
            }
            if (!empty($details['receptionhall'])) {
                ?>
                <br clear="all"/>
                <h5>reception hall</h5>
                <hr/>
                <ul>
                    <?php
                    foreach ($details['receptionhall'] as $reception) {
                        ?>
                        <li>
                            <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $reception[DBConfig::TABLE_RECEPTION_HALLS_ATT_APPROX_START_TIME]) ?></small><br/>
                            <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $reception[DBConfig::TABLE_RECEPTION_HALLS_ATT_APPROX_END_TIME]) ?></small><br/>
                            <small> Number of guest : <?php echo $reception[DBConfig::TABLE_RECEPTION_HALLS_ATT_GUESTS_NUMBER] ?></small><br/>
                            <small> Additional comments : <?php echo $reception[DBConfig::TABLE_RECEPTION_HALLS_ATT_ADDITIONAL_COMMENTS] ?></small><br/>
                            <small> Amenities type : <?php echo $reception['amenities'] ?></small><br/>
                            <small> Service : <?php echo $reception['service'] ?></small>

                        </li>
                        <?php
                        if ($reception['isBookmarked'] == '0') {
                            ?>
                            <a href="javascript:;" onclick="directory.bookmarkservice('2','<?php echo $eid ?>','<?php echo $reception[DBConfig::TABLE_RECEPTION_HALLS_ATT_RECEPTION_ID] ?>')" class="btn-small btn-info bookmark">Bookmark</a>

                            <?php
                        } else {
                            ?>
                            <a href="javascript:;" onclick="directory.removebookmarkservice('2','<?php echo $eid ?>','<?php echo $reception[DBConfig::TABLE_RECEPTION_HALLS_ATT_RECEPTION_ID] ?>')" class="btn-small btn-danger bookmark">Remove Bookmark</a>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }
            if (!empty($details['entertainers'])) {
                ?>
                <br clear="all"/>
                <h5>entertainment</h5>
                <hr/>
                <ul>
                    <?php
                    foreach ($details['entertainers'] as $entertainers) {
                        ?>
                        <li>
                            <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $entertainers[DBConfig::TABLE_ENTERTAINMENT_ATT_APPROX_START_TIME]) ?></small><br/>
                            <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $entertainers[DBConfig::TABLE_ENTERTAINMENT_ATT_APPROX_END_TIME]) ?></small><br/>
                            <small> Number of guest : <?php echo $entertainers[DBConfig::TABLE_ENTERTAINMENT_ATT_GUESTS_NUMBER] ?></small><br/>
                            <small> Additional comments : <?php echo $entertainers[DBConfig::TABLE_ENTERTAINMENT_ATT_ADDITIONAL_COMMENTS] ?></small><br/>
                            <small> Age range : <?php echo $entertainers['agerange'] ?></small><br/>
                            <small> Entertainment Type : <?php echo $entertainers['entertainment'] ?></small>


                        </li>
                        <?php
                        if ($entertainers['isBookmarked'] == '0') {
                            ?>
                            <a href="javascript:;" onclick="directory.bookmarkservice('3','<?php echo $eid ?>','<?php echo $entertainers[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_ID] ?>')" class="btn-small btn-info bookmark">Bookmark</a>

                            <?php
                        } else {
                            ?>
                            <a href="javascript:;" onclick="directory.removebookmarkservice('3','<?php echo $eid ?>','<?php echo $entertainers[DBConfig::TABLE_ENTERTAINMENT_ATT_ENTERTAINMENT_ID] ?>')" class="btn-small btn-danger bookmark">Remove Bookmark</a>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }

            if (!empty($details['florists'])) {
                ?>
                <br clear="all"/>
                <h5>florists</h5>
                <hr/>
                <ul>
                    <?php
                    foreach ($details['florists'] as $florists) {
                        ?>
                        <li>
                            <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $florists[DBConfig::TABLE_FLORISTS_ATT_EVENT_START_DATE]) ?></small><br/>
                            <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $florists[DBConfig::TABLE_FLORISTS_ATT_EVENT_END_DATE]) ?></small><br/>
                            <small> Number of guest : <?php echo $florists[DBConfig::TABLE_FLORISTS_ATT_GUESTS_NUMBER] ?></small><br/>
                            <small> Additional comments : <?php echo $florists[DBConfig::TABLE_FLORISTS_ATT_ADDITIONAL_COMMENT] ?></small><br/>
                            <small> Flowers Details : <?php echo $florists[DBConfig::TABLE_FLORISTS_ATT_FLOWERS_DETAILS] ?></small><br/>
                            <small> Service : <?php echo $florists['service'] ?></small><br/>
                            <small> Arrangement Type : <?php echo $florists['arrangement'] ?></small><br/>
                            <small> Flower Type : <?php echo $florists['flower'] ?></small>



                        </li>
                        <?php
                        if ($florists['isBookmarked'] == '0') {
                            ?>
                            <a href="javascript:;" onclick="directory.bookmarkservice('4','<?php echo $eid ?>','<?php echo $florists[DBConfig::TABLE_FLORISTS_ATT_FLORISTS_ID] ?>')" class="btn-small btn-info bookmark">Bookmark</a>

                            <?php
                        } else {
                            ?>
                            <a href="javascript:;" onclick="directory.removebookmarkservice('4','<?php echo $eid ?>','<?php echo $florists[DBConfig::TABLE_FLORISTS_ATT_FLORISTS_ID] ?>')" class="btn-small btn-danger bookmark">Remove Bookmark</a>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }

            if (!empty($details['photography'])) {
                ?>
                <br clear="all"/>
                <h5>photography</h5>
                <hr/>
                <ul>
                    <?php
                    foreach ($details['photography'] as $photography) {
                        ?>
                        <li>
                            <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_APPROX_START_TIME]) ?></small><br/>
                            <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_APPROX_END_TIME]) ?></small><br/>
                            <small> Number of guest : <?php echo $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_GUESTS_NUMBER] ?></small><br/>
                            <small> Additional comments : <?php echo $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_ADDITIONAL_COMMENT] ?></small><br/>
                            <small> Setting Location : <?php echo $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_SETTING_LOCATION] ?></small><br/>
                            <small> Requirements : <?php echo $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_REQUIRMENTS] ?></small><br/>
                            <small> Photography Style : <?php echo $photography['pstyle'] ?></small>


                        </li>
                        <?php
                        if ($photography['isBookmarked'] == '0') {
                            ?>
                            <a href="javascript:;" onclick="directory.bookmarkservice('5','<?php echo $eid ?>','<?php echo $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_ID] ?>')" class="btn-small btn-info bookmark">Bookmark</a>
                            <?php
                        } else {
                            ?>
                            <a href="javascript:;" onclick="directory.removebookmarkservice('5','<?php echo $eid ?>','<?php echo $photography[DBConfig::TABLE_PHOTOGRAPHY_ATT_PHOTOGRAPHY_ID] ?>')" class="btn-small btn-danger bookmark">Remove Bookmark</a>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }
            //debugPrint($details['Limos']);
            if (!empty($details['Limos'])) {
                ?>
                <br clear="all"/>
                <h5>Limos</h5>
                <hr/>
                <ul>
                    <?php
                    foreach ($details['Limos'] as $limos) {
                        ?>
                        <li>
                            <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $limos[DBConfig::TABLE_LIQUOR_ATT_APPROX_START_TIME]) ?></small><br/>
                            <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $limos[DBConfig::TABLE_LIQUOR_ATT_APPROX_END_TIME]) ?></small><br/>
                            <small> Number of guest : <?php echo $limos[DBConfig::TABLE_LIQUOR_ATT_GUESTS_NUMBER] ?></small><br/>
                            <small> Additional comments : <?php echo $limos[DBConfig::TABLE_LIQUOR_ATT_ADDITIONAL_COMMENT] ?></small><br/>
                            <small> Service : <?php echo $limos['service'] ?></small><br/>
                            <small> Food type : <?php echo $limos['food'] ?></small>


                        </li>
                        <?php
                        if ($limos['isBookmarked'] == '0') {
                            ?>
                            <a href="javascript:;" onclick="directory.bookmarkservice('6','<?php echo $eid ?>','<?php echo $limos[DBConfig::TABLE_LIQUOR_ATT_LIQUOR_ID] ?>')" class="btn-small btn-info bookmark">Bookmark</a>

                            <?php
                        } else {
                            ?>
                            <a href="javascript:;" onclick="directory.removebookmarkservice('6','<?php echo $eid ?>','<?php echo $limos[DBConfig::TABLE_LIQUOR_ATT_LIQUOR_ID] ?>')" class="btn-small btn-danger bookmark">Remove Bookmark</a>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        echo '<h3>Not found</h3>';
    }
    ?>
</div>