function vendorlogout(){
    var r = confirm('Are you sure ?');
    if(r==true)
        $.ajax({
            type:"GET",
            url:base_url+logoutUrl,
            success:function(res)
            {
                //alert(res);
                if(res=='1'){
                    location.reload();
                }
            }
        })
}
