$(function () {
    //set date and time picker for start time and end time
    $('#start_time').datetimepicker({
        locale: 'en'
    });
    $('#end_time').datetimepicker({
        locale: 'en'
    });

    $("#start_time").on("dp.change", function(e) {
        console.log(e.date);
        $('#end_time').data("DateTimePicker").minDate(e.date);
    });
    $("#end_time").on("dp.change", function (e) {
        $('#start_time').data("DateTimePicker").maxDate(e.date);
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
                    console.log("href = "+base_url+'events/details/'+btoa(event_id));
                    $this.attr('href',base_url+'events/details/'+encodeURIComponent(btoa(event_id)));
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

    // Lazy loading
    var page = 2;
    var load = true;
    $('#loadMore').click(function () {
        if (load)
        {
            loaddata();
        }
    });

    function loaddata()
    {
        uri = window.location.href;
        console.log(uri);
        var url;
        if (uri.indexOf('filter_event') > -1)
        {
            url = base_url + 'events/filter_event/' + page;
        } else
        {
            url = base_url + 'events/' + page;
        }

        $.ajax({
            url: url,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.event_container').append("<div class='col-sm-12 alert alert-info text-center'>" + no_events + "</div>");
                    $('#loadMore').remove();
                } else
                {
                    $('.event_container').append(data.view);
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
        page++;
    }

    // Set post in two column format
    setTimeout(function () {
        $('.event_post').each(function () {
            if ($(this).offset().left > 250)
            {
                $(this).addClass('right');
            }
        });
    }, 1200);
});