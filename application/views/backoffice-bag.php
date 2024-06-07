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
                <div class="item-number col-lg-4 col-md-4 col-sm-6 col-xs-12">
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
                <hr style="visibility:hidden">
            </div>
        </div>
        <!-- PAYMENT -->
    </form>
</div>
<!-- section payement -->