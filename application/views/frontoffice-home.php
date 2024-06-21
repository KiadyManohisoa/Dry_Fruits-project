
<?php if (isset($product)) { ?>
    <!-- A propos du produits -->
    <div class="content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?= site_url('frontoffice/View/page/home') ?>">Home</a></li>
            <li><a href="<?= site_url('frontoffice/View/page/search#products') ?>">Products</a></li>
            <li><a href="<?= site_url('frontoffice/View/page/search#'.$product['product_category']); ?>"><?=$product['product_category'] ?>s</a></li>
            <li class="active-link"><?= $product['product_category']." ".$product['fruit_category']; ?></li>
        </ol>

        <!-- Product details -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="product-img-placeholder"></div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 product-details">
                <h1 class="product-title"><?= $product['product_category']." ".$product['fruit_category']; ?></h1>
                <p class="product-description"><?= $product['product_category']." ".$product['fruit_category'].", ".$product['product_description']; ?></p>
                <p class="product-price">Detail (100g) : <?= $product['detail_price'] ?> Ar</p>
                <p class="product-price">Wholesale (100g) : <?= $product['wholesale_price'] ?> Ar</p>
                <p class="product-price">Bulk (kg) : <?= $product['bulk_price'] ?> Ar</p>
                <br>
                <div class="btn btn-custom btn-lg btn-add bag-icon">
                    <input type="checkbox" name="" id="check-<?php echo $product['product_id']; ?>" class="bag">
                    <label for="check-<?php echo $product['product_id']; ?>">
                        Add to bag
                    </label>
                    <div class="option" id="option-<?php echo $product['product_id']; ?>">
                        <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-B">Bulk</button>
                        <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-W">Wholesale</button>
                        <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-D">Detail</button>
                    </div>
                </div>
                <div href="" class="bag-icon btn btn-favorite">
                    <label for="heart-<?php echo $product['product_id']; ?>">
                        <input type="checkbox" class="heart" name="" id="heart-<?php echo $product['product_id']; ?>">
                        <img src="<?php echo site_url('assets/icons/heart-disable.png') ?>">
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="details">
        <h2>Details</h2>
        <hr>
        <p><?= $product['product_category']." ".$product['fruit_category'].", ".$product['product_description']; ?></p>
    </div>
    <!-- A propos du produits -->
    
    <div class="content container-fluid rating-div">
        <!-- Ratings & Reviews -->
        <div class="col-lg-4 col-md-4">
            <h3>Ratings & Reviews</h3>
            <div class="rating-summary">
                <div class="d-flex align-items-center">
                    <div class="stars-final">
                        <img src="<?= site_url('assets/icons/'.((int) $review_pourcentage['final_review']).'-stars.png') ?>">
                    </div>
                    <h2><?= $review_pourcentage['final_review']?></h2>
                </div>
                <p><?= $review_pourcentage['final_review']?> Reviews</p>
            </div>
            <div class="rating">
                <div class="progress-container">
                    <span class="rating-label">5 Stars</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $review_pourcentage['stars_pourcentages'][5]?>%;"></div>
                    </div>
                    <span class="rating-percentage"><?= $review_pourcentage['stars_pourcentages'][5]?>%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">4 Stars</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $review_pourcentage['stars_pourcentages'][4]?>%;"></div>
                    </div>
                    <span class="rating-percentage"><?= $review_pourcentage['stars_pourcentages'][4]?>%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">3 Stars</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $review_pourcentage['stars_pourcentages'][3]?>%;"></div>
                    </div>
                    <span class="rating-percentage"><?= $review_pourcentage['stars_pourcentages'][3]?>%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">2 Stars</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $review_pourcentage['stars_pourcentages'][2]?>%;"></div>
                    </div>
                    <span class="rating-percentage"><?= $review_pourcentage['stars_pourcentages'][2]?>%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">1 Star</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $review_pourcentage['stars_pourcentages'][1]?>%;"></div>
                    </div>
                    <span class="rating-percentage"><?= $review_pourcentage['stars_pourcentages'][1]?>%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">0 Stars</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: <?= $review_pourcentage['stars_pourcentages'][0]?>%;"></div>
                    </div>
                    <span class="rating-percentage"><?= $review_pourcentage['stars_pourcentages'][0]?>%</span>
                </div>
            </div>
        </div>

        <!-- Share your thoughts -->
        <div class="col-lg-8 col-md-8">
            <form class="content" action="<?= site_url('frontoffice/Products_Controller/add_products_review/'.$product['product_id'])?>" method="post">
                <div class="d-flex align-items-center mb-3">
                    <h3 class="mb-0 ">Share your thoughts</h3>
                    <div class="stars-div">
                        <h4>Your rating</h4>
                        <label for="1-star">
                            <input type="radio" name="stars" value="1" id="1-star">
                            <img src="<?= site_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?= site_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="2-star">
                            <input type="radio" name="stars" value="2" id="2-star">
                            <img src="<?= site_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?= site_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="3-star">
                            <input type="radio" name="stars" value="3" id="3-star">
                            <img src="<?= site_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?= site_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="4-star">
                            <input type="radio" name="stars" value="4" id="4-star">
                            <img src="<?= site_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?= site_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="5-star">
                            <input type="radio" name="stars" value="5" id="5-star">
                            <img src="<?= site_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?= site_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>
                        <hr>
                </div>

                <h4>Write something</h4>
                <div class="from-group">
                    <textarea class="form-control rating-textarea" name="comment" placeholder="What do you want to say?"></textarea>
                </div>
                <div class="form-group text-right"><button type="submit" class="btn btn-custom btn-lg">Submit</button></div>
                
            </form>

            <div class="content review-div">
                
                <?php foreach ($reviews as $review) { ?>
                    <div class="review">
                        <h5 class="d-inline"><?= $review['client'] ?></h5>
                        <span class="review-date float-right"><?= $review['review_date'] ?></span>
                        <div class="stars-img">
                            <img src="<?= site_url('assets/icons/'.$review ['stars'].'-stars.png') ?>">
                        </div>
                        <p><?= $review ['comment'] ?></p>
                        <hr>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

<?php } else { ?>
    <!-- side de reductions -->
        <div id="reduction-carousel" class="carousel reduce slide" data-ride="carousel">
            <!-- indicateurs -->
            <ol class="carousel-indicators">
                <li data-target="#reduction-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#reduction-carousel" data-slide-to="1"></li>
                <li data-target="#reduction-carousel" data-slide-to="2"></li>
            </ol>
        
            <!-- slides -->
            <div class="carousel-inner" role="listbox">
                <div class="content item active">
                    <div class="col-lg-6 col-md-6 text-center">
                        <h1 id="reduce-name"><?= $reduce_products[0]['product_category']." ".$reduce_products[0]['fruit_category']; ?></h1>
                        <h2><?= $reduce_products[0]['detail_price']; ?> Ar </h2><h1 id="reduction">-<?= $reduce_products[0]['detail_reduction']; ?>%</h1>
                        
                    </div>
                    <div class="col-lg-6 col-md-6 hidden-xs hidden-sm text-center">
                        <div class="reduce-img" style="background-image: url('<?= site_url('assets/'.$reduce_products[0]['product_image_link']) ?>')"></div>
                    </div>
                </div>
        
                <div class="content item">
                    <div class="col-lg-6 col-md-6 text-center">
                        <h1 id="reduce-name"><?= $reduce_products[1]['product_category']." ".$reduce_products[1]['fruit_category']; ?></h1>
                        <h2><?= $reduce_products[1]['detail_price']; ?> Ar </h2><h1 id="reduction">-<?= $reduce_products[1]['detail_reduction']; ?>%</h1>
                    </div>
                    <div class="col-lg-6 col-md-6 hidden-xs hidden-sm text-center">
                        <div class="reduce-img" style="background-image: url('<?= site_url('assets/'.$reduce_products[1]['product_image_link']) ?>')"></div>
                    </div>
                </div>
        
                <div class="content item">
                    <div class="col-lg-6 col-md-6 text-center">
                        <h1 id="reduce-name"><?= $reduce_products[2]['product_category']." ".$reduce_products[2]['fruit_category']; ?></h1>
                        <h2><?= $reduce_products[2]['detail_price']; ?> Ar </h2><h1 id="reduction">-<?= $reduce_products[2]['detail_reduction']; ?>%</h1>
                    </div>
                    <div class="col-lg-6 col-md-6 hidden-xs hidden-sm text-center">
                        <div class="reduce-img" style="background-image: url('<?= site_url('assets/'.$reduce_products[2]['product_image_link']) ?>')"></div>
                    </div>
                </div>
            </div>
        
            <!-- controles -->
            <a class="left carousel-control" href="#reduction-carousel" role="button" data-slide="prev">
            <img src="<?= site_url('assets/icons/chevron-left.png') ?>">
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#reduction-carousel" role="button" data-slide="next">
            <img src="<?= site_url('assets/icons/chevron-right.png') ?>">
                <span class="sr-only">Next</span>
            </a>
        </div>
    <!-- side de reductions -->
        
    <!-- nouveaux produits -->
        <div class="content products-defiler">
            <div class="title">
            <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">What's new?</h3>
            <div class="text-right col-lg-3 col-md-3 col-sm-8 col-xs-8">
                <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?= site_url('assets/icons/chevron-left.png') ?>"></button>
                <button class="btn btn-default btn-conrtrol next-btn"><img src="<?= site_url('assets/icons/chevron-right.png') ?>"></button>
            </div>
            </div>
            <div class="product-container row defiler">
                <!-- listes des produits -->
                <?php foreach ($new_products as $product) { ?>
                    <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="product-img" style="background-image: url('<?= site_url('assets/'.$product['product_image_link']) ?>')">
                            <div class="bag-icon bag">
                                <input type="checkbox" name="" id="new-check-<?php echo $product['product_id']; ?>" class="bag">
                                <label for="new-check-<?php echo $product['product_id']; ?>">
                                    <img src="<?php echo site_url('assets/icons/shopping-bag-disable.png') ?>">
                                </label>
                                <div class="option" id="new-option-<?php echo $product['product_id']; ?>">
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-B">Bulk</button>
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-W">Wholesale</button>
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-D">Detail</button>
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
                <?php } ?>
        
                <!-- listes des produits -->
        
                <div id="see-all-link" class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <a href="<?= site_url('frontoffice/View/page/search#products'); ?>">See All</a>
                </div>
            </div>
        </div>
    <!-- nouveaux produits -->
        
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
                    <div class="carousel-img" style="background-image: url('<?= site_url('assets/images/image_1.jpg') ?>')"></div>
                </div>
        
                <div class="item">
                    <div class="carousel-img" style="background-image: url('<?= site_url('assets/images/image_2.jpg') ?>')"></div>
                </div>
        
                <div class="item">
                    <div class="carousel-img" style="background-image: url('<?= site_url('assets/images/image_3.jpg') ?>')"></div>
                </div>
            </div>
        
            <!-- controles -->
            <a class="left carousel-control" href="#pub-carousel" role="button" data-slide="prev">
            <img src="<?= site_url('assets/icons/chevron-left.png') ?>">
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#pub-carousel" role="button" data-slide="next">
            <img src="<?= site_url('assets/icons/chevron-right.png') ?>">
                <span class="sr-only">Next</span>
            </a>
        </div>
    <!-- slides de publicite -->
        
    <!-- produits recemment acheter -->
        <div class="content products-defiler">
            <div class="title">
            <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">Recently Viewed</h3>
            <div class="text-right col-lg-3 col-md-3 col-sm-8 col-xs-8">
                <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?= site_url('assets/icons/chevron-left.png') ?>"></button>
                <button class="btn btn-default btn-conrtrol next-btn"><img src="<?= site_url('assets/icons/chevron-right.png') ?>"></button>
            </div>
            </div>
            <div class="product-container row defiler">
                <!-- listes des produits -->
                <?php foreach ($most_saled_products as $product) { ?>
                    <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="product-img" style="background-image: url('<?= site_url('assets/'.$product['product_image_link']) ?>')">
                            <div class="bag-icon bag">
                                <input type="checkbox" name="" id="most-saled-check-<?php echo $product['product_id']; ?>" class="bag">
                                <label for="most-saled-check-<?php echo $product['product_id']; ?>">
                                    <img src="<?php echo site_url('assets/icons/shopping-bag-disable.png') ?>">
                                </label>
                                <div class="option" id="most-saled-option-<?php echo $product['product_id']; ?>">
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-B">Bulk</button>
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-W">Wholesale</button>
                                    <button class="btn btn-default btn-block type" id="<?= $product['product_id']; ?>-D">Detail</button>
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
                <?php } ?>
                
                <!-- listes des produits -->
        
                <div id="see-all-link" class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <a href="<?= site_url('frontoffice/View/page/search#products'); ?>">See All</a>
                </div>
            </div>
        </div>
        <center class="content" id="see-all">
            <a href="<?= site_url('frontoffice/View/page/search#products'); ?>">See All</a>
        </center>
    <!-- produits recemment acheter -->
<?php } ?>
