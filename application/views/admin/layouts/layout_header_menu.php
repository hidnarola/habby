<div class="logo">
    <a href="<?php echo base_url() . 'home'; ?>">
        <img src="<?php echo DEFAULT_IMAGE_PATH . "logo.png" ?>" alt="" />
    </a>
</div>
<div class="header-right">
    <h4></h4>
    <ul>
        <?php
        if (!empty($user_data)) {
            ?>

            <li>
                <div class="currency dropdown">
                    <div class="currency-label" id="currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php
                        echo $user_data['fname'] . " " . $user_data['lname'];
                        ?> <span class="caret"></span> 
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="">
                        <li><a href="<?php echo base_url() . 'user/dashboard'; ?>">Dashboard</a></li>
                        <li><a href="<?php echo base_url() . 'user/offer_listing/upcoming'; ?>">Rides Offered</a></li>
                        <li><a href="#">Booking</a></li>
                        <li><a href="#">Message</a></li>
                        <li><a href="#">E-mail Alerts</a></li>
                        <li><a href="#">Ratings</a></li>
                        <li><a href="<?php echo base_url() . 'user/profile/edit'; ?>">Profile</a></li>
                        <li><a href="<?php echo base_url() . 'user/log_out'; ?>">Log Out</a></li>
                    </ul>
                </div>
            </li>

            <?php
        } else {
            ?>

            <li>
                <div class="user-login">
                    <a href="<?php echo base_url() . 'login'; ?>">Login</a>
                </div>	
            </li>	
            <li>
                <div class="user-register">
                    <a href="<?php echo base_url() . 'user/registration'; ?>">Register</a>
                </div>	
            </li>

            <?php
        }
        ?>
        <li>
            <div class="language dropdown">
                <div class="language-lable" id="language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
                    <i class="eng-flag"></i> ENGLISH <span class="caret"></span> 
                </div>
                <ul class="dropdown-menu" aria-labelledby="language">
                    <li><a href="#"><i class="eng-flag"></i> ENGLISH</a></li>
                    <li><a href="#"><i class="de-flag"></i> GERMAN</a></li>
                </ul>
            </div>
        </li>
        <li>
            <div class="offerride-button">
                <a href="<?php echo base_url(); ?>">Find A Ride</a>
            </div>
        </li>
        <li>
            <div class="offerride-button">
                <a href="<?php echo base_url() . 'offer/new_ride'; ?>">Offers A Ride</a>
            </div>
        </li>
    </ul>	
</div>