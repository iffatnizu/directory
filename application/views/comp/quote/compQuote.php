<script type="text/javascript" src="<?php echo base_url() ?>script/site/checkbox.js"></script>
<script type="text/javascript">
    jQuery(function(){
        var max = 3;
        var checkboxes = $('input[type="checkbox"]');

        checkboxes.change(function(){
            var current = checkboxes.filter(':checked').length;
            checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
        });
        
        $(".cateringCategory ul li").click(function(){
            var check = $(this).find("input[type=checkbox]").attr("checked");
            
            if(check==undefined){
                var truePng = base_url+'assets/images/true.png'; 
                $(this).find("img").attr("src",truePng);
                $(this).css({"background":"rgba(255, 0, 0,0.8)"})
                $(this).find("input[type=checkbox]").attr("checked","true");
            }
            
            else if(check=='checked'){
                var falsePng = base_url+'assets/images/false.png'; 
                $(this).find("img").attr("src",falsePng);
                $(this).find("input[type=checkbox]").removeAttr("checked");
                $(this).removeAttr("style");
            }
            //alert(check);
        })
    });
</script>
<!--<div class="commonpages">
    <div>
        <h2><i class="icon-ok-sign"></i> You are almost done!</h2>
        <script type="text/javascript" src="<?php echo base_url() ?>script/site/checkbox.js"></script>
        
        <br clear="all"/>
        <p>&nbsp;</p>
        <input type="submit" value="Submit" class="btn btn-large btn-success"/>
    </div>
</div>-->

<article>
    <div class="container">
        <link rel="stylesheet" href="<?php echo base_url(); ?>script/plugins/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>script/plugins/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
        <div id="dslider">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    <img src="<?php echo base_url(); ?>assets/public/slider/1.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/public/slider/2.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/public/slider/3.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/public/slider/4.jpg" alt=""/>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>script/plugins/nivo-slider/jquery.nivo.slider.js"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
                        
            function getEventCheckbox(){
                var allVals = [];
                $("input:checkbox[name=category]:checked").each(function() {
                    allVals.push($(this).val());
                });
                if(allVals.length != 0) {
                    $.ajax({
                        type:"POST",
                        url:"<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_SET_CATEGORY); ?>",
                        data:{
                            allVals:allVals
                        },
                        success:function(data){
                            window.location.href='<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_EVENT_INFO); ?>';
                        }
                    })
                } else {
                    alert('Please select at least one service');
                    return false;
                }
            }
        </script>

        <div class="cateringCategory">
            <?php
//            if (isset($_POST)) {
//                debugPrint($_POST);
//            }
            ?>
<!--            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">-->
            <ul>
                <?php
                if (!empty($allCategory)) {
                    foreach ($allCategory as $category) {
                        ?>
                        <li>
                            <?php if ($this->session->userdata('selectCategory' . $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]) == $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]) { ?>
                                <a href="javascript:;">
                                    <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                                </a>
                                <span>
                                    <input type="checkbox" name="category" checked="checked" id="category<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" value="<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" />
                                </span>
                            <?php } else { ?>
                                <a href="javascript:;">
                                    <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                                </a>
                                <span>
                                    <input type="checkbox" name="category" id="category<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" value="<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" />
                                </span>
                            <?php } ?>
                        </li>
                        <?php
                    }
                }
                ?>
                <input type="submit" value="Get Quote" class="btn btn-danger" onclick="return getEventCheckbox()" style="margin-top: 5px;"/>
            </ul>
            <!--                            
                                <li><a href="javascript:;">ENTERTAINMENT</a><span><input type="checkbox" name="catering_2" value="2"/></span></li>
                                <li><a href="javascript:;">FLORISTS</a><span><input type="checkbox" name="catering_3" value="3"/></span></li>
                                <li><a href="javascript:;">LIQUOR</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">PARTY SUPPLIES</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">PHOTOGRAPHERS</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">SPECIALITY CAKES</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">SPECIALITY SERVICES</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">RENTALS</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">TRANSPORTATION</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
                                <li><a href="javascript:;">VENUES</a><span><input type="checkbox" name="catering_category" value="1"/></span></li>
            -->


            <!--            </form>-->
        </div>

    </div>

    <div class="container">
        <div id="quetoContainer">
            <div class="cateringEvent">
                <div class="catering">
                    <img src="<?php echo base_url() ?>assets/images/pic_1.png" alt="wed"/>
                    <h3>Catering and events article</h3>
                    <p>
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                    </p>
                </div>
                <div class="events">
                    <img src="<?php echo base_url() ?>assets/images/pic_2.png" alt="wed"/>
                    <h3>Save on catering</h3>
                    <p>
                        Sign up for weekly<br/> catering specials.
                    </p>

                    <ul>
                        <li><i class="icon-circle-arrow-right"></i> Box Lunch Special</li>
                        <li><i class="icon-circle-arrow-right"></i> Great Deals On Hors</li>
                        <li><i class="icon-circle-arrow-right"></i> Corporate Discount</li>
                    </ul>
                    <script>
                        var subscribeUrl = '<?php echo SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SUBSCRIBE ?>';
                    </script>
                    <script src="<?php echo base_url() ?>script/site/subscribe.js" type="text/javascript"></script>

<!--                <a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGNUP); ?>" class="btn btn-large btn-info">User Signup <i class="icon-circle-arrow-right"></i></a>-->
                    <a onclick="directory.subscribeNow()" href="javascript:void(0)" class="btn btn-large btn-info">Subscribe Now <i class="icon-mail-forward"></i></a>
                    <div id="boxes">
                        <div class="window" id="weekly-catering-specials">
                            <div class="close_button"><a class="btn btn-danger" href="javascript:;" onclick="directory.removeSubscribe()"><i class="icon-remove"></i></a></div>
                            <h2>Sign up for weekly catering specials</h2>
                            <div class="weekly-specials-content">
                                <ul class="weekly-left-panel">   
                                    <li>Box Lunch Specials</li>
                                    <li>Great deals on Hors d'oeuvres</li>
                                    <li>Corporate Discounts</li>
                                </ul>
                                <br clear="all"/>
                                <style type="text/css">
                                    .cateringEvent .events img{
                                        margin: 0px;
                                    }
                                </style>
                                <form method="post" action="" name="subscribe">
                                    <ul class="weekly-right-panel">
                                        <li class="weekly-rightpanel-textbox">
                                            First Name:<br>
                                            <input type="text" class="textbox" name="txtFirstName"/>
                                            <span class="ferror"></span>
                                        </li>
                                        <li class="weekly-rightpanel-textbox">
                                            Email:<br>
                                            <input type="text" class="textbox" name="txtEmail"/>
                                            <span class="emerror"></span>
                                        </li>
                                        <li class="weekly-rightpanel-textbox">
                                            Zip Code:<br>
                                            <input type="text" class="textbox" maxlength="5" name="txtZipCode"/>
                                            <span class="zerror"></span>
                                        </li>
                                        <li class="weekly-rightpanel-describes"><strong>Which best describes you:</strong> (check all that apply)</li>
                                        <?php
                                        foreach ($servicesList as $list):
                                            ?>
                                            <li class="weekly-rightpanel-checkbox" style="float: left;width: 450px;">
                                                <input style="margin-top: -3px;margin-right: 5px;" type="checkbox" value="<?php echo $list[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_ID] ?>" name="bestdescribes[]"/><?php echo $list[DBConfig::TABLE_SERVICE_LIST_ATT_SERVICE_LIST_NAME] ?>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                        <br clear="all"/>
                                        <li class="weekly-rightpane-button" style="margin-top: 10px;">
                                            <input type="submit" value="Subscribe" class="btn btn-success"/>
                                            <span id="successmsg"></span>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="bottominfo">
                <?php echo ($homeContentStaus == '1') ? $homeContent : ''; ?>
                <!--            <div class="box">
                                <h3><i class="icon-anchor"></i> Finding the Best Catering Services for Your Event</h3><br clear="all"/>
                                <hr/>
                                <p>
                                    <img alt="img" src="<?php echo base_url() ?>assets/images/img_1.jpg"/>
                                    Things to know when searching for caterers in your city
                
                                    When looking for catering services for your party, wedding caterers for your big day or corporate caterers for your business event, you don't want to spend all of your valuable planning time researching and evaluating caterers in your area. This task can quickly become an overwhelming one, especially if you live in a larger cities and are looking for New York Caterers or Los Angeles caterers, the options can seem endless. This is where LocalCatering.com can help you. Our site enables you to do quick searches for caterers in your area that meet the needs of your particular event.
                
                                    It is important to secure catering services for your event early on. You want to ensure that the guests at your event will be given the best cuisine possible and will leave your party happy and satisfied. LocalCatering.com helps make this happen by getting you quotes fast from local caterers.
                
                                    When filling out the form, be as specific as possible and include any special requirements you might have. Caterers should be able to propose menu options for your special occasion and make estimates as to how much it will cost. The quotes you receive will typically be on a price-per-guest basis and specified to meet the needs of your individual event.
                
                                    Many caterers will provide you with an array of optional catering extras to choose from. You may realize that some of these are exactly what your particular event needs, but remember these are just extras and you may choose to decline them. 
                                </p>
                            </div>
                
                            <div class="box" style="background: #F6F6F6">
                                <h3><i class="icon-beaker"></i> It is important that you clarify with your caterer</h3><br clear="all"/>
                                <hr/>
                                <p>
                                    <img alt="img" src="<?php echo base_url() ?>assets/images/img_2.jpg"/>
                                    It is important that you clarify with your caterer what is and is not included in their catering package to make sure you are both on the same page and can avoid any road bumps later on. When looking at caterers for your event, there are several things that you can do to make sure you find the best for your event.
                
                                    Here are a few suggestions:
                
                                    BBB Ratings - Check the caterer's Better Business Bureau rating for additional information on the company.
                                    Look at pictures from past events - Pay attention to the presentation of the food and decorations to determine if the caterer's style will fit with your ideas and preferences.
                                    References - Check around for additional reviews and references of the catering service and find reviews from previous clients to find out if they were pleased with the services they received.
                
                                    All caterers who are members of LocalCatering.com are held to a certain standard. We collect reviews on our vendors and suspend accounts of those vendor that do not perform at a high quality and that socre high on customer satisfaction.
                
                                    Many caterers will provide you with an array of optional catering extras to choose from. You may realize that some of these are exactly what your particular event needs, but remember these are just extras and you may choose to decline them. 
                                </p>
                            </div>
                            <div class="box">
                                <h3><i class="icon-question"></i> Questions to ask Catering Services</h3><br clear="all"/>
                                <hr/>
                                <p>
                                    <img alt="img" src="<?php echo base_url() ?>assets/images/img_3.jpg"/>
                                    Whether you need catering for a corporate event in Dallas, a lavish wedding on a San Diego beach or your holiday party in Boston, it's important that you find the perfect catering service that can provide your event with the right cuisine and presentation that fits with the theme of your event. To ensure that you get exactly what you are looking for, there are certain questions that you need to ask as you begin searching out local catering services.
                
                                    What is the catering service's availability on the day of your event and will they be working any other events on the same day? You want to be sure they will be devoting sufficient time to your event.
                                    Does the company specialize in any particular types of foods? Catering services should provide you with sample menus to review.
                                    Can the caterer schedule a taste-testing of the specific foods you are interested in before hiring them? This is something that most catering services will do.
                                    Does the caterer handle all table settings? Will they be putting out place cards and favors? Find out what non-food items of this nature that they will provide and if it is not a part of their service, then will they make arrangements for rentals or is this something you will be responsible for?
                                    Does the catering company have a valid license and proper insurance? A license lets you know that catering services have met health department standards and that they have liability insurance should an accident occur.
                                    Where will the food be prepared? Will there be on-site facilities that the catering company can use? If the caterer has to bring in their own equipment, will this cost extra?
                                    Does the caterer work with top wedding banquet halls in the area? Can they suggest photographers, event florists and entertainers for your event?
                                    Does the catering service provide their own wait staff? How many would they recommend for an event the size of yours? What will the servers wear? Many catering services will provide their own wait staff because they understand the catering service's way of doing business.
                                    Does the catering company provide alcohol? Is the bar something you can handle on your own? If so, is there a corkage fee?
                
                                    These questions are just a starting place to help you start narrowing down your search. Your event may have several special requirements in which you will need to inquire about. Keeping all of the above in mind will help make choosing a caterer easier. If you find a caterer you like, go with your gut feeling, but don't forget to let your taste buds have a say in the matter too!
                
                                </p>
                            </div>-->
            </div>

            <!--            <div class="categorylist">
                            <div class="categoryBox">
                                <h3>Most Popular Caterers</h3>
                                <hr/>
                                <ul>
            <?php
            if (!empty($vendorList)) {
                foreach ($vendorList as $vendor) {
                    ?>
                                                    <li>
                                                        <a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DETAILS . cpr_encode($vendor[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]) . '/' . makeSeoFriendlyUrl($vendor[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME])); ?>">
                    <?php echo $vendor[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME]; ?>
                                                        </a>
                                                    </li>
                    <?php
                }
            }
            ?>
                                </ul>
                            </div>
                        </div>-->

            <div class="categorylist">
                <div class="categoryBox">
                    <h3>Most Popular Caterers</h3>
                    <hr/>
                    <ul>
                        <?php
                        if (!empty($stateList)) {
                            foreach ($stateList as $state) {
                                ?>
                                <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_STATE_VENDORS . '/' . $state[DBConfig::TABLE_STATE_ATT_STATE_ID]) ?>"><?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_NAME] ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
        <!--        <div class="stateList">
                    <h3> <i class="icon-anchor"></i>Vendor List By State</h3>
                    <hr/>
        
                    <ul class="nav nav-pills nav-stacked">
                                                <li class="active"><a href="#">Home</a></li>
                                                <li><a href="#">Profile</a></li>
                                                <li><a href="#">Messages</a></li>
        <?php
        foreach ($stateList as $state) {
            ?>
                                <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_STATE_VENDORS . '/' . $state[DBConfig::TABLE_STATE_ATT_STATE_ID]) ?>"><?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_NAME] ?></a></li>
            <?php
        }
        ?>
                    </ul>
                </div>-->
    </div>

</article>