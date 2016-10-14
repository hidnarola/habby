<?php $cnt = 0; ?>
<div class="row soulmate_con1">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#league_grp"><?php echo lang('New') ?> <br><?php echo lang('League') ?></a>
        <!-- New Group button end-->
    </div>
</div>

<!-- filter titile start here -->
<div class="row filter_row">
    <div class="container grp_pnl_container">
        <form class="" role="form" method="get" action="<?php echo base_url() . "league" ?>" id="filterby_form">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="lang_sec">
                    <select class="selectpicker filterby" data-style="btn-info" name="filterby">
                        <option value="newest" <?php echo (isset($filterby) && $filterby == 'newest') ? "selected" : "" ?>><?php echo lang('Newest'); ?></option>
                        <option value="popular" <?php echo (isset($filterby) && $filterby == 'popular') ? "selected" : "" ?>><?php echo lang('Popular'); ?></option>
                        <option value="recommended" <?php echo (isset($filterby) && $filterby == 'recommended') ? "selected" : "" ?>><?php echo lang('Recommended'); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="topichat_search_sec">
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="  search-query form-control" placeholder="<?php echo lang('Find leagues') ?>" name="topic" value="<?php echo (isset($search_topic)) ? $search_topic : "" ?>"/>
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- filter titile end here -->

<div id="FilterContainer">
    <!-- League plan section and Recommended Post area start here  -->
    <div class="row grp_pnl_row flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row league_data aliance_row">
                    <?php
                    if (isset($league) && !empty($league)) {
                        $cnt = count($league);
                        foreach ($league as $league_row) {
                            ?>

                            <!-- League and alliance each section start here -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 aliance_cl_6">
                                <div class="grp_pln_sec">
                                    <div class="grp_pln_img_sec">
                                        <a href="#" data-toggle="modal" data-target="#league1post" data-title="<?php echo $league_row['name'] ?>" data-image="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league_row['league_image'] ?>" data-user="<?php echo $league_row['created_user'] ?>" data-uimage="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $league_row['user_image'] ?>">
                                            <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league_row['league_image'] ?>" class="img-responsive center-block">
                                        </a>
                                    </div>

                                    <div class="row alliance_cont_sec">
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                            <img src="<?php echo DEFAULT_LEAGUE_IMAGE_PATH . $league_row['league_logo'] ?>" class="img-responsive center-block league_logo">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                            <p class="alinc_txt"><span><?php echo $league_row['total_user'] ?></span><span>/<?php echo $league_row['user_limit'] ?> users</span></p>
                                            <p class="alinc_txt"><?php echo $league_row['name'] ?></p>
                                        </div>
                                    </div>

                                    <div class="alliance_cont_sec2">
                                        <p class="alinc_txt text-center"><?php echo $league_row['introduction'] ?></p>
                                    </div>

                                    <div class="alliance_cont_sec3">
                                        <ul class="list-inline alliance_btn_ul">
                                            <li><a href="javascript:;" class="requirements" data-requirement="<?php echo $league_row['requirements'] ?>"><?php echo lang('Requirement') ?></a></li>
                                            <li><a id="winner13"><?php echo lang('Achieve'); ?></a></li>
                                            <li><a href="<?php echo base_url() . "league/apply/" . urlencode(base64_encode($league_row['id'])) ?>"><?php echo lang('Apply'); ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdownpln">
                                        <div class="winner_popup winner_popup13" role="menu">

                                            <div class="winner_hdg_sec">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h2 class="winner_hdg">Achieve</h2>
                                                </div>
                                            </div>

                                            <div class="dicrp_section">
                                                <div class="dicrp_sectioninr">

                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>challenge-prfl.jpg" class="img-responsive center-block ">
                                                    </div>

                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                        <!-- <h2 class="chlng_hdg">Work description</h2> -->
                                                        <p class="chlng_para">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_pstr">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH; ?>grp_pln_img4.jpg">
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_cmnt">

                                                        <ul class="list-inline winr_ul">
                                                            <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>coin_icon.png"><br><span> 10 </span></a></li>
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH; ?>like_img.png"><br><span>20 Likes  </span>
                                                                </a>
                                                                <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                                    <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a role="button" class="cmnt_winner"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>comment_icon.png"><br><span> Comments  </span></a></li>
                                                        </ul>

                                                        <div class="winner-comnt">

                                                            <p class="cmn_txtnw"> Comment Here</p>
                                                            <textarea class="form-control" rows="3" id="textArea"></textarea>

                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="<?php echo DEFAULT_IMAGE_PATH; ?>likeimg.jpg" class="img-responsive">
                                                                        </div>
                                                                        <div class="cmn_dtl">

                                                                            <p class="cmnt_txt1"><span>John Doe</span> Interesting</p>

                                                                            <ul class="cmnt_p clearfix">
                                                                                <li><a href="#">Like</a></li>
                                                                                <li><a href="#">Reply</a></li>
                                                                                <li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                                                <li class="stlnon"><span>- 10 October at 22:18</span></li>
                                                                            </ul>

                                                                            <p class="cmmnt_para">World Wide Web warned on Saturday that the freedom of the internet is under threat by governments</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- League and alliance each section end here -->
                            <?php
                        }
                    } else {
                        ?>
                        <div class="">
                            No league found.
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- League and alliance row section end here -->
                <?php
                if (isset($league) && !empty($league) && count($league) > 0) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                        <a href="javascript:;" id="loadMore">Load More</a>

                        <p class="totop"> 
                            <a href="#top"><img src="<?php echo DEFAULT_IMAGE_PATH; ?>/upload.png" class="img-responsive"></a> 
                        </p>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
    <!-- League plan section and Recommended Post area end here  -->

</div>

<!-- league group form popup start here -->
<div class="modal" id="league_grp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang('Create New League') ?></b>
                </div>
                <form method="post" action="league/add_league" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="league_name" placeholder="<?php echo lang('League Name') ?>:">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="league_intro" placeholder="<?php echo lang('League introduction') ?>: ">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="user_limit" placeholder="<?php echo lang('Number of maximum members') ?>: ">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="league_requirements" placeholder="<?php echo lang('League requirements') ?>: ">
                        </div>
                    </div>

                    <!-- Upload league image section start here -->
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="upld_sec">
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Cover Image'); ?></span>
                                    <input type="file" name="league_image" class="upload" id="uploadFile"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="message alert alert-danger" style="display:none"></div>
                        <div class="image_wrapper" style="display: none">
                            <div id="imagePreview"></div>
                        </div>
                    </div>

                    <!-- Upload league badge section start here -->
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="upld_sec">
                                <div class="fileUpload up_img btn">
                                    <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Badge Image'); ?></span>
                                    <input type="file" name="league_logo" class="upload" id="uploadLogo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="logo_message alert alert-danger" style="display:none"></div>
                        <div class="logo_wrapper" style="display: none">
                            <div id="logoPreview"></div>
                        </div>
                    </div>

                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="pstbtn">Save</button>
                        </div>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>
<!-- league form popup end here -->

<!-- league Requirement  popup start here -->
<div class="modal" id="league_rquirement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang('Requirement'); ?></b>
                </div>
                <div class="rquire_txt_sec">
                    <p id="requirement_text"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- league Requirement popup end here -->


<!--  league Post modal section start here -->
<div class="modal" id="league1post">
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
    // Image uploading script
    $("#uploadLogo").on("change", function ()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.logo_message').html("No file selected.");
            $('.logo_message').show();
            return; // no file selected, or no FileReader support
        }


        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                $('.logo_message').hide();
                $('.logo_wrapper').show();
                $("#logoPreview").css("background-image", "url(" + this.result + ")");
            }
        } else {
            $('.logo_message').html("Please select proper image");
            $('.logo_message').show();
        }
    });

    $("#uploadFile").on("change", function ()
    {
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

    $(".league_data").on('click', '.requirements', function () {
        $('#requirement_text').html($(this).data('requirement'));
        $('#league_rquirement').modal('show');
    });

    $(".filterby").change(function () {
        $("#filterby_form").submit();
    });
    $(".find_topic").click(function () {
        $("#search_form").submit();
    });

    $('#league1post').on('show.bs.modal', function (e) {

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

        q = window.location.href.split('?');
        if (typeof (q[1]) != 'undefined')
        {
            myurl = base_url + 'league/load_league/' + page + '?' + q[1];
        } else
        {
            myurl = base_url + 'league/load_league/' + page;
        }

        $.ajax({
            url: myurl,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.league_data').append("<div class='col-sm-12 alert alert-info text-center'>No more league found</div>");
                    $('#loadMore').remove();
                } else
                {
                    $('.league_data').append(data.view);
                }
            }
        });
        page++;
    }

</script>
<!--  league Post modal section end here  -->