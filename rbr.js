var m_names = new Array("Jan", "Feb", "Mar",
        "Apr", "May", "Jun", "Jul", "Aug", "Sept",
        "Oct", "Nov", "Dec");

jQuery(document).ready(function() {
    jQuery('.rbr_widget').each(function(i, j) {
        var $id = jQuery(j).attr('id');
        var $business = jQuery(j).attr('data-id');


        jQuery.ajax({
            url: 'http://api.rankedbyreview.com/get-business-reviews/' + $business,
            dataType: 'jsonp',
            success: function(dataWeGotViaJsonp) {

                if (parseInt(dataWeGotViaJsonp.total_reviews) > 0) {
                    var html = '<div id="widg_' + $id + '" class="list-group liquid-slider">';


                    jQuery.each(dataWeGotViaJsonp.reviews, function(index, review) {
                        var d = new Date(review.review_timestamp * 1000);
                        var curr_date = d.getDate();
                        var curr_month = d.getMonth();
                        var curr_year = d.getFullYear();
                        html += ' <div class="media list-group-item">';

                        html += '<a class="pull-left" href="' + review.review_url + '" style="width:75px;">';
                        html += '<img class="media-object img-thumbnail" src="http://api.rankedbyreview.com' + review.reviewer_avatar + '"  style="width:75px;">';
                        html += '</a>';

                        html += ' <div class="media-body">';
                        html += '  <h4 class="media-heading">' + review.review_title + '</h4>';

                        html += '  <p>' + review.review_body.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br />$2') + '</p>';
                        html += '  <small class="text-muted">' + review.review_rating + '/5 - ' + review.reviewed_by + ' - ' + curr_date + "-" + m_names[curr_month]
                                + "-" + curr_year + '</small>'
                        html += ' </div>';
                        html += '</div>';



                    });

                    html += '</div>';
                    html += '<div class="buttons clearfix">';
                    html += '<a href="' + dataWeGotViaJsonp.business_url + '" target="_blank" class="btn btn-right">View More Reviews</a>';
                    html += '<a href="' + dataWeGotViaJsonp.business_review_url + '" target="_blank" class="btn btn-left">Place a Review</a>';
                    html += '</div>';

                    jQuery(j).find('.inner').html(html);

                    jQuery(j).find('.list-group').liquidSlider({
                        autoSlide: true

                    });

                }
            }
        });
    });


});

