$(function () {
    //set date and time picker for start time and end time
    $('#start_time').datetimepicker({
        locale: 'en'
    });
    $('#end_time').datetimepicker({
        locale: 'en'
    });

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        var i = 0;
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                if (/^image/.test(files[key].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        // $('#imagePreview').addClass('imagePreview');
                        $('.message').hide();
                        $('.image_wrapper').show();
                        $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                        $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                        ++i;
                    }
                }
                else
                {
                    this.files = '';
                    $('.message').html("Please select proper image");
                    $('.message').show();
                }
            }
        }
    });

    // Video uploading script
    $('#uploadVideo').on("change", function () {
        $('.message').html();
        $('.video_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files)
        {
            if (/^video/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.video_wrapper').show();
                    $('.message').hide();
                    $('.video_wrapper').append("<img class='videoPreview" + i + "' id='imagePreview' src='" + $('.video_wrapper').data('default_image') + "'/>");
//                    $('.videoPreview'+i).css("background-image", ;
                    ++i;
                }
            }
            else
            {
                $('.message').html("Please select proper video");
                $('.message').show();
            }
        }
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