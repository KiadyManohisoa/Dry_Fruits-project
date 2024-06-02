        </div>
    </div>

        <!-- FOOTER -->
        <?php if ($application=='frontoffice') { ?>
            <center id="footer">
                <p><Strong>OC-정의</Strong> will help you configurate your characters's fitures. Don't hesitate to <a href="">learn more</a></p>
            </center>
        <?php } ?>
        <!-- FOOTER -->
    <?php for($i=0; $i<count($js); $i++) { ?>
        <script src="<?php echo base_url('assets/js/'.$js[$i]); ?>"></script>   
    <?php } ?>
</body>
</html>
