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
            <div class="col-lg-5 col-md-3">

                <div class="slider-container imageAdd">
                    <div id="slide-number" class="slide-number"></div>
                    <?php
                    if (empty($item['itemPics'])) {
                        echo '<img width="250px" height="250px" src="admin/uploads/items/no-image.png" alt="" />';
                    } else { ?>

                        <a href="admin/uploads/items/<?php echo $item['itemPics']; ?>" target="_blanck">
                            <img class="img-responsive img-thumbnail center-block imageItem" src="admin/uploads/items/<?php echo $item['itemPics']; ?>" alt="img">
                        </a>
                    <?php }
                    if (empty($item['itemPics2'])) {
                        echo '';
                    } else { ?>
                        <a href="admin/uploads/items/<?php echo $item['itemPics2']; ?>" target="_blanck">
                            <img class="img-responsive img-thumbnail center-block imageItem" src="admin/uploads/items/<?php echo $item['itemPics2']; ?>" alt="img">
                        </a>
                    <?php }
                    if (empty($item['itemPics3'])) {
                        echo '';
                    } else { ?>
                        <a href="admin/uploads/items/<?php echo $item['itemPics3']; ?>" target="_blanck">
                            <img class="img-responsive img-thumbnail center-block imageItem" src="admin/uploads/items/<?php echo $item['itemPics3']; ?>" alt="img">
                        </a>
                    <?php  } ?>
                </div>

                <div class="slider-controls">
                    <span id="prev" class="prev"><i class="fa-solid fa-backward"></i></span>
                    <span id="indicators" class="indicators"></span>
                    <span id="next" class="next"><i class="fa-solid fa-forward-fast"></i></span>
                </div>




            </div>
            <div class="col-lg-7 col-md-9  item-info">
                <h2><?php echo $item['Name']  ?></h2>
                <!-- <p><?php echo $item['Description']  ?></p> -->
                <ul class="list-unstyled">
                    <li><span class="fw-bold blu">added date : </span><?php echo $item['Add_Date'] ?></li>
                    <li><span class="fw-bold blu">Price : </span> <span style="color:#393f07;font-size:20px;font-weight:bold;"><?php echo $item['Price'] ?> <img class="img-cirlce" style="max-width:40px" src="admin/uploads/imgs/dollar.png"></span> </li>
                    <li style="max-height:120px;">
                        <table>
                            <tr>
                                <td> <span class="fw-bold blu">Description : </span></td>
                                <td><?php echo $item['Description'] ?></td>

                            </tr>
                        </table>

                    </li>
                    <li> <span class="fw-bold blu fs-5">Made in : </span><strong><?php echo $item['Country_Made']  ?></strong> </li>
                    <li> <span class="fw-bold blu">category : </span><a class="btn btn-dark text-white" href="categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name']  ?></a></li>
                    <li>
                        <span class="fw-bold blu">Added by : </span>
                        <?php echo "<img class='rounded-circle'style='max-width:80px;max-height:80px'src='admin/uploads/avatars/" . $item['image'] . "'alt=''>"; ?>
                        <a class="btn btn-dark text-white" href="userpage.php?userpageid=<?php echo $item['userID'] ?>"><?php echo $item['userName'] ?></a>
                    </li>
                    <li> <span class="fw-bold blu">phone number:</span><?php echo $item['phone'];  ?></li>
                    <li><span class="fw-bold blu">address :</span><?php if (empty($item['address'])) {
                                                                        echo 'There is no address to show';
                                                                    } else {
                                                                        echo $item['address'];
                                                                    } ?></li>
                    <!--  <li style="width:450px;">
                        <span>Location</span>
                        <iframe src="https://www.google.com/maps?q=<?php echo $item['latitude'] ?>,<?php echo $item['longitude']; ?>&hl=es;z=14&output=embed"></iframe>

                    </li>*/-->
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
                            <li class="rate bg-white">
                                <div class="cont">
                                    <div class="title">

                                        <h2 class=" fw-bold blu">Rate this item</h2>
                                    </div>
                                    <div class="stars">
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
                                        <div class="val text-dark mt-4 fw-bold blu">your review is <span style="margin-left:-1rem;color:#0028ff;">.........</span></div>
                                    </div>
                                </div>
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
        </li>
<?php
                        } else {

                            echo '<div class="container bg-danger text-white p-3 w-75" style="border-radius:7px">
                 your account needs to activate by <span style="color:#2c3e50;font-size:20px">Admin </span> to rate this item .
                 please be pation we well activate your account soon 
              </div>';
                        }
                    }
?>


</ul>
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
            <!-- end add comment -->
    <?php } else {

            echo '<div class="container bg-danger text-white p-3 w-75" style="border-radius:7px">
                 your account needs to activate by <span style="color:#2c3e50;font-size:20px">Admin </span> to add comment. 
                 please be pation we well activate your account soon 
              </div>';
        }
    } else {
        echo '<div class="container m-auto">
            <a href="login/login-user.php" class="btn btn-primary ">Login/register</a> to add comment
            </div>';
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
        <div class="comment-box ">
            <div class="row">
                <div class="col-sm-2 text-center">
                    <img class="img-responsive img-thubnail rounded-circle" style="width:100px;height:100px" src="admin/uploads/avatars/<?php echo $comment['image'] ?>" alt="img">
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
    <?php   } ?>
    <hr class="custom-hr">

    </div>

<?php
} else {
    $msg = '<div class="alert alert-danger text-center">there\'s no such id or this Item may not approval yet </div>';
    redirectHome($msg, 'back', 5);
}
include $tpl . 'footer.php';
ob_end_flush();
?>