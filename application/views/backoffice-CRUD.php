<!-- categories de produits -->
<div class="content col-lg-6 col-md-6">
    <h2>Products Categories</h2>
    <form method="get" action="<?php echo site_url();?>index.php/Cat_Produit_Controller/insert_Cat_Produit">
        <?php if(isset($cat_produit_update)) { ?>
            <input type="hidden" name="id_cat_product_to_update" value="<?php echo $cat_produit_update->id;?>">
        <?php } ?>
        <div class="form-group">
            <input name="cat_product_name" class="form-control" type="text" class="form-control form-control-custom" <?php if(isset($cat_produit_update)) { ?> value="<?php echo $cat_produit_update->libelle;?>" <?php } ?> placeholder="Enter the product categorie">
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ls_cat_prod as $cat_prod) { ?>
                    <tr>
                        <td><?php echo $cat_prod->libelle;?></td>
                        <td id="btn"> <a href="<?php echo site_url();?>index.php/Cat_Produit_Controller/form_Update_Cat_Produit/<?php echo $cat_prod->id;?>"> <button class="btn"><img src="<?php echo base_url('assets/icons/edit-disable.png') ?>" alt=""></button> </a> </td>
                        <td id="btn"> <a href="<?php echo site_url();?>index.php/Cat_Produit_Controller/delete_Cat_Produit/<?php echo $cat_prod->id;?>"> <button class="btn"><img src="<?php echo base_url('assets/icons/trash.png') ?>" alt=""></button> </a> </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- categories de produits -->

<!-- categories de fruits -->
<div class="content col-lg-6 col-md-6">
    <h2>Fruits Categories</h2>
    <form method="get" action="<?php echo site_url();?>index.php/Cat_Fruit_Controller/insert_Cat_Fruit">
        <div class="form-group">
            <?php if(isset($cat_fruit_update)) { ?>
                <input type="hidden" name="id_cat_fruits_to_update" value="<?php echo $cat_fruit_update->get_Id(); ?>">
            <?php } ?>
            <input class="form-control" type="text" name="cat_fruits_name" <?php if(isset($cat_fruit_update)) { ?> value="<?php echo $cat_fruit_update->get_Libelle();?>" <?php } ?>  placeholder="Enter the fruit category">
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($ls_cat_fruits)) { 
                    foreach ($ls_cat_fruits as $cat_fruit) { ?>
                        <tr>
                            <td><?php echo $cat_fruit['libelle']; ?></td>
                            <td id="btn"> <a href="<?php echo site_url();?>index.php/Cat_Fruit_Controller/form_Update_Cat_Fruit/<?php echo $cat_fruit['id'];?>">  <button class="btn"><img src="<?php echo base_url('assets/icons/edit-disable.png'); ?>" alt="Edit"></button> </a></td>
                            <td id="btn"> <a href="<?php echo site_url();?>index.php/Cat_Fruit_Controller/delete_Cat_Fruit/<?php echo $cat_fruit['id'];?>"> <button class="btn"><img src="<?php echo base_url('assets/icons/trash.png'); ?>" alt="Delete"></button> </a></td>
                        </tr>
                    <?php } 
                } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- categories de fruits -->

<!-- porduits finis -->
<div class="content col-lg-12">
    <h2>Finished Products</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group col-lg-6 col-mg-6">
            <label for="categorie">Fruits Categories</label>
            <select class="form-control" name="" id="categorie">
                <option value="">Strawberries</option>
            </select>
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="categorie">Products Categories</label>
            <select class="form-control" name="" id="categorie">
                <option value="">Dried</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Stock</label>
            <input class="form-control" type="text" name="" id="allonger" placeholder="Enter the stock (Kg)">
        </div>

        <div class="desc form-group col-lg-6 col-mg-6">
            <label for="">Desciption</label>
            <textarea class="form-control" name="" id="" cols="30" rows="5" placeholder="Enter the stock (Kg)"></textarea>
        </div>
        <div class="desc form-group col-lg-6 col-mg-6">
            <label for="">Pictures details</label>
            <input class="form-control" type="file" name="" id="" placeholder="Add a file">
        </div>

        <div class="form-group">
            <label for="">Charges by Kg</label>
            <input class="form-control" type="text" name="" id="allonger" placeholder="Enter the charges (Ar)">
        </div>

        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Detail price(100g)</label>
            <input class="form-control" type="text" name="" placeholder="Enter the price (Kg)">
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Detail reduction</label>
            <input class="form-control" type="text" name="" placeholder="Enter the reduction (%)">
        </div>

        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Wholesale price(100g)</label>
            <input class="form-control" type="text" name="" placeholder="Enter the price (Kg)">
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Wholesale reduction</label>
            <input class="form-control" type="text" name="" placeholder="Enter the reduction (%)">
        </div>

        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Bluck price(100g)</label>
            <input class="form-control" type="text" name="" placeholder="Enter the price (Kg)">
        </div>
        <div class="form-group col-lg-6 col-mg-6">
            <label for="">Bluck reduction</label>
            <input class="form-control" type="text" name="" placeholder="Enter the reduction (%)">
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
                    <th>Bluck price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dry Strawberries</td>
                    <td>
                        <p>Blabla</p>
                        <p>img.link</p>
                    </td>
                    <td>xxx kg</td>
                    <td>xx xxx Ar</td>
                    <td>
                        <p>x xxx Ar</p>
                        <p class="reduction">-0%</p>
                    </td>
                    <td>
                        <p>x xxx Ar</p>
                        <p class="reduction">-0%</p>
                    </td>
                    <td>
                        <p>x xxx Ar</p>
                        <p class="reduction">-0%</p>
                    </td>
                    <td id="btn"><button class="btn"><img src="<?php echo base_url('assets/icons/edit-disable.png') ?>" alt=""></button></td>
                    <td id="btn"><button class="btn"><img src="<?php echo base_url('assets/icons/trash.png') ?>" alt=""></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- porduits finis -->

    