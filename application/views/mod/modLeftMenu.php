<script type="text/javascript">
    function selectCategory(categoryId) {
        if ($('#category'+categoryId+'').is(':checked')) {
            $('#category'+categoryId+'').prop('checked', false);
        } else {
            $('#category'+categoryId+'').prop('checked', true);
        }
    }
    
    function getCheckedCheckbox(){
        var allVals = [];
        $("input:checkbox[name=category]:checked").each(function() {
            allVals.push($(this).val());
        });        
        $.ajax({
            type:"POST",
            url:"<?php echo base_url() . SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_SET_CATEGORY; ?>",
            data:{
                allVals:allVals
            },
            success:function(data){
                //alert(data);
                if(data == '1')
                    window.location.href='<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_EVENT_INFO); ?>';
            }
        })        
    }
</script>
<ul>
    <?php
    if (!empty($allCategory)) {
        foreach ($allCategory as $category) {
            ?>
            <?php if ($this->session->userdata('selectCategory' . $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]) == $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID]) { ?>
                <li style="background: rgba(255, 0, 0, 0.8);">
                    <?php 
                    if ($this->session->userdata('step1') == 'Done') {
                        if($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] == '1') {
                        ?>
                            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_CATERER . '/' . $this->session->userdata('eventId')); ?>">
                                <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                            </a>
                    <?php } else if($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] == '2') { ?>
                            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_DECORATION . '/' . $this->session->userdata('eventId')); ?>">
                                <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                            </a>
                    <?php } else if($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] == '3') { ?>
                            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_ENTERTAINER . '/' . $this->session->userdata('eventId')); ?>">
                                <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                            </a>
                    <?php } else if($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] == '4') { ?>
                            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_FLORIST . '/' . $this->session->userdata('eventId')); ?>">
                                <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                            </a>
                    <?php } else if($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] == '5') { ?>
                            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_PHOTOGRAPHY . '/' . $this->session->userdata('eventId')); ?>">
                                <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                            </a>
                    <?php } else if($category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID] == '6') { ?>
                            <a href="<?php echo site_url(SiteConfig::CONTROLLER_QUOTE . SiteConfig::METHOD_QUOTE_LIQUOR . '/' . $this->session->userdata('eventId')); ?>">
                                <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                            </a>
                    <?php } ?>
                    <?php } else { ?>
                        <a href="javascript:;">
                            <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                        </a>
                    <?php } ?>
                    <span><img src="<?php echo base_url(); ?>assets/images/true.png" /></span>
                </li>
            <?php } else { ?>
                <li>
                    <a href="javascript:;">
                        <?php echo $category[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_NAME]; ?>
                    </a>
                    <span><img src="<?php echo base_url(); ?>assets/images/false.png" /></span>
                </li>
            <?php } ?>
            <?php
        }
    }
    ?>
</ul>