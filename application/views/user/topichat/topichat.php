<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_grp">New <br>Group</a>
        <!-- New Group button end-->
    </div>

</div>
<!-- Topicaht Post and bannner section end here -->

<!-- filter titile start here -->
<div class="row filter_row">
    <div class="container grp_pnl_container">
        <form class="" role="form" method="get" action="<?php echo base_url() . "topichat" ?>" id="filterby_form">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="lang_sec">
                    <select class="selectpicker filterby" data-style="btn-info" name="filterby">
                        <option value="newest" <?php echo (isset($filterby) && $filterby == 'newest') ? "selected" : "" ?>>Newest</option>
                        <option value="popular" <?php echo (isset($filterby) && $filterby == 'popular') ? "selected" : "" ?>>Popular</option>
                        <option value="recommended" <?php echo (isset($filterby) && $filterby == 'recommended') ? "selected" : "" ?>>Recommended</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="topichat_search_sec">
                <form class="" role="form" method="get" action="<?php echo base_url() . "topichat/search" ?>" id="search_form">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="hidden" class="search-query form-control" placeholder="Find your group" name="topic_filter" value="<?php echo (isset($filterby)) ? $filterby : "" ?>"/>
                            <input type="text" class="search-query form-control" placeholder="Find your group" name="topic" />
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
    ?>
    <!-- Topichat #1 section and Newest Post area start here  -->
    <div class="row grp_pnl_row newest-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <?php
                    if (isset($topichat_groups) && !empty($topichat_groups)) {
                        foreach ($topichat_groups as $topichat_group) {
//                            pr($topichat_group);
                            ?>
                            <!-- Topichat #1 each section start here -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <div class="grp_pln_sec ">

                                    <div class="grp_pln_img_sec" style="height: 200px;width: 390px;">
                                        <a href="#" data-toggle="modal" data-target="#topichat1post" data-title="<?php echo $topichat_group['topic_name'] ?>" data-image="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat_group['group_cover'] ?>" data-user="<?php echo $topichat_group['display_name'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $topichat_group['user_image'] ?>">
                                            <img src="<?php echo DEFAULT_TOPICHAT_IMAGE_PATH . $topichat_group['group_cover'] ?> " class="img-responsive center-block" style="height: 100%;width: 100%;">
                                        </a>
                                    </div>

                                    <div class="grp_pln_cont_sec">
                                        <p class="topichat_txt1"><?php echo $topichat_group['topic_name'] ?> </p>
                                        <?php echo ($topichat_group['notes'] != NULL) ? '<p class="topichat_txt2">' . $topichat_group['notes'] . '</p>' : ""; ?>
                                        <ul class="list-inline soulmate_ul">
                                            <li><?php echo ($topichat_group['person_limit'] == -1) ? $topichat_group['Total_User'] : "<span>" . $topichat_group['Total_User'] . "/" . $topichat_group['person_limit'] . "</span>"; ?><span> users</span></li>
                                            <li><a href="<?php echo base_url() . "topichat/join/" . $topichat_group['id'] ?>" class="pstbtn">Join</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <!-- Topichat #1 each section start here -->
                            <?php
                        }
                    }
                    ?>
                </div>
                <!-- Topichat #1 row section end here -->
            </div>
        </div>
    </div>
    <!-- Topichat #1 section and Newest Post area end here  -->
</div>
<!-- Topichat Popular section start here -->
<div class="modal" id="new_grp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b>CRAETE NEW GROUP</b>
                </div>
                <div class="row pst_here_sec">
                    <!-- post start here -->
                    <form class="" role="form" method="post" action="<?php echo base_url() . "topichat/add_group"; ?>" enctype="multipart/form-data">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <!-- Upload images or video section start here -->
                                <div class="panel-body1 clearfix">
                                    <div class="topichat_txtarea">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <label for="select" class="col-lg-1 col-md-1 col-sm-2 col-xs-3 control-label">Topic : </label>
                                                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-9">
                                                        <textarea class="form-control topichat_txtarea" rows="3" id="textArea" placeholder="#Topic" name="topic_name" required="required"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="form-group clearfix">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-xs-5 control-label">Number of People :</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                        <div class="radio topchat_1_rdo">
                                                            <label>
                                                                <input type="radio" name="person_limit" id="optionsRadios1" value="-1" checked="">
                                                                No limit
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="person_limit" id="No_of_person" value="Yes" >
                                                                <input type="text" class="form-control" id="txt_No_of_person" name="No_of_person" placeholder="customise" disabled>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="message alert alert-danger" style="display:none"></div>
                                    <div class="upld_sec">
                                        <div class="fileUpload up_img btn">
                                            <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
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
                                                    <label for="select" class="col-lg-1 col-md-1 col-sm-2 col-xs-3 control-label">Note :</label>
                                                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-9">
                                                        <textarea class="form-control topichat_txtarea" rows="3" id="textArea" name="notes"></textarea>
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
                <p class="modl_ttl"><img src="" class="cht_pfl_img" id="m_image" style="height: 275px;width: 560px;"></p>
                <div class="grp_pln_img_sec">
                    <img src="" class="img-responsive center-block" id="m_user_image" style="height: 34px;width: 34px;display: inline-block;padding-right:5px"><span id="modal_user"></span>
                </div>
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
</script>
