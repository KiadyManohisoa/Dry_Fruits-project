<!-- services rating -->
    <div class="content container-fluid rating-div">
        <!-- Ratings & Reviews -->
        <div class="col-lg-4 col-md-4">
            <h1>Ratings & Reviews</h1>
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
            <h3>Client remarks</h3>
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
<!-- services rating -->

<!-- recherche de clients -->
<div class="content">
    <h2>Clients Search</h2>
    <form class="col-lg-6 col-md-6" action="<?php echo site_url("backoffice/Clients_Search_Controller/search");?>" method="post">
        <div class="form-group">
            <input class="form-control" type="text" name="client_name" placeholder="Enter the client full name">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <hr>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Purchases</th>
                    <th>Date last activities</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($clients) && !empty($clients)) {
                    ?>
                    <?php foreach($clients as $client) { ?>
                        <tr>
                            <td><a href="<?php echo site_url('backoffice/Clients_Search_Controller/client_info/' . $client->get_id_client() . '/'); ?>"><?php echo $client->get_id_client(); ?></a></td>
                            <td><?php echo $client->get_full_name(); ?></td>
                            <td><?php echo $client->get_mail(); ?></td>
                            <td><?php echo $client->get_phone_number(); ?></td>
                            <td><?php echo $client->get_purchases();?></td>
                            <td><?php echo $client->get_last_activites();?></td>
                        </tr>
                    <?php } ?>
                <?php } else if(isset($clients) && empty($clients)) { ?>
                        <tr>
                            <td>No clients found</td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- recherche de clients -->

<!-- bilan de production -->
<div class="content">
    <h2>Production situation report</h2>
    <form class="col-lg-6 col-md-6"  method="post" action="<?php echo site_url("backoffice/Production_balance_Controller/form_get_Production_balance");?>" >
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="date">Date</label>
            <input class="form-control" name="search_date" id="date" type="date">
        </div>
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="categorie">Products Categories</label>
            <select class="form-control" name="product_category" id="categorie">
                <option value="">Chose your products categories</option>
                <?php 
                    if(isset($ls_cat_products)) {
                        foreach ($ls_cat_products as $cat_prod) { ?>
                <option value="<?php echo $cat_prod->get_id_cat_product(); ?>"><?php echo $cat_prod->get_wording();?></option>
                <?php  }} ?>
            </select>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <hr>
    <div id="table">
        <?php if (isset($date_search)) { ?>
            <h3>Results for <?php echo $date_search;?></h3>
        <?php } ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Wording</th>
                    <th>Stock</th>
                    <th>Out</th>
                    <th>Sales</th>
                    <th>Charges</th>
                    <th>Sales Amount</th>
                    <th>Results</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($Production_balance)){ ?>
                <?php foreach($Production_balance as $balance) {?>
                <tr>
                    <td><?php echo $balance->get_product(); ?>  </td>
                    <td><?php echo $balance->get_stock(); ?> kg</td>
                    <td><?php echo $balance->get_out(); ?> kg</td>
                    <td><?php echo $balance->get_sales(); ?> pts</td>
                    <td><?php echo $balance->get_charges(); ?> Ar</td>
                    <td><?php echo $balance->get_sales_amount() ?> Ar</td>
                    <td><?php echo $balance->get_results(); ?> Ar</td>
                </tr>
                <?php }  }?>
            </tbody>
        </table>
    </div>

</div>
<!-- bilan de production -->



<!-- bilan general -->
<div class="content" ng-app="statApp" ng-controller="GraphController">
    <h2>General Report</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group">
            <input class="form-control" type="month" id="stat-date" class="form-control form-control-custom">
        </div>
        <div class="form-group text-right">
            <button class="btn btn-custom btn-lg" type="button" ng-click="getGraph()" >Submit</button>
        </div>
    </form>
    <hr>
    <div class="results">
        <p>Monthly sales: <span id="sales">xx xxxx Ar</span></p>
        <p>Monthly charges: <span id="charges">xx xxxx Ar</span></p>
        <p>Monthly results: <span id="results">xx xxxx Ar</span></p>
        <h4>Sales figures : <span id="sales_figures"></span></h4>
    </div>
    <div class="chart-container">
        <center>
            <canvas id="global-chart" width="400" height="200"></canvas>
            <h3>Graph of evolution of Sales - Charges - Results</h3>
        </center>
    </div>

    <div class="chart-container">
        <center>
            <canvas id="sales-chart" width="400" height="200"></canvas>
            <h3>Graph of evolution of Sales figures</h3>
        </center>
    </div>
</div>
<!-- bilan general -->