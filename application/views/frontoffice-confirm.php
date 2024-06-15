<div class="content">
    <center>
        <a href="<?php if ($application=='frontoffice') { echo base_url("View/page/".$application."/info"); } else { echo base_url("View/page/".$application); } ?>">
            <img height="60px" src="
                <?php echo base_url('assets/icons/'.$title.".png") ?>
            ">
        </a>
        <hr>
        <div class="thanking">
            <img height="50px" src="<?php echo base_url('assets/icons/check.png') ?>">
            <h2>Thank you!</h2>
            <p>Your payment was successful We’ll email you a receipt confirming your payment and the date for your delivery shortly</p>
        </div>
        <hr>
        <a href="<?php echo base_url("View/page/frontoffice/home"); ?>">Continue</a>
    </center>
</div>