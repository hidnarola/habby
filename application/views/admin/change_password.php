<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-user"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $heading; ?></li>
        </ul>
    </div>
</div>
<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">X</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    echo validation_errors();
}
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-validate" action="" id="user_info" method="POST">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Current Password:</label>
                            <div class="col-lg-3">
                                <input type="password" name="curr_pass" id="curr_pass" placeholder="Current Password" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">New Password:</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" id="pass" placeholder="New Password" name="pass" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Repeat Password:</label>
                            <div class="col-lg-3">
                                <input type="password" class="form-control" id="re_pass" placeholder="Repeat Password" name="re_pass" >
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Reset Password <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

