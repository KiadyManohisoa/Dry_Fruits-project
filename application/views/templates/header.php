<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <?php 
        for($i=0;$i < count($css);$i++) { ?>
            <link href="<?php echo base_url('assets/css/'.$css[$i]); ?>" rel="stylesheet" type="text/css" media="screen"/>
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo base_url('assets/icons/'.$title."-icon.png") ?>" />
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="row">
            <div height="50px" class="col-lg-3 col-md-3 col-xs-3 col-sm-3" id="title">
                <a href="<?php if ($application=='frontoffice') { echo base_url("index.php/backoffice/View/page/".$application."/info"); } else { echo base_url("index.php//View/page/".$application); } ?>">
                    <img height="35px" src="
                        <?php echo base_url('assets/icons/'.$title.".png") ?>
                    ">
                </a>
            </div>
            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9 last">
                <?php foreach ($nav_bar as $key => $value) { ?>
                    <a href="<?php echo base_url("index.php/backoffice/View/page/".$application."/".$value['wording']) ?>" class="btn btn-default form-component">
                        <center>
                            <img class="<?php echo $value['action'] ?>" src="
                            <?php echo base_url('assets/icons/'.$key."-".$value['action'].".png") ?>
                            ">
                            <p><?php echo $value['wording'] ?></p>
                        </center>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- HEADER -->

    <div class="container-fluid">
        <div class='row'>
    