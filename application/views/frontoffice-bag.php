<?php $basketlink=false; if ($basketlink==true){ ?>
<!-- secction produits -->
<div id="products" class="content col-lg-6 col-lg-push-6 col-md-6 col-md-push-6">
    <h1 class="title-products">My Basket</h1>

    <div class="receipt col-lg-12">
        <div class="item-list">
            <div class="item">
                <img src="" alt="Dried Grapes" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="item-details col-lg-5 col-md-5 col-sm-6 col-xs-6">
                    <strong>Dried Grapes</strong>
                    <small>Bluck</small>
                    <small>
                        <?php $reduction=true; if($reduction) { ?>
                            <span class="original-price">2 000 Ar</span>
                            <span class="reduced-price"> / 1 800 Ar</span>
                        <?php } else {?>
                            <span>2 000 Ar</span>
                        <?php } ?>
                    </small>
                    <small class="total-item">Total: 18 000 Ar</small>
                </div>
                <div class="item-number col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <p>10</p>
                </div>
                <hr>
            </div>
        </div>

        <div class="totals">
            <div class="title col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <p>Subtotal :</p>
                <p>Reduction :</p>
                <hr>
                <h4><strong>Total :</strong></h4>
            </div>
            <div class="price col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <p>48 000 Ar</p>
                <p>10%</p>
                <hr>
                <h4><strong>42 100 Ar</strong></h4>
            </div>
        </div>

    </div>
</div>
<!-- secction produits -->

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
                        <p id="Adress">Ninja Kassadias</p>
                        <p id="Adress">ninja@impekable.com, 933923223</p>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <p><strong>Adress</strong></p>
                        <p id="Adress">10 N. Martingale Road, Suite 400, Schaumburg, IL 60173</p>
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
                <h4 class="col-lg-10 col-md-10 col-xs-8 col-sm-8">PAY WITH</h4>
            </div>
            <div id="ship-info">
                <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                        <p><strong>Mobile Money</strong></p>
                        <p id="Adress">034 33 032 39</p>
                    </div>
                </div>
                <div class="form-group text-right">
                    <a href="" class="btn btn-custom btn-lg"> Download PDF</a>
                </div>
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
            <div class="item">
                <img src="" alt="Dried Grapes" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="item-details col-lg-5 col-md-5 col-sm-6 col-xs-6">
                    <strong>Dried Grapes</strong>
                    <small>Bluck</small>
                    <small>
                        <?php $reduction=true; if($reduction) { ?>
                            <span class="original-price">2 000 Ar</span>
                            <span class="reduced-price"> / 1 800 Ar</span>
                        <?php } else {?>
                            <span>2 000 Ar</span>
                        <?php } ?>
                    </small>
                    <small class="total-item">Total: 18 000 Ar</small>
                </div>
                <div class="item-number col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <button type="button" class="btn btn-default"><img src="<?php echo base_url('assets/icons/minus.png') ?>"></button>
                    <p>10</p>
                    <button type="button" class="btn btn-default"><img src="<?php echo base_url('assets/icons/plus.png') ?>"></button>
                    <button type="button" class="btn btn-default"><img src="<?php echo base_url('assets/icons/trash.png') ?>"></button>
                </div>
                <hr>
            </div>
        </div>

        <div class="totals">
            <div class="title col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <p>Subtotal :</p>
                <p>Reduction :</p>
                <hr>
                <h4><strong>Total :</strong></h4>
            </div>
            <div class="price col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <p>48 000 Ar</p>
                <p>10%</p>
                <hr>
                <h4><strong>42 100 Ar</strong></h4>
            </div>
        </div>

    </div>
</div>
<!-- secction produits -->

<!-- section payment -->
<div id="payments" class="content col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-6 payments">
    <h1 class="hidden-sm hidden-xs">My Basket</h1>

    <form action = "<?php echo base_url('View/page/frontoffice/login')?>" method="post">
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
                    <input id="Adress-input" class="form-control" type="text" name="adress" placeholder="Enter your Adress">
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
                        <input type="text" class="form-control" name="phone_number" id="">
                    </div>
                </div>
                <div class="form-group text-right"><button type="submit" onclick="verify_pay_form()" class="btn btn-custom btn-lg">Pay 42 100 Ar</button></div>
            </div>
        </div>
        <!-- PAYMENT -->
    </form>
</div>
<!-- section payement -->
<?php } ?>
