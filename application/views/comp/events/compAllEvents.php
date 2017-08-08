<div class="commonpages">
    <div>
        <h2><i class="icon-book"></i> <?php echo $title ?> ...</h2>
        <ul class="eventsList">
            <?php
            //debugPrint($allevents);
            foreach ($allevents as $events) {
                ?>

                <li>
                    <a href="<?php echo site_url(SiteConfig::CONTROLLER_EVENTS.SiteConfig::METHOD_EVENTS_DETAILS.'/'.cpr_encode($events[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_INFO_ID])) ?>">
                       <?php echo $events[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME]; ?>
                      
                    </a>
                    <br/>
                     <small><?php echo $events[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?></small>
                     |
                     <small><?php echo $events[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?></small>
                     <br/>
                      <small><?php echo date("m-d-Y, \a\\t g.i A",$events[DBConfig::TABLE_EVENT_INFO_ATT_ADDED_DATE]); ?></small>
                </li>

                <?php
            }
            ?>
        </ul>
    </div>
</div>