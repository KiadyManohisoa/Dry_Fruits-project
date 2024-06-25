<?php if(isset($user)) { ?>
    <!-- Modal de connexion -->
    <div id="profileEditer" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Edit Profile</h3>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo site_url('frontoffice/LogClient_Controller/update_client_info');?>" enctype="multipart/form-data">
                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="profile-pic">Profile picture</label>
                            <input type="file" name="user_profile_pic" class="form-control" id="profile-pic" placeholder="Username">
                        </div>
                        <hr>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="mail">Email</label>
                            <input type="text" name="new_mail" value="<?php echo $user->get_mail();?>" class="form-control" id="mail" placeholder="Enter your new Email">
                        </div>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="phone">Phone number</label>
                            <input type="text" name="new_phone_number" value="<?php echo $user->get_phone_number();?>" class="form-control" id="phone" placeholder="Enter your new phone number">
                        </div>

                        <div class="form-group">
                            <label for="full-name">Full name</label>
                            <input type="text" name="new_full_name" value="<?php echo $user->get_full_name();?>" class="form-control" id="full-name" placeholder="Enter your full Name">
                        </div>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your new Password">
                        </div>
                        <div class="form-group  col-lg-6 col-md-6 col-sm-6">
                            <label for="cpassword">Confirm password</label>
                            <input type="password" name="confirm_password" class="form-control" id="cpassword" placeholder="Confirm your Password">
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
        <div class="user-img" style="background-image: url('<?php echo site_url($user->get_user_image());?>')"></div>
        <hr>
        <button id="openProfileEditer" type="submit" class="btn btn-custom btn-lg user-button">Edit Profile</button>
    </center>
    <div class="col-lg-9 col-md-9 col-sm-8">
        <h3>Personal information</h3>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <h5>Email</h5>
            <p><?php echo $user->get_mail();?></p>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-6">
            <h5>Phone number</h5>
            <p><?php echo $user->get_phone_number();?></p>
        </div>

        <div class="form-group col-lg-12 col-md-12">
            <h5>Full Name</h5>
            <p><?php echo $user->get_full_name();?></p>
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
            <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?php echo site_url('assets/icons/chevron-left.png') ?>"></button>
            <button class="btn btn-default btn-conrtrol next-btn"><img src="<?php echo site_url('assets/icons/chevron-right.png') ?>"></button>
          </div>
        </div>
        <div class="product-container row defiler">
            <!-- listes des produits -->
                <?php if(isset($favoris_products)) { 
                    foreach ($favoris_products as $product) { ?>
                        <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="product-img" style="background-image: url('<?= site_url($product['product_image_link']) ?>')">
                                <div class="bag-icon bag">
                                    <input type="checkbox" name="" id="new-check-<?php echo $product['product_id']; ?>" class="bag">
                                    <label for="new-check-<?php echo $product['product_id']; ?>">
                                        <img src="<?php echo site_url('assets/icons/shopping-bag-disable.png') ?>">
                                    </label>
                                    <div class="option" id="new-option-<?php echo $product['product_id']; ?>">
                                        <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-B" <?= $disponibility[$product['product_id']]['B'] ?>>Bulk</button>
                                        <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-W" <?= $disponibility[$product['product_id']]['W'] ?>>Wholesale</button>
                                        <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-D" <?= $disponibility[$product['product_id']]['D'] ?>>Detail</button>
                                    </div>
                                </div>
    
                                <div class="bag-icon">
                                    <label for="heart-<?= $product['product_id']; ?>">
                                        <input type="checkbox" class="heart" name="" id="heart-<?= $product['product_id']; ?>">
                                        <img src="<?= site_url('assets/icons/heart-disable.png') ?>">
                                    </label>
                                </div>
                            </div>
                            <div class="product-desc">
                                <a href="<?= site_url('frontoffice/Products_Controller/get_product_by_id/'.$product['product_id'])?>"><h4><?= $product['product_category']." ".$product['fruit_category']; ?></h4></a>
                                <p><?= $product['detail_price']; ?> Ar</p>
                            </div>
                        </div>
                <?php } } ?>
            <!-- listes des produits -->
        </div>
    </div>
<!-- favoris -->

<!-- review services -->
    <div class="content col-lg-12 col-md-12">
        <h2>Delivery services rating</h2>
        <form class="content" action="<?= site_url('frontoffice/Products_Controller/add_services_review/')?>" method="post">
            <div class="stars-div">
                <h4>Rate our services</h4>
                <label for="1-star">
                    <input type="radio" name="stars" value="1" id="1-star">
                    <img src="<?php echo site_url('assets/icons/star-disable.png') ?>" width="35px">
                </label>

                <label for="2-star">
                    <input type="radio" name="stars" value="2" id="2-star">
                    <img src="<?php echo site_url('assets/icons/star-disable.png') ?>" width="35px">
                </label>

                <label for="3-star">
                    <input type="radio" name="stars" value="3" id="3-star">
                    <img src="<?php echo site_url('assets/icons/star-disable.png') ?>" width="35px">
                </label>

                <label for="4-star">
                    <input type="radio" name="stars" value="4" id="4-star">
                    <img src="<?php echo site_url('assets/icons/star-disable.png') ?>" width="35px">
                </label>

                <label for="5-star">
                    <input type="radio" name="stars" value="5" id="5-star">
                    <img src="<?php echo site_url('assets/icons/star-disable.png') ?>" width="35px">
                </label>
                <hr>
            </div>

            <h4>Remarks</h4>
            <div class="form-group">
                <textarea class="form-control rating-textarea" name="comment" placeholder="What do you want to say?"></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-custom btn-lg">Submit</button>
            </div>
        </form>
    </div>
<!-- review services -->

    <!-- basket-link -->
    <div class="content">
        <h3>My Basket history</h3>
    <!-- list des paniers -->
        <div class="content basket-history">
            <?php if(isset($last_orders)) { 
                foreach($last_orders as $orders) { 
            ?>
            <a href="<?php echo site_url();?>frontoffice/Delivery_Controller/basket_link/<?php echo $orders['id_order'];?>" class="btn basket-link"> 
                <h4><?php echo $orders['id_order']; ?></h4>
                <p><?php echo $orders['delivery_date'];?></p>
                <div class="form-group col-lg-6 col-md-6 col-sm-8">
                    <h3>SHIP</h3>
                    <p><?php echo $user->get_mail();?></p>
                    <h5><?php echo $orders['delivery_address'];?></h5>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-4">
                    <h3>PAYMENT</h3>
                    <h5><?php echo $orders['payement_mode'];?></h5>
                    <p><?php echo $orders['phone_number'];?></p>
                </div>
                <hr>
            </a>
        <?php } } ?>
            
        </div>
        
    <!-- list des paniers -->

    </div>
    <!-- basket-link -->
<?php } else {
    redirect(site_url('frontoffice/View/page/login'));
} ?>