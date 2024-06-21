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
            <div class="carousel-img" style="background-image: url('<?php echo site_url('assets/images/image_1.jpg') ?>')"></div>
        </div>

        <div class="item">
            <div class="carousel-img" style="background-image: url('<?php echo site_url('assets/images/image_2.jpg') ?>')"></div>
        </div>

        <div class="item">
            <div class="carousel-img" style="background-image: url('<?php echo site_url('assets/images/image_3.jpg') ?>')"></div>
        </div>
    </div>

    <!-- controles -->
    <a class="left carousel-control" href="#pub-carousel" role="button" data-slide="prev">
    <img src="<?php echo site_url('assets/icons/chevron-left.png') ?>">
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#pub-carousel" role="button" data-slide="next">
    <img src="<?php echo site_url('assets/icons/chevron-right.png') ?>">
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- slides de publicite -->

<!-- formulaire de recherche -->
 <div id="search-form" class="content">
    <h2>See our products</h2>
    <form class="col-lg-6 col-md-6" method="post" action="<?php echo site_url();?>frontoffice/Products_Controller/products_search">
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="min">Minimum price</label>
            <input class="form-control" id="min" name="minimum_price" type="number" placeholder="Price (Ar)">
        </div>
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="max">Maximum price</label>
            <input class="form-control" id="max" name="maximum_price" type="number" placeholder="Price (Ar)">
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
        <?php $i = 0; foreach ($products as $key => $value) {?>
            <button class="btn btn-default" id="<?php echo $key ?>-button"><?php echo $key ?></button>
        <?php } ?>
        <hr>
    </div>
    <div class="scroll-div-defiler">
        
        
         <?php foreach ($products as $key => $tab_products) { 
             ?>
            <div class="scroll-item" id="<?php echo $key ?>">
                 <!-- listes produits -->
                <?php foreach ($tab_products as $product) { ?>
                     <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <div class="item-img" style="background-image: url('<?php echo site_url('assets/'.$product['product_image_link']) ?>')">
                            <div class="bag-icon bag">
                                <input type="checkbox" name="" id="check-<?php echo $product['product_id']; ?>" class="bag">
                                <label for="check-<?php echo $product['product_id']; ?>">
                                    <img src="<?php echo site_url('assets/icons/shopping-bag-disable.png') ?>">
                                </label>
                                <div class="option" id="option-<?php echo $product['product_id']; ?>">
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-B">Bulk</button>
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-W">Wholesale</button>
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-D">Detail</button>
                                </div>
                            </div>

                            <div class="bag-icon">
                                <label for="heart-<?php echo $product['product_id']; ?>">
                                    <input type="checkbox" class="heart" name="" id="heart-<?php echo $product['product_id']; ?>">
                                    <img src="<?php echo site_url('assets/icons/heart-disable.png') ?>">
                                </label>
                            </div>
                        </div>
                        <div class="item-desc">
                            <a href="<?= site_url('frontoffice/Products_Controller/get_product_by_id/'.$product['product_id'])?>" class="product-link"><h4><?php echo $product['product_category']." ".$product['fruit_category']; ?></h4></a>
                            <p><?php echo $product['detail_price']; ?> Ar</p>
                        </div>
                    </div>
                <?php } ?>
    
                 <!-- listes produits -->
    
            </div>
        <?php } ?>
    </div>
</div>
<!-- parties d'affichage des produits -->