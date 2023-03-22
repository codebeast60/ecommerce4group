<?php
ob_start();
session_start();
$pageTitle = 'show items';
$page = '';
@$userid = $_SESSION['user'];
include 'init.php';

$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
$sql =   "SELECT 
                items.*, categories.Name  AS category_name, users.*
        FROM 
                items
        INNER JOIN
                categories
        ON
                categories.ID = items.Cat_ID
        INNER JOIN
                users
        ON
                users.userID = items.Member_ID
        WHERE 
                item_ID ='$itemid'
        AND
                Approve = 1 ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
if ($count > 0) {
    $item = mysqli_fetch_assoc($result);





?>

    <h1 class="text-center"><?php echo $item['Name'] ?></h1>
    <div class="container">
        <div class="row">
            <!-- item -->
            <div class="col-md-8">
                <div class="w3-content block2-pic hov-img0" style="max-width:600px;">
                    <a href="admin/uploads/items/<?php echo $item['itemPics']; ?>" target="_blanck">
                        <img class="mySlides" src="admin/uploads/items/<?php echo $item['itemPics'] ?> " style="width:350px;height:370px">
                    </a>
                    <a href="admin/uploads/items/<?php echo $item['itemPics2']; ?>" target="_blanck">
                        <img class="mySlides" src="admin/uploads/items/<?php echo $item['itemPics2'] ?> " style="width:350px;height:370px">
                    </a>

                    <a href="admin/uploads/items/<?php echo $item['itemPics3']; ?>" target="_blanck">
                        <img class="mySlides" src="admin/uploads/items/<?php echo $item['itemPics3'] ?> " style="width:350px;height:370px">
                    </a>

                </div>

                <div class="w3-center mt-4" style="position:relative;width:350px">
                    <div class="w3-section mt-2">
                        <button class="btn btn-success" onclick="plusDivs(-1)">❮ Prev</button>
                        <button class="btn btn-success" style="position:absolute;right:0" onclick="plusDivs(1)">Next ❯</button>
                    </div>
                    <div style="position: absolute;left:50%;transform:translateX(-50%)">
                        <button class="btn btn-success " onclick="currentDiv(1)">1</button>
                        <button class="btn btn-success " onclick="currentDiv(2)">2</button>
                        <button class="btn btn-success " onclick="currentDiv(3)">3</button>
                    </div>
                </div>
                <script>
                    var slideIndex = 1;
                    showDivs(slideIndex);

                    function plusDivs(n) {
                        showDivs(slideIndex += n);
                    }

                    function currentDiv(n) {
                        showDivs(slideIndex = n);
                    }

                    function showDivs(n) {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("demo");
                        if (n > x.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = x.length
                        }
                        for (i = 0; i < x.length; i++) {
                            x[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" w3-red", "");
                        }
                        x[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " w3-red";
                    }
                </script>
                <div style="color:#6e807a;line-height:1.7;font-size:17px;">
                    <p class="text-black-100 p-2">
                        <?php echo $item["Description"] ?>
                    </p>
                </div>
                <table class="table table-dark table-striped  ">
                    <tr class="table-primary">
                        <td class="table-primary blu"> name</td>
                        <td class="table-primary"> <?php echo $item['Name'] ?></td>
                    </tr>
                    <tr class="table-primary">
                        <td class="table-primary blu"> Price </td>
                        <td class="table-primary"> <?php echo $item['Price'] ?></td>
                    </tr>
                    <tr class="table-primary">
                        <td class="table-primary blu"> Made in</td>
                        <td class="table-primary"> <?php echo $item['Country_Made']  ?></td>
                    </tr>
                    <tr class="table-primary">
                        <td class="table-primary blu"> category </td>
                        <td class="table-primary"> <a class="btn btn-dark text-white" href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name']  ?></a></td>
                    </tr>
                    <tr class="table-primary">
                        <td class="table-primary blu"> Added by</td>
                        <td class="table-primary">
                            <?php echo "<img class='rounded-circle'style='width:80px;height:80px'src='admin/uploads/avatars/" . $item['image'] . "'alt=''>"; ?>
                            <a class="btn btn-dark text-white" href="userpage.php?userpageid=<?php echo $item['userID'] ?>"><?php echo $item['userName'] ?></a>
                        </td>
                    </tr>
                    <tr class="table-primary">
                        <td class="table-primary blu"> phone number</td>
                        <td class="table-primary"> <?php echo $item['phone'];  ?></td>
                    </tr>
                    <tr class="table-primary">
                        <td class="table-primary blu"> address </td>
                        <td class="table-primary">
                            <?php if (empty($item['address'])) {
                                echo '<div class="text-danger">There is no address to show</div>';
                            } else {
                                echo $item['address'];
                            } ?>
                        </td>







                    </tr>

                </table>
                <?php



                if (isset($_SESSION['user'])) {
                    $userStatus = checkUserStatus($sessionUser);
                    $userid = $_SESSION['uid'];
                    $sql1 = "SELECT * FROM rating WHERE item_id = '$itemid' AND user_id = '$userid'";
                    $result1 = mysqli_query($conn, $sql1);
                    $fetch = mysqli_fetch_assoc($result1);
                    $rows = mysqli_num_rows($result1);

                    if ($rows > 0) {
                        //  echo '<div class="rateBefore">you rate this item before with <span style="color:green;font-size:20px;font-weigth:bold">'. $fetch["stars"] .'</span> <i class="fa-solid fa-star fs-5" style="color:#FFC312"></i> </div>';
                        echo '<div class="rateBefore fs-4">';

                        for ($i = 0; $i < $fetch["stars"]; $i++) {
                            echo '<i class="fa-solid fa-star fs-4 p-3" style="color:#FFC312"></i>';
                        }
                        echo '</div>';
                    } elseif ($userStatus == 0) {
                ?>
                        <div class="rate bg-white pb-3 ">
                            <div class="cont ">
                                <div class="title">

                                    <h2 class=" fw-bold blu">Rate this item</h2>
                                </div>
                                <div class="stars  ">
                                    <form action="" method="POST" autocomplete="off">
                                        <input class="star star-5" id="star-5" type="radio" value="5" name="star" />
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" id="star-4" type="radio" value="4" name="star" />
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" id="star-3" type="radio" value="3" name="star" />
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" id="star-2" type="radio" value="2" name="star" />
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" id="star-1" type="radio" value="1" name="star" />
                                        <label class="star star-1" for="star-1"></label>
                                        <input type="hidden" id="ha" name="rat">
                                        <!-- <input type="submit" name="rating" value="submit"> -->
                                        <button type="submit" name="rating" class="btn btn-primary">submit</button>

                                    </form>
                                    <div class="val text-dark mt-4 fw-bold blu">your review is <span style="margin-left:1rem;color:#0028ff;">.........</span></div>
                                </div>
                            </div>


                            <script>
                                let t = document.querySelector(".val span");
                                let star = document.querySelectorAll(".stars input");
                                let ha = document.querySelector("#ha");
                                star.forEach((s) => {
                                    s.addEventListener("click", (e) => {
                                        t.innerHTML = e.currentTarget.value + ' / 5 <i class="fa-solid fa-star fs-4" style="color:#FFC312"></i>';
                                        ha.value = e.currentTarget.value;
                                        console.log(ha.value);
                                    });
                                });
                            </script>
                        </div>
                <?php
                    } else {

                        echo '<div class="container bg-danger text-white p-3 w-75" style="border-radius:7px">
                 your account needs to activate by <span style="color:#2c3e50;font-size:20px">Admin </span> to rate this item .
                 please be pation we well activate your account soon 
              </div>';
                    }
                }
                ?>

            </div>
            <!-- side -->
            <?php
            $sql1 = "SELECT * FROM items ORDER BY RAND() LIMIT 3";
            $result1 = mysqli_query($conn, $sql1);
            $rows = mysqli_fetch_all($result1, MYSQLI_ASSOC);

            ?>

            <div class="col-md-4" style="margin-top:-15px">
                <div class="d-flex justify-content-center flex-column mb-3 ">
                    <?php foreach ($rows as $row) { ?>
                        <div class="card block2-pic hov-img0" style="width: 18rem;">
                            <img src="admin/uploads/items/<?php echo $row['itemPics'] ?> " class="card-img-top" style="width:20rem;height:250px;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['Name'] ?></h5>
                                <p class="card-text"><?php echo $row['Description'] ?></p>
                                <a class="text-decoration-none btn btn-primary" href="items.php?itemid=<?php echo  $row['item_ID']  ?>">
                                    visit <i class="fa-solid fa-eye success"></i>
                                </a>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
    <?php
    // rating 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['rating'])) {
            $rate = mysqli_real_escape_string($conn, $_POST['rat']);
            $userid = $_SESSION['uid'];

            if ($rate < 1) {
                echo '<div class="alert alert-danger text-center"> please select your rating before submit</div>';
            } else {
                $sql = " INSERT INTO rating (item_id, user_id, stars) VALUES ('$itemid','$userid', '$rate') ";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<div class="alert alert-success text-center">you rate this item  ' . $rate . ' stars <br> <span>thank you</span> </div>';
    ?>
                    <script>
                        document.querySelector(".rate").style.display = "none";
                    </script>
    <?php
                }
            }
        }
    }

    ?>
    <hr class="custom-hr">

    <?php

    if (isset($_SESSION['user'])) {
        $userStatus = checkUserStatus($sessionUser); // variable taba3 if isset tba3 session['user'] user hata esta3mlou bkel application
        if ($userStatus == 0) {

    ?>
            <!-- start add comment  -->
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-3">
                        <div class="add-comment">
                            <h3>Add your comment</h3>
                            <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['item_ID'] ?>" method="POST">
                                <textarea class="form-control  m-auto" name="comment" required></textarea>
                                <input class="btn btn-primary ms-4 mt-3" type="submit" name="comm" value="Add comment">
                            </form>
                            <?php
                            if (isset($_POST['comm'])) {
                                $comment = mysqli_real_escape_string($conn, $_POST['comment']);
                                $itemid  = $item['item_ID'];
                                $userid  = $_SESSION['uid'];
                                if (!empty($comment) && !ctype_space($comment)) {
                                    $sql = "INSERT INTO comments (comment, statusC, comment_date, item_id, user_id) VALUES ('$comment', 0, now(), '$itemid', '$userid')  ";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo '<div class="alert alert-success text-center">comment added and waiting approve by admin</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger text-center"> you can\'t insert an empty comment</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end add comment -->
    <?php } else {

            echo '<div class="container bg-danger text-white p-3 w-75" style="border-radius:7px">
                 your account needs to activate by <span style="color:#2c3e50;font-size:20px">Admin </span> to add comment. 
                 please be pation we well activate your account soon 
              </div>';
        }
    } else {
        echo "<div class='container m-auto'>
            <a href='login/login-user.php' class='btn btn-primary'>Login/register</a> to add comment
            </div>";
    } ?>
    <hr class="custom-hr">
    <?php
    $sql = "SELECT 
                    comments.*, users.*
                FROM 
                      comments
                INNER JOIN
                      users
                on
                      users.userID = comments.user_id
                WHERE
                      item_id = '$item[item_ID]'
                AND
                      statusC = 1 
                ORDER BY
                      c_id DESC   ";
    $result = mysqli_query($conn, $sql);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    ?>


    <?php foreach ($comments as $comment) { ?>
        <div class="container">
            <div class="comment-box ">
                <div class="row">
                    <div class="col-sm-2 text-center block2-pic hov-img0 ">
                        <img class="img-responsive img-thubnail rounded-circle  " style="width:100px;height:100px" src="admin/uploads/avatars/<?php echo $comment['image'] ?>" alt="img">
                        <?php echo $comment['userName'] ?>
                    </div>
                    <!--<div class="col-sm-10">-->
                    <!--    <p class="lead">-->
                    <!--        <?php

                                echo $comment['comment'];
                                ?>
                    <!--    </p>-->

                    <!--</div>-->
                    <div class="col-sm-10">
                        <div class="commentp">
                            <?php echo $comment['comment'] ?>
                            <?php
                            $com = urlencode(base64_encode($comment['c_id']));
                            $linkuser = urlencode(base64_encode($comment['user_id']));
                            if (isset($_SESSION['user']) && ($comment['user_id'] == $_SESSION['uid'])) {
                                echo "<a class='btn confirm' href='profile.php?do=DeleteComment&cid=" . $com . "&memberid=" . $linkuser . "'>X</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php   } ?>












<?php
} else {
    $msg = '<div class="alert alert-danger text-center">there\'s no such id or this Item may not approval yet </div>';
    redirectHome($msg, 'back', 5);
}
include $tpl . 'footer.php';
ob_end_flush();
?>