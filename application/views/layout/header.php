<html lang="en" class="">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 5.0, user-scalable = yes">
        <link rel="shortcut icon" type="image/png" href="">
        <link rel="stylesheet" href="<?php echo $PUBLIC_URL . 'plugins/font-awesome/css/font-awesome.min.css';?>" type="text/css">
        <link rel="stylesheet" href="<?php echo $PUBLIC_URL . 'plugins/bootstrap/css/bootstrap.css';?>" type="text/css">
        <link rel="stylesheet" href="<?php echo $PUBLIC_URL . 'plugins/bootstrap/css/bootstrap.min.css';?>" type="text/css">
        <link rel="stylesheet" href="<?php echo $PUBLIC_URL . 'plugins/bootstrap/css/bootstrap-theme.min.css';?>" type="text/css">
        <link rel="stylesheet" href="<?php echo $PUBLIC_URL . 'css/app.css';?>" type="text/css">
        
    </head>
    <body>
        <script src="<?php echo $PUBLIC_URL . 'js/jquery.min.js';?>"></script>
        <script src="<?php echo $PUBLIC_URL . 'plugins/bootstrap/js/bootstrap.min.js';?>"></script>
        <!--<script src="<?php echo $PUBLIC_URL . 'plugins/jquery-validation/dist/jquery.validate.min.js';?>"></script>-->
        
        <?php if($LOG_USER_ID && !$FROM_MOBILE){ ?>
        <?php include APPPATH.'views/layout/menu.php'; ?>
        <?php } ?>

        <?php if($MESSAGE_DETAILS){ ?>
            <?php if($MESSAGE_STATUS){ ?>
                <?php if($MESSAGE_TYPE){  ?>
                    <?php $message_class = 'errorHandler alert alert-success'; ?>
                <?php } else { ?>
                    <?php $message_class = 'errorHandler alert alert-danger'; ?>
                <?php } ?>
                <div class="col-sm-12" style="margin: 5px 5px 5px 5px;">
                    <div id="message_box"  class="<?php echo $message_class; ?>">
                        <div id="message_note">                           
                            <?php echo $MESSAGE_DETAILS; ?>
                        </div>
                        <a href="#" id= "close_link" class="panel-close pull-right" style="margin-top: -18px;"> 
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        <?php }  ?>