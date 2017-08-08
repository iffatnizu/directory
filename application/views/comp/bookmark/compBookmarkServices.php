<div class="commonpages">

    <div>
        <h2><i class="icon-list"></i> <?php echo $title ?> ...</h2>


        <ul class="eventsList">

            <?php
            //debugPrint($services);
            foreach ($services as $bookmark) {
                ?>

            <li style="border: 0px;width: 980px;">
                    <h5><?php echo $bookmark['servicename'] ?></h5>
                    <?php
                    if ($bookmark['servicename'] == 'Catering') {
                        ?>
                        <ul>
                            <?php
                            foreach ($bookmark['servicDetails'] as $catering) {
                                ?>
                            <li class="bookmarkLi" style="list-style-type: decimal;border: none">
                                    <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $catering['ListDetails'][DBConfig::TABLE_CATERING_ATT_EVENT_START_DATE]) ?></small><br/>
                                    <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $catering['ListDetails'][DBConfig::TABLE_CATERING_ATT_EVENT_END_DATE]) ?></small><br/>
                                    <small> Number of guest : <?php echo $catering['ListDetails'][DBConfig::TABLE_CATERING_ATT_GUESTS_NUMBER] ?></small><br/>
                                    <small> Additional comments : <?php echo $catering['ListDetails'][DBConfig::TABLE_CATERING_ATT_ADDITIONAL_COMMENTS] ?></small><br/>
                                    <small> Food type : <?php echo $catering['ListDetails']['foodType'] ?></small><br/>
                                    <small> Equipment : <?php echo $catering['ListDetails']['equipmentname'] ?></small><br/>
                                    <small> Venue : <?php echo $catering['ListDetails']['venue'] ?></small>

                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } elseif ($bookmark['servicename'] == 'Reception Halls') {
                        ?>
                        <ul>
                            <?php
                            foreach ($bookmark['servicDetails'] as $reception) {
                                ?>
                                <li class="bookmarkLi" style="list-style-type: decimal;border: none">
                                    <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $reception['ListDetails'][DBConfig::TABLE_RECEPTION_HALLS_ATT_APPROX_START_TIME]) ?></small><br/>
                                    <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $reception['ListDetails'][DBConfig::TABLE_RECEPTION_HALLS_ATT_APPROX_END_TIME]) ?></small><br/>
                                    <small> Number of guest : <?php echo $reception['ListDetails'][DBConfig::TABLE_RECEPTION_HALLS_ATT_GUESTS_NUMBER] ?></small><br/>
                                    <small> Additional comments : <?php echo $reception['ListDetails'][DBConfig::TABLE_RECEPTION_HALLS_ATT_ADDITIONAL_COMMENTS] ?></small><br/>
                                    <small> Amenities type : <?php echo $reception['ListDetails']['amenities'] ?></small><br/>
                                    <small> Service : <?php echo $reception['ListDetails']['service'] ?></small>

                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } elseif ($bookmark['servicename'] == 'DJ/Entertainers') {
                        ?>
                        <ul>
                            <?php
                            foreach ($bookmark['servicDetails'] as $entertainers) {
                                ?>
                                <li class="bookmarkLi" style="list-style-type: decimal;border: none">
                                    <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $entertainers['ListDetails'][DBConfig::TABLE_ENTERTAINMENT_ATT_APPROX_START_TIME]) ?></small><br/>
                                    <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $entertainers['ListDetails'][DBConfig::TABLE_ENTERTAINMENT_ATT_APPROX_END_TIME]) ?></small><br/>
                                    <small> Number of guest : <?php echo $entertainers['ListDetails'][DBConfig::TABLE_ENTERTAINMENT_ATT_GUESTS_NUMBER] ?></small><br/>
                                    <small> Additional comments : <?php echo $entertainers['ListDetails'][DBConfig::TABLE_ENTERTAINMENT_ATT_ADDITIONAL_COMMENTS] ?></small><br/>
                                    <small> Age range : <?php echo $entertainers['ListDetails']['agerange'] ?></small><br/>
                                    <small> Entertainment Type : <?php echo $entertainers['ListDetails']['entertainment'] ?></small>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } elseif ($bookmark['servicename'] == 'Florists') {
                        ?>
                        <ul>
                            <?php
                            foreach ($bookmark['servicDetails'] as $florists) {
                                ?>
                                <li class="bookmarkLi" style="list-style-type: decimal;border: none">
                                    <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $florists['ListDetails'][DBConfig::TABLE_FLORISTS_ATT_EVENT_START_DATE]) ?></small><br/>
                                    <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $florists['ListDetails'][DBConfig::TABLE_FLORISTS_ATT_EVENT_END_DATE]) ?></small><br/>
                                    <small> Number of guest : <?php echo $florists['ListDetails'][DBConfig::TABLE_FLORISTS_ATT_GUESTS_NUMBER] ?></small><br/>
                                    <small> Additional comments : <?php echo $florists['ListDetails'][DBConfig::TABLE_FLORISTS_ATT_ADDITIONAL_COMMENT] ?></small><br/>
                                    <small> Flowers Details : <?php echo $florists['ListDetails'][DBConfig::TABLE_FLORISTS_ATT_FLOWERS_DETAILS] ?></small><br/>
                                    <small> Service : <?php echo $florists['ListDetails']['service'] ?></small><br/>
                                    <small> Arrangement Type : <?php echo $florists['ListDetails']['arrangement'] ?></small><br/>
                                    <small> Flower Type : <?php echo $florists['ListDetails']['flower'] ?></small>



                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } elseif ($bookmark['servicename'] == 'Photographers/Video') {
                        ?>
                        <ul>
                            <?php
                            foreach ($bookmark['servicDetails'] as $photography) {
                                ?>
                                <li class="bookmarkLi" style="list-style-type: decimal;border: none">
                                    <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $photography['ListDetails'][DBConfig::TABLE_PHOTOGRAPHY_ATT_APPROX_START_TIME]) ?></small><br/>
                                    <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $photography['ListDetails'][DBConfig::TABLE_PHOTOGRAPHY_ATT_APPROX_END_TIME]) ?></small><br/>
                                    <small> Number of guest : <?php echo $photography['ListDetails'][DBConfig::TABLE_PHOTOGRAPHY_ATT_GUESTS_NUMBER] ?></small><br/>
                                    <small> Additional comments : <?php echo $photography['ListDetails'][DBConfig::TABLE_PHOTOGRAPHY_ATT_ADDITIONAL_COMMENT] ?></small><br/>
                                    <small> Setting Location : <?php echo $photography['ListDetails'][DBConfig::TABLE_PHOTOGRAPHY_ATT_SETTING_LOCATION] ?></small><br/>
                                    <small> Requirements : <?php echo $photography['ListDetails'][DBConfig::TABLE_PHOTOGRAPHY_ATT_REQUIRMENTS] ?></small><br/>
                                    <small> Photography Style : <?php echo $photography['ListDetails']['pstyle'] ?></small>


                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } elseif ($bookmark['servicename'] == 'Limos') {
                        ?>
                        <ul>
                            <?php
                            foreach ($bookmark['servicDetails'] as $limos) {
                                ?>
                                <li class="bookmarkLi" style="list-style-type: decimal;border: none">
                                    <small> Start date : <?php echo date("m-d-Y, \a\\t g.i A", $limos['ListDetails'][DBConfig::TABLE_LIQUOR_ATT_APPROX_START_TIME]) ?></small><br/>
                                    <small> End date : <?php echo date("m-d-Y, \a\\t g.i A", $limos['ListDetails'][DBConfig::TABLE_LIQUOR_ATT_APPROX_END_TIME]) ?></small><br/>
                                    <small> Number of guest : <?php echo $limos['ListDetails'][DBConfig::TABLE_LIQUOR_ATT_GUESTS_NUMBER] ?></small><br/>
                                    <small> Additional comments : <?php echo $limos['ListDetails'][DBConfig::TABLE_LIQUOR_ATT_ADDITIONAL_COMMENT] ?></small><br/>
                                    <small> Service : <?php echo $limos['ListDetails']['service'] ?></small><br/>
                                    <small> Food type : <?php echo $limos['ListDetails']['food'] ?></small>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>

                </li>
                <?php
            }
            ?>
        </ul>

    </div>
</div>