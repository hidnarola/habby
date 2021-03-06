<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <?php if ($banner_image != "" && $banner_image != null) { ?>
        <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <?php } else {
        ?>
        <div class="raw col-sm-12">&nbsp;</div>
    <?php }
    ?>
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_grp"><?php echo lang('New'); ?> <br><?php echo lang('Group'); ?></a>
        <!-- New Group button end-->
    </div>
</div>
<!-- Topicaht Post and bannner section end here -->

<!-- filter titile start here -->
<div class="row filter_row">
    <div class="container grp_pnl_container">
        <form class="" role="form" method="get" action="<?php echo base_url() . "topichat" ?>" id="filterby_form">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="lang_sec">
                    <select class="selectpicker filterby" data-style="btn-info" name="filterby">
                        <option value="newest" <?php echo (isset($filterby) && $filterby == 'newest') ? "selected" : "" ?>><?php echo lang('Newest'); ?></option>
                        <option value="popular" <?php echo (isset($filterby) && $filterby == 'popular') ? "selected" : "" ?>><?php echo lang('Popular'); ?></option>
                        <option value="recommended" <?php echo (isset($filterby) && $filterby == 'recommended') ? "selected" : "" ?>><?php echo lang('Recommended'); ?></option>
                    </select>
                </div>
            </div>
            
        </form>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="topichat_search_sec">
                <form class="" role="form" method="get" action="<?php echo base_url() . "topichat/search" ?>" id="search_form">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="hidden" class="search-query form-control" placeholder="<?php echo lang('Find your group'); ?>" name="topic_filter" value="<?php echo (isset($filterby)) ? $filterby : "" ?>"/>
                            <input type="text" class="search-query form-control" placeholder="<?php echo lang('Find your group'); ?>" name="topic" value="<?php echo (isset($topic)) ? $topic : "" ?>" />
                            <span class="input-group-btn">
                                <button class="btn btn-danger find_topic" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- filter titile end here -->
<div id="FilterContainer">
    <?php
    $message = $this->session->flashdata('message');
    if (!empty($message) && isset($message)) {
        ($message['class'] != '') ? $message['class'] : '';
        echo '<div class="' . $message['class'] . '">' . $message['message'] . '</div>';
    }

    $all_errors = validation_errors();
    if (isset($all_errors) && !empty($all_errors)) {
        echo '<div class="alert alert-danger">' . $all_errors . '</div>';
    }
    $cnt = 0;
    ?>
    <!-- Topichat #1 section and Newest Post area start here  -->
    <div class="row grp_pnl_row newest-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row topichat_groups">
                    <?php
                    if (isset($topichat_groups) && !empty($topichat_groups)) {
                        $cnt = count($topichat_groups);
                        foreach ($topichat_groups as $topichat_group) {
                            ?>
                            <!-- Topichat #1 each section start here -->
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 grp_cl6">
                                <div class="grp_pln_sec ">

                                    <div class="grp_pln_img_sec">
                                        <a href="#" data-toggle="modal" data-target="#topichat1post" data-title="<?php echo $topichat_group['topic_name'] ?>" data-image="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat_group['group_cover'] ?>" data-user="<?php echo $topichat_group['display_name'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $topichat_group['user_image'] ?>">
                                            <div class="grp_plan_img">
                                                <img src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat_group['group_cover'] ?> " class="img-responsive center-block" style="">
                                            </div>
                                        </a>
                                    </div>

                                    <div class="grp_pln_cont_sec">
                                        <p class="topichat_txt1"><?php echo $topichat_group['topic_name'] ?> </p>
                                        <?php echo ($topichat_group['notes'] != NULL) ? '<p class="topichat_txt2">' . $topichat_group['notes'] . '</p>' : ""; ?>
                                        <ul class="list-inline soulmate_ul">
                                            <!--<li><?php echo ($topichat_group['person_limit'] == -1) ? $topichat_group['Total_User'] : "<span>" . $topichat_group['Total_User'] . "/" . $topichat_group['person_limit'] . "</span>"; ?><span> <?php echo lang('Users'); ?></span></li> -->                                            
                                            <!-- Changes made by "ar" dated on 14th Feb -->
                                            <li><?php echo $topichat_group['Total_User']  ?><span> <?php echo lang('Users')." ".lang('Joining'); ?></span></li>
                                            <li>
                                                <?php
                                                if (isset($topichat_group['is_joined']) && $topichat_group['is_joined']) {
                                                    ?>
                                                    <a href="<?php echo base_url() . "topichat/details/" . urlencode(base64_encode($topichat_group['id'])) ?>" class="pstbtn"><?php echo lang('Joined'); ?></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="<?php echo base_url() . "topichat/join/" . urlencode(base64_encode($topichat_group['id'])) ?>" class="pstbtn"><?php echo lang('Join'); ?></a>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                                        <!--<li><button class="join pstbtn" id="<?php echo md5($topichat_group['id']); ?>">Join</button></li>-->
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- Topichat #1 each section start here -->
                            <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-info text-center">
                            <?php echo lang('No Topichat found.'); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- Topichat #1 row section end here -->
            </div>
        </div>
    </div>
    <?php
    if ($cnt >= 3) {
        ?>
        <div class = "row">
            <div class = "container">
                <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                    <a id = "loadMore" href = "javascript:;"><?php echo lang('Load More'); ?></a>
                    <p class = "totop">
                        <a href = "#top" style = "display: inline;"><img class = "img-responsive" src = "<?php echo DEFAULT_IMAGE_PATH . "upload.png" ?>"></a>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <!--Topichat #1 section and Newest Post area end here  -->
</div>
<!--Topichat Popular section start here -->
<div class = "modal" id = "new_grp">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-body">
                <div class = "panel-heading">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">&times;
                    </button>
                    <b><?php echo lang('CREATE NEW GROUP'); ?></b>
                </div>
                <div class = "row pst_here_sec">
                    <!--post start here -->
                    <form class = "" role = "form" method = "post" action = "<?php echo base_url() . "topichat/add_group"; ?>" enctype = "multipart/form-data">
                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class = "panel panel-default">
                                <!--Upload images or video section start here -->
                                <div class = "panel-body1 clearfix">
                                    <div class = "topichat_txtarea">
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class = "row">
                                                <div class = "form-group clearfix">
                                                    <label for = "select" class = "col-lg-1 col-md-1 col-sm-2 col-xs-12 control-label"><?php echo lang('Topic'); ?> : </label>
                                                    <div class = "col-lg-11 col-md-11 col-sm-10 col-xs-12">
                                                        <textarea class = "form-control topichat_txtarea" rows = "3" id = "topic_name" placeholder = "#<?php echo lang('Topic'); ?>" name = "topic_name" required = "required"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class = "row">
                                                <div class = "form-group clearfix">
                                                    <label class = "col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label"><?php echo lang('Number of People'); ?> :</label>
                                                    <div class = "col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                        <div class = "radio topchat_1_rdo">
                                                            <label>
                                                                <input type = "radio" name = "person_limit" id = "no_limit" value = "-1" checked = "">
                                                                <?php echo lang('No limit'); ?>
                                                            </label>
                                                            <label>
                                                                <input type = "radio" name = "person_limit" id = "No_of_person" value = "Yes" >
                                                                <input type = "number" min="1" class = "custom_no_of_person form-control" id = "txt_No_of_person" name = "No_of_person" placeholder = "<?php echo lang('customise'); ?>" disabled>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "panel-body">
                                    <div class = "message alert alert-danger" style = "display:none"></div>
                                    <div class = "upld_sec">
                                        <div class = "fileUpload up_img btn">
                                            <span><i class = "fa fa-picture-o" aria-hidden = "true"></i> <?php echo lang('Images');
                                                                ?></span>
                                            <input type="file" name="group_cover" class="upload" id="uploadFile"/>
                                        </div>
                                    </div>
                                    <div class="image_wrapper" style="display: none">
                                        <div id="imagePreview"></div>
                                    </div>
                                </div>
                                <!-- Upload images or video section end here -->

                                <!-- selectng "Post to" and Original section start here -->

                                <div class="panel-body1 clearfix chat_pnl_ftr">
                                    <div class="topichat_txtarea">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <label for="select" class="col-lg-1 col-md-1 col-sm-2 col-xs-12 control-label"><?php echo lang('Note'); ?> :</label>
                                                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-12">
                                                        <textarea class="form-control topichat_txtarea" rows="3" id="note_textArea" name="notes"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="submit" class="pstbtn" value="<?php echo lang('Create') ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- selectng "Post to" and Original section end here -->
                            </div>
                        </div>
                    </form>
                    <!-- post end here -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Topichat Post modal section start here -->
<div class="modal" id="topichat1post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p id="modal_title"></p>
                <h4 class="modal-title">
                    <span id="modal_title"></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="grp_pln_img_sec text-center">
                    <img src="" class="img-responsive center-block" id="m_user_image" style="height: 34px;width: 34px;display: inline-block;padding-right:5px;border-radius: 50%;"><span id="modal_user"></span>
                </div>
                <p class="modl_ttl"><img src="" class="cht_pfl_img" id="m_image" style="height: 275px;width: 560px;"></p>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    //triggered when modal is about to be shown
    $('#topichat1post').on('show.bs.modal', function (e) {

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

    $('input:radio[name="person_limit"]').change(function () {
        if ($(this).is(":checked") && $(this).val() == 'Yes')
            $("#txt_No_of_person").removeAttr("disabled");
        else
            $("#txt_No_of_person").attr("disabled", "disabled");
    });

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        //        console.log('on change fired');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html(no_selected_file);
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
            $('.message').html(proper_image);
            $('.message').show();
        }
    });

    $(".filterby").change(function () {
        $("#filterby_form").submit();
    });
    $(".find_topic").click(function () {
        $("#search_form").submit();
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
        var uri = window.location.href;
        uri = uri.split('/');
        var myurl = "";
        if (typeof (uri[4]) != "undefined")
        {
            q = uri[4].split('?');
            if (typeof (q[1]) != 'undefined' && (q[0] == 'search'))
            {
                myurl = base_url + 'topichat/search/' + page + '?' + q[1];
            } else
            {
                myurl = base_url + 'topichat/load_topichat_data/' + page;
            }
        } else
        {
            q = window.location.href.split('?');
            if (typeof (q[1]) != 'undefined')
            {
                myurl = base_url + 'topichat/load_topichat_data/' + page + '?' + q[1];
            } else
            {
                myurl = base_url + 'topichat/load_topichat_data/' + page;
            }
        }
        $.ajax({
            url: myurl,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                var cnt = data.cnt;
                if (data.status == 0)
                {
                    load = false;
                    $('.topichat_groups').append("<div class='clearfix'></div><div class='col-sm-12 alert alert-info text-center'>" + no_groups + "</div>");
                    $('#loadMore').remove();
                } else
                {
                    $('.topichat_groups').append(data.view);
                    if (cnt < 3) {
                        load = false;
                        $('#loadMore').remove();
                    }
                }
            }
        });
        page++;
    }

    $(function () {
        $('#new_grp').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
            $(this).find('form').trigger('reset');
            $('#topic_name').val('').empty();
            $('#no_limit').prop('checked', true);
            $('#txt_No_of_person').val('').empty();
            $('.image_wrapper').html('');
            $('#note_textArea').html('');
        });
    });
</script>
