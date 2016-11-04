$('document').ready(function () {
    // Lazy loading for user's events
    var page = 2;
    var load = true;
    $('#loadMore_post').click(function () {
        if (load)
        {
            loaddata();
        }
    });

    function loaddata()
    {
        // user id declared on profile page
        $.ajax({
            url: base_url + 'user/home/load_users_events/' + user_id + '/' + page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('#users_events').append("<div class='col-sm-12 alert alert-info text-center'>" + data.message + "</div>");
                    $('#loadMore_post').remove();
                }
                else
                {
                    $('#users_events').append(data.view);
                }
            }
        });
        page++;
    }

    // Lazy loading for joined events

    var save_page = 2;
    var save_load = true;
    $('#loadMore_saved').click(function () {
        if (save_load)
        {
            save_loaddata();
        }
    });

    function save_loaddata()
    {
        // user id declared on profile page
        $.ajax({
            url: base_url + 'user/home/load_user_savepost/' + user_id + '/' + save_page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    save_load = false;
                    $('#saved_post').append("<div class='col-sm-12 alert alert-info text-center'>" + data.message + "</div>");
                    $('#loadMore_saved').remove();
                }
                else
                {
                    $('#saved_post').append(data.view);
                }
            }
        });
        save_page++;
    }

    // Accept request
    $('.request_row').on('click', '.accept', function () {
        th = $(this);
        request_id = th.parents('.request_row').data('id');
        $.ajax({
            url: base_url + 'user/home/accept_event_request/' + request_id,
            success: function (str) {
                if (str == 1)
                {
                    if ($('.request_row').length == 1)
                    {
                        $('.request_container').append("<div class='alert alert-info' style='margin:15px;'>No new request available</div>");
                    }
                    th.parents('.request_row').fadeOut('2000').remove();
                }
            }
        });
    });

    // Deny request
    $('.request_row').on('click', '.deny', function () {
        th = $(this);
        request_id = th.parents('.request_row').data('id');
        $.ajax({
            url: base_url + 'user/home/deny_event_request/' + request_id,
            success: function (str) {
                if (str == 1)
                {
                    if ($('.request_row').length == 1)
                    {
                        $('.request_container').append("<div class='alert alert-info' style='margin:15px;'>No new request</div>");
                    }
                    th.parents('.request_row').fadeOut('2000').remove();
                }
            }
        });
    });

});