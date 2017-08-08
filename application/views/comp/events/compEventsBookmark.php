<div class="commonpages">
    <div>
        <h2><i class="icon-question-sign"></i> <?php echo $title ?> ...</h2>


        <ul class="eventsList">
            <?php 
            foreach($allbookmark as $bookmark){
            ?>
            
            <li>
                <a href="<?php echo site_url(SiteConfig::CONTROLLER_BOOKMARK.SiteConfig::METHOD_BOOKMARK_SERVICES.'/'.cpr_encode($bookmark[DBConfig::TABLE_BOOKMARK_ATT_BOOKMARK_EVENTS_INFO_ID])) ?>"><?php echo $bookmark['eventsname'] ?></a>
            </li>
            <?php
            }
            ?>
        </ul>
        
    </div>
</div>