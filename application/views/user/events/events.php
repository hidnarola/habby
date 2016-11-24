<?php
$search_data = $this->session->flashdata('event_filter');
?>
<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "bootstrap-datetimepicker.min.css" ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_ADMIN_CSS_PATH . "sweetalert.css"; ?>">

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
        <a href="javascript:;" class="create_event_btn"><?php echo lang('New'); ?> <br><?php echo lang('Event'); ?></a>
        <!-- New Group button end-->
    </div>
</div>
<!-- Topicaht Post and bannner section end here -->

<!-- filter titile start here -->
<div class="row filter_row">
    <div class="container">
        <div class="txt_white">
            <span class="cursor_hand open_modal"><?php echo lang('Filters'); ?></span>
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

    <!-- Soulmate #1 section and Newest Post area start here  -->
    <div class="row event_row flter_sec_row grp_pnl_row">
        <div class="container ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row event_container">
                    <?php
                    if (isset($event_posts) && !empty($event_posts)) {
                        $cnt = count($event_posts);
                        $this->load->view('user/partial/events/display_events');
                    } else {
                        ?>
                        <div class="alert alert-info text-center">
                            <?php echo lang('No Events found.'); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Group section container end here -->
    <?php
    if ($cnt >= 2) {
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
</div>

<!-- new Event popup start here -->
<div class="modal" id="new_event">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <b><?php echo lang('Create New Event'); ?></b>
                </div>
                <form class="" role="form" method="post" action="<?php echo base_url() . "events/add_event"; ?>" enctype="multipart/form-data">
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="usr_post_img event_user_container col-md-3">
                                <img class="img-circle img-responsive event_user" src="<?php echo DEFAULT_PROFILE_IMAGE_PATH . $this->session->user['user_image'] ?>">
                                <span><label class="control-label"><?php echo $this->session->user['name']; ?></label></span>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="<?php echo lang('Event title'); ?>:" name="title" id="title" required="true">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <textarea class="form-control" name="details" id="details" placeholder="<?php echo lang("Events details and who you are looking for"); ?>"></textarea>
                        </div>
                    </div>
                    <!-- Upload images or video section start here -->
                    <div class="panel-body">
                        <div class="message alert alert-danger" style="display:none"></div>
                        <div class="upld_sec">
                            <div class="fileUpload up_img btn">
                                <span><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lang('Images'); ?></span>
                                <input type="file" name="uploadfile[]" class="upload" id="uploadFile"/>
                            </div>
                        </div>
                        <div class="image_wrapper" style="display:none">
                        </div>
                    </div>
                    <!-- Upload images or video section end here -->
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Event start time"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <div class='input-group date' id='start_time'>
                                <input type='text' class="form-control" name="start_time" id="start_time_txt" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Event end time"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <div class='input-group date' id='end_time'>
                                <input type='text' class="form-control" name="end_time" id="end_time_txt" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Number of people to join"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" min="1" name="limit" required="true" id="limit">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-3">
                            <label class="control-label"><?php echo lang("Approval needed"); ?></label>
                        </div>
                        <div class="col-md-9">
                            <input type="radio" class="" style="margin-right: 5px;" name="approval" id="approval" checked="checked" value="Yes"><?php echo lang("Yes"); ?>
                            <input type="radio" class="" name="approval" value="No" style="margin:0px 5px;"><?php echo lang("No"); ?>
                        </div>
                    </div>
                    <div class="form-group clearfix xs_mddle">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" class="pstbtn" value="<?php echo lang('Create') ?>"/>
                        </div>
                    </div>
                    <input type="hidden" name="lat" class="lat" value="">
                    <input type="hidden" name="long" class="long" value="">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Filter popup -->
<div id="filterModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form method="post" action="<?php echo base_url() . "events/filter_event"; ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo lang('Enter your searching criteria') ?></h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo lang("Filter By"); ?> : </div>
                        <div class="panel-body">
                            <div class="filter_div_row">
                                <label class="control-label col-sm-4" ><?php echo lang(""); ?>:</label>
                                <div class="col-sm-8">
                                    <div>
                                        <input type="radio" class="" name="release_date" value="desc" <?php echo ($this->session->has_userdata('event_filter') && $this->session->userdata('event_filter')['release_date'] == "asc") ? '' : 'checked' ?>> <?php echo lang("From Newest to Oldest"); ?>
                                    </div>
                                    <div>
                                        <input type="radio" class="" name="release_date" <?php echo ($this->session->has_userdata('event_filter') && $this->session->userdata('event_filter')['release_date'] == "asc") ? 'checked' : '' ?> value="asc"> <?php echo lang("From Oldest to Newest"); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="filter_div_row">
                                <label class="control-label col-sm-4" ><?php echo lang("Number of seat"); ?>:</label>
                                <div class="col-sm-8">
                                    <?php echo lang(""); ?>From <input type="number" class="form-control" value="<?php echo ($this->session->has_userdata('event_filter')) ? $this->session->userdata('event_filter')['from_seat'] : '' ?>" min="0" style="width:30%;display:inline-block;" name="from_seat"> 
                                    <?php echo lang(""); ?>to <input type="number" value="<?php echo ($this->session->has_userdata('event_filter')) ? $this->session->userdata('event_filter')['to_seat'] : '' ?>" min="1" class="form-control" style="width:30%;display:inline-block;" name="to_seat">
                                </div>
                            </div>
                            <div class="filter_div_row">
                                <label class="control-label col-sm-4" ><?php echo lang("Range Distance"); ?>:</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name="distance_range" required="true" style="width:30%;display:inline-block;">
                                        <?php
                                        for ($i = 1; $i <= 10; ++$i) {
                                            ?>

                                            <option value='<?php echo $i; ?>' <?php echo ($this->session->has_userdata('event_filter') && $this->session->userdata('event_filter')['distance_range'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?> <?php echo lang("Mile"); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo lang("From current location"); ?>
                                </div>
                            </div>
                            <div class="filter_div_row">
                                <label class="control-label col-sm-4" ><?php echo lang("Approval needed"); ?>:</label>
                                <div class="col-sm-8">
                                    <div>
                                        <input type="radio" class="" name="approval_needed" value="yes" <?php echo ($this->session->has_userdata('event_filter') && $this->session->userdata('event_filter')['approval_needed'] == "no") ? '' : 'checked' ?>> <?php echo lang("Yes"); ?>
                                    </div>
                                    <div>
                                        <input type="radio" class="" name="approval_needed" value="no" <?php echo ($this->session->has_userdata('event_filter') && $this->session->userdata('event_filter')['approval_needed'] == "no") ? 'checked' : '' ?>> <?php echo lang("No"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang("Close"); ?></button>
                    <button type="submit" class="btn btn-default"><?php echo lang("Search"); ?></button>
                </div>
                <input type="hidden" name="lat" class="lat" value="">
                <input type="hidden" name="long" class="long" value="">
            </form>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/moment.min.js"></script>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo USER_JS; ?>event/event.js"></script>
<script src="<?php echo DEFAULT_ADMIN_JS_PATH . "sweetalert.min.js"; ?>"></script>

<!-- Get current latitude and longitude -->
<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
//            console.log("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        console.log("Latitude: " + position.coords.latitude + "Longitude: " + position.coords.longitude);
        $('.lat').val(position.coords.latitude);
        $('.long').val(position.coords.longitude);
        $('#filterModal').modal('show');
    }

    function event_getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(event_showPosition);
        } else {
//            console.log("Geolocation is not supported by this browser.");
        }
    }
    function event_showPosition(position) {
//        console.log("Latitude: " + position.coords.latitude +"Longitude: " + position.coords.longitude);
        $('#new_event').find('.lat').val(position.coords.latitude);
        $('#new_event').find('.long').val(position.coords.longitude);
        $('#new_event').modal('show');
    }

    $(function () {
        $('.create_event_btn').click(function () {
            event_getLocation();
        });

        $('#new_event').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
            $(this).find('form').trigger('reset');
            $('#title').val('').empty();
            $('#details').html('');
            $('.image_wrapper').html('');
            $('#start_time_txt').val('').empty();
            $('#end_time_txt').val('').empty();
            $('#limit').val('').empty();
            $('#approval').prop('checked', true);
        });
    });
</script>