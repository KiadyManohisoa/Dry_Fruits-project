<?php $user = false; if($user) {?>
    <!-- Modal de connexion -->
    <div id="profileEditer" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Edit Profile</h3>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="profile-pic">Profile picture</label>
                            <input type="file" class="form-control" id="profile-pic" placeholder="Username">
                        </div>
                        <hr>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="mail">Email</label>
                            <input type="text" class="form-control" id="mail" placeholder="Enter your new Email">
                        </div>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter your new phone number">
                        </div>

                        <div class="form-group">
                            <label for="full-name">Full name</label>
                            <input type="text" class="form-control" id="full-name" placeholder="Enter your full Name">
                        </div>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your new Password">
                        </div>
                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="cpassword">Confirm password</label>
                            <input type="password" class="form-control" id="cpassword" placeholder="Confirm your Password">
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-custom">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- a propos de l'utilisateur -->
<div class="content">
    <center class="col-lg-3 col-md-3 col-sm-4">
        <div class="user-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')"></div>
        <hr>
        <button id="openProfileEditer" type="submit" class="btn btn-custom btn-lg user-button">Edit Profile</button>
    </center>
    <div class="col-lg-9 col-md-9 col-sm-8">
        <h3>Personal information</h3>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <h5>Email</h5>
            <p>NinjasKappable@gmail.com</p>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-6">
            <h5>Phone number</h5>
            <p>933923223</p>
        </div>

        <div class="form-group col-lg-12 col-md-12">
            <h5>Full Name</h5>
            <p>Ninjas Kappable</p>
        </div>
    </div>
    <hr>
</div>
<!-- a propos de l'utilisateur -->

<!-- favoris -->
<div class="content products-defiler">
        <div class="title">
          <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">My favorites</h3>
          <div class="text-right col-lg-3 col-md-3 col-sm-8 col-xs-8">
            <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?php echo base_url('assets/icons/chevron-left.png') ?>"></button>
            <button class="btn btn-default btn-conrtrol next-btn"><img src="<?php echo base_url('assets/icons/chevron-right.png') ?>"></button>
          </div>
        </div>
        <div class="product-container row defiler">
            <!-- listes des produits -->
            <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="product-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')">
                    <div class="bag-icon">
                        <input type="checkbox" name="" id="check-0">
                        <label for="check-0">
                            <img src="<?php echo base_url('assets/icons/shopping-bag-disable.png') ?>">
                        </label>
                        <div class="option">
                            <a class="btn btn-default" href="">Bulk</a>
                            <a class="btn btn-default" href="">Wholesale</a>
                            <a class="btn btn-default" href="">Detail</a>
                        </div>
                    </div>
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-enable.png') ?>"></a>
                </div>
                <div class="product-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>
    
            <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="product-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')">
                    <div class="bag-icon">
                        <input type="checkbox" name="" id="check-1">
                        <label for="check-1">
                            <img src="<?php echo base_url('assets/icons/shopping-bag-disable.png') ?>">
                        </label>
                        <div class="option">
                            <a class="btn btn-default" href="">Bulk</a>
                            <a class="btn btn-default" href="">Wholesale</a>
                            <a class="btn btn-default" href="">Detail</a>
                        </div>
                    </div>
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-enable.png') ?>"></a>
                </div>
                <div class="product-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>
    
            <!-- listes des produits -->
        </div>
    </div>
    <!-- favoris -->

    <!-- basket-link -->
    <div class="content">
        <h3>My Basket history</h3>
    <!-- list des paniers -->
        <div class="content basket-history">
            <a href="" class="btn basket-link">
                <h4>Basket-ID-xxxxx</h4>
                <p>xx-xx-xxxx</p>
                <div class="form-group col-lg-6 col-md-6 col-sm-8">
                    <h3>SHIP</h3>
                    <p>ninja@impekable.com, 933923223</p>
                    <h5>10 N. Martingale Road, Suite 400, Schaumburg, IL 60173</h5>
                </div>
    
                <div class="form-group col-lg-6 col-md-6 col-sm-4">
                    <h3>PAYMENT</h3>
                    <h5>Mobile money</h5>
                    <p>933923223</p>
                </div>
                <hr>
            </a>
    
            <a href="" class="btn basket-link">
                <h4>Basket-ID-xxxxx</h4>
                <p>xx-xx-xxxx</p>
                <div class="form-group col-lg-6 col-md-6 col-sm-8">
                    <h3>SHIP</h3>
                    <p>ninja@impekable.com, 933923223</p>
                    <h5>10 N. Martingale Road, Suite 400, Schaumburg, IL 60173</h5>
                </div>
    
                <div class="form-group col-lg-6 col-md-6 col-sm-4">
                    <h3>PAYMENT</h3>
                    <h5>PayPal</h5>
                </div>
                <hr>
            </a>
            
        </div>
        
    <!-- list des paniers -->

    </div>
    <!-- basket-link -->
<?php } else {
    redirect(base_url('View/page/frontoffice/login'));
} ?>