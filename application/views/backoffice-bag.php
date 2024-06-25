<?php if($order_details) { ?>

<!-- secction produits -->
<div id="products" class="content basket col-lg-6 col-lg-push-6 col-md-6 col-md-push-6">
    <h1 class="title-products"><?php echo $order_details[0]['client_full_name']; ?>'s Basket</h1>

    <div class="receipt col-lg-12">
        <div class="item-list">
            <?php if (isset($order_details) && !empty($order_details)) { ?>
                <?php foreach ($order_details as $order) { ?>
                    <div class="item">
                        <img src="<?= site_url();?><?= $order['product_image_link'];?>" alt="Product Image" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="item-details col-lg-5 col-md-5 col-sm-6 col-xs-6">
                            <strong><?php echo $order['product_name']; ?></strong>
                            <small><?php echo $order['type_sales']; ?></small>
                            <small>
                                <?php if ($order['reduction_product']  != $order['unit_product_price']) { ?>
                                    <span class="original-price"><?php echo number_format($order['unit_product_price'], 0, '.', ' '); ?>
                                        Ar</span>
                                    <span class="reduced-price"> / <?php echo number_format($order['reduction_product'], 0, '.', ' '); ?> Ar</span>
                                <?php } else { ?>
                                    <span><?php echo number_format($order['unit_product_price'], 0, '.', ' '); ?> Ar</span>
                                <?php } ?>
                            </small>
                            <small class="total-item">Total:
                                <?php echo number_format($order['price_product_with_reduction'], 0, '.', ' '); ?> Ar</small>
                        </div>
                        <div class="item-number col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <p><?php echo number_format($order['quantity_product']); ?></p>
                        </div>
                        <hr>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="content">
                    <p>No order details found.</p>
                </div>
            <?php } ?>
        </div>

        <div class="totals">
        <?php $order = $order_details[0]; ?>
        <div class="title col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <p>Subtotal :</p>
            <p>Reduction :</p>
            <hr>
            <h4><strong>Total :</strong></h4>
        </div>
        <div class="price col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <p><?php echo number_format($order['total_price_product'],0,'.',' '); ?> Ar</p>
            <p>-<?php echo number_format($order['reduction']); ?>%</p>
            <hr>
            <h4><strong><?php echo number_format($order['result'],0,'.',' '); ?> Ar</strong></h4>
        </div>
    </div>

    </div>
</div>
<!-- secction produits -->

<!-- section payment -->
<div id="payments" class="content col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 payments">
    <h1 class="hidden-sm hidden-xs"><?php echo $order['client_full_name']; ?>'s Basket</h1>

    <form>
        <!-- SHIP -->
        <div class="contents">
            <div id="ship" class="section enabled">
                <h4 class="col-lg-6 col-md-6 col-xs-4 col-sm-4">SHIP TO</h4>
            </div>
            <div id="ship-info">
                <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                        <p><strong>Personal Information</strong></p>
                        <p id="Adress"><?php echo $order['client_full_name']; ?></p>
                        <p id="Adress"><?php echo $order['client_email']; ?>,
                            <?php echo $order['client_phone_number']; ?></p>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <p><strong>Adress</strong></p>
                        <p id="Adress"><?php echo $order['delivery_address']; ?></p>
                    </div>
                </div>
                <hr style="visibility:hidden">
            </div>
        </div>
        <!-- SHIP -->
        <br>
        <!-- PAYMENT -->
        <div class="contents">
            <div id="pay" class="section">
                <h4 class="col-lg-10 col-md-10 col-xs-8 col-sm-8">PAID WITH</h4>
            </div>
            <div id="ship-info">
                <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                        <p><strong><?php echo $order['payment_type']; ?></strong></p>
                        <p id="Adress"><?php echo $order['payment_phone_number']; ?></p>
                    </div>
                </div>
                <hr style="visibility:hidden">
            </div>
        </div>
        <!-- PAYMENT -->
    </form>
</div>
<!-- section payement -->
<?php } else {
if ($admin_status=="A") {
    redirect(site_url('backoffice/View/page/home'));
}
redirect(site_url('backoffice/View/page/delivery'));
} ?>
