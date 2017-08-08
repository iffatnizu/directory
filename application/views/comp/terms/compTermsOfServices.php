<div class="commonpages">
    <div>
        <h2><i class="icon-question-sign"></i> <?php echo $title ?> ...</h2>
        <p>
            <img width="128" src="<?php echo base_url() ?>assets/images/checkered-flag-icon.png" alt="about" style="float: left;"/>
        </p>
        <?php
        echo $content[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS];
        ?>
    </div>
</div>