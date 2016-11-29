<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/event'); ?>"><i class="icon-magazine position-left"></i> Event</a></li>
            <li class="active"><?php echo $heading; ?></li>
        </ul>
    </div>
</div>
<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0 flashmsg">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    if (!empty(validation_errors())) {
        ?>
        <div class="content pt0 flashmsg">
            <div class = "alert alert-danger">
                <a class="close" data-dismiss="alert">X</a>
                <strong><?php echo validation_errors(); ?></strong>       
            </div>
        </div>
        <?php
    }
}
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-validate" action="" id="event_info" method="POST" enctype="multipart/form-data">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="message alert alert-danger" style="display:none"></div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Event Title <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <input type="text" id="title" name="title" placeholder="Enter event title" class="form-control" value="<?php echo (isset($events['title'])) ? $events['title'] : set_value('title'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Event details <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="details" name="details" placeholder="Enter event details" class="form-control" required><?php echo (isset($events['details'])) ? $events['details'] : set_value('details'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">Event Image</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="group_cover" id="uploadFile" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Images</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Event Start time<span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <div class='input-group date' id='start_time'>
                                    <?php
                                    //$start = new DateTime($events['start_time']);
                                    ?>
                                    <input type='text' class="form-control" name="start_time" id="start_time_txt" data-abc="<?php echo (isset($events['start_time'])) ? $events['start_time'] : set_value('start_time'); ?>" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Event End time<span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <div class='input-group date' id='end_time'>
                                    <?php
                                    //      $end = new DateTime($events['end_time']);
                                    ?>
                                    <input type='text' class="form-control" name="end_time" id="end_time_txt" data-abc="<?php echo (isset($events['end_time'])) ? $events['end_time'] : set_value('end_time'); ?>" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Person limit <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <input type="number" name="limit" placeholder="Enter person limit" class="form-control" value="<?php echo (isset($events['limit'])) ? $events['limit'] : set_value('limit'); ?>" required="" min="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Approval needed <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <input type="radio" class="" name="approval_needed" value="1" <?php echo (isset($events['approval_needed']) && $events['approval_needed']) ? "checked" : "" ?>>&nbsp;&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="" name="approval_needed" value="0" <?php echo (isset($events['approval_needed']) && $events['approval_needed']) ? "" : "checked" ?>>&nbsp;&nbsp;No
                            </div>
                        </div>
                        <?php
                        if (isset($events['media']) && !empty($events['media'])) {
                            ?>
                            <div class="col-lg-12 col-sm-12">
                                <div class="thumbnail">
                                    <div class="thumb">
                                        <div class="thumb-inner">
                                            <img src="<?php echo DEFAULT_EVENT_MEDIA_PATH . $events['media']; ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="image_wrapper" style="display:none">
                        </div>
                        <input type="hidden" name="lat" class="lat" value="">
                        <input type="hidden" name="long" class="long" value="">
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo DEFAULT_CSS_PATH . "bootstrap-datetimepicker.min.css" ?>"/>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/moment.min.js"></script>
<script type="text/javascript" src="<?php echo DEFAULT_JS_PATH ?>/bootstrap-datetimepicker.min.js"></script>
<style>
    .image_wrapper{
        height:auto;
        width:auto;
    }
    #imagePreview {
        width: 400px;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        float: left;
        margin: 9px;
    }

    #imagePreview_msg {
        width: 100%;
        height: 180px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    }

</style>
<script>
    var base_url = '<?php echo base_url(); ?>';

    // Image uploading script
    $("#uploadFile").on("change", function ()
    {
        $('.message').html();
        $('.image_wrapper').html('');
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
            $('.message').html("No file selected.");
            $('.message').show();
            return; // no file selected, or no FileReader support
        }

        var i = 0;
        for (var key in files) {
            if (/^image/.test(files[key].type)) { // only image file
                console.log(files[key].name);
                $('.filename').html(files[key].name);
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[key]); // read the local file
                reader.onloadend = function () { // set image data as background of div
                    // $('#imagePreview').addClass('imagePreview');
                    
                    $('.image_wrapper').show();
                    $('.message').hide();
                    $('.image_wrapper').append("<div class='imagePreview" + i + "' id='imagePreview'></div>");
                    $('.imagePreview' + i).css("background-image", "url(" + this.result + ")");
                    ++i;
                }
            } else {
//                this.files = '';
                $('.message').html("Please select proper image");
                $('.message').show();
            }
        }
    });

    function event_getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(event_showPosition);
        } else {
//            console.log("Geolocation is not supported by this browser.");
        }
    }
    function event_showPosition(position) {
//        console.log("Latitude: " + position.coords.latitude +"Longitude: " + position.coords.longitude);
        $('#event_info').find('.lat').val(position.coords.latitude);
        $('#event_info').find('.long').val(position.coords.longitude);
    }



</script>
<?php
if (isset($events['title'])) {
    ?>
    <script>
        console.log('edit');
        $('document').ready(function () {
            event_getLocation();

            start = $('#start_time_txt').data('abc');
            end = $('#end_time_txt').data('abc');
            console.log(start + "  ,  " + end);
            //set date and time picker for start time and end time
            $('#start_time').datetimepicker({
                locale: 'en',
                useCurrent: false,
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: start
            });
            $('#end_time').datetimepicker({
                locale: 'en',
                useCurrent: false,
                format: 'YYYY-MM-DD HH:mm:ss',
                defaultDate: end
            });
            $("#start_time").on("dp.hide", function(e) {
                $('#end_time').data("DateTimePicker").minDate(e.date);
            });
            $("#end_time").on("dp.hide", function (e) {
                $('#start_time').data("DateTimePicker").maxDate(e.date);
            });
        });

    </script>
    <?php
} else {
    ?>
    <script>
        $('document').ready(function () {
            //set date and time picker for start time and end time
            $('#start_time').datetimepicker({
                locale: 'en',
            });
            $('#end_time').datetimepicker({
                locale: 'en',
//                onClose: function (current_time, $input) {
//                    var endDate = $("#end_time").val();
//                    if (startDate > endDate) {
//                        alert('Please select date gretar than start time');
//                    }
//                }
            });
            $("#start_time").on("dp.hide", function(e) {
                $('#end_time').data("DateTimePicker").minDate(e.date);
            });
            $("#end_time").on("dp.hide", function (e) {
                $('#start_time').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
    <?php
}
?>