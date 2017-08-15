var directory = {

    /**
     * Description
     * @method subscribeNow
     * @return 
     */
    subscribeNow: function ()
    {
        $("div[id=boxes]").show();
    },
    /**
     * Description
     * @method removeSubscribe
     * @return 
     */
    removeSubscribe: function ()
    {
        $("div[id=boxes]").hide();
    },
    /**
     * Description
     * @method sendSubscribeFormData
     * @param {} form
     * @return Literal
     */
    sendSubscribeFormData: function (form)
    {
        var name = form.find("input[name=txtFirstName]").val();
        var email = form.find("input[name=txtEmail]").val();
        var zip = form.find("input[name=txtZipCode]").val();
        var error = 0;
        if (name === "")
        {
            $("span[class=ferror]").html("Enter your name");
            error = 1;
        } else {
            $("span[class=ferror]").html("");
        }
        var emailpat = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var matcharray = email.match(emailpat);
        if (matcharray === null)
        {
            $("span[class=emerror]").html("Enter your valid email");
            error = 1;
        } else {
            $("span[class=emerror]").html("");
        }
        if (zip === "")
        {
            $("span[class=zerror]").html("Enter your zip");
            error = 1;
        } else {
            $("span[class=zerror]").html("");
        }
        if (error === 0) {
            $.ajax({
                type: "POST",
                url: base_url + subscribeUrl,
                data: form.serialize() + "&subscriber=1",
                /**
                 * Description
                 * @method success
                 * @param {} res
                 * @return 
                 */
                success: function (res)
                {
                    //alert(res);
                    if (res == '1')
                    {
                        $("span[id=successmsg]").html("Your subscription successfully completed");
                        form.find("input[name=txtFirstName]").val("");
                        form.find("input[name=txtEmail]").val("");
                        form.find("input[name=txtZipCode]").val("");
                    }
                }
            });
        }

        return false;
    }
};

$(document).ready(function () {
    $("form[name=subscribe]").submit(function () {
        return directory.sendSubscribeFormData($(this));
    });
});