<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_grp">New <br>Challenge</a>
        <!-- New Group button end-->
    </div>

</div>
<!-- Topicaht Post and bannner section end here -->
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
    <!-- Soulmate #1 section and Newest Post area start here  -->
    <div class="row grp_pnl_row newest-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row challenges challenge_container">
                    <!-- Challenge each section start here -->
                    <?php
                    if ($Challenges != "" && !empty($Challenges)) {
                        $cnt = count($Challenges);

                        foreach ($Challenges as $Challenge) {
//                            pr($Challenge);
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                                <div class="challenge_sec" data-challenge_id="<?php echo $Challenge['id']; ?>">
                                    <!-- Challenge header section start here -->
                                    <div class="challenge_cont_sec row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3 chlng_pflsec">
                                            <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $Challenge['user_image']; ?>" class="img-responsive center-block ">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                            <h2 class="chlng_hdg"><?php echo $Challenge['name']; ?> <img src="<?php echo DEFAULT_IMAGE_PATH . "challeng_arrow.png"; ?>" class="pull-right"></h2>
                                        </div>
                                    </div>
                                    <!-- Challenge header section end here -->

                                    <!-- Challenge content section start here -->

                                    <div class="challenge_cont_sec2 row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                            <div id="field">
                                                <button type="button" id="add" class="add add_btn smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH; echo ($Challenge['is_ranked']  && $Challenge['given_rank'] == 1)?'challeng_arrow_ranked.png': "challeng_arrow.png"; ?>"></button>
                                                <input type="text" id="1" value="<?php echo $Challenge['average_rank']; ?>" class="field rank_rate" />
                                                <button type="button" id="sub" class="sub smlr_btn"><img src="<?php echo DEFAULT_IMAGE_PATH; echo ($Challenge['is_ranked'] && $Challenge['given_rank'] == 0)?'challeng_arrow_ranked.png': "challeng_arrow.png";?>"></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8 pad_lft0">
                                            <p class="chlng_para">
                                                <?php echo $Challenge['description'] ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Challenge content section end here -->

                                    <!-- Challenge buttons section start here -->
                                    <div class="challenge_cont_sec3 row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <ul class="list-inline chlng_ul2">
                                                <li><span title="Rewards"><img class="reward_img" src="<?php echo DEFAULT_IMAGE_PATH."coin_icon.png" ?>"/><?php echo $Challenge['rewards'] ?></span></li>
                                                <li class="winner winner_btn" id="winner<?php echo $Challenge['id']; ?>" data-id="<?php echo $Challenge['id']; ?>">
                                                    <a class="pstbtn">Winners</a>
                                                </li>
                                                <?php
                                                if ($Challenge['is_applied']) {
                                                    ?>
                                                    <a href="<?php echo base_url() . "challenge/details/" . urlencode(base64_encode($Challenge['id'])) ?>" class="pstbtn">Enter</a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <li><a href="<?php echo base_url() . "challenge/accept/" . urlencode(base64_encode($Challenge['id'])) ?>" class="pstbtn">Accept</a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>

                                        </div>
                                    </div>
                                    <!-- Challenge buttons section end here -->

                                    <!-- Winner Popup start here -->
                                    <div class="dropdownpln">
                                        <div class="winner_popup winner_popup<?php echo $Challenge['id']; ?>" role="menu">

                                            <div class="winner_hdg_sec">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <h2 class="winner_hdg">Winner</h2>
                                                </div>
                                            </div>

                                            <div class="dicrp_section">
                                                <div class="dicrp_sectioninr">

                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-3">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "challenge-prfl.jpg"; ?>" class="img-responsive center-block ">
                                                    </div>

                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-8">
                                                        <!-- <h2 class="chlng_hdg">Work description</h2> -->
                                                        <p class="chlng_para">
                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_pstr">
                                                        <img src="<?php echo DEFAULT_IMAGE_PATH . "grp_pln_img4.jpg"; ?>">
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 winnr_cmnt">

                                                        <ul class="list-inline winr_ul">
                                                            <li><a href="#"><img src="<?php echo DEFAULT_IMAGE_PATH . "coin_icon.png"; ?>"><br><span> 10 </span></a></li>
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                                                    <img src="<?php echo DEFAULT_IMAGE_PATH . "like_img.png"; ?>"><br><span>20 Likes  </span>
                                                                </a>
                                                                <ul class="dropdown-menu opn_drpdwn" role="menu">
                                                                    <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a role="button" class="cmnt_winner"><img src="<?php echo DEFAULT_IMAGE_PATH . "comment_icon.png"; ?>"><br><span> Comments  </span></a></li>
                                                        </ul>

                                                        <div class="winner-comnt">

                                                            <p class="cmn_txtnw"> Comment Here</p>
                                                            <textarea class="form-control" rows="3" id="textArea"></textarea>

                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="commnt_visit_sec clearfix">
                                                                        <div class="cmn_img">
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
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
                                                                            <img src="images/likeimg.jpg" class="img-responsive">
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
                                    <!-- Winner Popup start here -->
                                </div>
                            </div>
                            <!-- Challenge each section end here -->
                            <?php
                        }
                    } else {
                        ?>
                        <div class="">
                            No Challenge found.
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- Challenge row section end here -->
            </div>
        </div>
    </div>
    <!-- Soulmate #1 section and Newest Post area end here  -->
    <!-- Group section container end here -->

    <?php
    if ($cnt >= 3) {
        ?>
        <div class = "row">
            <div class = "container">
                <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                    <a id = "loadMore" href = "javascript:;">Load More</a>
                    <p class = "totop">
                        <a href = "#top" style = "display: inline;"><img class = "img-responsive" src = "<?php echo DEFAULT_IMAGE_PATH . "upload.png" ?>"></a>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<!-- Soulmate new group form popup start here -->
<div class="modal" id="new_grp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b>CREATE NEW CHALLENGE</b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "challenge/add_group"; ?>" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="name" placeholder="Challenge:" name="name" required="true">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="description" placeholder="Required Details : " name="description">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" id="rewards" placeholder="Rewards: " name="rewards">
                        </div>
                    </div>
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
    DEFAULT_IMAGE_PATH = '<?php echo DEFAULT_IMAGE_PATH; ?>';
    
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
    $(".more_challenge").click(function () {
        $("#more_ch_form").submit();
    })
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
    });</script>
<script>
    $(document).ready(function () {
        $(".challenges").on('click', '.winner_btn', function () {
            var id = $(this).data('id');
            $(".winner_popup" + id).slideToggle(1000);
        });
    });</script>
<script>
    $(document).ready(function () {
        $(".cmnt_winner").click(function () {
            $(".winner-comnt").slideToggle(1000);
        });
    });</script>

<!-- vote section jquery start here -->
<script>
    $('.add').click(function () {
        $(this).next().val(+$(this).next().val() + 1);
    });
    $('.sub').click(function () {
        if ($(this).prev().val() > 0)
            $(this).prev().val(+$(this).prev().val() - 1);
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
            myurl = base_url + 'challenge/load_challenge_data/' + page + '?' + q[1];
        } else
        {
            myurl = base_url + 'challenge/load_challenge_data/' + page;
        }
        $.ajax({
            url: myurl,
            method: 'get',
            success: function (data) {
                data = JSON.parse(data);
                if (data.status == 0)
                {
                    load = false;
                    $('.challenges').append("<div class='col-sm-12 alert alert-info text-center'>No more group found</div>");
                    $('#loadMore').remove();
                } else
                {
                    $('.challenges').append(data.view);
                }
            }
        });
        page++;
    }

    // Add rank for challenge
    $(".challenge_container").on("click", ".add", function () {
        var t = $(this);
        var challenge_id = t.parents('.challenge_sec').data('challenge_id');
        c = $('body').find("[data-challenge_id='" + challenge_id + "']");
        $.ajax({
            url: base_url + 'user/challenge/add_rank_to_challenge/' + challenge_id,
            success: function (str)
            {
                if (str == 1)
                {
                    c.find('.add').find('img').each(function () {
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.rank_rate').each(function () {
                        $(this).val(parseInt($(this).val()) + 1);
                    });
                }
                else if (str == 2)
                {
                    c.find('.add').find('img').each(function () {
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.sub').find('img').each(function () {
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow.png');
                    });
                    c.find('.rank_rate').each(function () {
                        $(this).val(parseInt($(this).val()) + 2);
                    });
                }
            }
        });
    });

    // Subtract rank for challenge
    $(".challenge_container").on("click", ".sub", function () {
        var t = $(this);
        var challenge_id = t.parents('.challenge_sec').data('challenge_id');
        c = $('body').find("[data-challenge_id='" + challenge_id + "']");
        $.ajax({
            url: base_url + 'user/challenge/subtract_rank_from_challenge/' + challenge_id,
            success: function (str) {
                if (str == -1)
                {
                    c.find('.sub').find('img').each(function () {
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.rank_rate').each(function () {
                        $(this).val(parseInt(t.siblings('.rank_rate').val()) - 1);
                    });
                }
                else if (str == -2)
                {
                    c.find('.sub').find('img').each(function () {
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow_ranked.png');
                    });
                    c.find('.add').find('img').each(function () {
                        $(this).attr('src', DEFAULT_IMAGE_PATH + 'challeng_arrow.png');
                    });
                    c.find('.rank_rate').each(function () {
                        $(this).val(parseInt($(this).val()) - 2);
                    });
                }
            }
        });
    });

</script>
