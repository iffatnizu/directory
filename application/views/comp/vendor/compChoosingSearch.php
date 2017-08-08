<div class="commonpages">
    <div>
        <h2><i class="icon-search"></i> Select Search Type :</h2>

<!--        <form id="searchSelect" method="POST" action="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DIRECTORY); ?>">
    <p><input type="radio" checked="checked" name="selectSearch" value="1"/> &nbsp; Normal Search</p><br/>
    <p><input type="radio" name="selectSearch" value="2"/> &nbsp; Advance Search</p><br/>
    <p><input type="submit" name="submit" class="btn btn-danger" value="Go"/></p>
</form>-->
        <ul class="choosingSearch">
            <li>
                <a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_SEARCH); ?>">
                    <img src="<?php echo base_url() ?>assets/images/search_1.png"/>
                    <span>Normal Search</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_ADVANCE_SEARCH); ?>">
                    <img style="height: 115px;width: 150px;margin: 33px 0;" src="<?php echo base_url() ?>assets/images/aus-map-flag.png"/>
                    <span>Advance Search</span>
                </a>
            </li>
        </ul>

    </div>
</div>