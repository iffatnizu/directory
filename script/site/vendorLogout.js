/**
 * Description
 * @method vendorlogout
 * @return 
 */
function vendorlogout() {
    var r = confirm('Are you sure ?');
    if (r === true)
        $.ajax({
            type: "GET",
            url: base_url + logoutUrl,
            /**
             * Description
             * @method success
             * @param {} res
             * @return 
             */
            success: function (res)
            {
                //alert(res);
                if (res === '1') {
                    location.reload();
                }
            }
        });
}
