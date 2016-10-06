<!-- Topicaht Post and bannner section end here -->

<div class="row topic_banner">
    <img src="<?php echo DEFAULT_BANNER_IMAGE_PATH . $banner_image; ?>" class="img-responsive center-block">
    <div class="new_grp">
        <!-- New Group button start-->
        <a href="#" data-toggle="modal" data-target="#new_grp">New <br>Group</a>
        <!-- New Group button end-->
    </div>

</div>
<!-- Topicaht Post and bannner section end here -->

<!-- filter titile start here -->
<div class="row filter_row">
    <div class="container grp_pnl_container">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="lang_sec">
                <select class="selectpicker filterby" data-style="btn-info">
                    <option value="newest-post">Newest</option>
                    <option value="popular-post">Popular</option>
                    <option value="recommended">Recommended</option>
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="topichat_search_sec">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" class="  search-query form-control" placeholder="Find your group" />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
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
    ?>
    <!-- Topichat #1 section and Newest Post area start here  -->
    <div class="row grp_pnl_row newest-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Topichat #1 row section start here -->
                <div class="row">

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img1.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img2.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img3.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                </div>
                <!-- Topichat #1 row section end here -->

                <!-- Topichat #1 row section start here -->
                <div class="row">

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img4.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img5.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img6.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                </div>
                <!-- Topichat #1 row section end here -->

                <!-- Topichat #1 row section start here -->
                <div class="row">

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img7.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img8.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img9.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                </div>
                <!-- Topichat #1 row section end here -->

            </div>
        </div>
    </div>
    <!-- Topichat #1 section and Newest Post area end here  -->

    <!-- Topichat #1 section and Popular Post area start here  -->
    <div class="row grp_pnl_row popular-post flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Topichat #1 row section start here -->
                <div class="row">

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img4.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img5.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img6.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                </div>
                <!-- Topichat #1 row section end here -->

                <!-- Topichat #1 row section start here -->
                <div class="row">

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img7.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img8.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img9.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                </div>
                <!-- Topichat #1 row section end here -->

            </div>
        </div>
    </div>
    <!-- Topichat #1 section and Popular Post area end here  -->

    <!-- Topichat #1 section and Recommended Post area start here  -->
    <div class="row grp_pnl_row recommended flter_sec_row">
        <div class="container grp_pnl_container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <!-- Topichat #1 row section start here -->
                <div class="row">

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img7.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img8.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                    <!-- Topichat #1 each section start here -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grp_cl6">
                        <div class="grp_pln_sec ">

                            <div class="grp_pln_img_sec">
                                <a href="#" data-toggle="modal" data-target="#topichat1post">
                                    <img src="images/topichat_img9.jpg" class="img-responsive center-block">
                                </a>
                            </div>

                            <div class="grp_pln_cont_sec">
                                <p class="topichat_txt1">#Topic </p>
                                <p class="topichat_txt2">Lorem Ipsum is simply dummy text </p>
                                <ul class="list-inline soulmate_ul">
                                    <li><span>120/200</span> <span>users</span></li>
                                    <li><a href="topichat-2.html" class="pstbtn">Join</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Topichat #1 each section start here -->

                </div>
                <!-- Topichat #1 row section end here -->

            </div>
        </div>
    </div>
    <!-- Topichat #1 section and Recommended Post area end here  -->

</div>
<!-- Topichat Popular section start here -->
