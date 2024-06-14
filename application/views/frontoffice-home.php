
<?php $product = true; if ($product == true) { ?>
    <!-- A propos du produits -->
    <div class="content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('View/page/frontoffice/home') ?>">Home</a></li>
            <li><a href="<?php echo base_url('View/page/frontoffice/search#products') ?>">Products</a></li>
            <li><a href="<?php echo base_url('View/page/frontoffice/search#jam') ?>">Jams</a></li>
            <li class="active-link">Strawberries Jams</li>
        </ol>

        <!-- Product details -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="product-img-placeholder"></div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 product-details">
                <h1 class="product-title">Strawberry Jams</h1>
                <p class="product-description">Jams made of natural and bio strawberries</p>
                <p class="product-price">Detail (100g) : 2 000 Ar</p>
                <p class="product-price">Wholesale (100g) : 2 000 Ar</p>
                <p class="product-price">Bulk (kg) : 2 000 Ar</p>
                <br>
                <a class="btn btn-custom btn-lg">Add to bag</a>
                <a href="" class="btn btn-favorite"><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
            </div>
        </div>
    </div>

    <div class="details">
        <h2>Details</h2>
        <hr>
        <p>blabla</p>
    </div>
    <!-- A propos du produits -->
    
    <div class="content container-fluid rating-div">
        <!-- Ratings & Reviews -->
        <div class="col-lg-4 col-md-4">
            <h3>Ratings & Reviews</h3>
            <div class="rating-summary">
                <div class="d-flex align-items-center">
                    <div class="stars-final">
                        <img src="<?php echo base_url('assets/icons/4-stars.png') ?>">
                    </div>
                    <h2>4.1</h2>
                </div>
                <p>2,945 Reviews</p>
            </div>
            <div class="rating">
                <div class="progress-container">
                    <span class="rating-label">5 Star</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 68%;"></div>
                    </div>
                    <span class="rating-percentage">68%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">4 Star</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 18%;"></div>
                    </div>
                    <span class="rating-percentage">18%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">3 Star</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 4%;"></div>
                    </div>
                    <span class="rating-percentage">4%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">2 Star</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 3%;"></div>
                    </div>
                    <span class="rating-percentage">3%</span>
                </div>
                <div class="progress-container">
                    <span class="rating-label">1 Star</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 7%;"></div>
                    </div>
                    <span class="rating-percentage">7%</span>
                </div>
            </div>
        </div>

        <!-- Share your thoughts -->
        <div class="col-lg-8 col-md-8">
            <form class="content">
                <div class="d-flex align-items-center mb-3">
                    <h3 class="mb-0 ">Share your thoughts</h3>
                    <div class="stars-div">
                        <h4>Your rating</h4>
                        <label for="1-star">
                            <input type="radio" name="stars" value="1" id="1-star">
                            <img src="<?php echo base_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?php echo base_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="2-star">
                            <input type="radio" name="stars" value="2" id="2-star">
                            <img src="<?php echo base_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?php echo base_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="3-star">
                            <input type="radio" name="stars" value="3" id="3-star">
                            <img src="<?php echo base_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?php echo base_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="4-star">
                            <input type="radio" name="stars" value="4" id="4-star">
                            <img src="<?php echo base_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?php echo base_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>

                        <label for="5-star">
                            <input type="radio" name="stars" value="5" id="5-star">
                            <img src="<?php echo base_url('assets/icons/star-disable.png') ?>" class="star-disabled">
                            <img src="<?php echo base_url('assets/icons/star-enable.png') ?>" class="star-enabled">
                        </label>
                        <hr>
                    </div>

                </div>
                <h4>Write something</h4>
                <div class="from-group">
                    <textarea class="form-control rating-textarea" placeholder="What do you want to say?"></textarea>
                </div>
                <div class="form-group text-right"><button type="submit" class="btn btn-custom btn-lg">Submit</button></div>
                
            </form>

            <div class="content review-div">
                <div class="review">
                    <h5 class="d-inline">John Shea</h5>
                    <span class="review-date float-right">12-02-2023</span>
                    <div class="stars-img">
                        <img src="<?php echo base_url('assets/icons/5-stars.png') ?>">
                    </div>
                    <p>Omg I love it!!!! Feels beautiful</p>
                    <hr>
                </div>
                <div class="review">
                    <h5 class="d-inline">James Andrew</h5>
                    <span class="review-date float-right">12-02-2023</span>
                    <div class="stars-img">
                        <img src="<?php echo base_url('assets/icons/3-stars.png') ?>">
                    </div>
                    <p>I like it...</p>
                    <hr>
                </div>
                <div class="review">
                    <h5 class="d-inline">Alice Waterson</h5>
                    <span class="review-date float-right">12-02-2023</span>
                    <div class="stars-img">
                        <img src="<?php echo base_url('assets/icons/4-stars.png') ?>">
                    </div>
                    <p>It's really healthy!</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <!-- side de reductions -->
    <div id="reduction-carousel" class="carousel slide" data-ride="carousel">
        <!-- indicateurs -->
        <ol class="carousel-indicators">
            <li data-target="#reduction-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#reduction-carousel" data-slide-to="1"></li>
            <li data-target="#reduction-carousel" data-slide-to="2"></li>
        </ol>
    
        <!-- slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
            </div>
    
            <div class="item">
            </div>
    
            <div class="item">
            </div>
        </div>
    
        <!-- controles -->
        <a class="left carousel-control" href="#reduction-carousel" role="button" data-slide="prev">
        <img src="<?php echo base_url('assets/icons/chevron-left.png') ?>">
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#reduction-carousel" role="button" data-slide="next">
        <img src="<?php echo base_url('assets/icons/chevron-right.png') ?>">
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- side de reductions -->
    
    <!-- nouveaux produits -->
    <div class="content products-defiler">
        <div class="title">
          <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">What's new?</h3>
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
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
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
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
                </div>
                <div class="product-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>
    
            <!-- listes des produits -->
    
            <div id="see-all-link" class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo base_url('View/page/frontoffice/search#search-form'); ?>">See All</a>
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
    
    <!-- produits recemment acheter -->
    <div class="content products-defiler">
        <div class="title">
          <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">Recently Viewed</h3>
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
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
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
                    <a href=""><img src="<?php echo base_url('assets/icons/heart-disable.png') ?>"></a>
                </div>
                <div class="product-desc">
                    <h4>Product 1</h4>
                    <p>Description du produit 1</p>
                </div>
            </div>
    
            <!-- listes des produits -->
    
            <div id="see-all-link" class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <a href="<?php echo base_url('View/page/frontoffice/search#search-form'); ?>">See All</a>
            </div>
        </div>
        <hr>
        <center>
            <a href="<?php echo base_url('View/page/frontoffice/search#search-form'); ?>">See All</a>
        </center>
    </div>
    <!-- produits recemment acheter -->
<?php } ?>
