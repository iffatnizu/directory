<script>
    var addToFavoriteUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_ADD_TO_FAVORITE ?>';
    var submitReviewUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_SUBMIT_REVIEW ?>';
    var submitRating = '<?php echo base_url() . SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_SUBMIT_RATING_AJAX ?>';
</script>
<script src="<?php echo base_url() ?>script/site/vendorDetails.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript">
    function CheckAndFocus(control, noofchars, focusControl) {	    
        if(document.getElementById(control).value.length == noofchars) {   
            document.getElementById(focusControl).focus(); }               
    }
    function getCityByStateId(stateId) {
        $.ajax({
            type: "POST",
            url: '<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_GET_CITY_BY_STATE_ID); ?>',
            data: {
                stateId:stateId
            },
            success: function(data) {
                //alert(data);
                var obj = jQuery.parseJSON(data);
                //alert(obj[0].value);
                $('select[id=city]').html('');
                $('select[id=city]').append('<option value="" >Please Select ...</option>');
                $.each(obj, function(key, val) {
                    $('select[id=city]').append('<option value="' + val.cityId + '" >'+ val.cityName+'</option>');
                });
            }
        });
    }
</script>
<script type="text/javascript" src="<?php echo base_url() ?>script/site/checkbox.js"></script>
<script type="text/javascript">
    jQuery(function(){
        var max = 3;
        var checkboxes = $('input[type="checkbox"]');

        checkboxes.change(function(){
            var current = checkboxes.filter(':checked').length;
            checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
        });
        
        $("ul li").click(function(){
            var check = $(this).find("input[type=checkbox]").attr("checked");
            
            if(check==undefined){
                var truePng = base_url+'assets/images/true.png'; 
                $(this).find("img").attr("src",truePng);
                $(this).css({"background":"rgba(255, 255, 255,0.8)"})
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
    
    function getEventCheckbox(){
        var allVals = [];
        $("input:checkbox[name=category]:checked").each(function() {
            allVals.push($(this).val());
        });
        if(allVals.length != 0) {
            //            alert(allVals);
            $('input[name=allVals]').val(allVals);
            return true;
        } else {
            alert('Please select at least one service');
            return false;
        }
    }
</script>
<div class="commonpages">
    <div>
        <h2><i class="icon-user"></i> <?php echo $vendorname ?> ...</h2>

        <div class="cateringQuetos">
            <?php
            //debugPrint($vendorDetails);
            ?>
            <h4>Step 1: Event Information</h4>
            <form method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DETAILS . $this->uri->segment(3) . '/' . $this->uri->segment(4)); ?>">
                <ul>
                    <?php
                    if (!empty($allCategory)) {
                        foreach ($allCategory as $category) {
                            ?>
                            <li>
                                <a href="javascript:;" style="width: 180px; float: left;">
                                    <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                                </a>
                                <span>
                                    <input type="checkbox" name="category" id="category<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" value="<?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]; ?>" />
                                </span>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <input type="hidden" name="allVals" />
                <br class="clear" />
                <ul>
                    <li>
                        Type of Event:<br />
                        <select class="textbox" name="<?php echo DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID; ?>">
                            <option value="" selected="selected">Select One</option>
                            <?php foreach ($vendor as $value): ?>
                                <option value="<?php echo $value[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_ID] ?>"><?php echo $value[DBConfig::TABLE_EVENT_TYPE_ATT_EVENT_NAME] ?></option>
                            <?php endforeach; ?>
                        </select><br/>
                        <?php echo form_error(DBConfig::TABLE_EVENT_ATT_EVENT_TYPE_ID); ?>
                    </li>
                    <li>
                        If Other please specify:<br>
                        <input name="otherEvent" type="text" value="<?php echo set_value('otherEvent'); ?>" />
                    </li>
                    <li>
                        Formal or Casual Event:<br>
                        <select name="eventStatus">
                            <option value=""></option>
                            <option value="1" <?php echo set_select('eventStatus', '1'); ?>>Black Tie</option>
                            <option value="2" <?php echo set_select('eventStatus', '2'); ?>>Casual</option>
                            <option value="3" <?php echo set_select('eventStatus', '3'); ?>>Formal</option>
                            <option value="4" <?php echo set_select('eventStatus', '4'); ?>>Semiformal</option>
                        </select>
                    </li>
                    <li>
                        Name of Event:<br>
                        <input name="<?php echo DBConfig::TABLE_EVENT_ATT_NAME; ?>" type="text" value="<?php echo set_value(DBConfig::TABLE_EVENT_ATT_NAME); ?>" />
                        <br/>
                        <?php echo form_error(DBConfig::TABLE_EVENT_ATT_NAME); ?>
                    </li>
                    <li>
                        Event State:<br>
                        <select name="stateId" onchange="getCityByStateId(this.value);">
                            <option value="">Please Select ...</option>
                            <?php
                            if (!empty($allState)) {
                                foreach ($allState as $state) {
                                    ?>
                                    <option value="<?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_ID]; ?>" <?php echo set_select('stateId', $state[DBConfig::TABLE_STATE_ATT_STATE_ID]) ?>>
                                        <?php echo $state[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <br/>
                        <?php echo form_error('stateId'); ?>
                    </li>
                    <li>
                        Event Suburb:<br />
                        <select name="<?php echo DBConfig::TABLE_EVENT_ATT_CITY_ID; ?>" id="city">
                            <option value="">Select One</option>
                        </select>
                        <br/>
                        <?php echo form_error(DBConfig::TABLE_EVENT_ATT_CITY_ID); ?>
                    </li>
                    <li class="btn_get_quotes">
                        <input type="submit" value="Submit" class="btn btn-small btn-info" onclick="return getEventCheckbox();" />
                    </li>
                </ul>
            </form>
        </div>


        <div class="cateringDetails">
            <?php
            if ($vendorDetails[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE]) {
                $vlogo = base_url() . 'assets/public/vendor/' . $vendorDetails[DBConfig::TABLE_VENDOR_ATT_VENDOR_PROFILE_IMAGE];
            } else {
                $vlogo = base_url() . 'assets/public/vendor/' . getDefaultVendorLogo();
            }
            ?>
            <img src="<?php echo $vlogo; ?>" alt="logo" style="float: right;" width="120" height="120"/>
            <h3> <?php echo $vendorDetails[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME]; ?></h3>
            <p><?php echo $vendorDetails[DBConfig::TABLE_VENDOR_ATT_VENDOR_EMAIL]; ?></p>

            <h5>Vendor Service :</h5>

            <ul>
                <?php
                foreach ($vendorDetails['servicename'] as $service) {
                    ?>
                    <li><?php echo $service ?></li>
                    <?php
                }
                ?>
            </ul>

            <div id="reviewarea">
                <p>
                    <span style="font-size:18px;" class="url">www.QSBBQ.com</span><br/><br/>
                    Customer Reviews:

                    <?php //if ($this->session->userdata('userLogin')) {  ?>

                    <?php
                    // echo getRatingBar($vendorRating);
                    //for ($i = 0; $i < 5; $i++) {
                    ?>
<!--                            <a href="javascript:;" onclick="directory.submitRating('<?php echo cpr_decode($this->uri->segment(3)); ?>', '<?php echo $i; ?>');">
                                <i class="icon-star" style="color: #D5B05B"></i>                            
                            </a>-->

                    <?php
//}
//} else {
//echo getRatingBar($vendorRating);
//}
//echo $vendorRating;
//echo '(' . $english_format_number = number_format($vendorRating, 2, '.', '') . ')';
                    ?>

                    <?php //echo getRatingBar($vendorRating); ?>

                <div class="exemple">
                    <div class="basic" data-average="<?php echo $vendorRating ?>" data-id="1"></div>
                    <div class="rsts"></div>
                </div>
                <br clear="all"/>

                <link rel="stylesheet" href="<?php echo base_url() ?>script/plugins/jRating/jquery/jRating.jquery.css" type="text/css" />

                <script>
                    var jrateUrl = '<?php echo base_url() ?>script/plugins/jRating/';
                    var vId = '<?php echo $this->uri->segment(3); ?>';
                    //var status;
                </script>

                <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/jRating/jquery/jquery.js"></script>
                <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/jRating/jquery/jRating.jquery.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){                        
                        $(".basic").jRating({
                            canRateAgain : false,
                            showRateInfo:false,
                            step:true,
                            isDisabled : '<?php if ($vendorDetails['allreadyrated'] == 1) {
                        echo 'true';
                    } ?>'
                        });
                    });
                </script>
                </p>
            </div>


            <p>
                <span class='st_sharethis_vcount' displayText='ShareThis'></span>
                <span class='st_facebook_vcount' displayText='Facebook'></span>
                <span class='st_twitter_vcount' displayText='Tweet'></span>
                <span class='st_linkedin_vcount' displayText='LinkedIn'></span>
                <span class='st_pinterest_vcount' displayText='Pinterest'></span>
                <span class='st_email_vcount' displayText='Email'></span>

                <script type="text/javascript">var switchTo5x=true;</script>
<!--                <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>-->
                <script type="text/javascript">stLight.options({publisher: "ur-84fb572c-354a-4da1-d374-228dae089d17", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
            </p>

            <?php
            if ($this->session->userdata('userLogin')) {
                ?>
                <p>

                    <?php
                    if (empty($vendorReview)) {
                        ?>

                        <a class="btn btn-small btn-danger" onclick="directory.showReviewArea('<?php echo cpr_decode($this->uri->segment(3)); ?>')">Write A Review</a>
                        <?php
                    }
                    ?>
                        <?php if ($this->session->userdata('userLogin')) { ?>
                        <a class="btn btn-small btn-success" onclick="directory.addToFavorite('<?php echo cpr_decode($this->uri->segment(3)); ?>','<?php echo ($vendorDetails['favoriteStatus'] == 1) ? '0' : '1'; ?>')">
                        <?php echo ($vendorDetails['favoriteStatus'] == 1) ? 'Remove Favorite' : 'Add to Favorite'; ?>
                        </a>
                    <?php } else { ?>
                        <a class="btn btn-small btn-success" onclick="return alert('Please Login');">Add to Favorite</a>
    <?php } ?>

                </p>
                <br/>
                <table>
                    <?php
                    //debugPrint($vendorReview);
                    if (!empty($vendorReview)) {
                        foreach ($vendorReview as $review) {
                            ?>
                            <tr>
                                <td style="width: 120px;" valign="top"><strong><?php echo $review['userName']; ?> : </strong></td>
                                <td valign="top">
                                    <div><?php echo $review[DBConfig::TABLE_VENDOR_REVIEW_ATT_REVIEW]; ?></div>
                                    <br clear="all"/>
                                    <small class="btn btn-danger btn-mini">Rating : <?php echo $review['totalRating']; ?> of 5</small>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>


                <br/>
                <?php
                if ($this->session->userdata('userLogin')) {
                    ?>
                    <table id="reviewTbl">

                    </table>
                    <?php
                }
                ?>

                <?php
            }
            ?>


        </div>

    </div>
</div>