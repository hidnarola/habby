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
        <form class="" role="form" method="get" action="<?php echo base_url() . "groupplan" ?>" id="filterby_form">
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
                <form class="" role="form" method="get" action="<?php echo base_url() . "groupplan/search" ?>" id="search_form">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="hidden" class="search-query form-control" placeholder="Find your group" name="topic_filter" value="<?php echo (isset($filterby)) ? $filterby : "" ?>"/>
                            <input type="text" class="search-query form-control" placeholder="Find your Group plan" name="topic" />
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
    <!-- Soulmate #1 section and Newest Post area start here  -->
    <div class="row grp_pnl_row newest-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <?php
                    if (isset($Group_plans) && !empty($Group_plans)) {
                        foreach ($Group_plans as $Group_plan) {
//                            pr($Group_plan);
                            ?>
                            <!-- Group plan each section start here -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 grp_cl6">
                                <div class="grp_pln_sec ">
                                    <div class="grp_pln_img_sec">
                                        <a href="#" data-toggle="modal" data-target="#groupplan1post" data-title="<?php echo $Group_plan['name'] ?>" data-image="<?php echo DEFAULT_GROUPPLAN_IMAGE_PATH . $Group_plan['group_cover'] ?>" data-user="<?php echo $Group_plan['display_name'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Group_plan['user_image'] ?>">
                                            <img src="<?php echo DEFAULT_GROUPPLAN_IMAGE_PATH . $Group_plan['group_cover'] ?> " class="img-responsive center-block">	
                                        </a>
                                    </div>
                                    <div class="grp_pln_cont_sec">
                                        <p class="soulmate_txt1"><?php echo $Group_plan['name'] ?> </p>
                                        <p class="soulmate_txt2"><?php echo $Group_plan['slogan'] ?></p>
                                        <p class="soulmate_txt3"><?php echo $Group_plan['introduction'] ?></p>
                                        <p class="soulmate_txt4"><?php echo $Group_plan['display_name'] ?> Created Group</p>
                                        <ul class="list-inline soulmate_ul">
                                            <li><?php echo ($Group_plan['Total_User'] == 0) ? "No" : "<span>" . $Group_plan['Total_User'] . "</span>"; ?><span> users</span></li>
                                            <li><a href="group_plan_2.html" class="pstbtn">Join</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Group plan each section end here -->
                            <?php
                        }
                    }
                    ?>
                </div>
                <!-- Soulmate #1 row section end here -->
            </div>
        </div>
    </div>
    <!-- Soulmate #1 section and Newest Post area end here  -->
    <!-- Group section container end here -->

    <div class="row">
        <div class="container">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                <a href="#" id="loadMore">Load More</a>

                <p class="totop"> 
                    <a href="#top"><img src="images/upload.png" class="img-responsive"></a> 
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Soulmate new group form popup start here -->
<div class="modal" id="new_grp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b>CREATE NEW GROUP</b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "groupplan/add_group"; ?>" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Group:" name="name" required="true">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Slogan : " name="slogan">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Group introduction : " name="introduction">
                        </div>
                    </div>
                    <!-- Upload images or video section start here -->
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
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="pstbtn" value="<?php echo lang('Create') ?>"/>
                        </div>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>
<div class="modal" id="groupplan1post">
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
<!-- Soulmate new group form popup end here -->
<script type="text/javascript">
    $('#groupplan1post').on('show.bs.modal', function (e) {

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
<script>
    $(function () {
        $("div.soulmate_con2").slice(0, 5).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $("div.soulmate_con2:hidden").slice(0, 5).slideDown();
            if ($("div.soulmate_con2:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1500);
        });
    });

    $('a[href=#top]').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.totop a').fadeIn();
        } else {
            $('.totop a').fadeOut();
        }
    });
</script>
