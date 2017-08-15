<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $site = getSitParameter();
        ?>
        <meta charset="utf-8">
        <title><?php if (isset($title)) echo $title . "||" . $site[DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="<?php echo $site[DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION] ?>"/>
        <meta name="keyword" content="<?php echo $site[DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD] ?>"/>
        <meta name="author" content=""/>
        <!-- Le styles -->
        <!--        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans"/>-->
        <link href="<?php echo base_url(); ?>assets/css/site.css" rel="stylesheet"/>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                  <script src="<?php echo base_url(); ?>script/plugins/bootstrap/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.ico"/>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>


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
        <div  class="container">
            <?php
            // Call header section
            echo (isset($header)) ? $header : '';
            ?>

            <?php
            // Call Content of the page
            echo (isset($content)) ? $content : '';
            ?>

            <?php
            // Call foter section
            echo (isset($footer)) ? $footer : '';
            ?>
        </div>
        <!-- ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <script src="<?php echo base_url(); ?>script/plugins/bootstrap/bootstrap.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>script/core/jquery-1.9.1.js"></script>
        <script type="text/javascript">
                        !function ($) {
                            $(function () {
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

