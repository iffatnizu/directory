<div class="commonpages">
    <script type="text/javascript">
        $(document).ready(function(){
            // FAQ Code
            $('#faqs h5').each(function() {
                var tis = $(this), state = false, answer = tis.next('div').hide().css('height','auto').slideUp();
                tis.prepend("<span>+</span> ")
                tis.click(function() {
                    state = !state;
                    answer.slideToggle(state);
                    tis.toggleClass('active',state);
                    if(tis.hasClass('active')) {
                        tis.find('span').text('→');
                    } else {
                        tis.find('span').text('+');
                    }
                });
            }); // end each faqs
        })
    </script>
    <div>
        <h2><i class="icon-question-sign"></i> <?php echo $title ?> ...</h2>


        <div class="maincontent" id="faqs"><!-- dont remove this id faqs -->
            <p>Select one of the above questions to find out it's answer.</p>
            <?php
            if (!empty($faq)) {
                foreach ($faq as $value) {
                    ?>
                    <h5><?php echo $value[DBConfig::TABLE_FAQ_ATT_FAQ_QUESTION]; ?></h5>
                    <div>
                        <p><?php echo $value[DBConfig::TABLE_FAQ_ATT_FAQ_ANSWER]; ?></p>
                    </div><!-- end faq item -->
                    <?php
                }
            }
            ?>

        </div>
        <?php
        //echo $content[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS];
        ?>
    </div>
</div>