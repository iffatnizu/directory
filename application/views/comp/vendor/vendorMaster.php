<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset=utf-8/>
        <meta http-equiv=X-UA-Compatible content="IE=edge,chrome=1"/>
        <title><?php echo $title ?> :: Vendor Panel</title>
        <link href="favicon.ico" rel="shortcut icon"/>

        <meta name=viewport content="width=device-width,initial-scale=1"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>script/plugins/fontawasome/css/site.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>script/plugins/fontawasome/css/prettify.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>script/plugins/fontawasome/css/font-awesome.css"/>
        <link href="<?php echo base_url(); ?>assets/css/directory/vendor.css" rel="stylesheet"/>

        <script src="<?php echo base_url() ?>script/core/jquery-1.9.1.js" type="text/javascript"></script> 
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>
        


    </head>
    <body>

        <div id="header-surround">
            <div class="container">
                <?php
                if (isset($header)) {
                    echo $header;
                }
                ?>
            </div>
        </div>
        <div id="navigation" class="well well-large well-transparent lead">
            <div class="container">
                <?php
                if (isset($navigation)) {
                    echo $navigation;
                }
                ?>
            </div>
        </div>
        <div class="well well-large well-transparent lead">
            <div class="container" id="displayContent">
                <?php
                if (isset($content)) {
                    echo $content;
                }
                ?>
            </div>
        </div>
        <?php
        if (isset($footer)) {
            echo $footer;
        }
        ?>

        <script src="<?php echo base_url() ?>script/plugins/fontawasome/js/underscore.min.js"></script> 
        <script src="<?php echo base_url() ?>script/plugins/fontawasome/js/backbone.min.js"></script> 
        <script src="<?php echo base_url() ?>script/plugins/fontawasome/js/prettify.min.js"></script> 
        <script src="<?php echo base_url() ?>script/plugins/fontawasome/js/bootstrap-222.min.js"></script> 
        <script src="<?php echo base_url() ?>script/plugins/fontawasome/js/index/index.js"></script>
    </body>
</html>