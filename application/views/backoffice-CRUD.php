
<!-- categories de produits -->
<div class="content col-lg-6 col-md-6">
    <h2>Products Categories</h2>
    <form method="get" action="<?php echo site_url();?>backoffice/Cat_product_Controller/insert_cat_product">
        <?php if(isset($cat_product_update)) { ?>
            <input type="hidden" name="id_cat_product_to_update" value="<?php echo $cat_product_update->get_id_cat_product();?>">
        <?php } ?>
        <div class="form-group">
            <input name="cat_product_name" class="form-control" type="text" class="form-control form-control-custom" <?php if(isset($cat_product_update)) { ?> value="<?php echo $cat_product_update->get_wording();?>" <?php } ?> placeholder="Enter the product categorie">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <br>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Wording</th>
                    <th></th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                if(isset($ls_cat_products)) {
                    foreach ($ls_cat_products as $cat_prod) { ?>
                        <tr>
                            <td><?php echo $cat_prod->get_wording();?></td>
                            <td id="btn"> <a href="<?php echo site_url();?>backoffice/Cat_product_Controller/form_update_cat_product/<?php echo $cat_prod->get_id_cat_product();?>"> <button class="btn"><img src="<?php echo site_url('assets/icons/edit-disable.png') ?>" alt=""></button> </a> </td>
                            <!-- <td id="btn"> <a href="<?php echo site_url();?>backoffice/Cat_product_Controller/delete_cat_product/<?php echo $cat_prod->get_id_cat_product();?>"> <button class="btn"><img src="<?php echo site_url('assets/icons/trash.png') ?>" alt=""></button> </a> </td> -->
                        </tr>
                <?php  } 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- categories de produits -->

<!-- categories de fruits -->
<div class="content col-lg-6 col-md-6">
    <h2>Fruits Categories</h2>
    <form method="get" action="<?php echo site_url();?>backoffice/Cat_fruit_Controller/insert_cat_fruit">
        <div class="form-group">
            <?php if(isset($cat_fruit_update)) { ?>
                <input type="hidden" name="id_cat_fruits_to_update" value="<?php echo $cat_fruit_update->get_id_cat_fruit();?>">
            <?php } ?>
            <input class="form-control" type="text" name="cat_fruits_name" <?php if(isset($cat_fruit_update)) { ?> value="<?php echo $cat_fruit_update->get_wording();?>" <?php } ?>  placeholder="Enter the fruit category">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <br>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Wording</th>
                    <th></th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <?php if(isset($ls_cat_fruits)) { 
                    foreach ($ls_cat_fruits as $cat_fruit) { ?>
                        <tr>
                            <td><?php echo $cat_fruit->get_wording(); ?></td>
                            <td id="btn"> <a href="<?php echo site_url();?>backoffice/Cat_fruit_Controller/form_update_cat_fruit/<?php echo $cat_fruit->get_id_cat_fruit();?>">  <button class="btn"><img src="<?php echo site_url('assets/icons/edit-disable.png'); ?>" alt="Edit"></button> </a></td>
                            <!-- <td id="btn"> <a href="<?php echo site_url();?>backoffice/Cat_fruit_Controller/delete_cat_fruit/<?php echo $cat_fruit->get_id_cat_fruit();?>"> <button class="btn"><img src="<?php echo site_url('assets/icons/trash.png'); ?>" alt="Delete"></button> </a></td> -->
                        </tr>
                    <?php } 
                } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- categories de fruits -->

<!-- produits finis -->
<div class="content col-lg-12">
    <h2>Finished Products</h2>
    <form class="col-lg-6 col-md-6" method="post" enctype="multipart/form-data" action="<?php echo site_url();?>backoffice/Finished_Product_Controller/insert_finished_product">
    <?php if(isset($update_finished_product)) { ?>
            <input type="hidden" name="update_mode" value="1">
    <?php } ?>
    
    <div class="form-group col-lg-6 col-mg-6">
            <label for="categorie">Fruits Categories</label>
            <select <?= isset($update_finished_product) ? 'disabled': '' ?> class="form-control" name="id_cat_fruits" id="categorie">
                <option value="">Chose your fruits categories</option>
                <?php if(isset($ls_cat_fruits)) { 
                    foreach ($ls_cat_fruits as $cat_fruit) {  ?>
                        <option value="<?php echo $cat_fruit->get_id_cat_fruit(); ?>" <?= isset($id_cat_fruit) && $cat_fruit->get_id_cat_fruit()==$id_cat_fruit ? 'selected' : '' ?>><?php echo $cat_fruit->get_wording(); ?></option>
                <?php   } } ?>
            </select>
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="categorie">Products Categories</label>
            <select <?= isset($update_finished_product) ? 'disabled': '' ?> class="form-control" name="id_cat_produits" id="categorie">
                <option value="">Chose your products categories</option>
                <?php 
                    if(isset($ls_cat_products)) {
                        foreach ($ls_cat_products as $cat_prod) { ?>
                <option value="<?php echo $cat_prod->get_id_cat_product(); ?>" <?= isset($id_cat_product) && $cat_prod->get_id_cat_product()==$id_cat_product ? 'selected' : '' ?>><?php echo $cat_prod->get_wording();?></option>
                <?php  }} ?>
            </select>
        </div>

        <div class="form-group">
            <label for="">Stock</label>
            <?php if(isset($id_product_to_update)) { ?>
            <input type="hidden" name="id_product_to_update" value="<?php echo $id_product_to_update;?>">
            <?php } ?>
            <input 

            class="form-control" type="number" name="stock" id="allonger" placeholder="Enter the stock (Kg)">
        </div>

        <div class="desc form-group col-lg-6 col-mg-6">
            <label for="">Description</label>
            
            <textarea <?= isset($update_finished_product) ? 'disabled': '' ?> class="form-control" name="description" id="" cols="30" rows="5" placeholder="Enter the stock (Kg)"></textarea>
        </div>
        <div class="desc form-group col-lg-6 col-mg-6">
            <label for="">Pictures details</label>
            <input class="form-control" type="file" name="pictures_details" id="" placeholder="Add a file">
        </div>

        <div class="form-group">
            <label for="">Charges by Kg</label>
            <?php if(isset($charges_update)) { ?>
            <input type="hidden" name="id_charges_to_update" value="<?php echo $charges_update->get_id_charges_movement();?>">
            <input type="hidden" name="charges_movement_date" value="<?php echo $charges_update->get_movement_date();?>">
            <?php } ?>
            <input
            <?php if(isset($charges_update)) { ?>
                 value="<?php echo $charges_update->get_price();?>"
                  <?php } ?>
            class="form-control" type="number" name="charges_by_kg" id="allonger" placeholder="Enter the charges (Ar)">
        </div>

        <div class="form-group col-lg-6 col-mg-6">
        <?php if(isset($detail_update)) { ?>
            <input type="hidden" name="id_detail_to_update" value="<?php echo $detail_update->get_id_detail_movement();?>">
            <input type="hidden" name="detail_movement_date" value="<?php echo $detail_update->get_movement_date();?>">
            <?php } ?>
            <label for="">Detail price(100g)</label>
            <input 
            <?php if(isset($detail_update)) { ?>
                 value="<?php echo $detail_update->get_price();?>"
                  <?php } ?>
            class="form-control" type="number" name="detail_price" placeholder="Enter the price (100 g)">
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Detail reduction</label>
            <input 
            <?php if(isset($detail_update)) { ?>
                 value="<?php echo $detail_update->get_reduction();?>"
                  <?php } ?>
            class="form-control" type="number" name="detail_reduction" placeholder="Enter the reduction (%)" min="0" max="100" value="0">
        </div>

        <div class="form-group col-lg-6 col-mg-6">
        <?php if(isset($wholesale_update)) { ?>
            <input type="hidden" name="id_wholesale_to_update" value="<?php echo $wholesale_update->get_id_wholesale_movement();?>">
            <input type="hidden" name="wholesale_movement_date" value="<?php echo $wholesale_update->get_movement_date();?>">
        
            <?php } ?>

            <label for="">Wholesale price(100g)</label>
            <input 
            
            <?php if(isset($wholesale_update)) { ?>
                 value="<?php echo $wholesale_update->get_price();?>"
                  <?php } ?>
            class="form-control" type="number" name="wholesale_price" placeholder="Enter the price (100 g)">
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Wholesale reduction</label>
            <input
            
            <?php if(isset($wholesale_update)) { ?>
                 value="<?php echo $wholesale_update->get_reduction();?>"
                  <?php } ?>
            class="form-control" type="number" name="wholesale_reduction" placeholder="Enter the reduction (%)" min="0" max="100" value="0">
        </div>

        <div class="form-group col-lg-6 col-mg-6">
        <?php if(isset($bulk_update)) { ?>
            <input type="hidden" name="id_bulk_to_update" value="<?php echo $bulk_update->get_id_bulk_movement();?>">
            <input type="hidden" name="bulk_movement_date" value="<?php echo $bulk_update->get_movement_date();?>">

            <?php } ?>

            <label for="">Bulk price(Kg)</label>
            <input
            <?php if(isset($bulk_update)) { ?>
                 value="<?php echo $bulk_update->get_price();?>"
                  <?php } ?>
            class="form-control" type="number" name="bulk_price" placeholder="Enter the price (Kg)">
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Bulk reduction</label>
            <input 
            <?php if(isset($bulk_update)) { ?>
                 value="<?php echo $bulk_update->get_reduction();?>"
                  <?php } ?> class="form-control" type="number" name="bulk_reduction" placeholder="Enter the reduction (%)" min="0" max="100" value="0">
        </div>
        <div class="form-group text-right"><button type="submit" class="btn btn-custom btn-lg">Submit</button></div>
    </form>
    <hr>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>Wording</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Charges</th>
                    <th>Details price</th>
                    <th>Wholesale price</th>
                    <th>Bulk price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
               if(isset($ls_product_configuration)) {
                        foreach ($ls_product_configuration as $prod_conf) { ?>
                <tr>
                    <td><?php echo $prod_conf['product_category']." ".$prod_conf['fruit_category']; ?></td>
                    <td>
                        <p><?php echo $prod_conf['product_description']; ?></p>
                        <p><?php echo $prod_conf['product_image_link']; ?></p>
                    </td>
                    <td><?php echo $prod_conf['stock_quantity']; ?></td>
                    <td><?php echo $prod_conf['charges_price']; ?></td>
                    <td>
                        <p><?php echo $prod_conf['detail_price']; ?></p>
                        <p class="reduction"><?php echo $prod_conf['detail_reduction']; ?>%</p>
                    </td>
                    <td>
                        <p><?php echo $prod_conf['wholesale_price']; ?></p>
                        <p class="reduction"><?php echo $prod_conf['wholesale_reduction']; ?>%</p>
                    </td>
                    <td>
                        <p><?php echo $prod_conf['bulk_price']; ?></p>
                        <p class="reduction"><?php echo $prod_conf['bulk_reduction']; ?>%</p>
                    </td>
                    <td id="btn">
                        <a href="<?php echo site_url();?>backoffice/Finished_Product_Controller/form_update_finished_product/<?php echo 
                            $prod_conf["product_id"]."/"
                            .$prod_conf["id_detail_movement"]."/"
                            .$prod_conf["id_wholesale_movement"]."/"
                            .$prod_conf["id_bulk_movement"]."/"
                            .$prod_conf["id_charges_movement"];?>">
                        <button class="btn"><img src="<?php echo site_url('assets/icons/edit-disable.png') ?>" alt="">
                        </button> </a> </td>
                    <td id="btn"><a href="<?php echo site_url();?>backoffice/Finished_Product_Controller/delete_finished_product/<?php echo 
                    $prod_conf["product_id"]; ?>"><button class="btn"><img src="<?php echo site_url('assets/icons/trash.png') ?>" alt=""></button></a></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</div>
<!-- produits finis -->

    