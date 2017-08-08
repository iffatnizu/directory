var isClick = false;
var loadId ;
var isUserClick = true; 
var userLoadId;

var directory = {
    
    getAllMessageById:function(id)
    {
        $(".msgTitleBox ul li").css({
            "background":"#F7F7F7"
        })
        $("li[id=pmid_"+id+"]").css({
            "background":"#DBEAF9"
        });
        $("ul[id=msgList]").html("");
        $.ajax({
            type:"GET",
            url:base_url+"conversation/getMessages",
            data:{
                "eid":id,
                "submit":"1"
            },
            success:function(res)
            {
                if(res!=""){
                    $("div[id=reportArea]").html('<a onclick="directory.vendorReportViolation(\''+id+'\',\'user\')" href="javascript:;"><i class="icon-minus-sign"></i><br/>Report</a>');
                    $("div[class=sendarea]").show();
                    var obj = $.parseJSON(res);
                    $.each(obj,function(index,value){
                        var tag = '<li id="" class="'+value.cssclass+'"><h6><i class="icon-user"></i> '+value.username+' Says :</h6><p>'+value.messageDescription+'</p></li><br clear="all"/>';
                        $("ul[id=msgList]").append(tag);
                    })
                
                    var sendarea = '<div contenteditable="true" id="pageContent" class="sendReply_'+id+'"></div><br clear="all"/><input onclick="directory.sendReply(\''+id+'\')" type="button" class="btn btn-info" name="sendMsg" value="Send"/>';
                
                    $("div[class=sendMsgWriteArea]").html(sendarea);
                    
                    isClick = true; 
                    loadId = id;
                }
            }
        })

    },
    getUserMessageById:function(id)
    {
        $(".msgTitleBox ul li").css({
            "background":"#F7F7F7"
        })
        $("li[id=pmid_"+id+"]").css({
            "background":"#DBEAF9"
        });
        $("ul[id=msgList]").html("");
        $.ajax({
            type:"GET",
            url:base_url+"user/getMessages",
            data:{
                "eid":id,
                "submit":"1"
            },
            success:function(res)
            {
                if(res!=""){
                    
                    $("div[id=reportArea]").html('<a onclick="directory.userReportViolation(\''+id+'\',\'vendor\')" href="javascript:;"><i class="icon-minus-sign"></i><br/>Report</a>');
                    $("div[class=sendarea]").show();
                    var obj = $.parseJSON(res);
                    $.each(obj,function(index,value){
                        var tag = '<li id="" class="'+value.cssclass+'"><h6><i class="icon-user"></i> '+value.username+' Says :</h6><p>'+value.messageDescription+'</p></li><br clear="all"/>';
                        $("ul[id=msgList]").append(tag);
                    })
                
                    var sendarea = '<div contenteditable="true" id="pageContent" class="sendReply_'+id+'"></div><br clear="all"/><input onclick="directory.sendUserReply(\''+id+'\')" type="button" class="btn btn-info" name="sendMsg" value="Send"/>';
                
                    $("div[class=sendMsgWriteArea]").html(sendarea);
                    
                    isUserClick = true; 
                    userLoadId = id;
                }
            }
        })

    },
    intervalForLoadMessage:function()
    {
        $.ajax({
            type:"GET",
            url:base_url+"conversation/getMessages",
            data:{
                "eid":loadId,
                "submit":"1"
            },
            success:function(res)
            {               
                if(res!=""){
                    $("ul[id=msgList]").html("");
                    var obj = $.parseJSON(res);
                    $.each(obj,function(index,value){
                        var tag = '<li id="" class="'+value.cssclass+'"><h6><i class="icon-user"></i> '+value.username+' Says :</h6><p>'+value.messageDescription+'</p></li><br clear="all"/>';
                        $("ul[id=msgList]").append(tag);
                    })

                }
            }
        })

    },
    intervalForLoadUserMessage:function()
    {
        $.ajax({
            type:"GET",
            url:base_url+"user/getMessages",
            data:{
                "eid":userLoadId,
                "submit":"1"
            },
            success:function(res)
            {
                if(res!=""){
                    $("ul[id=msgList]").html("");
                    var obj = $.parseJSON(res);
                    $.each(obj,function(index,value){
                        var tag = '<li id="" class="'+value.cssclass+'"><h6><i class="icon-user"></i> '+value.username+' Says :</h6><p>'+value.messageDescription+'</p></li><br clear="all"/>';
                        $("ul[id=msgList]").append(tag);
                    })
                }
            }
        })

    },
    forceLoadMessage:function()
    {
        $("a[class=pm_1]").trigger("click");
    },
    sendReply:function(eid)
    {
        var replyMsg = $("div[class=sendReply_"+eid+"]").html();
        if(replyMsg=="")
        {
            $("div[class=sendReply_"+eid+"]").css({
                "border-color":"red"
            })      
        }
        else{
            $.ajax({
                type:"POST",
                url:base_url+'conversation/sendReply',
                data:{
                    "replyMsg":replyMsg,
                    "eid":eid,
                    "submit":"1"
                },
                success:function(res){
                    var obj = $.parseJSON(res);
                    var tag = '<li id="" class="'+obj.cssclass+'"><h6><i class="icon-user"></i> '+obj.username+' Says :</h6><p>'+obj.messageDescription+'</p></li><br clear="all"/>';
                    $("ul[id=msgList]").append(tag);
                    $("div[class=sendReply_"+eid+"]").html("");
                }
            })
        }
    },
    sendUserReply:function(eid)
    {
        var replyMsg = $("div[class=sendReply_"+eid+"]").html();
        if(replyMsg=="")
        {
            $("div[class=sendReply_"+eid+"]").css({
                "border-color":"red"
            })      
        }
        else{
            $.ajax({
                type:"POST",
                url:base_url+'user/sendUserReply',
                data:{
                    "replyMsg":replyMsg,
                    "eid":eid,
                    "submit":"1"
                },
                success:function(res){
                    var obj = $.parseJSON(res);
                    var tag = '<li id="" class="'+obj.cssclass+'"><h6><i class="icon-user"></i> '+obj.username+' Says :</h6><p>'+obj.messageDescription+'</p></li><br clear="all"/>';
                    $("ul[id=msgList]").append(tag);
                    $("div[class=sendReply_"+eid+"]").html("");
                }
            })
        }
    }
}
$(document).ready(function(){   
    directory.forceLoadMessage();
    
    setInterval(function(){
        if(isClick==true)
        {
            directory.intervalForLoadMessage();    
        }
    },7000)
})

