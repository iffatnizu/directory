var directory = {

    /**
     * Description
     * @method addToFavorite
     * @param {} vendorId
     * @param {} status
     * @return 
     */
    addToFavorite: function (vendorId, status)
    {
        var ans = confirm('Are you sure?');
        if (ans) {
            $.ajax({
                type: "POST",
                data: {
                    "vendorId": vendorId,
                    "status": status,
                    "submit": "1"
                },
                url: base_url + addToFavoriteUrl,
                /**
                 * Description
                 * @method success
                 * @param {} res
                 * @return 
                 */
                success: function (res)
                {
                    if (res == '1') {
                        location.reload();
                    }
                }
            })
        }
    },
    /**
     * Description
     * @method showReviewArea
     * @param {} vendorId
     * @return 
     */
    showReviewArea: function (vendorId)
    {
        var reviewArea = '<tr><td>Write review</td><td><textarea name="reviewTxt" style="width: 480px; height: 168px;"></textarea><br clear="all"/><input onclick="directory.submitReview()" value="Submit review" type="button" name="reviewBtn" class="btn btn-info"/><input value="' + vendorId + '" type="hidden" name="vendorId" /> <a onclick="directory.removeReviewArea()" href="javascript:;" class="btn btn-danger btn-small">Close</a></td></tr>';
        $("table[id=reviewTbl]").html(reviewArea).show();
    },
    /**
     * Description
     * @method removeReviewArea
     * @return 
     */
    removeReviewArea: function ()
    {
        $("table[id=reviewTbl]").slideUp('slow').empty();
    },
    /**
     * Description
     * @method submitReview
     * @return 
     */
    submitReview: function ()
    {
        var reviewTxt = $('textarea[name=reviewTxt]').val();
        var vendorId = $('input[name=vendorId]').val();

        //alert(rating);

        if (reviewTxt == "") {
            alert('Please Write Review');
        } else {
            $.ajax({
                type: "POST",
                data: {
                    "vendorId": vendorId,
                    "reviewTxt": reviewTxt,
                    "submit": "1"
                },
                url: base_url + submitReviewUrl,
                /**
                 * Description
                 * @method success
                 * @param {} res
                 * @return 
                 */
                success: function (res)
                {
                    if (res == '1') {
                        location.reload();
                    } else {
                        alert('Please Give Your Rating First');
                        $('textarea[name=reviewTxt]').val('');
                    }
                }
            })
        }
    },

}