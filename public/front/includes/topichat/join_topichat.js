var Server;
var url;
data = JSON.parse(data);

var file_flag = 0;
var uploading_file = [];

function send(text) {
    var msg = {
        message: text,
        type: 'topic_msg',
        group_id: group_id
    }
    Server.send('message', JSON.stringify(msg));
}

function share_links(url) {
    var api_key = '18566814981d41358f03a7635f716d8a';
    var i = Math.random().toString(36).substring(7);
    var embedlyAPI = "https://api.embed.ly/1/extract?key=" + api_key + "&url=" + escape(url);
    var youtube_video_html = null, html = '';
    
    $(".loader").addClass('show');
    $.ajax({
        url: embedlyAPI,
        async: false,
        dataType: 'json', // Choosing a JSON datatype
        beforeSend: function () {

        },
        success: function (preview) {
            if (JSON.stringify(preview) != '{}') {
                if (preview.title == null && preview.description == null) {
                    swal("No content found");
                    $('#url').val('');
                    $('#url').prop('disabled', false);
                    return false;
                } else {
                    
                    var link_title = $('#link_title').val();
                    
                    //$('.chat_area2').append("<div class='share_2 clearfix topichat_media_post' data-chat_id=''><div id='field' class='topichat_media_rank'><button type='button' id='add' class='add add_btn smlr_btn'><img src='" + DEFAULT_IMAGE_PATH + "challeng_arrow.png' class='rank_img_sec'/></button><span class='rank_rate'>0</span><button type='button' id='sub' class='sub smlr_btn'><img src='" + DEFAULT_IMAGE_PATH + "challeng_arrow.png' class='rank_img_sec'/></button></div><div class='fileshare" + i + " fileshare'></div></div>");

                    $('.total_views_inner').append('<div class="topichat_media_post chat_area_updated_list" data-chat_id=""><div class="chat_area_updated_list_top"> <h4>Total x is Watching</h4> <div class="clearfix"></div> </div> <div class="chat_area_updated_list_middle"> <div class="chat_area_updated_list_middle_left"> <div class="topichat_media_thumb"> <a href="javascript:void(0);"> <img class="user_chat_thumb" src="'+DEFAULT_PROFILE_IMAGE_PATH+data.user_image+'" title="'+data.name+'"> </a> </div> <div id="field" class="topichat_media_rank"> <button type="button" id="add" class="add add_btn smlr_btn"> <img src="'+DEFAULT_IMAGE_PATH+'challeng_arrow.png" class="rank_img_sec"/> </button> <span class="rank_rate">0</span> <button type="button" id="sub" class="sub smlr_btn"> <img src="'+DEFAULT_IMAGE_PATH+'challeng_arrow.png" class="rank_img_sec"/> </button> </div> </div> <div class="chat_area_updated_list_middle_right"> <div class="chat_area_updated_list_middle_head"> <h4>'+link_title+'</h4> </div> <div class="chat_area_updated_list_middle_middle"><div class="fileshare'+ i + ' fileshare"></div></div></div></div></div>');

                    left_link_html = '<div class="fileshare" id="fileshare' + i + '"><div class="">';

                    if ($.isEmptyObject(preview.media)) {
                        var thumbnail_url = (preview.images.length > 0) ? 
                                                '<div class="large-3 columns">' +
                                                    '<img class="thumb" src="' + preview.images[0].url + '"></img>' +
                                                '</div>' : "";
                                        
                        var title = (preview.title != null) ? preview.title : "";
                        var description = (preview.description != null) ? preview.description : "";
                        
                        html = '<div class="">' + thumbnail_url +
                                '<div class="large-9 column">' +
                                '<a href="' + preview.url + '" target="_blank">' + title + '</a>' +
                                '<p>' + description + '</p>' +
                                '</div>' +
                                '</div>';
                        left_link_html += thumbnail_url + '<div class="large-9 column"><a href="' + preview.url + '" target="_blank">' + title + '</a></div>';

                    } else {
                        if (preview.provider_name == "YouTube") {
                            var thumbnail_url = (preview.images.length > 0) ? preview.images[0].url : "";
                            html = '<div class="videoPreview" data-toggle="modal" data-target="#linkModal" data-id=""><img class="thumb" src="' + thumbnail_url + '"></img><div class="youtube-icon"><img src="' + DEFAULT_IMAGE_PATH + 'youtube-icon.png"/></div></div>';
                            left_link_html += html;
                            youtube_video_html = preview.media.html;
                            $('.fileshare' + i).parents('.topichat_media_post').addClass('youtube_video');
                        } else {
                            var thumbnail_url = (preview.images.length > 0) ? '<div class="large-3 columns">' +
                                    '<img class="thumb" src="' + preview.images[0].url + '"></img>' +
                                    '</div>' : "";
                            var title = (preview.title != null) ? preview.title : "";
                            var description = (preview.description != null) ? preview.description : "";
                            html = '<div class="">' + thumbnail_url +
                                    '<div class="large-9 column">' +
                                    '<a href="' + preview.url + '" target="_blank">' + title + '</a>' +
                                    '<p>' + description + '</p>' +
                                    '</div>' +
                                    '</div>';
                            left_link_html += thumbnail_url + '<div class="large-9 column"><a href="' + preview.url + '" target="_blank">' + title + '</a></div>';
                        }
                    }
                    left_link_html += '</div></div>';

                    $('.fileshare' + i).append(html);

                    // Add left link in left section
                    if ($('.topic_frame').find('.fileshare').length == 2)
                    {
                        // If two links are available then remove one
                        $('.topic_frame').find('.fileshare').last().remove();
                    }
                    else if ($('.topic_frame').find('.fileshare').length == 0)
                    {
                        $('.topic_frame').html('');
                    }
                    $('.topic_frame').prepend(left_link_html);

                    // Send file using ajax
                    preview = JSON.stringify(preview);
                    var msg = {
                        message: preview,
                        type: 'topic_msg',
                        group_id: group_id,
                        media: 'links',
                        title:link_title,
                        youtube_video: youtube_video_html,
                        link_id: i
                    }

                    Server.send('message', JSON.stringify(msg))
                    $('#url').val('');
                    $('#url').prop('disabled', false);
                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
                }
            } else {
                swal(correct_link);
                $('#url').prop('disabled', false);
                return false;
            }
        },
        error: function (x, t, m) {
            var error_list = new Array("error", "abort", "timeout", "parsererror");
            if (error_list.indexOf(t) !== -1)
            {
                $('#url').prop('disabled', false);
                swal('Looking back, it seems we can not find what you are looking for or network is slow. Please try agian');
            }
        },
        complete: function (xhr, status) {
            setTimeout(function () {
                $.ajax({
                    url: base_url + 'topichat/get_chat_id_from_link_id',
                    method: 'post',
                    async: false,
                    data: 'link_id=' + i,
                    success: function (resp) {
                        $('.fileshare' + i).parents('.topichat_media_post').attr('data-chat_id', resp);
                        $('.fileshare' + i).children('.videoPreview').attr('data-id', resp);
                        $('#fileshare' + i).find('.videoPreview').attr('data-id', resp);
                    },
                    complete: function (xhr, status) {
                        $(".loader").removeClass('show');
                    }
                });
            }, 1500);
        }
    });
}
function upload_image(files) {
    var image_title= $('#media_description').val();
    var i = Math.random().toString(36).substring(7);
    $('.message').html();
    if (!files.length || !window.FileReader) {
        $('.message').html(no_selected_file);
        $('.message').show();
        return; // no file selected, or no FileReader support
    }
    
    var i = 0;
    for (var key in files)
    {
        if (key != 'item' && key != 'length')
        {
            $(".loader").addClass('show');
            if (/^image/.test(files[key].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    $('.image_wrapper').show();
                    $('.image_wrapper').html("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                    ++i;
                   // $('.chat_area2,.topichat_msg_sec_modal').append('<div class="chat_2 clearfix topichat_media_post" data-chat_id="" style="float:right;clear:right"><div class="wdth_span media_wrapper"><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div><span class="imagePreview' + i + '"  id="imagePreview_msg" data-toggle="modal" data-target="#mediaModal" data-image="" data-type="image"></span></div></div>');
                   
                   $('.total_views_inner').append('<div class="topichat_media_post chat_area_updated_list" data-chat_id=""> <div class="chat_area_updated_list_top"> <h4>Total x is Watching</h4> <div class="clearfix"></div> </div> <div class="chat_area_updated_list_middle"> <div class="chat_area_updated_list_middle_left"> <div class="topichat_media_thumb"> <a href="javascript:void(0);"> <img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + data.user_image + '" title="' + data.name + '"/> </a> </div> <div id="field" class="topichat_media_rank"> <button type="button" id="add" class="add add_btn smlr_btn"> <img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/> </button> <span class="rank_rate">0</span> <button type="button" id="sub" class="sub smlr_btn"> <img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/> </button> </div> </div> <div class="chat_area_updated_list_middle_right"> <div class="chat_area_updated_list_middle_head"> <h4>'+image_title+'</h4> </div> <div class="chat_area_updated_list_middle_middle"> <div class="wdth_span media_wrapper img_media_wrapper"> <span class="imagePreview' + i + '" id="imagePreview_msg" data-toggle="modal" data-target="#mediaModal" data-image="" data-type="image"> </span> </div> </div> </div> </div> </div>');
                   
                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                    $(".chat_area2").animate({scrollTop: $('.chat_area2,.topichat_msg_sec_modal').prop("scrollHeight")}, 1000);

                    var form_data = new FormData();
                    $.each(files, function (i, file) {
                        form_data.append('image-' + i, file);
                    });
                    form_data.append("msg_image", files);
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
                            if (str != 0)
                            {
                                if ($('.topichat_image_ul').find('li').length == 8)
                                {
                                    $('.topichat_image_ul').find('li').last().remove();
                                }
                                else if ($('.topichat_image_ul').find('li').length == 0) {
                                    $('.topichat_image_ul').html('');
                                }
                                media_file = JSON.parse(str);
                                var html = '<li class="topi_image_li"> <a data-toggle="modal" data-target="#mediaModal" data-image="' + media_file[0].media + '" data-type="image"> <img src="' + upload_path + media_file[0].media + '" class="img-responsive topi_image"> </a> </li>';
                                $('.topichat_image_ul').prepend(html);

                                var msg = {
                                    message: str,
                                    type: 'topic_msg',
                                    title : image_title,
                                    group_id: group_id,
                                    media: 'image'
                                }
                                Server.send('message', JSON.stringify(msg));
                                media_data = JSON.parse(str);
                            }
                        },
                        complete: function (xhr, status) {
                            $.ajax({
                                url: base_url + 'topichat/get_chat_id_from_media_name',
                                method: 'post',
                                async: false,
                                data: 'media=' + media_data[0].media,
                                success: function (resp) {
                                    $('.imagePreview' + i).data('image', media_data[0].media);
                                    $('.imagePreview' + i).parents('.topichat_media_post').attr('data-chat_id', resp);
                                },
                                complete: function (xhr, status) {
                                    $(".loader").removeClass('show');
                                }
                            });
                        }
                    });
                }
            } else
            {
                swal(proper_image);
                $(".loader").removeClass('show');
            }
        }
    }
}
function upload_video(files) {
    var i = Math.random().toString(36).substring(7);
    var display_file_class = '';

    $('.message').html();
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
                    display_file_class = 'imagePreview' + i;
                    $('.message').hide();
                    $('.chat_area2').append('<div class="chat_2 clearfix topichat_media_post" data-chat_id="" style="float:right;clear:right"><div class="media_wrapper" style="float:right"><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div><span class="' + display_file_class + '"  id="imagePreview_msg"></span></div></div>');
                    $('.' + display_file_class).html("<video controls='' src='" + this.result + "' style='height:180px;'>");
                    $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);

                    var form_data = new FormData();
                    $.each(files, function (i, file) {
                        form_data.append('video-' + i, file);
                    });
                    form_data.append("msg_video", files);
                    var media_data;
                    // Send file using ajax
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
                                if ($('.topichat_video_ul').find('li').length == 8)
                                {
                                    $('.topichat_video_ul').find('li').last().remove();
                                } else if ($('.topichat_video_ul').find('li').length == 0) {
                                    $('.topichat_video_ul').html('');
                                }
                                media_file = JSON.parse(str);
                                video_thumb = media_file[0].media.split('.')[0] + '_thumb.png';
                                var html = '<li class="topi_image_li"> <a data-toggle="modal" data-target="#mediaModal" class="video-w-icon" data-image="' + media_file[0].media + '" data-type="video" > <img src="' + upload_path + video_thumb + '" class="img-responsive topi_image"> </a> </li>';
                                $('.topichat_video_ul').prepend(html);

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
                                url: base_url + 'topichat/get_chat_id_from_media_name',
                                method: 'post',
                                async: false,
                                data: 'media=' + media_data[0].media,
                                success: function (resp) {
                                    $('.' + display_file_class).parents('.topichat_media_post').attr('data-chat_id', resp);
                                },
                                complete: function (xhr, status)
                                {
                                    $(".loader").removeClass('show');
                                }
                            });
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
}
function upload_files(files) {
    var i = Math.random().toString(36).substring(7);
    var display_file_class = '';
    $('.message').html();
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
//                var file_name = files[key].name;
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file
                reader.onloadend = function () { // set image data as background of div
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
                            $.ajax({
                                url: base_url + 'topichat/get_chat_id_from_media_name',
                                method: 'post',
                                async: false,
                                data: 'media=' + media_data[0].media,
                                success: function (resp) {
                                    $('.' + display_file_class).parents('.topichat_media_post').attr('data-chat_id', resp);
                                },
                                complete: function (xhr, status) {
                                    $(".loader").removeClass('show');
                                }
                            });
                        }
                    });
                }
            } else
            {
                //this.files = '';
                swal(proper_file + " (pdf/txt/xls/doc)");
                $(".loader").removeClass('show');
                return;
            }
        }
    }
}

$(document).ready(function () {
    Server = new FancyWebSocket(socket_server);
    // Send message to server
    $(document).on('keypress', '#message_div', function (e) {
        if (e.keyCode == 13)
        {
            if ($.trim($(this).html()) != '')
            {
                msg = $(this).html();
                //$('.panel-body,.topichat_msg_sec_modal').append("<div class='messageHer'><span>"+msg+"</span><div class='clearFix'></div></div>");
                $('.panel-chat').find('.panel-body').append("<div class='messageHer'><span>"+msg+"</span><div class='clearFix'></div></div>");
                $(this).html('');
                $('#message').val('');
                send(msg);
                var control = $('.panel-chat').find('.panel-body');
                control.scrollTop(control[0].scrollHeight);
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

    $('.mainchatarea').on('click', '.submit_btn', function (e) {
        msg = $('#message_div').html();
        if (msg.trim() != '')
        {
            $('.chat_area2,.topichat_msg_sec_modal').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + msg + "</span></span></div>");
            $('#message_div').html('');
            $('#message').val('');
            send(msg);
            $(".chat_area2,.topichat_msg_sec_modal").animate({scrollTop: $('.chat_area2,.topichat_msg_sec_modal').prop("scrollHeight")}, 1000);
        }
    });

    $('#mediaModal').on('click', '.submit_btn', function () {
        msg1 = $('#mediaModal').find('#message_div').html();
        if (msg1.trim() != '')
        {
            $('.chat_area2,.topichat_msg_sec_modal').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + msg1 + "</span></span></div>");
            $('#mediaModal').find('#message_div').html('');
            $('#mediaModal').find('#message').val('');
            send(msg1);
            $(".chat_area2,.topichat_msg_sec_modal").animate({scrollTop: $('.chat_area2,.topichat_msg_sec_modal').prop("scrollHeight")}, 1000);
        }
    });

    $('#linkModal').on('click', '.submit_btn', function () {
        msg1 = $('#linkModal').find('#message_div').html();
        if (msg1.trim() != '')
        {
            $('.chat_area2,.topichat_msg_sec_modal').append("<div class='chat_2 clearfix topichat_media_post' style='float:right;clear:right'><span class='wdth_span'><span>" + msg1 + "</span></span></div>");
            $('#linkModal').find('#message_div').html('');
            $('#linkModal').find('#message').val('');
            send(msg1);
            $(".chat_area2,.topichat_msg_sec_modal").animate({scrollTop: $('.chat_area2,.topichat_msg_sec_modal').prop("scrollHeight")}, 1000);
        }
    });
    // Image uploading script
    $('#mediaModal').on('change', '#uploadFile', function () {
        var files = !!this.files ? this.files : [];
        upload_image(files);
    });
    // Image uploading script For POPUP
    $("#upload_file_section").on("change","#uploadFile", function () {
        
        file_flag = 1;
        uploading_file  = !!this.files ? this.files : [];
        //var files = !!this.files ? this.files : [];
        //upload_image(files);
    });
    // Video uploading script
    $("#upload_file_section").on("change","#upload_video", function () {
        file_flag = 2;
        uploading_file  = !!this.files ? this.files : [];
        //var files = !!this.files ? this.files : [];
        //upload_video(files);
    });
    // Video uploading script For POPUP
    $('#mediaModal').on('change', '#upload_video', function () {
        var files = !!this.files ? this.files : [];
        upload_video(files);
    });
    // File uploading script
    $("#upload_file_section").on("change","#upload_files", function ()
    {
        file_flag = 3;
        uploading_file  = !!this.files ? this.files : [];
        //var files = !!this.files ? this.files : [];
        //upload_files(files);
    });
    // Files uploading script For POPUP
    $('#mediaModal').on('change', '#upload_files', function () {
        var files = !!this.files ? this.files : [];
        upload_files(files);
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
    // On submit add hidden inputs to the form.
//        $('#url').preview({key: '18566814981d41358f03a7635f716d8a'});
    $('.share_btn').click(function () {
        if ($("#url").val() != "")
        {
            if($('#link_title').val() == "")
            {
                swal(enter_title);
                return false;
            }
            var url = $("#url").val();
            $('#url').prop('disabled', true);
            share_links(url);
        } else {
            swal(enter_url);
            return false;
        }
    });
    $('#url').keypress(function (e) {
        if (e.keyCode == 13) {
            if ($(this).val() != "")
            {
                if($('#link_title').val() == ""){
                    swal(enter_title);
                    return false;
                }
                var url = $(this).val();
                $('#url').prop('disabled', true);
                share_links(url);
            } else {
                swal(enter_url);
                return false;
            }
        }
    });
    
    // Phase 2 code for adding media (image, video and file) using modal
    $('#topi_media_upload').click(function(){
        console.log('Button called');
        if($('#media_description').val() != ""){
            console.log('Description is not empty, file flag = ',file_flag, ", upload file length = ",uploading_file.length);
            if(file_flag == 0 && uploading_file.length == 0)
            {
                console.log('file not selected');
                swal('Please select media');
                return false;
            }
            else if(file_flag == 1)
            {
                console.log('Image uploading');
                // Code to upload image
                upload_image(uploading_file);
            }
            else if(file_flag == 2)
            {
                console.log('Video uploading');
                // Code to upload video
                upload_video(uploading_file);
            }
            else if(file_flag == 3)
            {
                console.log('File uploading');
                // Code to upload file
                upload_files(uploading_file);
            }
            $('#upload_file_section').modal('hide');
        }
        else
        {
            console.log('Description is empty');
            swal(enter_title);
            return false;
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
    });
    //Log any messages sent from server
    Server.bind('message', function (payload) {
        userdata = JSON.parse(payload);
        if (userdata.media_type == null)
        {
            $('.panel-chat').find('.panel-body').append("<div class='messageMe'><a href='javascript:;'><img src='" + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + "' title='"+userdata.user+"'></a><span>"+userdata.message+"</span><div class='clearFix'></div></div>");
            var control = $('.panel-chat').find('.panel-body');
            control.scrollTop(control[0].scrollHeight);
        }
        else
        {
            if (userdata.media_type == "image")
            {
                var i = Math.random().toString(36).substring(7);
                //$('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="wdth_span media_wrapper img_media_wrapper"><span class="imagePreview' + i + '" id="imagePreview_msg" data-toggle="modal" data-target="#mediaModal" data-image="' + userdata.media + '" data-type="image"></span><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
                $('.total_views_inner').append('<div class="topichat_media_post chat_area_updated_list" data-chat_id=""> <div class="chat_area_updated_list_top"> <h4>Total x is Watching</h4> <div class="clearfix"></div> </div> <div class="chat_area_updated_list_middle"> <div class="chat_area_updated_list_middle_left"> <div class="topichat_media_thumb"> <a href="javascript:void(0);"> <img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"/> </a> </div> <div id="field" class="topichat_media_rank"> <button type="button" id="add" class="add add_btn smlr_btn"> <img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/> </button> <span class="rank_rate">0</span> <button type="button" id="sub" class="sub smlr_btn"> <img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/> </button> </div> </div> <div class="chat_area_updated_list_middle_right"> <div class="chat_area_updated_list_middle_head"> <h4>'+userdata.title+'</h4> </div> <div class="chat_area_updated_list_middle_middle"> <div class="wdth_span media_wrapper img_media_wrapper"> <span class="imagePreview' + i + '" id="imagePreview_msg" data-toggle="modal" data-target="#mediaModal" data-image="'+userdata.media+'" data-type="image"> </span> </div> </div> </div> </div> </div>');
                $('.imagePreview' + i).css("background-image", "url(" + upload_path + userdata.media + ")");

                if ($('.topichat_image_ul').find('li').length == 8)
                {
                    $('.topichat_image_ul').find('li').last().remove();
                } else if ($('.topichat_image_ul').find('li').length == 0) {
                    $('.topichat_image_ul').html('');
                }

                var html = '<li class="topi_image_li"> <a data-toggle="modal" data-target="#mediaModal" data-image="' + userdata.media + '" data-type="image"> <img src="' + upload_path + userdata.media + '" class="img-responsive topi_image"> </a> </li>';
                $('.topichat_image_ul').prepend(html);

            } else if (userdata.media_type == "video")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="float:left"><span class="imagePreview' + i + '" id="imagePreview_msg"></span><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
                //$('.imagePreview' + i).css("background-image", "url(" + upload_path + userdata.media + ")");
                $('.imagePreview' + i).html("<video controls='' src='" + upload_path + userdata.media + "' style='height:180px;'>");

                if ($('.topichat_video_ul').find('li').length == 8)
                {
                    $('.topichat_video_ul').find('li').last().remove();
                } else if ($('.topichat_video_ul').find('li').length == 0) {
                    $('.topichat_video_ul').html('');
                }
                video_thumb = userdata.media.split('.')[0] + '_thumb.png';
                var html = '<li class="topi_image_li"> <a data-toggle="modal" data-target="#mediaModal" class="video-w-icon" data-image="' + userdata.media + '" data-type="video" > <img src="' + upload_path + video_thumb + '" class="img-responsive topi_image"> </a> </li>';
                $('.topichat_video_ul').prepend(html);

            } else if (userdata.media_type == "files")
            {
                var i = Math.random().toString(36).substring(7);
                $('.chat_area2').append('<div class="chat_1 clearfix topichat_media_post" data-chat_id="' + userdata.chat_id + '" style="float:left;clear:left"><img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"><div class="media_wrapper" style="width: 250px"><span class="imagePreview' + i + ' file_download" id="" data-file=""></span><a href="' + base_url + 'user/download_file/' + userdata.media + '"><span class="filename">' + userdata.media + '</span></a><div id="field" class="topichat_media_rank"><button type="button" id="add" class="add add_btn smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button><span class="rank_rate">0</span><button type="button" id="sub" class="sub smlr_btn"><img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/></button></div></div></div>');
                $('.imagePreview' + i).data('file', userdata.media);
                $('.imagePreview' + i).css("background-image", "url(" + DEFAULT_IMAGE_PATH + "filedownload.jpg)");
            } 
            else if (userdata.media_type == "links") {
                userlink = JSON.parse(userdata.message);

                left_link_html = '<div class="fileshare" id="fileshare' + i + '"><div class="">';

                var thumbnail_url = (userlink.images.length > 0) ? userlink.images[0].url : "";
                
                if (userdata.youtube_video != null) {
                    
                    var youtube_video = '<div class="videoPreview" data-toggle="modal" data-target="#linkModal" data-id=' + userdata.chat_id + '><img class="thumb" src="' + thumbnail_url + '"></img><div class="youtube-icon"><img src="' + DEFAULT_IMAGE_PATH + 'youtube-icon.png"/></div></div>';

                    $('.total_views_inner').append('<div class="topichat_media_post chat_area_updated_list" data-chat_id="' + userdata.chat_id + '"> <div class="chat_area_updated_list_top"> <h4>Total x is Watching</h4> <div class="total_views_list"> <ul> <li> <a href="javascript:void(0);">A</a> </li> <li> <a href="javascript:void(0);">B</a> </li> <li> <a href="javascript:void(0);">C</a> </li> <li> <a href="javascript:void(0);" class="more_views">3 More</a> </li> </ul> </div> <div class="clearfix"></div> </div> <div class="chat_area_updated_list_middle"> <div class="chat_area_updated_list_middle_left"> <div class="topichat_media_thumb"> <a href="javascript:void(0);"> <img class="user_chat_thumb" src="' + DEFAULT_PROFILE_IMAGE_PATH + "/" + userdata.user_image + '" title="' + userdata.user + '"> </a> </div> <div id="field" class="topichat_media_rank"> <button type="button" id="add" class="add add_btn smlr_btn"> <img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/> </button> <span class="rank_rate">0</span> <button type="button" id="sub" class="sub smlr_btn"> <img src="' + DEFAULT_IMAGE_PATH + 'challeng_arrow.png" class="rank_img_sec"/> </button> </div> </div> <div class="chat_area_updated_list_middle_right"> <div class="chat_area_updated_list_middle_head"> <h4>'+userdata.title+'</h4> </div> <div class="chat_area_updated_list_middle_middle"> <div class = "fileshare" > '+youtube_video+' </div> </div> </div> </div> </div>');

                    left_link_html += youtube_video;
                } else {
                    var thumbnail_url = (userlink.images.length > 0) ? '<div class="large-3 columns">' +
                            '<img class="thumb" src="' + userlink.images[0].url + '"></img>' +
                            '</div>' : "";
                    var title = (userlink.title != null) ? userlink.title : "";
                    var description = (userlink.description != null) ? userlink.description : "";
                    
                    $('.total_views_inner').append('<div class="topichat_media_post chat_area_updated_list" data-chat_id="' + userdata.chat_id + '"> <div class="chat_area_updated_list_top"> <h4>Total x is Watching</h4> <div class="clearfix"></div> </div> <div class="chat_area_updated_list_middle"> <div class="chat_area_updated_list_middle_left"> <div class="topichat_media_thumb"> <a href="javascript:void(0);"> <img class="user_chat_thumb" src="'+DEFAULT_PROFILE_IMAGE_PATH+userdata.user_image+'" title="'+userdata.user+'"> </a> </div> <div id="field" class="topichat_media_rank"> <button type="button" id="add" class="add add_btn smlr_btn"> <img src="'+DEFAULT_IMAGE_PATH+'challeng_arrow.png" class="rank_img_sec"/> </button> <span class="rank_rate">0</span> <button type="button" id="sub" class="sub smlr_btn"> <img src="'+DEFAULT_IMAGE_PATH+'challeng_arrow.png" class="rank_img_sec"/> </button> </div> </div> <div class="chat_area_updated_list_middle_right"> <div class="chat_area_updated_list_middle_head"> <h4>'+userdata.title+'</h4> </div> <div class="chat_area_updated_list_middle_middle"> <div class="fileshare"> <div class="">'+ thumbnail_url +' <div class="large-9 column"> <a href="' + userlink.url + '" target="_blank">'+title +'</a> <p> '+ description + '</p> </div> </div> </div> </div> </div> </div> </div>');
                    left_link_html += thumbnail_url + '<div class="large-9 column"><a href="' + userlink.url + '" target="_blank">' + title + '</a></div>';
                }

                left_link_html += '</div></div>';

                // Add left link in left section
                if ($('.topic_frame').find('.fileshare').length == 2)
                {
                    // If two links are available then remove one
                    $('.topic_frame').find('.fileshare').last().remove();
                }
                else if ($('.topic_frame').find('.fileshare').length == 0)
                {
                    $('.topic_frame').html('');
                }
                $('.topic_frame').prepend(left_link_html);
            }
            $(".chat_area2").animate({scrollTop: $('.chat_area2').prop("scrollHeight")}, 1000);
        }
        
    });
    Server.connect();

    // Other jquery
    $('#topic_group_subscribe').click(function () {
        var thi = $(this);
        if(thi.data('is_subscribe') == 'no')
        {
            s_text = "You want to subscribe this group!";
            s_confirm_button = "Yes, Subscribe it!";
            s_action = "subscribe";
            s_success_text = "Subscribed";
            s_success_msg = "You have subscribed this group.";
            s_after_btn_text = unsubscribe;
        }
        else if(thi.data('is_subscribe') == 'yes')
        {
            s_text = "You want to Unsubscribe this group!";
            s_confirm_button = "Yes, Unsubscribe it!";
            s_action = "unsubscribe";
            s_success_text = "Unsubscribed";
            s_success_msg = "You have unssubscribed this group.";
            s_after_btn_text = subscribe;
        }
        swal({
            title: "Are you sure?",
            text: s_text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: s_confirm_button,
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                url : base_url+'topichat/subscribe_topichat',
                data : 'user_id='+data.id+"&group_id="+group_id+"&action="+s_action,
                method : 'post',
                success : function(resp){
                    if(resp == "1")
                    {
                        if(thi.data('is_subscribe') == 'no')
                        {
                            thi.data('is_subscribe','yes');
                        }
                        else if(thi.data('is_subscribe') == 'yes')
                        {
                            thi.data('is_subscribe','no');
                        }
                        thi.html(s_after_btn_text);
                        swal(s_success_text,s_success_msg,"success");
                    }
                    else
                    {
                        swal("failed","Your request has been denied due to some problem","error");
                    }
                }
            });
        });
    });
});