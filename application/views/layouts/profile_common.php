<?php
$controller = $this->router->fetch_class(); //outputs index
$method_name = $this->router->fetch_method(); //outputs index
?>
<div class="row personal_act_sec">
    <?php
    if (isset($user_data) && !empty($user_data)) {
//        pr($user_data);
        ?>
        <div class="container prsna_coner personal_cntner">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="prfl_cvr_sec">
                    <div class="row">
                        <!-- Profile section start here -->
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                    <div class="pfl_imgsec" style="height: 140px;max-width: 216px;">
                                        <img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $user_data['user_image']; ?>" class="img-responsive center-block user_image" style="height: 100%;max-width: 100%;">
                                        <?php
                                        if ($user_data['id'] == $this->session->user['id']) {
                                            ?>
                                            <div class="pfl_imgsec_innr">
                                                <div class="upld_sec">
                                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url() . "home/profile_upload" ?>" id="upload_user_image">
                                                        <div class="fileUpload up_img btn">
                                                            <span><i class="fa fa-camera" aria-hidden="true"></i> <?php echo lang('UPLOAD PROFILE PICTURE'); ?></span>
                                                            <input type="file" class="upload user_profile_upload" name="user_image">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                                    <div class="prfl_details">
                                        <p><?php echo lang('Name'); ?> : <?php echo $user_data['name'] ?></p>	
                                        <p><?php echo lang('Gender'); ?> : <?php echo $user_data['gender'] ?></p>	
                                        <p><?php echo lang('Country'); ?> : <?php echo get_country_name($user_data['country']) ?></p>
                                        <p><?php echo lang('Self-introduction'); ?> : <span class="more"><?php echo $user_data['bio'] ?></span></p>	
                                        <p><?php echo lang('Interest/Hobby'); ?> : <span class="more"><?php echo $user_data['hobby'] ?></span></p>
                                        <?php
                                        if ($user_data['id'] == $this->session->user['id']) {
                                            ?>
                                            <p class="editprfl_p"><a href="#" data-toggle="modal" data-target="#edit-profile" class="pstbtn"><?php echo lang("Edit Profile"); ?></a></p>
                                            <?php
                                        } else {
                                            if (isset($followers) && !empty($followers) && in_array($this->session->user['id'], array_column($followers, 'follower_id'))) {
                                                ?>
                                                <p class="follow_p"><a href="javascript:void(0)" class="unfollowbtn pstbtn" data-userid="<?php echo $user_data['id']; ?>"><?php echo lang("Followed"); ?></a></p>

                                                <?php
                                            } else {
                                                ?>
                                                <p class="follow_p"><a href="javascript:void(0)" class="followbtn pstbtn" data-userid="<?php echo $user_data['id']; ?>"><?php echo lang("Follow"); ?></a></p>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile section end here -->

                        <!-- Follow and follower sections start here -->

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 pad_lft0">
                            <div class="follower_sec follow_sec">
                                <h2><?php echo lang('Follower'); ?></h2>

                                <ul class="list-inline">
                                    <?php
                                    $i = 0;
                                    if (isset($followers) && !empty($followers)) {
                                        foreach ($followers as $follower) {
                                            ?>
                                            <li><a href="<?php echo base_url() . "user_profile/" . $follower['follower_id'] ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $follower['user_image']; ?>" title="<?php echo $follower['name']; ?>" class="img-circle" style="height: 25px;width: 25px;"></a></li>
                                            <?php
                                            $i++;
                                        }
                                        if ($i > 4) {
                                            ?>
                                            <li><a href="#">+<?php echo lang('more'); ?></a></li>
                                            <?php
                                        }
                                    } else {
                                        echo "<li>" . lang('No Follower.') . "</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="follow_sec2 follow_sec">
                                <h2><?php echo lang('Follow'); ?></h2>
                                <ul class="list-inline">
                                    <?php
                                    $j = 0;
                                    if (isset($followings) && !empty($followings)) {
                                        foreach ($followings as $following) {
                                            ?>
                                            <li><a href="<?php echo base_url() . "user_profile/" . $following['user_id'] ?>"><img src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $following['user_image']; ?>" title="<?php echo $following['name']; ?>" class="img-circle" style="height: 25px;width: 25px;"></a></li>
                                            <?php
                                        }
                                        if ($j > 4) {
                                            ?>
                                            <li><a href="#">+<?php echo lang('more'); ?></a></li>
                                            <?php
                                        }
                                    } else {
                                        echo "<li>" . lang('No Followee.') . "</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- Follow and follower sections end here -->
                    </div>

                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<!-- Personal Account submenu start here -->
<div class="row personal_act_sec">
    <div class="container personal_cntner sub_menusec">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad_lft_rit0">
            <ul class="list-inline submenu_ul">
                <?php
                if ($user_data['id'] == $this->session->user['id']) {
                    ?>
                    <li class="<?php echo ($controller == 'home' && $method_name == 'profile') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "home/profile" ?>"><?php echo lang('IP'); ?></a></li>
                    <li class="<?php echo ($controller == 'home' && $method_name == 'topichat') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "home/topichat" ?>"><?php echo lang('Share & Chat'); ?></a></li>
    <!--                            <li><a href="<?php echo base_url() . "home/soulmate" ?>"><?php echo lang('Soulmate'); ?></a></li>
                    <li><a href="<?php echo base_url() . "home/groupplan" ?>"><?php echo lang('Group Plan'); ?></a></li>-->
                    <li class="<?php echo ($controller == 'home' && $method_name == 'events') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "home/events" ?>"><?php echo lang('Join me'); ?></a></li>
                    <li class="<?php echo ($controller == 'home' && $method_name == 'challenges') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "home/challenges" ?>"><?php echo lang('Challenge'); ?></a></li>
                    <!--<li class="<?php // echo ($controller == 'home' && $method_name == 'league') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "home/league" ?>"><?php echo lang('League and alliance'); ?></a></li>-->
                    <?php
                } else {
//                    echo $controller . " " . $method_name;
                    ?>
                    <li class="<?php echo ($controller == 'Home' && $method_name == 'user_profile') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "user_profile/" . $user_data['id']; ?>"><?php echo lang('IP'); ?></a></li>
                    <li class="<?php echo ($controller == 'Home' && $method_name == 'topichat') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "user_profile/topichat/" . $user_data['id']; ?>"><?php echo lang('Topichat'); ?></a></li>
    <!--                        <li><a href="<?php echo base_url() . "user_profile/soulmate/" . $user_data['id']; ?>><?php echo lang('Soulmate'); ?></a></li>
                    <li><a href="<?php echo base_url() . "user_profile/groupplan/" . $user_data['id']; ?>"><?php echo lang('Group Plan'); ?></a></li>-->
                    <li class="<?php echo ($controller == 'Home' && $method_name == 'events') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "user_profile/events/" . $user_data['id']; ?>"><?php echo lang('Events'); ?></a></li>
                    <li class="<?php echo ($controller == 'Home' && $method_name == 'challenges') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "user_profile/challenges/" . $user_data['id']; ?>"><?php echo lang('Challenge'); ?></a></li>
                    <!--<li class="<?php // echo ($controller == 'Home' && $method_name == 'league') ? 'active' : ''; ?>"><a href="<?php echo base_url() . "user_profile/league/" . $user_data['id']; ?>"><?php echo lang('League and alliance'); ?></a></li>-->
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<!-- Personal Account submenu end here -->
<!--  Edit Profile Detail form modal start here -->
<div class="modal mdl_frm" id="edit-profile" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
                    <b><?php echo lang('edit your profile') ?></b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "home/profile" ?>">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $name = (set_value('name') == false) ? $user_data['name'] : set_value('name'); ?>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('Display Name'); ?>" value="<?php echo $name; ?>" required >
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $email = (set_value('email') == false) ? $user_data['email'] : set_value('email'); ?>
                            <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo lang('E-mail'); ?>" value="<?php echo $email; ?>" readonly="" required>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <select name="country" class="form-control" id="country" >
                                <?php
                                if (!empty($all_countries)) {
                                    foreach ($all_countries as $a_country) {
                                        ?>
                                        <option value="<?php echo $a_country['id']; ?>" <?php echo set_select('country', $a_country['id']); ?>>
                                            <?php echo $a_country['nicename']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Male" <?php
                                    if ($user_data['gender'] == 'Male') {
                                        echo 'checked';
                                    }
                                    ?>><?php echo lang('Male'); ?>
                                </label>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="Female" <?php
                                    if ($user_data['gender'] == 'Female') {
                                        echo 'checked';
                                    }
                                    ?>><?php echo lang('Female'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $bio = (set_value('bio') == false) ? $user_data['bio'] : set_value('bio'); ?>
                            <textarea class="form-control" id="bio" name="bio" placeholder="<?php echo lang('Enter your Bio'); ?>" rows="5" cols="20" ><?php echo $bio; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $hobby = (set_value('hobby') == false) ? $user_data['hobby'] : set_value('hobby'); ?>
                            <textarea class="form-control" id="hobby" name="hobby" placeholder="<?php echo lang('Enter your hobby seprate by comma'); ?>" rows="5" cols="20"><?php echo $hobby; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="pstbtn" value="<?php echo lang('Save'); ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  Edit Profile Detail form modal end here -->
<script>
    $("#country").val('<?php echo $user_data['country']; ?>');
    $(function () {
        $('.user_profile_upload').change(function () {
            $('#upload_user_image').submit();
        });
        $('.followbtn').click(function () {
            var user_id = $(this).data('userid');
            swal({
                title: "<?php echo lang('Are you sure?') ?>",
                text: "<?php echo lang('You would like to follow this user!') ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo lang("Yes, Follow!"); ?>",
                cancelButtonText: "<?php echo lang("No, cancel plz!"); ?>",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: '<?php echo base_url() . "home/follow_user"; ?>',
                                type: 'POST',
                                data: {user_id: user_id},
                                success: function (data) {
                                    $('.followbtn').text("<?php echo lang('Followed') ?>");
                                    swal("<?php echo lang("Followed"); ?>!", "<?php echo lang("User have been followed."); ?>", "<?php echo lang("success"); ?>");
                                }
                            });
                        } else {
                            swal("<?php echo lang("Cancelled"); ?>", "<?php echo lang("You are not follow this user :)"); ?>", "<?php echo lang("error"); ?>");
                        }
                    });
        });

        $('.unfollowbtn').click(function () {
            var user_id = $(this).data('userid');
            swal({
                title: "<?php echo lang("Are you sure?"); ?>",
                text: "<?php echo lang("You would like to unfollow this user!"); ?>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo lang("Yes, Unfollow!"); ?>",
                cancelButtonText: "<?php echo lang("No, cancel plz!"); ?>",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: '<?php echo base_url() . "home/unfollow_user"; ?>',
                                type: 'POST',
                                data: {user_id: user_id},
                                success: function (data) {
                                    $('.unfollowbtn').text("<?php echo lang("Follow"); ?>");
                                    swal("<?php echo lang("Unfollowed"); ?>!", "<?php echo lang("User have been Unfollowed."); ?>", "<?php echo lang("success"); ?>");
                                }
                            });
                        } else {
                            swal("<?php echo lang("Cancelled"); ?>", "<?php echo lang("You are not unfollow this user :)"); ?>", "<?php echo lang("error"); ?>");
                        }
                    });
        });
    });
    $(document).ready(function () {
        // Configure/customize these variables.
        var showChar = 100;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = "Show more >";
        var lesstext = "Show less";

        $('.more').each(function () {
            var content = $(this).html();

            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function () {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
        
        $('#edit-profile').on('hidden.bs.modal', function () {
            
            modal = $('#edit-profile');
            modal.find('#name').val("<?php echo $user_data['name']; ?>");
            modal.find('#email').val("<?php echo $user_data['email']; ?>");
            modal.find('#email').val("<?php echo $user_data['email']; ?>");
            modal.find('#country').val("<?php echo $user_data['country']; ?>");
            modal.find('[name="gender"][value="<?php echo $user_data['gender'] ?>"]').prop('checked',true);
            modal.find('#bio').val("<?php echo $user_data['bio'] ?>");
            modal.find('#hobby').val("<?php echo $user_data['hobby'] ?>");
        });
    });
</script>