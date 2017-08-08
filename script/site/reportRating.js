var directory = {
    
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
                url:base_url+reportUrl,
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
    }
}

