        </div>
    </div>

        <!-- FOOTER -->
        <?php if ($application=='frontoffice') { ?>
            <center id="footer">
                
            </center>
        <?php } ?>
        <!-- FOOTER -->
    <?php for($i=0; $i<count($js); $i++) { ?>
        <script src="<?php echo base_url('assets/js/'.$js[$i]); ?>"></script>   
    <?php } ?>
</body>
</html>
