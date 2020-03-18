<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home/index"><?php echo $PROJECT_NAME;?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          
    <?php foreach ($MENU_ARR as $MENU) { ?>
    
        <?php 
            if($MENU['link'] == ($CURRENT_CTRL.'/'.$CURRENT_MTD)){
                $class = 'class="active"';
            } else { 
                $class = '';
            } 
        ?>
        <?php if(empty($MENU['sub'])) { ?>
            <li <?php echo $class; ?>><a href="<?php echo $BASE_URL . $MENU['link'];?>"><?php echo $MENU['menu_name'];?></a></li>
        <?php } else { ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $MENU['menu_name'];?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php foreach ($MENU['sub'] as $MENU_SUB) { ?>
                        <li><a href="<?php echo $BASE_URL . $MENU_SUB['link'];?>"><?php echo $MENU_SUB['menu_name'];?></a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
            
    <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>