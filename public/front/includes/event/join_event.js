var Server;
data = JSON.parse(data);

function send(text) {
    var msg = {
        message: text,
        type: 'event_msg',
        group_id: group_id
    }
    Server.send('message', JSON.stringify(msg));
}

$(document).ready(function () {

    Server = new FancyWebSocket(socket_server);
    $(document).find('#emogis').popover({
        html: true,
        content: function () {
            console.log($("#popover-content").html());
            return $("#popover-content").html();
        }
    });
    // Send message to server
    $('#message_div').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($.trim($(this).html()) != '')
            {
                $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + $('#message_div').html() + "</span></span></div>");
                send($('#message_div').html());
                $(this).html('');
                $('#message').val('');
                $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
            }
            return false;
        } else if (e.charCode == 32 && $.trim($(this).html()) == '')
        {
            return false;
        } else if ($.trim($(this).html()) == '&nbsp;' || $.trim($(this).html()) == '<br>')
        {
            $(this).html('');
            return false;
        }
    });

    $('.submit_btn').click(function (e) {
        msg = $('#message_div').html();
        if (msg.trim() != '')
        {
            $('.chat_area2').append("<div class='chat_2 clearfix event_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + msg + "</span></span></div>");
            send(msg);
            $('#message_div').html('');
            $('#message').val('');
            $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        }
    });

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                $(".loader").addClass('show');
                if (/^image/.test(files[key].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        var i = Math.random().toString(36).substring(7);
                        // $('#imagePreview').addClass('imagePreview');
                        $('.message').hide();

                        $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" style="float:right;clear:right"><div class="wdth_span media_wrapper"><span class="imagePreview' + i + '"  id="imagePreview_msg"></span></div></div>');

                        $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");

                        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                        var form_data = new FormData();
                        $.each(files, function (i, file) {
                            form_data.append('image-' + i, file);
                        });
                        form_data.append("msg_image", files);
                        // Send file using ajax
                        $.ajax({
                            url: base_url + 'user/upload_chat_media',
                            dataType: 'script',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            error: function (textStatus, errorThrown) {

                            },
                            success: function (str)
                            {
                                if (str != 0)
                                {
                                    if ($('.content_images').find('.panel-body').find('a').length == 3)
                                    {
                                        $('.content_images').find('.panel-body').find('a').last().remove();
                                    } else if ($('.content_images').find('.panel-body').find('a').length == 0) {
                                        $('.content_images').find('.panel-body').html('');
                                    }
                                    media_file = JSON.parse(str);
                                    var html = '<a data-fancybox-group="gallery1" href="' + upload_path + media_file[0].media + '" class="fancybox col-sm-4"><img class="img-responsive topi_image" src="' + upload_path + media_file[0].media + '"></a>';
                                    $('.content_images').find('.panel-body').prepend(html);
                                    var msg = {
                                        message: str,
                                        type: 'event_msg',
                                        group_id: group_id,
                                        media: 'image'
                                    }
                                    Server.send('message', JSON.stringify(msg));
                                }
                            },
                            complete: function (xhr, status) {
                                $(".loader").removeClass('show');
                            }
                        });
                    }
                } else
                {
                    swal(proper_image);
                    $(".loader").removeClass('show');
                    return;
                }
            }
        }
    });

    // Video uploading script
    $("#upload_video").on("change", function ()
    {
        var display_file_class = '';
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                $(".loader").addClass('show');
                if (/^video/.test(files[key].type)) { // only video file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        var i = Math.random().toString(36).substring(7);
                        display_file_class = 'imagePreview' + i;

                        $('.message').hide();
                        $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" style="float:right;clear:right"><div class="media_wrapper" style="float:right"><span class="' + display_file_class + '"  id="imagePreview_msg"></span></div></div>');
                        $('.' + display_file_class).html("<video controls='' src='" + this.result + "' style='height:180px;'>");
                        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                        var form_data = new FormData();
                        $.each(files, function (i, file) {
                            form_data.append('video-' + i, file);
                        });
                        form_data.append("msg_video", files);

                        // Send file using ajax
                        $.ajax({
                            url: base_url + 'user/upload_chat_media',
                            dataType: 'script',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            error: function (textStatus, errorThrown) {

                            },
                            success: function (str)
                            {
                                if (str == "601")
                                {
                                    var p = $('.' + display_file_class).parent().addClass('wdth_span');
                                    p.html('<span>' + fail_message + '</span>');
                                } else if (str != 0)
                                {
                                    media_file = JSON.parse(str);
                                    video_thumb = media_file[0].media.split('.')[0] + '_thumb.png';
                                    if ($('.content_videos').find('.panel-body').find('a').length == 3)
                                    {
                                        $('.content_videos').find('.panel-body').find('a').last().remove();
                                    } else if ($('.content_videos').find('.panel-body').find('a').length == 0) {
                                        $('.content_videos').find('.panel-body').html('');
                                    }
                                    var html = '<a class="fancybox col-sm-4" href="' + upload_path + media_file[0].media + '" target="_blank" data-fancybox-group="gallery1"><div class="video-w-icon"><img src="' + upload_path + video_thumb + '" class="img-responsive topi_image"></div></a>';
                                    $('.content_videos').find('.panel-body').prepend(html);
                                    var msg = {
                                        message: str,
                                        type: 'event_msg',
                                        group_id: group_id,
                                        media: 'video'
                                    }
                                    Server.send('message', JSON.stringify(msg));
                                }
                            },
                            complete: function (xhr, status) {
                                $(".loader").removeClass('show');
                            }
                        });
                    }
                } else
                {
                    swal(proper_video);
                    $(".loader").removeClass('show');
                    return;
                }
            }

        }
    });

    // File uploading script
    $("#upload_files").on("change", function ()
    {

        var display_file_class = '';
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                $(".loader").addClass('show');
                if (!/^video/.test(files[key].type) && !/^image/.test(files[key].type) && (/pdf$/.test(files[key].type) || /plain$/.test(files[key].type) || /vnd.ms-excel$/.test(files[key].type) || /msword$/.test(files[key].type)) || /vnd.openxmlformats-officedocument.wordprocessingml.document$/.test(files[key].type) || /.docx$/.test(files[key].name) || /.doc$/.test(files[key].name) || /.xls$/.test(files[key].name) || /.xlsx$/.test(files[key].name)) { // only pdf and text files 
                    var file_name = files[key].name;
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file
                    reader.onloadend = function () { // set image data as background of div
                        var i = Math.random().toString(36).substring(7);
                        display_file_class = 'imagePreview' + i;
                        $('.message').hide();
                        $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" data-chat_id="" style="float:right;clear:right"><div class="media_wrapper" style="width: 250px"><span class="' + display_file_class + ' file_download"  id=""></span><a href=""><span class="filename"></span></a></div></div>');
                        $('.imagePreview' + i).css("background-image", "url(" + DEFAULT_IMAGE_PATH + "filedownload.jpg)");
                        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);

                        var form_data = new FormData();
                        $.each(files, function (i, file) {
                            form_data.append('files-' + i, file);
                        });

                        form_data.append("msg_files", files);
                        // Send file using ajax
                        var media_data;
                        $.ajax({
                            url: base_url + 'user/upload_chat_media',
                            dataType: 'script',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            async: false,
                            error: function (textStatus, errorThrown) {

                            },
                            success: function (str)
                            {
                                if (str == "601")
                                {
                                    var p = $('.' + display_file_class).parent().addClass('wdth_span');
                                    p.html('<span>' + fail_message + '</span>');
                                } else if (str != 0)
                                {

                                    media_file = JSON.parse(str);
                                    if ($('.content_files').find('.panel-body').find('a').length == 3) {
                                        $('.content_files').find('.panel-body').find('a').last().remove();
                                    } else if ($('.content_files').find('.panel-body').find('a').length == 0) {
                                        $('.content_files').find('.panel-body').html('');
                                    }

                                    var html = '<a class="col-sm-4" href="' + base_url + 'user/download_file/' + media_file[0].media + '" target="_blank" data-fancybox-group="gallery1"><div class=""><img src="' + base_url + 'public/front/img/filedownload.jpg" class="img-responsive topi_image"><span class="event_file_name">' + media_file[0].media + '</span></div></a>';

                                    $('.content_files').find('.panel-body').prepend(html);

                                    var msg = {
                                        message: str,
                                        type: 'event_msg',
                                        group_id: group_id,
                                        media: 'files'
                                    }
                                    str = JSON.parse(str);
                                    $('.' + display_file_class).siblings('a').attr('href', base_url + 'user/download_file/' + str[0].media);
                                    $('.' + display_file_class).siblings('a').find('.filename').html(str[0].media);
                                    Server.send('message', JSON.stringify(msg));
                                    media_data = str;
                                }
                            },
                            complete: function () {
                                $(".loader").removeClass('show');
                            }
                        });

                    }
                } else
                {
                    swal(proper_file + " (pdf/txt/xls/doc)");
                    $(".loader").removeClass('show');
                    return;
                }
            }
        }

    });

    //Let the user know we're connected
    Server.bind('open', function () {
        // Fire when user connect first time
        var msg = {
            type: 'room_bind',
            message: data,
            group_id: group_id,
            room_type: 'event_msg'
        }
        Server.send('message', JSON.stringify(msg));
    });

    //OH NOES! Disconnection occurred.
    Server.bind('close', function (data) {
//                    log("Disconnected.");
    });

    //Log any messages sent from server
    Server.bind('message', function (payload) {
        userdata = JSON.parse(payload);
        if (userdata.media_type == null)
        {
            $('.chat_area2').append('<div class="chat_1 clearfix event_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><span class="wdth_span"><span>' + userdata.message + '</span></div>');

        } else
        {
            if (userdata.media_type == "image")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix event_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="wdth_span media_wrapper img_media_wrapper"><span class="imagePreview' + i + '" id="imagePreview_msg"></span></div></div>');

                $('.imagePreview' + i).css("background-image", "url(" + upload_path + userdata.media + ")");

                if ($('.content_images').find('.panel-body').find('a').length == 3) {
                    $('.content_images').find('.panel-body').find('a').last().remove();
                } else if ($('.content_images').find('.panel-body').find('a').length == 0) {
                    $('.content_images').find('.panel-body').html('');
                }
                var html = '<a data-fancybox-group="gallery1" href="' + upload_path + userdata.media + '" class="fancybox col-sm-4"><img class="img-responsive topi_image" src="' + upload_path + userdata.media + '"></a>';
                $('.content_images').find('.panel-body').prepend(html);
            } else if (userdata.media_type == "video")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="float:left"><span class="imagePreview' + i + '" id="imagePreview_msg"></span></div></div>');
                $('.imagePreview' + i).html("<video controls='' src='" + upload_path + userdata.media + "' style='height:180px;'>");

                video_thumb = userdata.media.split('.')[0] + '_thumb.png';
                if ($('.content_videos').find('.panel-body').find('a').length == 3)
                {
                    $('.content_videos').find('.panel-body').find('a').last().remove();
                } else if ($('.content_videos').find('.panel-body').find('a').length == 0) {
                    $('.content_videos').find('.panel-body').html('');
                }

                var html = '<a class="fancybox col-sm-4" href="' + upload_path + userdata.media + '" target="_blank" data-fancybox-group="gallery1"><div class="video-w-icon"><img src="' + upload_path + video_thumb + '" class="img-responsive topi_image"></div></a>';
                $('.content_videos').find('.panel-body').prepend(html);

            } else if (userdata.media_type == "files")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="width: 250px"><span class="imagePreview' + i + ' file_download" id="" data-file=""></span><a href="' + base_url + 'user/download_file/' + userdata.media + '"><span class="filename">' + userdata.media + '</span></a></div></div>');
                $('.imagePreview' + i).data('file', userdata.media);
                $('.imagePreview' + i).css("background-image", "url(" + DEFAULT_IMAGE_PATH + "filedownload.jpg)");

                if ($('.content_files').find('.panel-body').find('a').length == 3) {
                    $('.content_files').find('.panel-body').find('a').last().remove();
                } else if ($('.content_files').find('.panel-body').find('a').length == 0) {
                    $('.content_files').find('.panel-body').html('');
                }

                var html = '<a class="col-sm-4" href="' + base_url + 'user/download_file/' + userdata.media + '" target="_blank" data-fancybox-group="gallery1"><div class=""><img src="' + base_url + 'public/front/img/filedownload.jpg" class="img-responsive topi_image"><span class="event_file_name">' + userdata.media + '</span></div></a>';

                $('.content_files').find('.panel-body').prepend(html);
            }
        }
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
    });

    Server.connect();

    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
});