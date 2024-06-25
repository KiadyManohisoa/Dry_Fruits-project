<?php if(isset($order_details)) { ?>

    <!-- secction produits -->
    <div id="products" class="content basket col-lg-6 col-lg-push-6 col-md-6 col-md-push-6">
        <h1 class="title-products">My Basket</h1>

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
                                        <span class="original-price"><?php echo number_format($order['unit_product_price'],0, '.', ' '); ?>
                                            Ar</span>
                                        <span class="reduced-price"> / <?php echo number_format($order['reduction_product'],0, '.', ' '); ?> Ar</span>
                                    <?php } else { ?>
                                        <span><?php echo number_format($order['unit_product_price'],0, '.', ' '); ?> Ar</span>
                                    <?php } ?>
                                </small>
                                <small class="total-item">Total:
                                    <?php echo number_format($order['price_product_with_reduction'],0, '.', ' '); ?> Ar</small>
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
                    <p><?php echo number_format($order['total_price_product'],2,'.',' '); ?> Ar</p>
                    <p>-<?php echo number_format($order['reduction']); ?>%</p>
                    <hr>
                    <h4><strong><?php echo number_format($order['result'],2,'.',' '); ?> Ar</strong></h4>
                </div>
            </div>

        </div>
    </div>
    <!-- secction produits -->
    <hr class="hidden-lg hidden-md" style="visibility : hidden">
    
    <!-- section payment -->
    <div id="payments" class="content col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 payments">
        <h1 class="hidden-sm hidden-xs">My Basket</h1>

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
                    <div class="form-group text-right"><a class="btn btn-custom btn-lg" href="<?= isset($order_id) ? site_url("frontoffice/Basket_Controller/generatePDF/".$order_id) : '#' ?>">Download PDF</a></div>
                    <hr style="visibility:hidden">
                </div>
            </div>
            <!-- PAYMENT -->
        </form>
    </div>
    <!-- section payement -->
<?php } else {?>
<!-- secction produits -->
<div id="products" class="content col-lg-6 col-lg-push-6 col-md-6 col-md-push-6">
    <h1 class="title-products">My Basket</h1>

    <div class="receipt col-lg-12">
        <div class="item-list">
            <?php if (isset($basket) && !empty($basket)) { ?>
                <?php foreach ($basket as $order) { ?>
                    <div class="item">
                        <img src="<?= site_url();?><?= $order['product_image_link'];?>" alt="Product Image" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="item-details col-lg-5 col-md-5 col-sm-6 col-xs-6">
                            <strong><?php echo $order['product_name']; ?></strong>
                            <small><?php echo $order['type_sales']; ?></small>
                            <small>
                                <?php if ($order['reduction_product']  != $order['unit_product_price']) { ?>
                                    <span class="original-price"><?php echo number_format($order['unit_product_price'],0, '.', ' '); ?>
                                        Ar</span>
                                    <span id="product-price-<?= $order['product_id']; ?>-<?= $order['type']; ?>" class="reduced-price product-price">/<?php echo number_format($order['reduction_product'],0, '.', ' '); ?> Ar</span>
                                <?php } else { ?>
                                    <span class="product-price" id="product-price-<?= $order['product_id']; ?>-<?= $order['type']; ?>"><?php echo number_format($order['unit_product_price'],0, '.', ' '); ?> Ar</span>
                                <?php } ?>
                            </small>
                            <small id="total-<?= $order['product_id']; ?>-<?= $order['type']; ?>" class="total-item">Total: <?php echo number_format($order['price_product_with_reduction'],0, '.', ' '); ?> Ar</small>
                        </div>
                        <div class="item-number col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <button type="button" class="btn btn-default change-basket" id="minus-<?= $order['product_id']; ?>-<?= $order['type']; ?>"><img src="<?php echo site_url('assets/icons/minus.png') ?>"></button>
                            <input type="text" min="1" id="quantity-<?= $order['product_id']; ?>-<?= $order['type']; ?>" value="<?php echo number_format($order['quantity_product']); ?>" name="<?php echo number_format($order['quantity_product']); ?>" class="quantity">

                            <button type="button" class="btn btn-default change-basket" id="plus-<?= $order['product_id']; ?>-<?= $order['type']; ?>"><img src="<?php echo site_url('assets/icons/plus.png') ?>"></button>
                            <button type="button" class="btn btn-default change-basket" id="delete-<?= $order['product_id']; ?>-<?= $order['type']; ?>"><img src="<?php echo site_url('assets/icons/trash.png') ?>"></button>
                        </div>
                        <hr>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="content">
                    <p>Your basket is empty.</p>
                </div>
            <?php } ?>

        </div>

        <div class="totals">
            <?php if (!empty($basket)) { 
                // Calculer les totaux à partir du premier produit dans le panier
                $order = $basket[0];
            ?>
                <div class="title col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p>Subtotal :</p>
                    <p>Reduction :</p>
                    <hr>
                    <h4><strong>Total :</strong></h4>
                </div>
                <div class="price col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p id="subtotal"><?php echo number_format($order['total_price_product'],0, '.', ' '); ?> Ar</p>
                    <p id="reduction">-<?php echo number_format($order['reduction'],0, '.', ' '); ?>%</p>
                    <hr>
                    <h4><strong id="total"><?php echo number_format($order['result'],0, '.', ' '); ?> Ar</strong></h4>
                </div>
            <?php } else { ?>
                <div class="content">
                    <p>Your basket is empty.</p>
                </div>
            <?php } ?>
            <hr style="visibility:hidden">
        </div>


    </div>
</div>
<!-- secction produits -->
<hr class="hidden-lg hidden-md" style="visibility : hidden">
<!-- section payment -->
<div id="payments" class="content col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 payments">
    <h1 class="hidden-sm hidden-xs">My Basket</h1>

    <form action = "<?php echo site_url('frontoffice/Basket_Controller/create_order')?>" method="post">
        <!-- SHIP -->
        <div class="contents">
            <div id="ship" class="section enabled">
                <label class="round-check col-lg-1 col-md-1 col-xs-2 col-sm-2">
                    <input id="ship-check" type="checkbox" disabled>
                    <span id="ship-span">1</span>
                </label>
                <h4 class="col-lg-6 col-md-6 col-xs-4 col-sm-4">SHIP TO</h4>

                <div class="section-button col-lg-5 col-md-5 col-xs-5 col-sm-5">
                    <p id="ship-select">Shipping to <select name="" id="">
                        <option value="">Madagascar</option>
                    </select></p>
                    <button type="button" onclick="edit_ship()" id="ship-edit">edit</button>
                </div>
            </div>
            <div id="ship-form" class="payment-form">
                <div class="form-group">
                    <label for="">Adress</label>
                    <input id="Adress-input" class="form-control" type="text" name="address" placeholder="Enter your Adress">
                </div>

                <div class="form-group col-lg-5 col-md-5">
                    <label for="">Post code</label>
                    <input id="Postcode-input" class="form-control" type="text" name="post_code" placeholder="Enter your Post code">
                </div>

                <div class="form-group col-lg-7 col-md-7">
                    <label for="">City</label>
                    <input id="City-input" class="form-control" type="text" name="city" placeholder="Enter your City">
                </div>
                <div class="form-group text-right"><button type="button" onclick="verify_ship_form()" class="btn btn-custom btn-lg">Continue payment</button></div>
            </div>
            <div id="ship-info" class="disabled">
                <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                        <p><strong>Adress</strong></p>
                        <p id="Adress"></p>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <p><strong>Post code</strong></p>
                        <p id="Postcode"></p>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <p><strong>City</strong></p>
                        <p id="City"></p>
                    </div>
                </div>
                <hr style="visibility:hidden">
            </div>
        </div>
        <!-- SHIP -->
        <br>
        <!-- PAYMENT -->
        <div class="contents">
            <input type="hidden" id="cost" name="cost" value="<?= number_format($delivery_cost,0, '.', ' '); ?>">
            <div id="pay" class="section">
                <label class="round-check col-lg-1 col-md-1 col-xs-2 col-sm-2">
                    <input id="pay-check" type="checkbox" disabled>
                    <span id="pay-span">2</span>
                </label>
                <h4 class="col-lg-10 col-md-10 col-xs-8 col-sm-8">PAY WITH</h4>
            </div>
            <div id="pay-form" class="payment-form disabled">
                <div class="radio form-group check">
                    <input type="radio" name="payment" id="paypal" value="PayPal" checked>
                    <label for="paypal">
                        PayPal
                    </label>
                </div>
                <div class="radio form-group">
                    <input type="radio" name="payment" id="mobile" value="Mobile Money">
                    <label for="mobile">
                        Mobile Money
                    </label>
                    <br>
                    <div class="form-group input">
                        <p>Phone number</p>
                        <input type="text" class="form-control" value="" name="phone_number" id="">
                    </div>
                </div>
                <div class="form-group text-right"><button type="submit" onclick="verify_pay_form()" class="btn btn-custom btn-lg">Pay <span id="total-payment"><?php echo isset($order['result']) ? number_format($order['result']+$delivery_cost,0, '.', ' ') : '' ?> Ar</span></button></div>
            </div>
        </div>
        <!-- PAYMENT -->
    </form>
</div>
<!-- section payement -->
<?php } ?>
