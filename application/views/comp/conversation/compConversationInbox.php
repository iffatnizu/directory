<script src="<?php echo base_url() ?>script/site/conversation.js" type="text/javascript"></script>
<div class="commonpages">
    <div>         
        <h2><i class="icon-lock"></i> Conversation Inbox</h2>

        <?php
        if(!empty($allmessage)){
        ?>
        <div class="msgTitleBox">
            <ul>
                <?php
                //debugPrint($allmessage);
                $i = 1;
                foreach ($allmessage as $msg) {
                    ?>
                    <li id="pmid_<?php echo cpr_encode($msg[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID]) ?>">
                        <a id="pmaid_<?php echo cpr_encode($msg[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID]) ?>" class="pm_<?php echo $i; ?>" href="javascript:;" onclick="directory.getAllMessageById('<?php echo cpr_encode($msg[DBConfig::TABLE_EVENT_MESSAGE_ATT_EVENT_INFO_ID]) ?>')">
                            <i class="icon-user"></i>
                            <h6><?php echo $msg[DBConfig::TABLE_EVENT_MESSAGE_ATT_MESSAGE_TITLE] ?></h6>
                            <p>
                                <?php echo $msg[DBConfig::TABLE_EVENT_INFO_ATT_EVENT_NAME] ?>

                                <small>
                                    To : <?php echo $msg['name'] ?><br/>
                                    Unread : <?php echo $msg['unread'] ?>
                                </small>
                            </p>                       
                        </a>
                    </li>
                    <?php
                    $i++;
                }
                ?>
            </ul>
        </div>
        <div class="msgDeatilsBox">
            <div style="min-height: 420px;">
                <div id="reportArea"></div>
                <ul id="msgList">

                </ul>
            </div>
            <div class="sendarea">
                <div class="designelement">
                    <script type="text/javascript" src="<?php echo base_url() ?>script/site/cpr_editor.js"></script>
                    <ul id="formateText">
                        <li><a onclick="changeStyle('bold')" href="javascript:;" class="btn"><i class="icon-bold"></i></a></li>
                        <li><a onclick="changeStyle('italic')" href="javascript:;" class="btn"><i class="icon-italic"></i></a></li>
                        <li><a onclick="changeStyle('underline')" href="javascript:;" class="btn"><i class="icon-underline"></i></a></li>                                                                                             
                        <li><a onclick="changeStyle('insertunorderedlist')" href="javascript:;" class="btn"><i class="icon-list-ul"></i></a></li>
                        <li><a onclick="changeStyle('indent')" href="javascript:;" class="btn"><i class="icon-indent-right"></i></a></li>
                        <li><a onclick="changeStyle('outdent')" href="javascript:;" class="btn"><i class="icon-indent-left"></i></a></li>
                        <li><a onclick="changeFontColor()" href="javascript::" class="btn"><i class="icon-pencil"></i></a></li>

                        <li><a onclick="changeLink()" href="javascript:;" class="btn"><i class="icon-font"></i></a></li>                    
                        <li><a onclick="changeStyle('justifyleft')" href="javascript:;" class="btn"><i class="icon-align-left"></i></a></li>
                        <li><a onclick="changeStyle('justifycenter')" href="javascript:;" class="btn"><i class="icon-align-center"></i></a></li>
                        <li><a onclick="changeStyle('justifyright')" href="javascript:;" class="btn"><i class="icon-align-right"></i></a></li> 
                        <li><a onclick="changeStyle('justifyfull')" href="javascript:;" class="btn"><i class="icon-align-justify"></i></a></li>
                    </ul>

                </div>
                <div class="sendMsgWriteArea">

                </div>
            </div>

        </div>

        <?php
        }
        else
        {
            echo '<h4>No conversation found</h4>';
        }
        ?>

    </div>
</div>
