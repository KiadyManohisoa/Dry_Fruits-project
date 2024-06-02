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
            <div height="50px" class="col-lg-9 col-md-8 col-xs-4 col-sm-7" id="title">
                <a href="<?php echo base_url("View/page/".$application."/info") ?>">
                    <img height="35px" src="
                        <?php echo base_url('assets/icons/'.$title.".png") ?>
                    ">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-8 col-sm-5 last">
                <?php foreach ($nav_bar as $key => $value) { 
                    $width=18;
                    if ($value['action']=='enable') {
                        $width=24;
                    } ?>
                    <a href="<?php echo base_url("View/page/".$application."/".$value['wording']) ?>" class="btn btn-default form-component">
                        <center>
                            <img width="<?php echo $width ?>px" src="
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
    