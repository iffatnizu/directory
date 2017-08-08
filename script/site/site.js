var isClick = false;
var loadId ;
var isUserClick = true; 
var userLoadId;

var directory = {
    
    doLogin: function(form){
        $(".loginstatus").html("Verifying credential....");
        $.ajax({
            type:"POST",
            url:base_url+'vendor/doLogin',
            data:form.serialize()+"&signin=1",
            success:function(res)
            {
                //alert(res);
                if(res=='0')
                {
                    $(".loginstatus").html("Incorrect usernname and password");
                }
                else if(res=='2')
                {
                    $(".loginstatus").html('Your vendor account is suspended.please <a href="'+base_url+'contact.php">contact</a> with site administrator');    
                }
                else{
                    $(".loginstatus").html("Logged in success redirecting....");
                    
                    setTimeout(function(){
                        location.reload();
                    },2000)
                }
            }
        })
        return false;
    },
    
    logout:function()
    {
        var r = confirm('Are you sure ?');
        if(r==true)
            $.ajax({
                type:"GET",
                url:base_url+'vendor/logout',
                success:function(res)
                {
                    //alert(res);
                    if(res=='1'){
                        location.reload();
                    }
                }
            })
    },
    
    changepassword:function(form){
        var oldpass = form.find("input[name=oldpassword]").val();
        var newpass = form.find("input[name=newpassword]").val();
        var connewpass = form.find("input[name=connewpassword]").val();
        var error = 0;
        if(oldpass=="")
        {
            $("span[class=eop]").html("Enter old passowrd"); 
            error = 1;
        }
        else{
            $("span[class=eop]").html(""); 
        }
        
        if(newpass=="")
        {
            $("span[class=enp]").html("Enter new passowrd"); 
            error = 1;
        }
        else{
            $("span[class=enp]").html(""); 
        }
        
        if(connewpass=="")
        {
            $("span[class=ecnp]").html("Confirm new passowrd"); 
            error = 1;
        }
        else{
            $("span[class=ecnp]").html(""); 
        }
        if(connewpass!=newpass)
        {
            $("span[class=ecnp]").html("New passowrd does not match"); 
            error = 1;
        }
        else{
            $("span[class=ecnp]").html(""); 
        }
        
        if(error==0)
        {
            $(".chpstatus").html("Verifying credential....");
           
            $.ajax({
                type:"POST",
                url:base_url+"vendor/updatepassword",
                data:{
                    "oldpass":oldpass,
                    "newpass":newpass
                },
                success:function(res)
                {
                    if(res=='1')
                    {
                        $(".chpstatus").html("Password successfully updated");    
                    }
                    else{
                        $("span[class=eop]").html("old passowrd does not match"); 
                    }
                    $("input[type=password]").val("");
                    setTimeout(function(){
                        $(".chpstatus").html("");  
                        $("span[class=eop]").html(""); 
                    },3000)
                }
            })
        }
        return false;
    },
    
    cityByState:function(stateId)
    {
        $("select[name=cityId]").html("");
        $.ajax({
            type:"GET",
            url:base_url+'home/getcity',
            data:{
                "stateId":stateId
            },
            success:function(res)
            {
                $("select[name=cityId]").prepend('<option value="">Select City</option>');
                var object = $.parseJSON(res);
                $.each(object,function(i,v){
                    $("select[name=cityId]").append('<option value="'+v.cityId+'">'+v.cityName+'</option>');
                })
            }
        })
    },
    
    subscribeNow:function()
    {
        $("div[id=boxes]").show();
    },
    removeSubscribe:function()
    {
        $("div[id=boxes]").hide();
    },
    sendSubscribeFormData:function(form)
    {
        var name = form.find("input[name=txtFirstName]").val();
        var email = form.find("input[name=txtEmail]").val();
        var zip = form.find("input[name=txtZipCode]").val();
        var error = 0;
        if(name=="")
        {
            $("span[class=ferror]").html("Enter your name"); 
            error=1;
        }
        else{
            $("span[class=ferror]").html(""); 
        }
        var emailpat=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var matcharray= email.match(emailpat);
        if(matcharray==null)
        {
            $("span[class=emerror]").html("Enter your valid email"); 
            error=1;
        }
        else{
            $("span[class=emerror]").html(""); 
        }
        if(zip=="")
        {
            $("span[class=zerror]").html("Enter your zip"); 
            error=1;
        }
        else{
            $("span[class=zerror]").html(""); 
        }
        if(error==0){
            $.ajax({
                type:"POST",
                url:base_url+'user/subscribe',
                data:form.serialize()+"&subscriber=1",
                success:function(res)
                {
                    //alert(res);
                    if(res=='1')
                    {
                        $("span[id=successmsg]").html("Your subscription successfully completed");
                        form.find("input[name=txtFirstName]").val("");
                        form.find("input[name=txtEmail]").val("");
                        form.find("input[name=txtZipCode]").val("");   
                    }
                }
            })
        }
       
        return false;
    },
    bookmarkservice:function(serviceid,eventsid,servicelistId)
    {
        $.ajax({
            type:"GET",
            data:{
                "serviceid":serviceid,
                "eventsInfoid":eventsid,
                "servicelistId":servicelistId
            },
            url:base_url+"events/bookmarkservice",
            success:function(res)
            {
                if(res=='1')
                {
                    location.reload();
                     
                }
            }
        })
    },
    removebookmarkservice:function(serviceid,eventsid,servicelistId)
    {
        $.ajax({
            type:"GET",
            data:{
                "serviceid":serviceid,
                "eventsInfoid":eventsid,
                "servicelistId":servicelistId,
                "submit":"1"
            },
            url:base_url+"events/removebookmarkservice",
            success:function(res)
            {
                if(res=='1')
                {
                    location.reload();
                     
                }
            }
        })
    },
    showReviewArea:function(vendorId)
    {
        var reviewArea = '<tr><td>Rating</td><td>1<input checked="checked" type="radio" name="rating" value="1"/>&nbsp;2<input type="radio" name="rating" value="2"/>&nbsp;3<input type="radio" name="rating" value="3"/>&nbsp;4<input type="radio" name="rating" value="4"/>&nbsp;5<input type="radio" name="rating" value="5"/>&nbsp;</td></tr><tr><td>Write review</td><td><textarea name="reviewTxt" style="width: 480px; height: 168px;"></textarea><br clear="all"/><input onclick="directory.submitReview()" value="Submit review" type="button" name="reviewBtn" class="btn btn-info"/><input value="'+vendorId+'" type="hidden" name="vendorId" /> <a onclick="directory.removeReviewArea()" href="javascript:;" class="btn btn-danger btn-small">Close</a></td></tr>';
        $("table[id=reviewTbl]").html(reviewArea).show();
    },
    removeReviewArea:function()
    {
        $("table[id=reviewTbl]").slideUp('slow').empty();
    },
    submitReview:function()
    {
        var reviewTxt = $('textarea[name=reviewTxt]').val();
        var vendorId = $('input[name=vendorId]').val();
        var rating = $('input[name=rating]:checked').val();
        
        //alert(rating);
        
        if(rating==undefined){
            alert('Please Select Rating');
        }
        else {
            $.ajax({
                type:"POST",
                data:{
                    "vendorId":vendorId,
                    "rating":rating,
                    "reviewTxt":reviewTxt,
                    "submit":"1"
                },
                url:base_url+"vendor/submitReview/",
                success:function(res)
                {
                    if(res=='1') {
                        location.reload();
                    } else {
                        alert('You already add a review');
                        $('textarea[name=reviewTxt]').val('');
                    }
                }
            })
        }
    },
    addToFavorite:function(vendorId, status)
    {
        var ans = confirm('Are you sure?');
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "vendorId":vendorId,
                    "status":status,
                    "submit":"1"
                },
                url:base_url+"vendor/addToFavorite/",
                success:function(res)
                {
                    if(res=='1') {
                        location.reload();
                    }
                }
            })
        }
    },
    sendMessageToUser:function()
    {
        var error = 0;
        var msgSubject = $("input[name=msgSubject]").val();
        var msgEid = $("input[name=msgEid]").val();
        var msgDetails = $("div[id=pageContent]").html();
        
        //alert(msgDetails);
        
        if(msgSubject=="")
        {
            $("input[name=msgSubject]").css({
                "border-color":"red"
            })    
            
            error = 1;
        }
        else{
            $("input[name=msgSubject]").css({
                "border-color":""
            })    
        }
        if(msgDetails=="")
        { 
            $("div[id=pageContent]").css({
                "border-color":"red"
            })
            error = 1;
        }
        else{
            $("div[id=pageContent]").css({
                "border-color":""
            })   
        }
        if(error==0)
        {
            $.ajax({
                type:"POST",
                url:base_url+'conversation/sendMessage',
                data:{
                    "subject":msgSubject,
                    "message":msgDetails,
                    "eid":msgEid,
                    "submit":"1"
                },
                success:function(res){
                    if(res=='0')
                    {
                        alert("You are not authorized to send message"); 
                    }
                    else if(res=='1')
                    {
                        alert("Message successfully sent");
                        directory.clearMessageArea();
                        $("button[id=modalClose]").trigger("click")
                    }
                    else if(res=='2')
                    {
                        alert("Try again");     
                    }
                }
            })   
        }
    },
    clearMessageArea:function()
    {
        $("input[name=msgSubject]").val("");
        $("div[id=pageContent]").html("");
    },
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
    },
    submitRating:function(vendorId, rating)
    {
        var ans = confirm('Are you sure?');
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "vendorId":vendorId,
                    "rating":rating
                },
                url:base_url+"vendor/submitRating/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Customer Review Successfully Added');
                        location.reload();
                    } else if(res == '0') {
                        alert('You Already Reviewed This Customer');
                    }
                }
            })
        }
    },
    
    blockedVendor:function(email)
    {
        var ans = confirm('Are you sure want to block?');
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "vendorEmail":email,
                    "submit":"1"
                },
                url:base_url+"administrator/blockedVendor/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Successfully Blocked');
                        location.reload();
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    blockedUser:function(email)
    {
        var ans = confirm('Are you sure want to block?');
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "userEmail":email,
                    "submit":"1"
                },
                url:base_url+"administrator/blockedUser/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Successfully Blocked');
                        location.reload();
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    unblockedVendor:function(email)
    {
        var ans = confirm('Are you sure want to block?');
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "vendorEmail":email,
                    "submit":"1"
                },
                url:base_url+"administrator/unblockedVendor/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Successfully Unblocked');
                        location.reload();
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    unblockedUser:function(email)
    {
        var ans = confirm('Are you sure want to block?');
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "userEmail":email,
                    "submit":"1"
                },
                url:base_url+"administrator/unblockedUser/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Successfully Unblocked');
                        location.reload();
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    getVendorByState:function(state)
    {
        var service = $("input[name=category]:checked").val();
        
        if(service!=undefined){
            
            var val = [];
            $('input[name=category]:checked').each(function(i){
                val[i] = $(this).val();
            });
            
            //alert(val);
        
            location.href = base_url+"vendor/advancesearch/?stateID="+state+"&serviceID="+val;
        }
        else{
            alert("Please select at least one service");
        }
    },
    userReportViolation:function(id,type)
    {
        var ans = confirm('Are you sure want to report this '+type);
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "eid":id,
                    "submit":"1"
                },
                url:base_url+"user/reportViolation/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Report Successfully Sent');
                        location.reload();
                    }
                    else if(res == '0'){
                        alert('Your report already in queue.');
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    vendorReportViolation:function(id,type)
    {
        var ans = confirm('Are you sure want to report this '+type);
        if(ans) {
            $.ajax({
                type:"POST",
                data:{
                    "eid":id,
                    "submit":"1"
                },
                url:base_url+"vendor/reportViolation/",
                success:function(res)
                {
                    if(res == '1') {
                        alert('Report Successfully Sent');
                        location.reload();
                    }
                    else if(res == '0'){
                        alert('Your report already in queue.');
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    updateVendorRatingReview:function(id)
    {
        var rating = $("input[name=rating_"+id+"]:checked").val();
        var review = $("textarea[name=review_"+id+"]").val();
          
        //alert(review);  
          
        if(review!="" && rating!=undefined){ 
            var ans = confirm('Are you sure want to update this');
            if(ans) {
           
            
            
                $.ajax({
                    type:"POST",
                    data:{
                        "vID":id,
                        "review":review,
                        "rating":rating,
                        "submit":"1"
                    },
                    url:base_url+"user/updateVendorRatingReview/",
                    success:function(res)
                    {
                        //console.log(res);
                        if(res == '1') {
                            alert('Rating Successfully Updated');
                            location.reload();
                        }
                        else{
                            alert('Something went wrong.try again');
                        }
                    }
                })
            }
        }
    },
    reportTheRating:function(id)
    {
        var htmlElm = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button><h3 id="myModalLabel">Report this rating! are you sure ?</h3></div><div class="modal-body"><p>Why you going to report this rating! write a short note</p><input type="hidden" name="ratingId" value="'+id+'"/><textarea id="" name="reportReason_'+id+'" style="height: 147px;width: 513px;"></textarea></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button><button onclick="directory.sendReportForRating(\''+id+'\')" class="btn btn-info">Send</button></div>';
        $("div[id=myModal]").html(htmlElm);
    },
    sendReportForRating:function(id)
    {
        var reason = $("textarea[name=reportReason_"+id+"]").val();
        if(reason!=""){
            $.ajax({
                type:"POST",
                data:{
                    "rID":id,
                    "reason":reason,
                    "submit":"1"
                },
                url:base_url+"vendor/sendReportForRating/",
                success:function(res)
                {
                    //console.log(res);
                    if(res == '1') {
                        alert('Report Successfully sent');
                        location.reload();
                    }
                    else if(res == '0'){
                        alert('Your report already in queue.');
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })
        }
    },
    deleteRatingReview:function(vId,uId,rId)
    {
        var ans = confirm('Are you sure want to delete this');
        if(ans)
        {
            $.ajax({
                type:"POST",
                data:{
                    "vID":vId,
                    "uID":uId,
                    "rId":rId,
                    "submit":"1"
                },
                url:base_url+"administrator/deleteRatingReview/",
                success:function(res)
                {
                    //console.log(res);
                    if(res == '1') {
                        alert('Rating Successfully deleted');
                        location.reload();
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })     
        }
    },
    reportMarkAsInvalid:function(rId)
    {
        var ans = confirm('Are you sure want to report this');
        if(ans)
        {
            $.ajax({
                type:"POST",
                data:{
                    "rId":rId,
                    "submit":"1"
                },
                url:base_url+"administrator/reportMarkAsInvalid/",
                success:function(res)
                {
                    //console.log(res);
                    if(res == '1') {
                        alert('Report Successfully Marked As Invalid');
                        location.reload();
                    }
                    else{
                        alert('Something went wrong.try again');
                    }
                }
            })     
        }       
    }
    
}
$(document).ready(function(){
    $("form[class=form-signin]").submit(function(){
        return directory.doLogin($(this));
    })
    
    $("form[class=form-change-pass]").submit(function(){
        return directory.changepassword($(this));
    })
    
    $("form[name=subscribe]").submit(function(){
        return directory.sendSubscribeFormData($(this));
    })
    directory.forceLoadMessage();
    
    setInterval(function(){
        if(isClick==true)
        {
            directory.intervalForLoadMessage();    
        }
    },7000)
    
    
})