var directory = {

    /**
     * Description
     * @method updateVendorRatingReview
     * @param {} id
     * @return 
     */
    updateVendorRatingReview: function (id)
    {
        var rating = $("input[name=rating_" + id + "]:checked").val();
        var review = $("textarea[name=review_" + id + "]").val();

        //alert(review);  

        if (review !== "" && rating !== undefined) {
            var ans = confirm('Are you sure want to update this');
            if (ans) {



                $.ajax({
                    type: "POST",
                    data: {
                        "vID": id,
                        "review": review,
                        "rating": rating,
                        "submit": "1"
                    },
                    url: base_url + updateVendorRatingReviewUrl,
                    /**
                     * Description
                     * @method success
                     * @param {} res
                     * @return 
                     */
                    success: function (res)
                    {
                        //console.log(res);
                        if (res == '1') {
                            alert('Rating Successfully Updated');
                            location.reload();
                        } else {
                            alert('Something went wrong.try again');
                        }
                    }
                });
            }
        }
    }
};
