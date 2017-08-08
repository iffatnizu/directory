var directory = {
    
    cityByState:function(stateId)
    {
        $("select[name=cityId]").html("");
        $.ajax({
            type:"GET",
            url:base_url+cityUrl,
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
    }
}

