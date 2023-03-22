<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php"><?php echo lang('HOME_ADMIN') ?></a>
        </div>
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">

                <li><a href="categories.php">
                        <ion-icon name="copy-outline"></ion-icon> <?php echo lang('CATEGORIES') ?>
                    </a></li>
                <li><a href="Items.php">
                        <ion-icon name="pricetag-outline"></ion-icon> <?php echo lang('ITEMS') ?>
                    </a></li>
                <li><a href="Members.php">
                        <ion-icon name="person-add-outline"></ion-icon> <?php echo lang('MEMBERS') ?>
                    </a></li>
                <li><a href="comments.php">
                        <ion-icon name="clipboard-outline"></ion-icon> <?php echo lang('COMMENTS') ?>
                    </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['userName'] ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../index.php">visit shop</a></li>
                        <li><a href="Members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">Edit Profile </a></li>
                        <li><a href="#">settings </a></li>
                        <li><a href="logout.php">Logout </a></li>
                    </ul> 
                </li>
            </ul>
        </div>
    </div>
</nav>