<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('admin/layouts/layout_header'); ?>
    <body class="login-container login-cover">

        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content pb-20">    

                        <!-- Form with validation -->
                        <form class="form-validate" role="form" method="post">
                            <div class="panel panel-body login-form">
                                <?php
                                $message = $this->session->flashdata('message');
                                if (!empty($message) && isset($message)) {
                                    ($message['class'] != '') ? $message['class'] : '';
                                    echo '<div class="' . $message['class'] . ' flashmsg">' . $message['message'] . '</div>';
                                }
                                ?>
                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                                    <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="text" class="form-control" placeholder="Username" name="username" required="required">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group login-options">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="remember_me" value="1" <?php echo set_checkbox('remember_me', '1', TRUE); ?> class="styled" >
                                                Remember me
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- /form with validation -->

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

        <!-- My script code -->
        <script>
        $('document').ready(function () {
            $('.flashmsg').fadeOut(6000);
        });
        </script>
    </body>
</html>