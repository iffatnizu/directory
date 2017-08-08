<script>
    var advanceSearchUrl = '<?php echo SiteConfig::CONTROLLER_VENDOR.SiteConfig::METHOD_VENDOR_ADVANCE_SEARCH ?>';
</script>
<script src="<?php echo base_url() ?>script/site/advanceSearch.js" type="text/javascript"></script>
<div class="commonpages">
    <div>
        <h2><i class="icon-user"></i> <?php echo $title ?> ...</h2>

        <hr/>
        <div id="vdleftContent">
            <h3>Step 1:</h3>
            <ul>
                <li class="lft_cont_txt">What are you looking for?</li>
                <li style="font-size:15px;" class="lft_cont_txt">
                    <?php
                    foreach ($category as $ca) {
                        $checked = "";
                        if (!empty($servicesarray)) {
                            if (in_array($ca[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID], $servicesarray) == true) {
                                $checked = 'checked="checked"';
                            } else {
                                $checked = "";
                            }
                        }
                        ?>
                        <input style="margin-top: -3px;" type="checkbox" <?php echo $checked; ?> name="category" value="<?php echo $ca[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] ?>"/> <?php echo $ca[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME] ?> <br/>
                        <?php
                    }
                    ?>

                </li>

                <!-- Home Page Vendor Hilites -->


            </ul>
        </div>
        <div id="vdrightContent">
<!--            <img src="<?php echo base_url() ?>assets/images/locationmapaust.jpg"/>-->

            <div class="map">
                <div><a class="wa" title="Western Australia" href="javascript:;" onclick="directory.getVendorByState('8')"></a></div>
                <div><a class="nt" title="Northen Territory" href="javascript:;" onclick="directory.getVendorByState('3')"></a></div>
                <div><a class="ql" title="Queensland" href="javascript:;" onclick="directory.getVendorByState('4')"></a></div>
                <div><a class="act" title="Australian Capital Territory" href="javascript:;" onclick="directory.getVendorByState('1')"></a></div>
                <div><a class="vc" title="Victoria" href="javascript:;" onclick="directory.getVendorByState('7')"></a></div>
                <div><a class="ts" title="Tasmania" href="javascript:;" onclick="directory.getVendorByState('6')"></a></div>
                <div><a class="sa" title="South Australia" href="javascript:;" onclick="directory.getVendorByState('5')"></a></div>
                <div><a class="nsw" title="New South Wales" href="javascript:;" onclick="directory.getVendorByState('2')"></a></div>
                <div><a style="left:558px; top:520px; background:transparent; display:block; width:202px; height:17px; overflow:hidden; position:absolute; font-size:0px;"></a></div>
            </div>






            <!--            <div id="map_canvas" class="map rounded"></div>
                        <div id="dialog" style="display: none;"></div>
            
                        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
                        <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/gmaps/modernizr.min.js"></script>
                        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>script/plugins/gmaps/jquery-ui.css" />
                        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>script/plugins/gmaps/mp.css" />
                        <script type="text/javascript" src="<?php echo base_url() ?>script/core/jquery-1.9.1.js"></script>
                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
            
                        <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/gmaps/maps.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/gmaps/jquery.ui.map.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/gmaps/jquery.ui.map.services.js"></script>
                        <script type="text/javascript" src="<?php echo base_url() ?>script/plugins/gmaps/jquery.ui.map.extensions.js"></script>
            
                        <script type="text/javascript">
                            $(function() { 
                                
                                demo.add(function() {
                                    $('#map_canvas').gmap({ 'disableDefaultUI':true, 'callback': function(map) {
                                            var self = this;
                                            self.set('openDialog', function(marker) {
                                                $('#dialog'+marker.__gm_id).dialog({'modal':true, 'title': 'Edit and save point', 'buttons': { 
                                                        'Remove': function() { $(this).dialog('close'); marker.setMap(null); return false; },
                                                        'Save': function() { $(this).dialog('close'); return false; }
                                                    }});
                                            });
                                            self.set('findLocation', function(location, marker) {
                                                self.search({'location': location}, function(results, status) {
                                                    
                                                    gotresult(results);
                                                    
                                                    if ( status === 'OK' ) {
                                                        $.each(results[0].address_components, function(i,v) {
                                                            if ( v.types[0] == "administrative_area_level_1" || v.types[0] == "administrative_area_level_2" ) {
                                                                $('#state'+marker.__gm_id).val(v.long_name);
                                                            } else if ( v.types[0] == "country") {
                                                                $('#country'+marker.__gm_id).val(v.long_name);
                                                            }
                                                        });
                                                        marker.setTitle(results[0].formatted_address);
                                                        $('#address'+marker.__gm_id).val(results[0].formatted_address);
                                                        self.get('openDialog')(marker);
                                                    }
                                                });
                                            });
                                            $(map).click( function(event) {                               
                                                self.addMarker({'position': event.latLng, 'draggable': true, 'bounds': false}, function(map, marker) {
                                                    //$('#dialog').append('<form id="dialog'+marker.__gm_id+'" method="get" action="/" style="display:none;"><p><label for="country">Country</label><input id="country'+marker.__gm_id+'" class="txt" name="country" value=""/></p><p><label for="state">State</label><input id="state'+marker.__gm_id+'" class="txt" name="state" value=""/></p><p><label for="address">Address</label><input id="address'+marker.__gm_id+'" class="txt" name="address" value=""/></p><p><label for="comment">Comment</label><textarea id="comment" class="txt" name="comment" cols="40" rows="5"></textarea></p></form>');
                                                    self.get('findLocation')(marker.getPosition(), marker);    
                                                }).dragend( function(event) {
                                                    self.get('findLocation')(event.latLng, this);
                                                }).click( function() {                                        
                                                    //self.get('openDialog')(this);
                                                })
                                            });
                                        }});
                                }).load();
                            });
                            
                            function gotresult(data)
                            {
                                $.each(data[0].address_components, function(i,v) {
                                    //alert(v.types[1]);
                                    if ( v.types[0] == "locality" || v.types[0] == "political" ) {
                                        alert(v.long_name);
                                    }
                                });
                     
                            }
                        </script>
                            <script type="text/javascript">
                                function CheckSearchForm(frm){
                                    if(frm.zipcode.value==""){
                                        alert("Please enter city or zipcode");
                                        return false;
                                    }
                                    //alert("This page is currently being worked on. Please come back soon.");
                                }
                            </script>
                            <form onsubmit="return CheckSearchForm(this);" name="frmVendorSearch" method="post" action="vendor-directory-listing.asp">
                                <input type="hidden" value="1" id="hidServiceType" name="ServiceID">
                                <h3>Step 2:</h3>
                                <ul>
                                    <li class="rgt_cont_txt">Enter a City in the field.</li>						
                                    <li>
                                        <span>
                                            <input type="text" autocomplete="off" class="txt_box ac_input" id="zipcode" name="zipcode"/>
                                        </span>
                                        <br/>
                                        <span>
                                            <input type="submit" value="Search" class="btn btn-info"/>
                                        </span>
                                    </li>
                
                                    
                                </ul>
                                <img  alt="map" src="<?php echo base_url() ?>assets/public/vendor/map-img.jpg"/>
                            </form>
                    </div>-->

        </div>

        <link href="<?php echo base_url() ?>script/plugins/datatable/css/demo_table_jui.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>script/plugins/datatable/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function() {
                var oTable = $('#searchResult').dataTable( {                               
                    "bJQueryUI": false,
                    "sPaginationType": "full_numbers",
                    "aaSorting": []
                });
            } );
        </script>
        <?php
        if (isset($_GET['stateID'])) {
            if (isset($_GET['serviceID'])) {
                echo '<br clear="all"/><h3><i class="icon-cogs"></i> Search Result : <small>'.$stateName.'->'.$services.'</small></h3>';

                if (!empty($advSrcResult)) {
                    ?>

                    <table id="searchResult" style="float: left;">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>City</td>
                                <th>State</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($advSrcResult as $vendor) { ?>
                                <tr>
                                    <td><a href="<?php echo site_url(SiteConfig::CONTROLLER_VENDOR . SiteConfig::METHOD_VENDOR_DETAILS . cpr_encode($vendor[DBConfig::TABLE_VENDOR_ATT_VENDOR_ID]) . '/' . makeSeoFriendlyUrl($vendor[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME])) ?>"><?php echo $vendor[DBConfig::TABLE_VENDOR_ATT_VENDOR_NAME]; ?></a></td>
                                    <td><?php echo $vendor[DBConfig::TABLE_CITY_ATT_CITY_NAME]; ?></td>
                                    <td><?php echo $vendor[DBConfig::TABLE_STATE_ATT_STATE_NAME]; ?></td>
                                    <td>Vote : <?php echo $vendor['rating']['vote']; ?> <?php echo $vendor['rating']['ratebar']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo '<br clear="all"/>No result found';
                }
            }
        }



        //debugPrint($advSrcResult);
        ?>
    </div>
</div>