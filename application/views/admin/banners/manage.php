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
            <form class="form-horizontal form-validate" action="" id="user_info" method="POST" enctype="multipart/form-data" >
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Page Name <span class="text-danger">*</span></label>
                            <div class="col-lg-3">
                                <select class="form-control" name="page" id="page">
                                    <option value="home" <?php echo ((isset($banner_datas['page'])) && $banner_datas['page'] == "home") ? "selected='selected'" : ""; ?>>Home</option>
                                    <option value="topichat" <?php echo ((isset($banner_datas['page'])) && $banner_datas['page'] == "topichat") ? "selected='selected'" : ""; ?>>Topichat</option>
                                    <option value="soulmate" <?php echo ((isset($banner_datas['page'])) && $banner_datas['page'] == "soulmate") ? "selected='selected'" : ""; ?>>Soulmate</option>
                                    <option value="grupplan" <?php echo ((isset($banner_datas['page'])) && $banner_datas['page'] == "grupplan") ? "selected='selected'" : ""; ?>>Group Plan</option>
                                    <option value="challenge" <?php echo ((isset($banner_datas['page'])) && $banner_datas['page'] == "challenge") ? "selected='selected'" : ""; ?>>Challenge</option>
                                    <option value="leauge" <?php echo ((isset($banner_datas['page'])) && $banner_datas['page'] == "leauge") ? "selected='selected'" : ""; ?>>Leauge And Alliance</option>
                                </select>
<!--                                <input type="text" name="page" id="page" placeholder="Enter page name" class="form-control" value="<?php echo (isset($banner_datas['page'])) ? $banner_datas['page'] : set_value('page'); ?>">-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Image Name <span class="text-danger">*</span></label>
                            <div class="col-lg-3">
                                <input type="text" name="image_name" id="image_name" placeholder="Enter image name" class="form-control" value="<?php echo (isset($banner_datas['image_name'])) ? $banner_datas['image_name'] : set_value('image_name'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Banner Image <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="file" name="image" id="image" class="file-styled" value="<?php echo (isset($banner_datas['image'])) ? $banner_datas['image'] : set_value('image'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-3">
                                <img src="<?php echo (isset($banner_datas['image'])) ? DEFAULT_BANNER_IMAGE_PATH . $banner_datas['image'] : ""; ?>" style="max-width: 100%"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3">Do you want to active banner? </label>
                            <div class="col-lg-9">
                                <div class="checkbox checkbox-switch">
                                    <label>
                                        <input type="checkbox" name="is_active" data-on-text="Yes" data-off-text="No" class="switch">
                                        Activate/Deactivate Banner
                                    </label>
                                </div>
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
<script type="text/javascript">
    $(function () {
        $("[name='is_active']").bootstrapSwitch();
    });
</script>