
<script type="text/javascript">
    jQuery(document).ready(function(){
        var element = "article nav[id=nav] ul[class=menu] li[class=parent]";
        var menu = jQuery(element);
        jQuery.each(menu,function(index,value){
            //alert(index);
            jQuery("article nav[id=nav] ul[class=menu] li[id=parent_"+index+"]").mouseover(function(){
                jQuery("article nav[id=nav] ul[class=menu] li[id=parent_"+index+"] ul[id=child_"+index+"]").show();
            })
            jQuery("article nav[id=nav] ul[class=menu] li[id=parent_"+index+"]").mouseout(function(){
                jQuery("article nav[id=nav] ul[class=menu] li[id=parent_"+index+"] ul[id=child_"+index+"]").hide();
            })
        })
    })
</script>
<script>
    var logoutUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR.SiteConfig::METHOD_VENDOR_LOG_OUT ?>';
</script>
<script src="<?php echo base_url() ?>script/site/vendorLogout.js" type="text/javascript"></script>
<article>

    <nav id=nav style="min-height: 40px;">

        <ul class="menu">
            <li class="parent" id="parent_6"><a href="<?php echo site_url();?>"  class=current><i class="icon-home"></i> Main Site</a></li>    
            <?php
            if ($this->session->userdata('_userLogin')) {
                ?>
                <li class="parent" id="parent_0"><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DASHBOARD) ?>" class=current><i class="icon-dashboard"></i> Dashboard</a></li>
                <li class="parent" id="parent_1"> <a href="javascript:void(0);"><i class="icon-cogs"></i> Setting <i class="icon-arrow-down"></i></a>
                    <ul class="sub" id="child_1">
                        <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_PROFILE) ?>"><i class="icon-lock"></i> My Account</a></li>
                        <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_CHANGE_PASSWORD) ?>"><i class="icon-lock"></i> Change Password</a></li>
                        <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_CHANGE_LOGO) ?>"><i class="icon-lock"></i> Change Logo</a></li>
                    </ul>
                </li>
                <li class="parent" id="parent_2"> <a href="javascript:void(0);"><i class="icon-tasks"></i> Events <i class="icon-arrow-down"></i></a>
                    <ul class="sub" id="child_2">
                        <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_EVENTS . SiteConfig::METHOD_EVENTS_ALL) ?>"><i class="icon-asterisk"></i> All</a></li>                       
                        <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_EVENTS . SiteConfig::METHOD_EVENTS_BOOKMARK) ?>"><i class="icon-bookmark"></i> Bookmark</a></li>                       
                    </ul>
                </li>
                <li class="parent" id="parent_4"><a href="<?php echo site_url(SiteConfig::CONTROLLER_CONVERSATION . SiteConfig::METHOD_CONVERSATION_INBOX) ?>"  class=current><i class="icon-envelope-alt"></i> Inbox </a></li>           
                <li class="parent" id="parent_5"><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_RATING_REVIEW) ?>"  class=current><i class="icon-star"></i> Rating Review </a></li>           
                <li class="parent" id="parent_3"><a onclick="vendorlogout()" href="javascript:void(0)"  class=current><i class="icon-lock"></i> Logout</a></li>           
                <?php
            }
            ?>
        </ul>

    </nav>

</article>
