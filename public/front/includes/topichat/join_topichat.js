var Server;
data = JSON.parse(data);
function send(text) {
    var msg = {
        message: text,
        type: 'topic_msg',
        group_id: group_id
    }
    Server.send('message', JSON.stringify(msg));
}

function share_links() {
    setTimeout(function () {
        var i = Math.random().toString(36).substring(7);
        $('#url').trigger('preview');
        var preview = $('#url').data('preview');
        if (JSON.stringify(preview) != '{}') {
            if (preview.title == null && preview.description == null && typeof (data.media) == 'undefined') {
                swal("No content found");
                $('#url').val('');
//                $(".loader").removeClass('show');
                $('#url').prop('disabled', false);
                return false;
            } else {
                var thumbnail_url = (typeof (preview.thumbnail_url) != "undefined") ? '<div class="large-3 columns">' +
                        '<img class="thumb" src="' + preview.thumbnail_url + '"></img>' +
                        '</div>' : "";
                var title = (preview.title != null) ? preview.title : "";
                var description = (preview.description != null) ? preview.description : "";
                html = '<div class="">' + thumbnail_url +
                        '<div class="large-9 column">' +
                        '<a href="' + preview.original_url + '" target="_blank">' + title + '</a>' +
                        '<p>' + description + '</p>' +
                        '</div>' +
                        '</div>';
                $('.chat_area2').append("<div class='share_2 clearfix topichat_media_post' data-chat_id=''><div id='field' class='topichat_media_rank'><button type='button' id='add' class='add add_btn smlr_btn'><img src='" + DEFAULT_IMAGE_PATH + "challeng_arrow.png' class='rank_img_sec'/></button><span class='rank_rate'>0</span><button type='button' id='sub' class='sub smlr_btn'><img src='" + DEFAULT_IMAGE_PATH + "challeng_arrow.png' class='rank_img_sec'/></button></div><div class='fileshare" + i + " fileshare'></div></div>");
                $('.fileshare' + i).append(html);

                // Send file using ajax
                preview = JSON.stringify(preview);
                var msg = {
                    message: preview,
                    type: 'topic_msg',
                    group_id: group_id,
                    media: 'links'
                }
                if (Server.send('message', JSON.stringify(msg)))
                {
                    setTimeout(function () {
                        $.ajax({
                            url: base_url + '/user/Topichat/get_chat_id_from_media_name',
                            method: 'post',
                            async: false,
                            data: 'media=' + preview,
                            success: function (resp) {
                                $('.fileshare' + i).parents('.topichat_media_post').attr('data-chat_id', resp);
                            }
                        });
                    }, 3000);
                }
                $('#url').val('');
//                $('#url').preview({bind: false});
//                $(".loader").removeClass('show');
                $('#url').prop('disabled', false);
                $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
            }
        } else {
            swal("Please correct your Link.");
//            $(".loader").removeClass('show');
            $('#url').prop('disabled', false);
            return false;
        }
    }, 5000);
}

$(document).ready(function () {
//    Server = new FancyWebSocket('ws://192.168.1.202:9300');
    Server = new FancyWebSocket('ws://192.168.1.143:9300');
//    Server = new FancyWebSocket('ws://192.168.1.186:9300');
//    Server = new FancyWebSocket('ws://123.201.110.194:9300');
//    Server = new FancyWebSocket('ws://203.109.68.198:9300');
//    Server = new FancyWebSocket('ws://127.0.0.1:9300');
    // Send message to server
    $('#message_div').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($.trim($(this).html()) != '')
            {
                msg = $(this).html();
                $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + $('#message_div').html() + "</span></span></div>");
                $(this).html('');
                $('#message').val('');
                send(msg);
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
            $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + msg + "</span></span></div>");
            $('#message_div').html('');
            $('#message').val('');
            send(msg);
            $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        }
    });
    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $(".loader").addClass('show');
        var i;
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        for (var key in files)
        {
            if (/^image/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    i = Math.random().toString(36).substring(7);
                    // $('#imagePreview').addClass('imagePreview');
                    $('.message').hide();
                    $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" data-chat_id="" style="float:right;clear:right"><div class="wdth_span media_wrapper"><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div><span class="imagePreview' + i + '"  id="imagePreview_msg"></span></div></div>');
                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                }
            } else
            {
//this.files = '';
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
        var form_data = new FormData();
        $.each(files, function (i, file) {
            form_data.append('image-' + i, file);
        });
        form_data.append("msg_image", files);
        // Send file using ajax
        var media_data;
        $.ajax({
            url: base_url + '/user/User/upload_chat_media',
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
//                console.log(str);
                if (str != 0)
                {
                    var msg = {
                        message: str,
                        type: 'topic_msg',
                        group_id: group_id,
                        media: 'image'
                    }
                    Server.send('message', JSON.stringify(msg));
                    media_data = JSON.parse(str);
                }
            },
            complete: function (xhr, status) {
                $.ajax({
                    url: base_url + '/user/Topichat/get_chat_id_from_media_name',
                    method: 'post',
                    async: false,
                    data: 'media=' + media_data[0].media,
                    success: function (resp) {
                        $(".loader").removeClass('show');
//                        $('.imagePreview' + i).parents('.topichat_media_post').data('chat_id', resp);
                        $('.imagePreview' + i).parents('.topichat_media_post').attr('data-chat_id', resp);
                    }
                });
            }
        });
    });
    // Video uploading script
    $("#upload_video").on("change", function ()
    {
        $(".loader").addClass('show');
        var display_file_class = '';
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        for (var key in files)
        {
//            console.log("key = ", key);
            if (key != "length" && key != "item")
            {
                if (/^video/.test(files[key].type)) { // only video file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        var i = Math.random().toString(36).substring(7);
                        display_file_class = 'imagePreview' + i;
                        $('.message').hide();
                        $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" data-chat_id="" style="float:right;clear:right"><div class="media_wrapper" style="float:right"><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div><span class="' + display_file_class + '"  id="imagePreview_msg"></span></div></div>');
                        $('.' + display_file_class).html("<video controls='' src='" + this.result + "' style='height:180px;'>");
                        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                    }
                } else
                {
                    $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>Please select proper video</span></span></div>");
                    //this.files = '';
                    $('.message').html("Please select proper Video");
                    $('.message').show();
                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                    return;
                }
            }

        }
        var form_data = new FormData();
        $.each(files, function (i, file) {
            form_data.append('video-' + i, file);
        });
        form_data.append("msg_video", files);
        var media_data;
        // Send file using ajax
        $.ajax({
            url: base_url + '/user/User/upload_chat_media',
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
//                console.log('in video uploading response : ' + str);
                if (str == "601")
                {
                    var p = $('.' + display_file_class).parent().addClass('wdth_span');
                    p.html('<span>Fail to send message</span>');
                } else if (str != 0)
                {
                    var msg = {
                        message: str,
                        type: 'topic_msg',
                        group_id: group_id,
                        media: 'video'
                    }
                    Server.send('message', JSON.stringify(msg));
                    media_data = JSON.parse(str);
                }
            },
            complete: function (xhr, status) {
                $.ajax({
                    url: base_url + '/user/Topichat/get_chat_id_from_media_name',
                    method: 'post',
                    async: false,
                    data: 'media=' + media_data[0].media,
                    success: function (resp) {
                        $(".loader").removeClass('show');
//                        $('.imagePreview' + i).parents('.topichat_media_post').data('chat_id', resp);
                        $('.' + display_file_class).parents('.topichat_media_post').attr('data-chat_id', resp);
                    }
                });
            }
        });
    });
    // File uploading script
    $("#upload_files").on("change", function ()
    {
        $(".loader").addClass('show');
        var display_file_class = '';
        $('.message').html();
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }
        for (var key in files)
        {
            if (key != "length" && key != "item")
            {
                if (!/^video/.test(files[key].type) && !/^image/.test(files[key].type) && (/pdf$/.test(files[key].type) || /plain$/.test(files[key].type) || /vnd.ms-excel$/.test(files[key].type) || /msword$/.test(files[key].type)) || /vnd.openxmlformats-officedocument.wordprocessingml.document$/.test(files[key].type) || /.docx$/.test(files[key].name) || /.doc$/.test(files[key].name) || /.xls$/.test(files[key].name) || /.xlsx$/.test(files[key].name)) { // only pdf and text files 
                    var file_name = files[key].name;
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[key]); // read the local file
                    reader.onloadend = function () { // set image data as background of div

                        console.log("hello");

                        var i = Math.random().toString(36).substring(7);
                        display_file_class = 'imagePreview' + i;
                        $('.message').hide();
                        $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" data-chat_id="" style="float:right;clear:right"><div class="media_wrapper" style="width: 250px"><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div><span class="' + display_file_class + ' file_download"  id=""></span><a href=""><span class="filename"></span></a></div></div>');
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
                            url: base_url + '/user/User/upload_chat_media',
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
                                    p.html('<span>Fail to send message</span>');
                                } else if (str != 0)
                                {
                                    var msg = {
                                        message: str,
                                        type: 'topic_msg',
                                        group_id: group_id,
                                        media: 'files'
                                    }
                                    str = JSON.parse(str);
                                    $('.' + display_file_class).siblings('a').attr('href', base_url + 'topichat/download_file/' + str[0].media);
                                    $('.' + display_file_class).siblings('a').find('.filename').html(str[0].media);
                                    Server.send('message', JSON.stringify(msg));
                                    media_data = str;
                                }
                            },
                            complete: function () {
                                $(".loader").removeClass('show');
                                setTimeout(function(){
                                    $.ajax({
                                        url: base_url + '/user/Topichat/get_chat_id_from_media_name',
                                        method: 'post',
                                        async: false,
                                        data: 'media=' + media_data[0].media,
                                        success: function (resp) {
                                            $('.' + display_file_class).parents('.topichat_media_post').attr('data-chat_id', resp);
                                        }
                                    });
                                },1500)
                            }
                        });

                    }
                } else
                {
                    $('.chat_area2').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>Please select proper files (pdf/txt/xls/doc)</span></span></div>");
                    //this.files = '';
                    $('.message').html("Please select proper files (pdf/txt/xls/doc)");
                    $('.message').show();
                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                    return;
                }
            }
        }

    });

    // Send update notification to other users
    $(".update_form").submit(function () {
        var msg = {
            message: 'changed',
            type: 'topic_notification',
            group_id: group_id
        }
        Server.send('message', JSON.stringify(msg));
    });

    // Set up preview.
    $('#url').preview({key: '18566814981d41358f03a7635f716d8a'})
    // On submit add hidden inputs to the form.
    $('.share_btn').click(function () {
        if ($("#url").val() != "")
        {
//            $(".loader").addClass('show');
            $('#url').prop('disabled', true);
            share_links();
        } else {
            swal("Please Enter url.");
            return false;
        }
    });
    $('#url').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($(this).val() != "")
            {
//                $(".loader").addClass('show');
                $('#url').prop('disabled', true);
                share_links();
            } else {
                swal("Please Enter url");
                return false;
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
            room_type: 'topic_msg'
        }
        Server.send('message', JSON.stringify(msg));
    });
    //OH NOES! Disconnection occurred.
    Server.bind('close', function (data) {
//                    log("Disconnected.");
    });
    //Log any messages sent from server
    Server.bind('message', function (payload) {
//        console.log("message received : ", payload);
        userdata = JSON.parse(payload);
        if (userdata.media_type == null)
        {
            $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><span class="wdth_span"><span>' + userdata.message + '</span></div>');
        } else
        {
            if (userdata.media_type == "image")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="wdth_span media_wrapper img_media_wrapper"><span class="imagePreview' + i + '" id="imagePreview_msg"></span><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
                $('.imagePreview' + i).css("background-image", "url(" + upload_path + userdata.media + ")");
            } else if (userdata.media_type == "video")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="float:left"><span class="imagePreview' + i + '" id="imagePreview_msg"></span><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
                //$('.imagePreview' + i).css("background-image", "url(" + upload_path + userdata.media + ")");
                $('.imagePreview' + i).html("<video controls='' src='" + upload_path + userdata.media + "' style='height:180px;'>");
            } 
            else if (userdata.media_type == "files")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="width: 250px"><span class="imagePreview' + i + ' file_download" id="" data-file=""></span><a href="' + base_url + 'user/download_file/' + userdata.media + '"><span class="filename">' + userdata.media + '</span></a><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
                $('.imagePreview' + i).data('file', userdata.media);
                $('.imagePreview' + i).css("background-image", "url(" + DEFAULT_IMAGE_PATH + "filedownload.jpg)");
            } else if (userdata.media_type == "links") {
                userlink = JSON.parse(userdata.message);
                var thumbnail_url = (typeof (userlink.thumbnail_url) != "undefined") ? '<div class="large-3 columns">' +
                        '<img class="thumb" src="' + userlink.thumbnail_url + '"></img>' +
                        '</div>' : "";
                var title = (userlink.title != null) ? userlink.title : "";
                var description = (userlink.description != null) ? userlink.description : "";
                $('.chat_area2').append('<div class="share_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="fileshare"><div class="">' + thumbnail_url +
                        '<div class="large-9 column">' +
                        '<a href="' + userlink.original_url + '" target="_blank">' + title + '</a>' +
                        '<p>' + description + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
            }
        }
        $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
    });
    Server.connect();
});