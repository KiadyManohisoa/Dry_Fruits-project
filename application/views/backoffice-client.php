<?php $client = false; if($client) {?>
<!-- a propos de l'utilisateur -->
<div class="content">
    <center class="col-lg-3 col-md-3 col-sm-4">
        <div class="user-img" style="background-image: url('<?php echo base_url('assets/images/image.jpg') ?>')"></div>
        <hr>
    </center>
    <div class="col-lg-9 col-md-9 col-sm-8">
        <h3>Personal information</h3>
        <div class="form-group col-lg-6 col-md-6 col-sm-6">
            <h5>Email</h5>
            <p>NinjasKappable@gmail.com</p>
        </div>

        <div class="form-group col-lg-4 col-md-4 col-sm-6">
            <h5>Phone number</h5>
            <p>933923223</p>
        </div>

        <div class="form-group col-lg-12 col-md-12">
            <h5>Full Name</h5>
            <p>Ninjas Kappable</p>
        </div>
    </div>
    <hr>
</div>
<!-- a propos de l'utilisateur -->

    <!-- basket-link -->
    <div class="content">
        <h3>My Basket history</h3>
    <!-- list des paniers -->
        <div class="content basket-history">
            <a href="" class="btn basket-link">
                <h4>Basket-ID-xxxxx</h4>
                <p>xx-xx-xxxx</p>
                <div class="form-group col-lg-6 col-md-6 col-sm-8">
                    <h3>SHIP</h3>
                    <p>ninja@impekable.com, 933923223</p>
                    <h5>10 N. Martingale Road, Suite 400, Schaumburg, IL 60173</h5>
                </div>
    
                <div class="form-group col-lg-6 col-md-6 col-sm-4">
                    <h3>PAYMENT</h3>
                    <h5>Mobile money</h5>
                    <p>933923223</p>
                </div>
                <hr>
            </a>
    
            <a href="" class="btn basket-link">
                <h4>Basket-ID-xxxxx</h4>
                <p>xx-xx-xxxx</p>
                <div class="form-group col-lg-6 col-md-6 col-sm-8">
                    <h3>SHIP</h3>
                    <p>ninja@impekable.com, 933923223</p>
                    <h5>10 N. Martingale Road, Suite 400, Schaumburg, IL 60173</h5>
                </div>
    
                <div class="form-group col-lg-6 col-md-6 col-sm-4">
                    <h3>PAYMENT</h3>
                    <h5>PayPal</h5>
                </div>
                <hr>
            </a>
            
        </div>
        
    <!-- list des paniers -->

    </div>
    <!-- basket-link -->
<?php } else {
    redirect(base_url('View/page/backoffice/home'));
} ?>