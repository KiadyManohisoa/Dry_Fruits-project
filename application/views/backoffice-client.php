<?php if($client) { ?>
<!-- a propos de l'utilisateur -->
<div class="content">
    <center class="col-lg-3 col-md-3 col-sm-4">
        <div class="user-img" style="background-image: url('<?php echo site_url('assets/images/image.jpg') ?>')"></div>
        <hr>
    </center>
    <div class="col-lg-9 col-md-9 col-sm-8">
        <h3>Personal information</h3>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <h5>Email</h5>
            <p><?php echo $client->get_mail();?></p>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-6">
            <h5>Phone number</h5>
            <p><?php echo $client->get_phone_number();?></p>
        </div>

        <div class="form-group col-lg-12 col-md-12">
            <h5>Full Name</h5>
            <p><?php echo $client->get_full_name();?></p>
        </div>
    </div>
    <hr>
</div>
<!-- a propos de l'utilisateur -->

    <!-- basket-link -->
    <div class="content">
        <h3>ORDERS HISTORY</h3>
    <!-- list des paniers -->
        <div class="content basket-history">

        <?php if(isset($last_orders)) { 
                foreach($last_orders as $orders) { 
            ?>
            <a href="<?php echo site_url();?>backoffice/Delivery_Controller/basket_link/<?php echo $orders['id_order'];?>" class="btn basket-link"> 
                <h4><?php echo $orders['id_order']; ?></h4>
                <p><?php echo $orders['delivery_date'];?></p>
                <div class="form-group col-lg-6 col-md-6 col-sm-8">
                    <h3>SHIP</h3>
                    <p><?php echo $client->get_mail();?></p>
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
    redirect(site_url('backoffice/View/page/home'));
} ?>