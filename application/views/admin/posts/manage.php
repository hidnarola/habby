<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-user"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/users'); ?>"><i class="icon-users4 position-left"></i> Users</a></li>
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
            <form class="form-horizontal form-validate" action="" id="user_info" method="POST">
                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Post Description <span class="text-danger">*</span> </label>
                            <div class="col-lg-7">
                                <textarea id="description" name="description" placeholder="Enter Description" class="form-control"><?php echo (isset($post_datas['description'])) ? $post_datas['description'] : set_value('description'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">Post Images</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="uploadfile[]" id="uploadFile" multiple="multiple" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Images</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-material">
                            <label class="display-block control-label has-margin animate is-visible col-lg-3">Post Videos</label>
                            <div class="col-lg-7">
                                <div class="uploader">
                                    <input type="file" name="videofile[]" id="uploadVideo" multiple="multiple" class="file-styled">
                                    <span class="filename" style="-webkit-user-select: none;"></span>
                                    <span class="action btn bg-info-400" style="-webkit-user-select: none;">Choose Videos</span>
                                </div>
                            </div>
                        </div>
                        <?php
//                        pr($post_datas['media']);
                        if (isset($post_datas['media']) && !empty($post_datas['media'])) {
                            foreach ($post_datas['media'] as $post_media) {
                                pr($post_media);
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-3">
                                <img src="<?php echo (isset($banner_datas['image'])) ? DEFAULT_BANNER_IMAGE_PATH . $banner_datas['image'] : ""; ?>" style="max-width: 100%"/>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>