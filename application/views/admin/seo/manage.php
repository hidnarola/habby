<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-server"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/seo'); ?>"><i class="icon-server position-left"></i> SEO</a></li>
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
                            <label class="col-lg-3 control-label">Name:</label>
                            <div class="col-lg-8">
                                <input type="text" name="page" placeholder="Enter Page name" readonly="" class="form-control" value="<?php echo (isset($seo_datas['page'])) ? $seo_datas['page'] : set_value('page'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Meta title:</label>
                            <div class="col-lg-8">
                                <input type="text" name="meta_title" placeholder="Enter meta title" class="form-control" value="<?php echo (isset($seo_datas['meta_title'])) ? $seo_datas['meta_title'] : set_value('meta_title'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Meta keyword:</label>
                            <div class="col-lg-8">
                                <textarea name="meta_keyword" placeholder="Enter meta keyword" class="form-control"><?php echo (isset($seo_datas['meta_keyword'])) ? $seo_datas['meta_keyword'] : set_value('meta_keyword'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Meta description:</label>
                            <div class="col-lg-8">
                                <textarea name="meta_description" placeholder="Enter meta description" class="form-control"><?php echo (isset($seo_datas['meta_description'])) ? $seo_datas['meta_description'] : set_value('meta_description'); ?></textarea>
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
<script>
    $("#country_code").val('<?php echo $categories_datas['country']; ?>');
</script>