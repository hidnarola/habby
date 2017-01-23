$('document').ready(function(){
    
    // On click of smile-share post tab, apply masonry effect to the smile-sharepost container
    $('#load_post_tab').click(function(){
        setTimeout(function () {
            $('.post_masonry_article').each(function () {
                if ($(this).offset().left > 250)
                {
                    $(this).addClass('right');
                }
            });
        },1000);
    });
    
    // Join event
    $('.event_container').on('click', '.event_join', function () {
        $this = $(this);
        var event_id = $(this).parents('.event_post').data('id');
        $.ajax({
            url: base_url + 'events/join_event/' + event_id,
            success: function (str) {
                if (str == 0)
                {
                    swal(already_joined);
                    $this.removeClass('event_join');
                    $this.html(Enter);
                } else if (str == 1)
                {
                    swal(already_requested);
                    $this.removeClass('event_join');
                    $this.html(Requested);
                } else if (str == 2)
                {
                    swal(cant_join);
                } else if (str == 3 || str == 5)
                {
                    swal(wrong);
                } else if (str == 4)
                {
                    swal(joined);
                    $this.removeClass('event_join');
                    console.log("href = " + base_url + 'events/details/' + btoa(event_id));
                    $this.attr('href', base_url + 'events/details/' + encodeURIComponent(btoa(event_id)));
                    $this.html(Enter);
                } else if (str == 6)
                {
                    swal(made_request);
                    $this.removeClass('event_join');
                    $this.html(Requested);
                } else
                {
                    swal(wrong);
                }
            }
        });
    });
    
    // To open popover of smile-share post for social sharing
    $('.post_section').on('click', '.share-link', function () {
        $popover = $(this).siblings('.popover-content-custom');
        if ($popover.hasClass('hide'))
        {
            $popover.removeClass('hide').addClass('show');
        } else
        {
            $popover.removeClass('show').addClass('hide');
        }
    });
    
    
    // Lazy loading
    
    // Lazy loading for event
    var event_page = 2;
    var event_load = true;
    $('.event_loadmore').click(function(){
        if (event_load)
        {
            event_loaddata();
        }
    });
    
    function event_loaddata()
    {
        uri = window.location.href;
        console.log(uri);
        url = base_url + 'search';
        $.ajax({
            url: url,
            method: 'post',
            data : 'is_ajax=yes&event_page='+event_page+'&search_keyword='+search_keyword,
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    event_load = false;
                    $('.event_container').append("<div class='col-sm-12 alert alert-info text-center'>" + no_events + "</div>");
                    $('.event_loadmore').remove();
                }
                else
                {
                    var cnt = data.cnt;
                    $('.event_container').append(data.view);
                    if (cnt < 2) {
                        event_load = false;
                        $('.event_loadmore').remove();
                    }
                    setTimeout(function () {
                        $('.event_post').each(function () {
                            if ($(this).offset().left > 250)
                            {
                                $(this).addClass('right');
                            }
                        });
                    }, 1200);
                }
            }
        });
        event_page++;
    }
});