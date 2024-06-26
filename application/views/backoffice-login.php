<div id="backgroundCarousel" class="carousel slide" data-ride="carousel">
    <!-- Slides -->
    <div class="carousel-inner" role="listbox" >
        <div class="item active" style="background-image: url('<?php echo site_url('assets/images/image_4.jpg') ?>');"></div>
        <div class="item" style="background-image: url('<?php echo site_url('assets/images/image_2.jpg') ?>');"></div>
        <div class="item" style="background-image: url('<?php echo site_url('assets/images/image_3.jpg') ?>');"></div>
    </div>
</div>

<div class="content login-form col-lg-4 col-md-4 col-sm-10 col-xs-10">
    <center>
    <h2>Login</h2>
    </center>
    <form action="<?php echo site_url();?>index.php/backoffice/LogAdmin_Controller/authenticate" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input name="user_name" type="text" class="form-control" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="user_psswd" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <center>
            <button type="submit" class="btn btn-custom btn-lg">Login</button>
        </center>
    </form>
</div>

<footer>
    <p>&copy; 2024 <span class="logo">Dryfruit</span> Media</p>
</footer>