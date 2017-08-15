var directory = {
    
    /**
     * Description
     * @method getVendorByState
     * @param {} state
     * @return 
     */
    getVendorByState:function(state)
    {
        var service = $("input[name=category]:checked").val();
        
        if(service!==undefined){
            
            var val = [];
            $("input[name=category]:checked").each(function(i){
                val[i] = $(this).val();
            });
        
            location.href = base_url+advanceSearchUrl+"/?stateID="+state+"&serviceID="+val;
        }
        else{
            alert("Please select at least one service");
        }
    }
};

