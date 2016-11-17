$(function () {
    //set date and time picker for start time and end time
    $('#start_time').datetimepicker({
        locale: 'en'
    });
    $('#end_time').datetimepicker({
        locale: 'en'
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
                    swal("You have already joined this event");
                    $this.removeClass('event_join');
                    $this.html('Enter');
                }
                else if (str == 1)
                {
                    swal("You have already requested for this event");
                    $this.removeClass('event_join');
                    $this.html('Requested');
                }
                else if (str == 2)
                {
                    swal("You can't join this event as event reached at its maximum limit");
                }
                else if (str == 3 || str == 5)
                {
                    swal("Something went wrong");
                }
                else if (str == 4)
                {
                    swal("You have joined this event");
                    $this.removeClass('event_join');
                    $this.html('Enter');
                }
                else if (str == 6)
                {
                    swal("You have made request for join this event");
                    $this.removeClass('event_join');
                    $this.html('Requested');
                }
                else
                {
                    swal("Something went wrong");
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
        $.ajax({
            url: base_url + 'events/' + page,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.event_container').append("<div class='col-sm-12 alert alert-info text-center'>No more event found</div>");
                    $('#loadMore').remove();
                }
                else
                {
                    $('.event_container').append(data.view);
                    setTimeout(function () {
                        $('.event_post').each(function () {
                            if ($(this).offset().left > 250 )
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