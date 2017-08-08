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
                            //alert(data);
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
            <ul>
                <?php
                if (!empty($allCategory)) {
                    foreach ($allCategory as $category) {
                        ?>
                        <?php if ($this->session->userdata('selectCategory' . $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]) == $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]) { ?>
                            <li style="background: rgba(255, 0, 0, 0.8);">
                                <a href="javascript:;">
                                    <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                                </a>
                                <span>
                                    <input type="checkbox" name="category" checked="checked" id="category<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" value="<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" />
                                </span>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="javascript:;">
                                    <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                                </a>
                                <span>
                                    <input type="checkbox" name="category" id="category<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" value="<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" />
                                </span>
                            </li>
                        <?php } ?>
                        <?php
                    }
                }
                ?>
<!--                <input type="submit" value="Get Quote" class="btn btn-danger" onclick="getEventCheckbox()" style="margin-top: 5px;"/>-->
            </ul>
        </div>
        <div class="cateringCategory" style="float: left; margin-left: 350px; width: 630px;">
            <h2 style="margin-left: 20px; color: #fff;">Step 2: Add or Edit Services for the Event</h2>
            <p style="width: 95%; font-size: 12px; margin-left: 10px; color: yellow;">* Add or remove services by selecting from the new on the left</p>
            <p style="width: 95%; font-size: 12px; margin-left: 10px; color: yellow;">* Click on pre-selected service to edit it</p>
            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE.SiteConfig::METHOD_QUOTE_EVENT_INFO.'/'.$this->session->userdata('eventInfoId')); ?>" class="btn btn-danger" style="margin: 10px;">BACK TO EVENT INFO</a>
            <a href="javascript:;" class="btn btn-danger" style="margin: 10px; float: right;" onclick="getEventCheckbox()">NEXT</a>
        </div>
    </div>

    <div class="container">
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

                <a href="<?php echo site_url(SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SIGNUP); ?>" class="btn btn-large btn-info">Sign Up Now <i class="icon-circle-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="bottominfo">
            <div class="box">
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
            </div>
        </div>
    </div>
    <div class="container">
        <div class="categorylist">
            <div class="categoryBox">
                <h3>Most Popular Caterers</h3>
                <hr/>
                <ul><li>
                        <a href="/Catering/atlanta-caterers.asp">Atlanta Catering</a></li>
                    <li><a href="/Catering/austin-caterers.asp">Austin Catering</a></li>

                    <li><a href="/Catering/albuquerque-caterers.asp">Albuquerque Catering</a></li>
                    <li><a href="/Catering/arlington-caterers.asp">Arlington Catering</a></li>
                    <li><a href="/Catering/arlington-tx-caterers.asp">Arlington TX Catering</a></li>
                    <li><a href="/Catering/bakersfield-caterers.asp">Bakersfield Catering</a></li>
                    <li><a href="/Catering/bayarea-caterers.asp">Bay Area Catering</a></li>
                    <li><a href="/Catering/beverlyhills-caterers.asp">Beverly Hills Catering</a></li>
                    <li><a href="/Catering/birmingham-caterers.asp">Birmingham Catering</a></li>

                    <li><a href="/Catering/boston-caterers.asp">Boston Catering</a></li>
                    <li><a href="/Catering/baltimore-caterers.asp">Baltimore Catering</a></li>
                    <li><a href="/Catering/charlotte-caterers.asp">Charlotte Catering</a></li>
                    <li><a href="/Catering/charleston-caterers.asp">Charleston Catering</a></li>
                    <li><a href="/Catering/cincinnati-caterers.asp">Cincinnati Catering</a></li>
                    <li><a href="/Catering/cleveland-caterers.asp">Cleveland Catering</a></li>

                    <li><a href="/Catering/colorado-springs-caterers.asp">Colorado Springs Catering</a></li>
                    <li><a href="/Catering/columbus-caterers.asp">Columbus Catering</a></li>
                    <li><a href="/Catering/corpuschristi-caterers.asp">Corpus Christi Catering</a></li>
                    <li><a href="/Catering/chicago-caterers.asp">Chicago Catering</a></li>
                    <li><a href="/Catering/connecticut-caterers.asp">Connecticut Catering</a></li>
                    <li><a href="/Catering/dallas-caterers.asp">Dallas Catering</a></li>

                    <li><a href="/Catering/delaware-caterers.asp">Delaware Catering</a></li>
                    <li><a href="/Catering/denver-caterers.asp">Denver Catering</a></li>
                    <li><a href="/Catering/detroit-caterers.asp">Detroit Catering</a></li>
                    <li><a href="/Catering/elpaso-caterers.asp">El Paso Catering</a></li>
                    <li><a href="/Catering/Fortlauderdale-caterers.asp">Fort Lauderdale Catering</a></li>
                    <li><a href="/Catering/fortworth-caterers.asp">Fort Worth Catering</a></li>

                    <li><a href="/Catering/fresno-caterers.asp">Fresno Catering</a></li>
                    <li><a href="/Catering/houston-caterers.asp">Houston Catering</a></li>

                    <li><a href="/Catering/honolulu-caterers.asp">Honolulu Catering</a></li>
                    <li><a href="/Catering/indianapolis-caterers.asp">Indianapolis Catering</a></li>
                    <li><a href="/Catering/jacksonville-caterers.asp">Jacksonville Catering</a></li>

                    <li><a href="/Catering/kansascity-caterers.asp">Kansas City Catering</a></li>
                    <li><a href="/Catering/knoxville-caterers.asp">Knoxville Catering</a></li>
                    <li><a href="/Catering/longbeach-caterers.asp">Long Beach Catering</a></li>
                    <li><a href="/Catering/louisville-caterers.asp">Louisville Catering</a></li>
                    <li><a href="/Catering/lasvegas-caterers.asp">Las Vegas Catering</a></li>
                    <li><a href="/Catering/losangeles-caterers.asp">Los Angeles Catering</a></li>

                    <li><a href="/Catering/madison-caterers.asp">Madison Catering</a></li>
                    <li><a href="/Catering/manhattan-caterers.asp">Manhattan Catering</a></li>
                    <li><a href="/Catering/memphis-caterers.asp">Memphis Catering</a></li>
                    <li><a href="/Catering/miami-caterers.asp">Miami Catering</a></li>
                    <li><a href="/Catering/maine-caterers.asp">Maine Catering</a></li>
                    <li><a href="/Catering/massachusetts-caterers.asp">Massachusetts Catering</a></li>

                    <li><a href="/Catering/mesa-caterers.asp">Mesa Catering</a></li>
                    <li><a href="/Catering/minneapolis-caterers.asp">Minneapolis Catering</a></li>
                    <li><a href="/Catering/milwaukee-caterers.asp">Milwaukee Catering</a></li>
                    <li><a href="/Catering/mobile-caterers.asp">Mobile Catering</a></li>
                    <li><a href="/Catering/montgomery-caterers.asp">Montgomery Catering</a></li>

                    <li><a href="/Catering/nashville-caterers.asp">Nashville Catering</a></li>
                    <li><a href="/Catering/newhampshire-caterers.asp">New Hampshire Catering</a></li>
                    <li><a href="/Catering/newjersey-caterers.asp">New Jersey Catering</a></li>

                    <li><a href="/Catering/neworleans-caterers.asp">New Orleans Catering</a></li>
                    <li><a href="/Catering/newyork-caterers.asp">New York Catering</a></li>
                    <li><a href="/Catering/oklahomacity-caterers.asp">Oklahoma City Catering</a></li>
                    <li><a href="/Catering/omaha-caterers.asp">Omaha Catering</a></li>
                    <li><a href="/Catering/orangecounty-caterers.asp">Orange County Catering</a></li>
                    <li><a href="/Catering/orlando-caterers.asp">Orlando Catering</a></li>
                    <li><a href="/Catering/philadelphia-caterers.asp">Philadelphia Catering</a></li>

                    <li><a href="/Catering/phoenix-caterers.asp">Phoenix Catering</a></li>
                    <li><a href="/Catering/pittsburgh-caterers.asp">Pittsburgh Catering</a></li>
                    <li><a href="/Catering/portland-caterers.asp">Portland Catering</a></li>
                    <li><a href="/Catering/rapidcity-caterers.asp">Rapid City Catering</a></li>

                    <li><a href="/Catering/raleigh-catering.asp">Raleigh Catering</a></li>
                    <li><a href="/Catering/rhodeisland-caterers.asp">Rhode Island Catering</a></li>
                    <li><a href="/Catering/riverside-caterers.asp">Riverside Catering</a></li>
                    <li><a href="/Catering/salem-catering.asp">Salem Catering</a></li>
                    <li><a href="/Catering/SaltLakeCity-caterers.asp">Salt Lake City Catering</a></li>  
                    <li><a href="/Catering/sanantonio-caterers.asp">San Antonio Catering</a></li>

                    <li><a href="/Catering/sanbernardino-caterers.asp">San Bernardino Catering</a></li>
                    <li><a href="/Catering/sandiego-caterers.asp">San Diego Catering</a></li>
                    <li><a href="/Catering/sanfrancisco-caterers.asp">San Francisco Catering</a></li>
                    <li><a href="/Catering/sanjose-caterers.asp">San Jose Catering</a></li>
                    <li><a href="/Catering/sacramento-caterers.asp">Sacramento Catering</a></li>

                    <li><a href="/Catering/santamonica-caterers.asp">Santa Monica Catering</a></li>
                    <li><a href="/Catering/scottsdale-catering.asp">Scottsdale Catering</a></li>
                    <li><a href="/Catering/seattle-caterers.asp">Seattle Catering</a></li>
                    <li><a href="/Catering/stlouis-caterers.asp">St. Louis Catering</a></li>
                    <li><a href="/Catering/tampabay-caterers.asp">Tampa Bay Catering</a></li>
                    <li><a href="/Catering/tulsaoklahoma-caterers.asp">Tulsa Oklahoma Catering</a></li>

                    <li><a href="/Catering/tucson-caterers.asp">Tucson Catering</a></li>
                    <li><a href="/Catering/vermont-caterers.asp">Vermont Catering</a></li>
                    <li><a href="/Catering/virginabeach-caterers.asp">Virginia Beach Catering</a></li>
                    <li><a href="/Catering/westpalmbeach-caterers.asp">West Palm Beach Catering</a></li>
                    <li><a href="/Catering/washingtondc-caterers.asp">Washington DC Catering</a></li></ul>
            </div>
        </div>
    </div>
</article>