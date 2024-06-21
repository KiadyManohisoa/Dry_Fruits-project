<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <?php 
        for($i=0;$i < count($css);$i++) { ?>
            <link href="<?php echo site_url('assets/css/'.$css[$i]); ?>" rel="stylesheet" type="text/css" media="screen"/>
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo site_url('assets/icons/'.$title."-icon.png") ?>" />

    <script>
        var site_url = '<?php echo site_url(); ?>';
        var client_favoris = [];
    <?php if (isset($client_favoris)) { ?>
        client_favoris = JSON.parse('<?php echo json_encode($client_favoris); ?>');
    <?php } ?>
    </script>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="row">
            <div height="50px" class="col-lg-3 col-md-3 col-xs-3 col-sm-3" id="title">
                <a href="<?php echo $application==='frontoffice' ? site_url("/frontoffice/View/page/info") : site_url("/backoffice/View/page/home") ?>">
                    <img height="35px" src="
                        <?php echo site_url('assets/icons/'.$title.".png") ?>
                    ">
                </a>
            </div>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9 last">
                <?php foreach ($nav_bar as $key => $value) { ?>
                    <a href="<?php echo site_url("/".$application."/View/page/".$value['wording']) ?>" class="btn btn-default form-component">
                        <center>
                            <img class="<?php echo $value['action'] ?>" src="
                            <?php echo site_url('assets/icons/'.$key."-".$value['action'].".png") ?>
                            ">
                            <p><?php echo $value['wording'] ?></p>
                        </center>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- HEADER -->

    <div class="container-fluid" <?php echo $application === "frontoffice" ? 'ng-app="frontofficeApp" ng-controller="heartController"' : ''?> >
        <div class='row'>

        <!-- Modal d'exception -->
        <div id="ExceptionModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">Error</h3>
                        </div>
                        <div class="modal-body">
                            <h5 id="exception"><?php echo isset($error) ? $error : '' ?></h5>
                            <div class="form-group text-right">
                                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-custom">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    