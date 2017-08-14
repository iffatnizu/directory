var directory = {
    changepassword:function(form){
        var oldpass = form.find("input[name=oldpassword]").val();
        var newpass = form.find("input[name=newpassword]").val();
        var connewpass = form.find("input[name=connewpassword]").val();
        var error = 0;
        if(oldpass==="")
        {
            $("span[class=eop]").html("Enter old passowrd"); 
            error = 1;
        }
        else{
            $("span[class=eop]").html(""); 
        }
        
        if(newpass==="")
        {
            $("span[class=enp]").html("Enter new passowrd"); 
            error = 1;
        }
        else{
            $("span[class=enp]").html(""); 
        }
        
        if(connewpass==="")
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
        
        if(error===0)
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
                    },3000);
                }
            });
        }
        return false;
    }
};
$(document).ready(function(){
    $("form[class=form-change-pass]").submit(function(){
        return directory.changepassword($(this));
    });
});