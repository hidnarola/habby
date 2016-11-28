<?php $this->load->view('layouts/profile_common'); ?>
<div class="row personal_act_sec personal_act_sec3">
    <div class="container prsna_coner personal_cntner">

        <?php
        if ($user_data['id'] == $this->session->user['id']) {
            ?>
            <!-- Event request section -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="prfl_cvr_sec">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row grp_3sec">
                                <h2 class="subgroup"><?php echo lang("Event join request"); ?></h2>
                            </div>
                            <hr/>
                            <div class="row grp_3sec request_container">
                                <?php
                                if (count($event_request) > 0) {
                                    foreach ($event_request as $request) {
                                        ?>
                                        <div class="request_row" data-id='<?php echo $request['id'] ?>'>
                                            <div class='usr_post_img'>
                                                <a href="javascript:;" class="img-circle"/></a>
                                            </div>
                                            <div class='post_title'>
                                                <label class='control-label'><?php echo $request['name']; ?></label>
                                                &nbsp;<?php echo lang("wants to join"); ?>&nbsp;
                                                <label class='control-label'><?php echo $request['title'] ?></label>
                                            </div>
                                            <div class='actions'>
                                                <button class='pstbtn deny'><?php echo lang('Deny'); ?></button>
                                                <button class='pstbtn accept'><?php echo lang('Accept'); ?></button>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class='alert alert-info text-center' style='margin:15px'>
                                        <?php echo lang('No new request available'); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Event request section over -->
            <?php
        }
        ?>
        <!-- Personal Account content  start here -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prsnl_sm_innrsec">
            <div class="row">
                <br/>
                <!-- Personal Account Posts start here -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post_section">
                    <h2><?php echo lang('Created Events'); ?></h2>
                    <section class="post_masonry_section" id="users_events">
                        <?php
                        if (count($user_events) > 0) {
                            $pass['event_post'] = $user_events;
                            $this->load->view('user/partial/events/load_user_events', $pass);
                        } else {
                            ?>
                            <div class="alert alert-info text-center">
                                <?php echo lang('No Event available'); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </section>
                    <?php
                    if (count($user_events) == 3) {
                        ?>
                        <div class = "row">
                            <div class = "">
                                <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                                    <a id = "loadMore_post" class="loadmore" href = "javascript:;"><?php echo lang("Load More"); ?></a>
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
                <!-- Personal Account Posts end here -->

                <!-- Personal Account Saved start here -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post_section">
                    <h2><?php echo lang('Joined Events'); ?></h2>
                    <section class="post_masonry_section" id="users_events">
                        <?php
                        if (count($joined_events) > 0) {
                            $pass['event_post'] = $joined_events;
                            $this->load->view('user/partial/events/load_user_events', $pass);
                        } else {
                            ?>
                            <div class="alert alert-info text-center">
                                <?php echo lang('No Joined Event available'); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </section>
                    <?php
                    if (count($joined_events) == 3) {
                        ?>
                        <div class = "row">
                            <div class = "">
                                <div class = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
                                    <a id = "loadMore_saved" class="loadmore" href = "javascript:;"><?php echo lang("Load More"); ?></a>
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
                <!-- Personal Account Saved end here -->
            </div>
        </div>
        <!-- Personal Account content  ennd here -->
    </div>
</div>
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('Display Name'); ?>" value="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $email = (set_value('email') == false) ? $user_data['email'] : set_value('email'); ?>
                            <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo lang('E-mail'); ?>" value="<?php echo $email; ?>">
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
                            <textarea class="form-control" id="bio" name="bio" placeholder="<?php echo lang('Enter your Bio'); ?>" rows="20" cols="20" ><?php echo $bio; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $hobby = (set_value('hobby') == false) ? $user_data['hobby'] : set_value('hobby'); ?>
                            <textarea class="form-control" id="hobby" name="hobby" placeholder="<?php echo lang('Enter your hobby seprate by comma'); ?>" rows="20" cols="20"><?php echo $hobby; ?></textarea>
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
<script type="text/javascript">
    user_id = '<?php echo $user_data['id']; ?>'; // change this id with the user_id for which post is going to display
</script>
<script type="text/javascript" src="<?php echo USER_JS; ?>event/profile_events.js"></script>