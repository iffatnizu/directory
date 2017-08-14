var directory = {
    
    doLogin: function(form){
        $(".loginstatus").html("Verifying credential....");
        $.ajax({
            type:"POST",
            url:base_url+loginUrl,
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
                    },2000);
                }
            }
        });
        return false;
    }
};
$(document).ready(function(){
    $("form[class=form-signin]").submit(function(){
        return directory.doLogin($(this));
    });
});