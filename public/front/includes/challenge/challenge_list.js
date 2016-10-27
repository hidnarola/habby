$(function () {
    $("div.soulmate_con2").slice(0, 5).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("div.soulmate_con2:hidden").slice(0, 5).slideDown();
        if ($("div.soulmate_con2:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });

    $('a[href=#top]').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.totop a').fadeIn();
        } else {
            $('.totop a').fadeOut();
        }
    });

    $('#groupplan1post').on('show.bs.modal', function (e) {

        //get data-id attribute of the clicked element
        var title = $(e.relatedTarget).data('title');
        var image = $(e.relatedTarget).data('image');
        var user = $(e.relatedTarget).data('user');
        var uimage = $(e.relatedTarget).data('uimage');

        $('#modal_title').text(title);
        $('#modal_user').text(user);
        $('#m_image').attr('src', image);
        $('#m_user_image').attr('src', uimage);
    });
    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function () { // set image data as background of div
                $('.message').hide();
                $('.image_wrapper').show();
                $("#imagePreview").css("background-image", "url(" + this.result + ")");
            }
        } else {
            $('.message').html("Please select proper image");
            $('.message').show();
        }
    });

    $(".filterby").change(function () {
        $("#filterby_form").submit();
    });
    $(".find_topic").click(function () {
        $("#search_form").submit();
    });

    $(".more_challenge").click(function () {
        $("#more_ch_form").submit();
    })

    $(".winner_n_btn").click(function () {
        var id = $(this).data('id');
        $(".winner_popup_n_" + id).slideToggle(1000);
    });
    $(".winner_p_btn").click(function () {
        var id = $(this).data('id');
        $(".winner_popup_p_" + id).slideToggle(1000);
    });
    $(".winner_r_btn").click(function () {
        var id = $(this).data('id');
        $(".winner_popup_r_" + id).slideToggle(1000);
    });

    $(".cmnt_winner").click(function () {
        $(".winner-comnt").slideToggle(1000);
    });

    // Add rank for challenge
    $(".challenge_container").on("click",".add",function(){
        var t = $(this);
        console.log(t);
        var challenge_id = t.parents('.challenge_sec').data('challenge_id');
        c = $('body').find("[data-challenge_id='"+challenge_id+"']");
        $.ajax({
            url: base_url + 'user/challenge/add_rank_to_challenge/' + challenge_id,
            success: function (str) 
            {
                if (str == 1)
                {
                    c.find('.add').find('img').each(function(){
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.rank_rate').each(function(){
                        $(this).val(parseInt($(this).val()) + 1);
                    });
                }
                else if (str == 2)
                {
                    c.find('.add').find('img').each(function(){
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.sub').find('img').each(function(){
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow.png');
                    });
                    c.find('.rank_rate').each(function(){
                        $(this).val(parseInt($(this).val()) + 2);
                    });
                }
            }
        });
    });
    
    // Subtract rank for challenge
    $(".challenge_container").on("click",".sub",function(){
        var t = $(this);
        var challenge_id = t.parents('.challenge_sec').data('challenge_id');
        c = $('body').find("[data-challenge_id='"+challenge_id+"']");
        $.ajax({
            url: base_url + 'user/challenge/subtract_rank_from_challenge/' + challenge_id,
            success: function (str) {
                if (str == -1)
                {
                    c.find('.sub').find('img').each(function(){
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.rank_rate').each(function(){
                        $(this).val(parseInt(t.siblings('.rank_rate').val()) - 1);
                    });
                }
                else if (str == -2)
                {
                    c.find('.sub').find('img').each(function(){
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.add').find('img').each(function(){
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow.png');
                    });
                    c.find('.rank_rate').each(function(){
                        $(this).val(parseInt($(this).val()) - 2);
                    });
                }
            }
        });
    });

});