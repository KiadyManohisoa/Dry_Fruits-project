<!-- livraison en attente -->
<div class="content col-lg-6 col-md-6">
    <h2>Lists of pending baskets</h2>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Baskets</th>
                </tr>
            </thead>
            <tbody>
                    <?php if(isset($pending_baskets)){
                        foreach($pending_baskets as $pending){ ?>
                        <tr>
                            <td><?php echo  $pending['delivery_date'] ;?></td>
                            <td><a href="<?php echo site_url('backoffice/Delivery_Controller/basket_link/'.$pending['order_id']);?>">Baskets-<?php echo $pending['order_id']; ?> </a></td>
                        </tr>
                      <?php } } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- livraison en attente -->

<!-- deja livree -->
<div class="content col-lg-6 col-md-6">
    <h2>Lists of delivered baskets</h2>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Baskets</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($delivered_baskets)){
                        foreach($delivered_baskets as $delivered){ ?>
                    <tr>
                        <td><?php echo  $delivered['delivery_date'] ;?></td>
                        <td><a href="<?php echo site_url('backoffice/Delivery_Controller/basket_link/'.$delivered['order_id']);?>">Baskets-<?php echo $delivered['order_id']; ?> </a></td>
                    </tr>
                      <?php  } }  ?>

            </tbody>
        </table>
    </div>
</div>
<!-- deja livree -->

<!-- livraison a faire -->
<div class="content col-lg-12">
    <h2>Delivery managment</h2>
    <form class="col-lg-6 col-md-6" method="post" action="<?php echo site_url();?>backoffice/Delivery_Controller/get_delivery">
        <div class="form-group">
            <input class="form-control" type="date" class="form-control form-control-custom" name="date_rechercher">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <hr>
    <div id="table" ng-app="deliveryckeckApp" ng-controller="checkedController">
        <table class="table">
            <thead>
                <tr>
                    <th>Client full name</th>
                    <th>Adress</th>
                    <th>Baskets</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                 
                <?php if(isset($deliveries_management)){
                    foreach($deliveries_management as $deliverie_management){ ?>

                    <tr>
                        <td><?php echo $deliverie_management['client_full_name']; ?></td>
                        <td><?php echo $deliverie_management['delivery_address']; ?></td>
                        <td><a href="<?php echo site_url('backoffice/Delivery_Controller/basket_link/'.$deliverie_management['order_id']);?>">Baskets-<?php echo $deliverie_management['order_id']; ?> </a></td>
                        <td>
                            <label for="<?= $deliverie_management['delivery_id'];?>" class="round-check" href="#">
                                <input type="checkbox" class="delivery-check" <?= $deliverie_management['delivery_status'] == 1 ? 'checked' : '' ?> id="<?= $deliverie_management['delivery_id'];?>">
                                <span></span>
                            </label>
                            
                        </td>
                    </tr>

                 <?php  }
                }  ?>

            </tbody>
        </table>
    </div>
</div>
<!-- livraison a faire -->