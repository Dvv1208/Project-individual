    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
        }
        document.getElementById(tabName).style.display = " block";
        evt.currentTarget.className += " active";
    }

    var rating_data = 0;

    $('#add_review').click(function() {

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function() {

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function() {

        var user_name = $('#user_name').val();

        var pro_id = $('#pro_id').val();

        var user_review = $('#user_review').val();

        if (user_review == '') {
            alert("Vui lòng nhập đánh giá của bạn");
            return false;
        } else {
            $.ajax({
                url: "index.php?option=product-reviews",
                method: "POST",
                data: {
                    rating_data: rating_data,
                    pro_id: pro_id,
                    user_name: user_name,
                    user_review: user_review
                },
                success: function(data) {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);

                    location.href = 'index.php?option=product&id=' + $row_pro['Slug'];
                }
            })
        }

    });
    load_rating_data();

    function load_rating_data() {
        var pro_id = $('#pro_id').val();
        $.ajax({
            url: "index.php?option=product-reviews",
            method: "POST",
            data: {
                pro_id: pro_id,
                action: 'load_data'
            },
            dataType: "JSON",
            success: function(data) {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);
                $('#product_rating').text(data.product_rating);

                var count_star = 0;

                $('.main_star').each(function() {
                    count_star++;
                    if (Math.ceil(data.average_rating) >= count_star) {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });
                $('.m_star').each(function() {
                    count_star++;
                    if (Math.ceil(data.product_rating) >= count_star) {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                if (data.review_data.length > 0) {
                    var html = '';

                    for (var count = 0; count < data.review_data.length; count++) {
                        html += '<div class="row mb-3">';
                        html += '<div class="col-md-12">';
                        html += '<div id="reviews">';
                        html += '<ul class="reviews">';
                        html += '<li>';
                        html += '<div class="review-heading">';
                        html += '<h5 class="name"> ' + data.review_data[count].user_name + '</h5>';
                        html += '<p class="date"> ' + data.review_data[count].datetime + ' </p>';
                        html += '<div class="review-rating">';
                        for (var star = 1; star <= 5; star++) {
                            var class_name = '';

                            if (data.review_data[count].rating >= star) {
                                class_name = 'text-warning';
                            } else {
                                class_name = 'star-light';
                            }
                            html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                        }
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="review-body">';
                        html += '<p>' + data.review_data[count].user_review + '</p>';
                        html += '</div>';
                        html += '</li>';
                        html += '</ul>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    }

                    $('#reviews').html(html);
                }
            }
        })
    }
