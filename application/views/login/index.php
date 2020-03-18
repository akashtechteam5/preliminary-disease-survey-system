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
        <input type="hidden" name="base_url" id="base_url" value="<?php echo $BASE_URL;?>">
        <input type="hidden" name="img_src_path" id="img_src_path" value="<?php echo $PUBLIC_URL;?>">
        
        <div class="container w-xxl">
            <div class=" app-header-fixed"></div>
            
            <div class=" app-header-fixed"></div>
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
            <!--<div class="navbar-brand_login block m-t"> <img src=""> </div>-->
            <div class="m-b-lg">
                <form action="<?php echo $BASE_URL . 'login/verifylogin';?>" class="" id="login-form" name="login_form" autocomplete="off" method="post" accept-charset="utf-8" novalidate="novalidate">

                <input type="password" style="display:none">
                <input type="text" style="display:none">
                <div class="text-danger wrapper text-center" ng-show="authError"> </div>

                <div class="list-group form-group">
                    <div class="list-group-item">
                        <input type="text" name="username" id="username" autocomplete="Off" size="32" maxlength="128" placeholder="Username" value="" class="form-control no-border">
                    </div>
                    <div class="list-group-item form-group">
                        <input type="password" name="password" id="password" size="32" maxlength="32" placeholder="Password" class="form-control no-border password">
                    </div>
                </div>
                <div class="m-t-xxl">
                    <input type="submit" id="user_login" name="user_login" value="Submit" class="btn btn-lg btn-primary btn-block">
                </div>
                </form>

                <div class="line line-dashed"></div>

            </div>
            <div class="text-center"></div>
        </div>
        <script>
            jQuery(document).ready(function () {
                jQuery("#close_link").click(function () {
                    jQuery("#message_box").fadeOut(1000);
                });
            });
        </script>
        <div class="col-sm-12 text-center"> 
            <small class="text-muted ">2020 © IOSS</small> 
        </div>
    </body>
</html>