<!-- slides de publicite -->
<div id="pub-carousel" class="carousel slide" data-ride="carousel">
    <!-- indicateurs -->
    <ol class="carousel-indicators">
        <li data-target="#pub-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#pub-carousel" data-slide-to="1"></li>
        <li data-target="#pub-carousel" data-slide-to="2"></li>
    </ol>

    <!-- slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="carousel-img" style="background-image: url('<?php echo base_url('assets/images/image_1.jpg') ?>')"></div>
        </div>

        <div class="item">
            <div class="carousel-img" style="background-image: url('<?php echo base_url('assets/images/image_2.jpg') ?>')"></div>
        </div>

        <div class="item">
            <div class="carousel-img" style="background-image: url('<?php echo base_url('assets/images/image_3.jpg') ?>')"></div>
        </div>
    </div>

    <!-- controles -->
    <a class="left carousel-control" href="#pub-carousel" role="button" data-slide="prev">
    <img src="<?php echo base_url('assets/icons/chevron-left.png') ?>">
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#pub-carousel" role="button" data-slide="next">
    <img src="<?php echo base_url('assets/icons/chevron-right.png') ?>">
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- slides de publicite -->

<!-- formulaire de recherche -->
 <div id="search-form" class="content">
    <h2>See our products</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="min">Minimum price</label>
            <input class="form-control" id="min" type="number" placeholder="Price (Ar)">
        </div>
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="max">Maximum price</label>
            <input class="form-control" id="max" type="number" placeholder="Price (Ar)">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Search</button>
        </div>
    </form>
    <hr>
 </div>
<!-- formulaire de recherche -->

<!-- parties d'affichage des produits -->
<div class="content" id="products">
    <div class="defiler-option col-xs-12 text-left">
        <button class="btn btn-default btn-active" id="dried-button">Dried</button>
        <button class="btn btn-default" id="candied-button">Candied</button>
        <button class="btn btn-default" id="jam-button">Jam</button>
        <button class="btn btn-default" id="compote-button">Compote</button>
        <hr>
    </div>
    <div class="scroll-div-defiler">
        <div class="scroll-item" id="dried">
            <!-- listes produits -->
            <div class="item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="item-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')">
                    <div class="bag-icon">
                        <input type="checkbox" name="" id="check-0">
                        <label for="check-0">
                            <img src="<?php echo base_url('assets/icons/shopping-bag-disable.png') ?>">
                        </label>
                        <div class="option">
                            <a class="btn btn-default .btn-block" href="">Bulk</a>
                            <a class="btn btn-default .btn-block" href="">Wholesale</a>
                            <a class="btn btn-default .btn-block" href="">Detail</a>
                        </div>
                    </div>
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
                </div>
                <div class="item-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>

            <!-- listes produits -->

        </div>
        <div class="scroll-item" id="candied">
            <!-- listes produits -->
            <div class="item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="item-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')">
                    <div class="bag-icon">
                        <input type="checkbox" name="" id="check-0">
                        <label for="check-0">
                            <img src="<?php echo base_url('assets/icons/shopping-bag-disable.png') ?>">
                        </label>
                        <div class="option">
                            <a class="btn btn-default .btn-block" href="">Bulk</a>
                            <a class="btn btn-default .btn-block" href="">Wholesale</a>
                            <a class="btn btn-default .btn-block" href="">Detail</a>
                        </div>
                    </div>
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
                </div>
                <div class="item-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>

            <!-- listes produits -->
        </div>
        <div class="scroll-item" id="jam">
            <!-- listes produits -->
            <div class="item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="item-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')">
                    <div class="bag-icon">
                        <input type="checkbox" name="" id="check-0">
                        <label for="check-0">
                            <img src="<?php echo base_url('assets/icons/shopping-bag-disable.png') ?>">
                        </label>
                        <div class="option">
                            <a class="btn btn-default .btn-block" href="">Bulk</a>
                            <a class="btn btn-default .btn-block" href="">Wholesale</a>
                            <a class="btn btn-default .btn-block" href="">Detail</a>
                        </div>
                    </div>
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
                </div>
                <div class="item-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>

            <!-- listes produits -->
        </div>
        <div class="scroll-item" id="compote">
            <!-- listes produits -->
            <div class="item col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="item-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')">
                    <div class="bag-icon">
                        <input type="checkbox" name="" id="check-0">
                        <label for="check-0">
                            <img src="<?php echo base_url('assets/icons/shopping-bag-disable.png') ?>">
                        </label>
                        <div class="option">
                            <a class="btn btn-default .btn-block" href="">Bulk</a>
                            <a class="btn btn-default .btn-block" href="">Wholesale</a>
                            <a class="btn btn-default .btn-block" href="">Detail</a>
                        </div>
                    </div>
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
                </div>
                <div class="item-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>

            <!-- listes produits -->
        </div>
    </div>
</div>
<!-- parties d'affichage des produits -->