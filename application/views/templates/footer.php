        </div>
    </div>

        <!-- FOOTER -->
        <?php if ($application=='frontoffice') { ?>
            <div class="footer">
                <div class="footer-link">
                    <div id="discover" class="div-footer col-lg-4 col-md-4">
                        <h1>Discover <span class="logo">Dryfruit</span></h1>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#investitors') ?>">Investitors</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#about-us') ?>">About Us</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#about-us') ?>">Delivery</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/login#signup') ?>">Join Us</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#type-products') ?>">Type of Products</a></p>
                        
                    </div> 
                    <div id="legal-notices" class="div-footer col-lg-4 col-md-4">
                        <h1>Legal notices</h1>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#legal-notices') ?>">Legal notices</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#confidentiality') ?>">Confidentiality</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#cookies') ?>">Cookies</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#partners') ?>">Ranking of our partners</a></p>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#public-authorities-information-request') ?>">Public Authorities information requests</a></p>
                    </div> 
                    <div id="help" class="div-footer col-lg-4 col-md-4">
                        <h1>Help</h1>
                        <p><a href="<?php echo site_url('frontoffice/View/page/info#contact-us') ?>">Contact Us</a></p>
                    </div> 
                </div>
               <div class="text-right">
                    <h3>&copy; 2024 <span class="logo">Dryfruit</span> Media</h3>
               </div>
            </div>
        <?php } ?>
        <!-- FOOTER -->
    <?php for($i=0; $i<count($js); $i++) { ?>
        <script src="<?php echo site_url('assets/js/'.$js[$i]); ?>"></script>   
    <?php } ?>
</body>
</html>
