<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <!-- Le styles -->
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans"/>
        <link href="<?php echo base_url(); ?>assets/css/site.css" rel="stylesheet"/>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url(); ?>script/core/jquery-1.8.1.min.js"></script> 

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                  <script src="<?php echo base_url(); ?>script/plugins/bootstrap/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.ico"/>
    </head>
    <body>

        <div class="popUp">
            <div id="popup">
                <div id="popframe">
                    <div class="popNotification"></div><div class="popError"></div>&nbsp; 
                    <a href="javascript:;" onclick="hideAll()">Go Back</a></p>
                </div>
            </div>
        </div>

        <header>
            <div id="headerLogo">
                <div class="container">
                    <div class="logo">
                        <a href=""><img src="<?php echo base_url() ?>assets/images/logo.png" alt="logo" title="<?php echo $title ?>"/></a>
                        <span class="slogan">Your Local Catering</span>
                    </div>
                    <div class="contactandsearch">
                        <div class="iconphone">
                            &nbsp;
                        </div>
                        <div class="contactDetails">
                            24/7 Support Number<br/>
                            <span>1-555-555-555</span>
                        </div>
                    </div>

                    <div class="topbox">
                        <div class="boxtop">
                            <ul>
                                <li><a href="">MY ACCOUNT</a></li>
                                <li><a href="">ENGLISH (US)</a></li>
                                <li><a href="">$(US DOLLER)</a></li>
                            </ul>
                        </div>
                        <div class="boxbottom">

                        </div>
                    </div>
                </div>                
            </div>
            <div class="container">
                <div class="navbar">
                    <div class="menubar">
                        <div class="container">
                            <ul>
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Downloads</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <article>
            <div class="container">
                <div id="dslider">
                    <img src="<?php echo base_url() ?>assets/images/directory_slider.png" alt="d_slider"/>
                </div>
                <div class="tab">
                    <div class="tabbar">
                        <ul>
                            <li><a href="#">Catering</a></li>
                            <li id="ex2" class=""><a href="#">Reception Halls</a></li>
                            <li id="ex2" class=""><a href="#">Dj/Entertainers</a></li>
                            <li><a href="#">Florists</a></li>
                            <li id="ex" class="active1"><a href="#">Photographers/Video</a></li>
                            <li><a href="#">Limos</a></li>
                        </ul>
                    </div>
                    <div class="taboption">
                        <br clear="all"/>
                        <form action="" method="GET">
                            <table class="">
                                <tr>
                                    <th>Date of Event :</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="event"/></td>
                                </tr>
                                <tr>
                                    <th>Event City :</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="event"/></td>
                                </tr>
                            </table>
                            <span class="separator"></span>
                            <table class="">
                                <tr>
                                    <th>Event Type :</th>
                                </tr>
                                <tr>
                                    <td><select name="type"><option>-Please Select-</option></select></td>
                                </tr>
                                <tr>
                                    <th>Number of Guests :</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="event"/></td>
                                </tr>
                            </table>
                            <span class="separator"></span>
                            <table class="">
                                <tr>
                                    <th>Event Location :</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="location" value="1"/> I need a location<br/>
                                        <input type="radio" name="location" value="0"/> I already have a location
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <span class="separator"></span>
                            <table class="info">
                                <tr>
                                    <th valign="top">Name :</th>
                                    <td>&nbsp;<input type="text" name="event"/></td>
                                </tr>
                                <tr>
                                    <th valign="top">Phone :</th>
                                    <td>&nbsp;<input type="text" name="phone"/> <input type="text" name="phone"/> <input type="text" name="phone"/> Ext : <input type="text" name="phone"/></td>
                                </tr>
                                <tr>
                                    <th valign="top">Email :</th>
                                    <td>&nbsp;<input type="text" name="event"/></td>
                                </tr>

                            </table>
                            <br clear="all"/>
                            <input type="submit" name="advsearch" value="PROCEED TO RESULT"/>
                        </form>                      
                    </div>
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

                        <a href="#" class="btn btn-large btn-warning">Sign Up Now <i class="icon-circle-arrow-right"></i></a>
                    </div>
                    <hr/>
                </div> 

            </div>
            
            
            

        </article>





        <footer>
            <div class="container">
                <p>&copy; Company 2013</p>
            </div>
        </footer>





        <!-- ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <script src="<?php echo base_url(); ?>script/plugins/bootstrap/bootstrap.js"></script> 
        <script type="text/javascript">
                !function ($) {
                $(function(){
                    // carousel demo
                    $('#myCarousel').carousel({
                        interval: 7000
                    })
                })
            }(window.jQuery)
        </script> 
        <script src="<?php echo base_url(); ?>script/plugins/bootstrap/holder.js"></script>
    </body>
</html>

