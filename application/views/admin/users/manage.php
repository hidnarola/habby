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
                            <label class="col-lg-3 control-label">Name:</label>
                            <div class="col-lg-3">
                                <input type="text" name="name" id="fname" placeholder="Enter name" class="form-control" value="<?php echo (isset($user_datas['name'])) ? $user_datas['name'] : set_value('name'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-3">
                                <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" value="<?php echo (isset($user_datas['email'])) ? $user_datas['email'] : set_value('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Hobby:</label>
                            <div class="col-lg-3">
                                <textarea name="hobby" id="display_name" placeholder="Enter hobby" class="form-control"><?php echo (isset($user_datas['hobby'])) ? $user_datas['hobby'] : set_value('hobby'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Bio:</label>
                            <div class="col-lg-3">
                                <textarea name="bio" id="lname" placeholder="Enter Bio" class="form-control"><?php echo (isset($user_datas['bio'])) ? $user_datas['bio'] : set_value('bio'); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Country:</label>
                            <div class="col-lg-3">
                                <select name="country" id="country_code" class="form-control">
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
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Gender:</label>
                            <div class="col-lg-9">
                                <label class="radio-inline">
                                    <input type="radio" class="styled" name="gender" value="Male" <?php
                                    if ($user_datas['gender'] == 'Male') {
                                        echo 'checked';
                                    }
                                    ?>>
                                    Male
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" class="styled" name="gender" value="Female" <?php
                                    if ($user_datas['gender'] == 'Female') {
                                        echo 'checked';
                                    }
                                    ?>>
                                    Female
                                </label>
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
    $("#country_code").val('<?php echo $user_datas['country']; ?>');
</script>