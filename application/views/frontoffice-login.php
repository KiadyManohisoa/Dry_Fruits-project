<div id="backgroundCarousel" class="carousel slide" data-ride="carousel">
    <!-- Slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active" style="background-image: url('<?php echo base_url('assets/images/image_4.jpg') ?>');"></div>
        <div class="item" style="background-image: url('<?php echo base_url('assets/images/image_2.jpg') ?>');"></div>
        <div class="item" style="background-image: url('<?php echo base_url('assets/images/image_3.jpg') ?>');"></div>
    </div>
</div>

<div class="content login-form col-lg-5 col-md-5">
    <div class="defiler-option">
        <button class="col-lg-6 col-md-6 col-sm-6 col-xs-6 btn btn-default btn-active" id="login-button">Login</button>
        <button class="col-lg-6 col-md-6 col-sm-6 col-xs-6 btn btn-default" id="signup-button">Sign Up</button>
    </div>
    <div class="scroll-div-defiler">
        <div class="scroll-item" id="login">
            <form action="<?php echo site_url();?>index.php/frontoffice/LogClient_Controller/authenticate" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="alice@example.com" name="user" type="text" class="form-control" id="username1" placeholder="Enter your email or phone number">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input value="password1" name="user_password" type="password" class="form-control" id="password0" placeholder="Password">
                </div>
                <center>
                    <button type="submit" class="btn btn-custom btn-lg">Login</button>
                    <hr>
                <div class="form-group">
                </div>
                </center>
            </form>
        </div>
        <div class="scroll-item" id="signup">
            <form action="<?php echo site_url();?>index.php/frontoffice/LogClient_Controller/sign_up" method="post">
                <div class="form-group">
                    <label for="username">Full name</label>
                    <input value="Rakoto Soa" name="full_name" type="mail" class="form-control" id="username2" placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label for="username">Email</label>
                    <input value="rakotosoa@gmail.com" name="mail" type="mail" class="form-control" id="username" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone number</label>
                    <input value="+261 34 865 68" name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Enter your phone number">
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label for="password">Password</label>
                    <input value="rakoto" name="password" type="password" class="form-control" id="password1" placeholder="Enter your password">
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label for="password">Confirm password</label>
                    <input value="rakoto" name="confirm_password" type="password" class="form-control" id="password2" placeholder="Confirm your password">
                </div>
                <center>
                    <button type="submit" class="btn btn-custom btn-lg">Sign Up</button>
                    <hr>
                    <div class="form-group">
                        </div>
                    </center>
                </form>
            </div>
        </div>
        <!-- <center>
            <a href="" class="btn btn-custom btn-lg google">
            <img src="<?php echo base_url('assets/icons/google.png') ?>">
                Continue with Google
            </a>
        </center> -->
</div>

<footer>
    <p>&copy; 2024 <span class="logo">Dryfruit</span> Media</p>
</footer>