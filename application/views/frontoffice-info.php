<!-- investisseurs -->
<div class="dark-content products-defiler" id="investitors">
    <div class="title">
        <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">Ours investitors</h3>
        <div class="text-right col-lg-3 col-md-3 col-sm-8 col-xs-8">
        <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?php echo site_url('assets/icons/chevron-left.png') ?>"></button>
        <button class="btn btn-default btn-conrtrol next-btn"><img src="<?php echo site_url('assets/icons/chevron-right.png') ?>"></button>
        </div>
    </div>
    <div class="product-container row defiler">
        <!-- listes des investisseurs -->
         <?php foreach($investissors as $investissor) { ?>
            <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="product-img" style="background-image: url('<?php echo site_url('assets/images/'.$investissor['picture']);?>')">
                </div>
                <div class="product-desc">
                    <h4><?=$investissor['fullName'];?></h4>
                    <a href=""><?=$investissor['userName'];?></a>
                </div>
            </div>
        <?php } ?>

        <!-- listes des investisseurs -->

    </div>
</div>
<!-- investisseurs -->

<!-- a propos -->
<div class="dark-content" id="about-us">
    <h3>About us</h3>
    <?php foreach($about_us as $key => $value) { ?>
        <h4> <?=$key;?> : <?=$value;?> </h4>
    <?php } ?>
</div>
<!-- a propos -->

<!-- teams -->
<div class="dark-content products-defiler" id="investitors">
    <div class="title">
        <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">Ours teams</h3>
        <div class="text-right col-lg-3 col-md-3 col-sm-8 col-xs-8">
        <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?php echo site_url('assets/icons/chevron-left.png') ?>"></button>
        <button class="btn btn-default btn-conrtrol next-btn"><img src="<?php echo site_url('assets/icons/chevron-right.png') ?>"></button>
        </div>
    </div>
    <div class="product-container row defiler">
        <!-- listes des teams -->

         <?php foreach($team as $teammate) { ?>
            <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="product-img" style="background-image: url('<?php echo site_url('assets/images/'.$teammate['picture']);?>')">
            </div>
            <div class="product-desc">
                <h4><?=$teammate['name'].' '.$teammate['firstname'];?></h4>
                <a href=""><?=$teammate['email'];?></a>
            </div>
        </div>
        <?php } ?>

        <!-- listes des teams -->

    </div>
</div>
<!-- teams -->

<!-- legal notices -->
<div class="dark-content" id="legal-notices">
    <h3>Legal notices</h3>
    <?php foreach($legal_notices as $key => $value) { ?>
        <h4> <?=$key;?> : <?=$value;?> </h4>
    <?php } ?>
</div>
<!-- legal notices -->

<!-- Demande d'informations des autorités publiques -->
<div class="dark-content" id="public-authorities-information-request">
    <h3>Public authorities information request</h3>
    <?php foreach($public_authorities as $key => $value) { ?>
        <h4> <?=$key;?> : <?=$value;?> </h4>
    <?php } ?>
</div>
<!-- Demande d'informations des autorités publiques -->

<!-- confidentialite -->
<div class="dark-content" id="confidentiality">
    <h3>Confidentiality</h3>
    <?php foreach($confidentiality as $key => $value) { ?>
        <h4> <?=$key;?> : <?=$value;?> </h4>
    <?php } ?>
</div>
<!-- confidentialite -->

<!-- coockies -->
<div class="dark-content" id="cookies">
    <h3>Cookies</h3>
    <?php foreach($cookies as $key => $value) { ?>
        <h4> <?=$key;?> : <?=$value;?> </h4>
    <?php } ?>
</div>
<!-- coockies -->

<!-- contact et localisation -->
<div class="dark-content" id="contact-us">
    <div class="col-lg-6 col-md-6">
        <h3>Contact Us</h3>
        <div class="small-div">
            <p id="small-div-p"> <?=$about_us['Email']?> </p>
            <p id="small-div-p"> <?=$about_us['Phone number']?> </p>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <h3>Location</h3>
        <div class="small-div">
            <p id="small-div-p"> <?=$about_us['Location']?> </p>
        </div>
    </div>
    <hr>
</div>
<!-- contact et localisation -->

<!-- type de produits -->
<div class="dark-content" id="type-products">
    <h3>Type of products</h3>
    <?php foreach($type_of_products as $type_product)  { ?>
        <div class="col-lg-6 col-md-6">
        <div class="small-div">
            <p id="small-div-p"><?=$type_product['type'];?></p>
        </div>
        <hr>
    </div> 
    <?php } ?>
    <hr>
</div>
<!-- type de produits -->

<!-- partenaires -->
<div class="dark-content products-defiler" id="partners">
    <div class="title">
        <h3 class="col-lg-9 col-md-9 col-sm-4 col-xs-4">Ranking of our partners</h3>
        <div class="text-right col-lg-3 col-md-3 col-sm-8 col-xs-8">
        <button class="btn btn-default btn-conrtrol prev-btn"><img src="<?php echo site_url('assets/icons/chevron-left.png') ?>"></button>
        <button class="btn btn-default btn-conrtrol next-btn"><img src="<?php echo site_url('assets/icons/chevron-right.png') ?>"></button>
        </div>
    </div>
    <div class="product-container row defiler">
        <!-- listes des partenaires -->

        <?php foreach($partners as $partner) { ?>
            <div class="product col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="product-img" style="background-image: url('<?php echo site_url('assets/images/'.$partner['picture']);?>')">
                </div>
                <div class="product-desc">
                    <h4><?=$partner['name'];?></h4>
                </div>
            </div>
        <?php } ?>


        <!-- listes des partenaires -->

    </div>
</div>
<!-- partenaires -->
