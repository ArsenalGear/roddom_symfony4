$(document).ready(function () {

    // changeReviewsOrCommentfunction();

    $('.reveiew-rating').click(function () {
        let me = $(this);
        console.log(me.attr('value'));
        $('#rating-input').val(me.attr('value'));
    });

    $("#registration_form_phone").inputmask("+7 (999) 999 99 99");

    //star rating at the reviews

    if ($('.clinic__add-rating').length > 0) {

        $('#star-rating').starRating({
            initialRating: 4,
            strokeColor: '#F9B6A6',
            ratedColor: '#F9B6A6',
            hoverColor: "#F9B6A6",
            activeColor: "#F9B6A6",
            strokeWidth: 10,
            starSize: 36,
            useFullStars: true,
            click: function (currentIndex, currentRating, $el) {
                console.log(currentIndex);
            },
        });
    }

    if ($('#review-or-comment-select').length > 0) {
        $('#review-or-comment-select').change(function () {
            if ($('#review-or-comment-select option:selected').hasClass('review')) {
                $('.clinic__add-rating').css('display', 'flex');
            } else {
                $('.clinic__add-rating').css('display', 'none');
            }
        });
    }

    // answer to comment

    // if($('.clinic__comments').length > 0 ) {
    //     $('body').on('click', '.comment-btn', function (e) {
    //         e.preventDefault();
    //         $('.clinic__comment-answer').remove();
    //         $('.comment-btn').show();
    //         $(this).parent('.clinic__comment').append($('<div class="clinic__comment-answer"><textarea class="textarea-main" name="comment" placeholder="Напишите комментарий..."></textarea><button type="submit" class="btn btn-primary">Отправить</button></div>'));
    //         $(this).hide();
    //     });
    // }

    //gallery

    if ($('.clinic__gallery').length > 0) {

        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            }
        });

    }

    //show phone number

    if ($('.clinic__phone-wrapper').length > 0) {
        $('body').on('click', '.clinic__phone-wrapper', function () {
            $('.clinic__phone').hide();
            $('.clinic__phone-link').show();
        });
    }

    //mobile gallery slider

    if ($('.clinic__gallery-mobile-slider').length > 0) {
        $('.clinic__gallery-mobile-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    }

    //show submenu on mobile

    if ($(window).width() <= 992 && $('.collapse.navbar-collapse').length > 0 && $('.navbar-toggler').length > 0) {
        $('body').on('click', '.navbar-toggler', function () {
            $('.sub-menu').toggleClass( "d-flex" );
        });
    }

    $('.rating-star').on('click', function () {
        let rating = $(this).find('input').val()
        $('#hidden-rating').val(rating)
    })

    $('.clinic-type').on('click', function () {
        let type = $(this).find('input').val()
        $('#hidden-type').val(type)
    })

    $('.count_review').on('click', function () {
        let count = $(this).find('.radio-main__input').val()
        console.log(count);
        $('#hidden-count').val( count)

    });

    $("#filtre-form").on('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();
        let city = $('#user-city').text().trim();
        if (document.location.pathname === '/') {
            city = 0;
        }
        let rating = $('#hidden-rating').val()
        let type = $('#hidden-type').val()
        let count = $('body').find('.count_review_input:checked').val();
        typeof  count === 'undefined' ? count = 0 :

            console.log(count);

        let url = '/filtre/?rating=' + rating + '&clinic-type=' + type + '&count_review=' + count + '&city='+city+'';
        console.log(url);
        $('.preloader').show()
        $.ajax({
            type: "GET",
            url: url,
            success: data => {
                let obj = jQuery.parseJSON(data);
                console.log(obj);
                $("#clinic-cards").empty();
                if (obj.length) {
                    for (let i = 0; i < obj.length; i++) {
                        $('#clinic-cards').append(addCard(obj[i].rating, obj[i].city, obj[i].subscription_plan.subscription_plan, obj[i].logo, obj[i].name, obj[i].year, obj[i].licence, obj[i].id))
                    }
                } else {
                    $('#clinic-cards').append('<h1>Нет результатов</h1>')
                }
                $('.preloader').hide()
            }
        });
    });

    $('body').on('change, input', '[attr-city]', function () {
        let key_cookie = $(this).attr('attr-city');
        let val_cookie = $(this).val();

        $.cookie('city-cookie', key_cookie, {
            expires: 7,
            path: '/'
        });

        $.cookie('city-cookie-translit', val_cookie, {
            expires: 7,
            path: '/'
        });

        document.location.href = `/city/${val_cookie}`;

        // location.reload()
    });

    $(".sub-comment").click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).next('.review-commented').toggleClass("active");
    });
});

$("#accept_phone_reg").click(function () {
    var phone = $('#registration_form_phone').val().replace(/\D+/g, "");
    $.post("/accept_phone", {phone: phone}, function (data) {
        console.log(data);
    });
});

function addCard(rating, city, subscription_plan, logo, name, year, licence, id) {
    let new_licence
    let new_city
    let rating_star
    if (licence) {
        new_licence = '<p class="card__license">Есть лицензия</p>'
    } else {
        new_licence = ''
    }
    if (city) {
        new_city = '<div class="clinic__city"> <img src="/img/city-icon.png" alt="" class="clinic__city-icon"> <p class="clinic__city-name">' + city.name + '</p> </div> '
    } else {
        new_city = ''
    }

    switch (rating) {
        case 1:
            rating_star = '<i class="clinic__rating-star"></i>'
            break;
        case 2:
            rating_star = '<i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i>'
            break;
        case 3:
            rating_star = '<i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i>'
            break;
        case 4:
            rating_star = '<i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i>'
            break;
        case 5:
            rating_star = '<i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i> <i class="clinic__rating-star"></i>'
            break;
        default:
            rating_star =  '<i class="clinic__rating-star"></i>'
    }
    let transfer = '<div class="col-lg-4 col-md-6 col-12">\n' +
        '                        <div class="card">\n' +
        '                            <div class="card__body">\n' +
        '                                <div class="clinic__card-info-wrapper">\n' +
        '                                    <div class="clinic__card-info">\n' +
        '                                        <div class="clinic__rating">\n' +
        '                                                                     '+rating_star+' </div>\n' +
        '                                                                                   ' + new_city + ' \n' +
        '                                                                            </div>\n' +
        '                                    <p class="clinic__tag">' + subscription_plan + '</p>\n' +
        '                                </div>\n' +
        '                                <div class="clinic__info-main">\n' +
        '                                    <div class="card__img-top-wrapper">\n' +
        '                                        <img src="/uploads/images/organisations/' + logo + '" class="card__img-top" alt="...">\n' +
        '                                    </div>\n' +
        '                                    <div class="clinic__info-main-text">\n' +
        '                                        <h5 class="card__title">' + name + '</h5>\n' +
        '                                        <p class="card__year-of-foundation">Год\n' +
        '                                            основания: ' + year + '</p>\n' +
        '                                                                                   ' + new_licence + ' \n' +
        '                                                                            </div>\n' +
        '                                </div>\n' +
        '                                <div class="clinic__links">\n' +
        '                                    <a href="/organisations/' + id + '" class="btn btn-primary clinic__show-more">Подробнее</a>\n' +
        '                                    <a href="#" class="clinic__add-to-comparison">Добавить к сравнению</a>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>'
    return transfer
}