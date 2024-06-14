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
            <form>
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter your username or your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
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
            <form>
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="mail" class="form-control" id="username" placeholder="Enter your email">
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control" id="password" placeholder="Confirm your password">
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
        <center>
            <a href="" class="btn btn-custom btn-lg google">
            <img src="<?php echo base_url('assets/icons/google.png') ?>">
                Continue with Google
            </a>
        </center>
</div>

<footer>
    <p>&copy; 2024 <span class="logo">Dryfruit</span> Media</p>
</footer>