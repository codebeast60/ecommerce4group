<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/icons/favicon.png" />
    <title><?php echo getTitle(); ?></title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css">
    <link rel="stylesheet" href="<?php echo $css; ?>all.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>maicons.css">
    <link rel="stylesheet" href="<?php echo $css; ?>frontend.css">
    <link rel="stylesheet" href="<?php echo $css; ?>slide.css">

    <link rel="stylesheet" href="layout/vendors/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="layout/vendors/animate/animate.css">


    <link rel="stylesheet" href="<?php echo $css;
                                    loading() ?>">
    <link rel="stylesheet" href="<?php echo $css; ?>/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />








    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5851579625117417" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md ps-4 sticky-top navbar-dark h-lg-auto">
        <div class="container">
            <a class="navbar-brand" href="home.php">e<span style="color:red;font-size:24px">C</span>ommerce<i class="fa-solid fa-4 fs-3"></i>group.com</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="about.php">about us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu drop-nav">
                            <?php
                            $categories =  getAllFrom("*", "categories", "where parent = 0", "", "ID", "ASC");
                            foreach ($categories as $cat) { ?>
                                <li>
                                    <a class="dropdown-item" href="categories.php?pageid=<?php echo $cat['ID'] ?>"><?php echo $cat['Name']; ?>

                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>
                </ul>



                <div class="search pe-lg-4 pb-1">
                    <form action="itemsearch.php" method="POST" autocomplete="off">
                        <input type="text" name="search" placeholder="Search . . ." required>
                        <input type="submit" name="submit" class="go">
                    </form>


                </div>
                <?php
                if (isset($_SESSION['user'])) { ?>
                    <ul class="list-unstyled">
                        <li class="nav-item dropdown ps-2 ">
                            <a class="nav-link dropdown-toggle mt-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php $sql = "SELECT image FROM users WHERE userID = '$_SESSION[uid]'";
                                $result = mysqli_query($conn, $sql);
                                $rows =  mysqli_fetch_assoc($result);

                                if (empty($rows['image'])) {
                                    echo '<img class="rounded-circle" src="no-image.png" style="width:40px" alt="Profile">';
                                } else {
                                    echo "<img class='rounded-circle ' style='max-width:35px' src='admin/uploads/avatars/" . $rows['image'] . "'alt=''>";
                                }
                                echo "<span class='ps-2'>" . $sessionUser . "</span> ";
                                ?>
                                <?php  ?>
                            </a>
                            <ul class="dropdown-menu drop-nav">
                                <li><a class="dropdown-item" href="profile.php">My profile</a></li>
                                <?php $userStatus = checkUserStatus($sessionUser);
                                if ($userStatus == 0) {
                                    echo '
                                <li><a class="dropdown-item" href="newad.php">New item</a></li>';
                                } ?>
                                <li><a class="dropdown-item" href="profile.php#my-ads">My ads</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item logout" href="login/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php
                } else { ?>
                    <a class="btn main-btn btn-primary rounded-pill mt-sm-1 ps-3 " href="login/login-user.php">Login / signup</a>
            </div>
        <?php } ?>
        </div>
    </nav>
    <?php
    $userStatus = checkUserStatus($sessionUser); // variable taba3 if isset tba3 session['user'] user hata esta3mlou bkel application
    if ($userStatus == 1) {
        echo '
    <div class="check-status float-end position-absolute text-white end-0">
        your Membership needs to activate by admin
    </div>';
    } ?>