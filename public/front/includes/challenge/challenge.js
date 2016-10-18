$('document').ready(function () {
    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
    var load = true;
    var in_progress = false;
    $('.chat_area2').scroll(function () {
        if (load && !in_progress)
        {
            if ($('.chat_area2').scrollTop() == 0) {
                loaddata();
                in_process = true;
            }
        }
    });

    function loaddata()
    {
        $.ajax({
            url: base_url + 'challenge/load_more_msg/' + group_id,
            method: 'post',
            async: false,
            data: 'last_msg=' + last_msg,
            success: function (more) {
                more = JSON.parse(more);
                if (more.status)
                {
                    $('.chat_area2').prepend(more.view);
                    last_msg = more.last_msg_id;
                    $(".chat_area2").animate({scrollTop: 200}, 500);
                }
                else
                {
                    load = false;
                    $('.chat_area2').prepend('<div class="text-center">No more messages to show</div>');
                    $(".chat_area2").animate({scrollTop: 0}, 500);
                }
                in_progress = false;
            }
        });
    }

    // upload challange post
    var selected = false;
    $('.upload_image').change(function () {
        selected = true;
        $(".type").val("image");
        $('.media_name').html($(this).val());
        $('.upload_btn').removeClass('make_disabled');
    });
    $('.upload_video').change(function () {
        selected = true;
        $(".type").val("video");
        $('.media_name').html($(this).val());
        $('.upload_btn').removeClass('make_disabled');
    });

    $("#media_form").submit(function () {
        if (selected)
        {
            return true;
        }
        return false;
    });
    
    // give coin to challenge post
    $('.chlng2_past_rank_sec').on('click','.user_coin',function(){
        var t = $(this);
        post_id = t.parents('.rank_lg_sec').data('post_id');
        $.ajax({
            url: base_url + 'user/challenge/add_coin/' + post_id,
            success: function (str) {
                var coin = parseInt(t.find('.coin_cnt').html());
                if (str == 1)
                {
                    t.find('.coin_cnt').html((coin + 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                }
                else if (str == 2)
                {
                    alert("You can't take back given coin");
                    // t.find('.coin_cnt').html((coin - 1));
                    t.find('.img-coin').attr('src', base_url + 'public/front/img/coined_icon.png');
                }
                else if (str == 3)
                {
                    alert("You don't have enough coin to give");
                }
                else
                {
                    console.log('fail');
                }
            }
        });
    });
});
