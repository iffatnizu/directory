var directory = {

    /**
     * Description
     * @method sendMessageToUser
     * @return 
     */
    sendMessageToUser: function ()
    {
        var error = 0;
        var msgSubject = $("input[name=msgSubject]").val();
        var msgEid = $("input[name=msgEid]").val();
        var msgDetails = $("div[id=pageContent]").html();

        if (msgSubject === "")
        {
            $("input[name=msgSubject]").css({
                "border-color": "red"
            });

            error = 1;
        } else {
            $("input[name=msgSubject]").css({
                "border-color": ""
            });
        }
        if (msgDetails === "")
        {
            $("div[id=pageContent]").css({
                "border-color": "red"
            });
            error = 1;
        } else {
            $("div[id=pageContent]").css({
                "border-color": ""
            });
        }
        if (error === 0)
        {
            $.ajax({
                type: "POST",
                url: base_url + sendMessageToUserUrl,
                data: {
                    "subject": msgSubject,
                    "message": msgDetails,
                    "eid": msgEid,
                    "submit": "1"
                },
                /**
                 * Description
                 * @method success
                 * @param {} res
                 * @return 
                 */
                success: function (res) {
                    if (res == '0')
                    {
                        alert("You are not authorized to send message");
                    } else if (res == '1')
                    {
                        alert("Message successfully sent");
                        directory.clearMessageArea();
                        $("button[id=modalClose]").trigger("click");
                    } else if (res == '2')
                    {
                        alert("Try again");
                    }
                }
            });
        }
    },
    /**
     * Description
     * @method clearMessageArea
     * @return 
     */
    clearMessageArea: function ()
    {
        $("input[name=msgSubject]").val("");
        $("div[id=pageContent]").html("");
    },
    /**
     * Description
     * @method bookmarkservice
     * @param {} serviceid
     * @param {} eventsid
     * @param {} servicelistId
     * @return 
     */
    bookmarkservice: function (serviceid, eventsid, servicelistId)
    {
        $.ajax({
            type: "GET",
            data: {
                "serviceid": serviceid,
                "eventsInfoid": eventsid,
                "servicelistId": servicelistId
            },
            url: base_url + bookmarkserviceUrl,
            /**
             * Description
             * @method success
             * @param {} res
             * @return 
             */
            success: function (res)
            {
                if (res == '1')
                {
                    location.reload();

                }
            }
        });
    },
    /**
     * Description
     * @method removebookmarkservice
     * @param {} serviceid
     * @param {} eventsid
     * @param {} servicelistId
     * @return 
     */
    removebookmarkservice: function (serviceid, eventsid, servicelistId)
    {
        $.ajax({
            type: "GET",
            data: {
                "serviceid": serviceid,
                "eventsInfoid": eventsid,
                "servicelistId": servicelistId,
                "submit": "1"
            },
            url: base_url + removebookmarkserviceUrl,
            /**
             * Description
             * @method success
             * @param {} res
             * @return 
             */
            success: function (res)
            {
                if (res === '1')
                {
                    location.reload();

                }
            }
        });
    }
};


