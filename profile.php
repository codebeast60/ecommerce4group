<?php
ob_start();
session_start();
$pageTitle = 'Profile';
$page = '';
$userid = $_SESSION['user'];


error_reporting(0);



if (isset($_SESSION['user'])) {
    include 'init.php';
    $do  =  isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') {
        $sql = "SELECT * FROM users WHERE userName = '$sessionUser'";
        $result = mysqli_query($conn, $sql);
        $info = mysqli_fetch_assoc($result);
        $userid = $info['userID'];
        $passwor = $info['password'];
        $id = $info['userID'];



?>


        <h1 class="text-center">My profile</h1>

        <div class="information p-3 mb-5">

            <div class="container">
                <div class="row">


                    <div class="col-lg-8 col-md-6 p-3">

                        <table class="table-striped  w-75  ">

                            <tr>
                                <td style="color:#26a69a;"><i class="fa-solid fa-user fs-4" style="color:#26a69a;"></i> Login Name: </td>
                                <td><?php echo $info['userName'] ?></td>

                            </tr>

                            <tr>
                                <td style="color:#26a69a;"><i class="fa-solid fa-envelope fs-4"></i> Email address: </td>
                                <td><?php echo $info['email'] ?></td>
                            </tr>


                            <tr>
                                <td style="color:#26a69a;"><i class="fa-solid fa-signature fs-4"></i> Full Name: </td>
                                <td> <?php echo $info['fullName'] ?></td>
                            </tr>


                            <tr>
                                <td style="color:#26a69a;"><i class="fa-solid fa-phone fs-4"></i> Phone Number: </td>
                                <td> <?php echo $info['phone'] ?></td>
                            </tr>


                            <tr>
                                <td style="color:#26a69a;"><i class="fa-solid fa-calendar-days fs-4"></i> register date </td>
                                <td> <?php echo $info['Date'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="profile.php?do=Edit&userid=<?php echo $userid ?>" class="btn btn-primary " style="width:180px;margin-bottom:-50px;"> edit information</a>
                                </td>
                            </tr>

                        </table>

                    </div>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="image-profile">
                            <div class="imgp">

                                <form class="form" id="form" enctype="multipart/form-data" method="POST">

                                    <?php

                                    $name = $info['userName'];

                                    echo ' <div class="upload1">
                                 <img class="rounded-circle" style="height:180px;" src="admin/uploads/avatars/' .  $info['image'] .  '">';
                                    echo '<div class="round1"';
                                    echo '<input type="hidden" name="id" value="' . $info['userID'] . '">';
                                    echo '<input type="hidden" name="name" value="' . $name . '">';
                                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                                    echo '  <input type="file" name="profile" id="profile" accept=".jpg, .jpeg, .png ">
                                           
                                  
                                      </div>
                                    </div>';
                                    ?>
                                    <script type="text/javascript">
                                        document.getElementById("profile").onchange = function() {
                                            document.getElementById('form').submit();
                                        }
                                    </script>
                                    <?php
                                    if (isset($_FILES["profile"]["name"])) {
                                        /*   $ID        = $_POST["id"]; */
                                        $name        = $_POST["name"];

                                        $imageName = $_FILES["profile"]["name"];
                                        $imageSize = $_FILES["profile"]["size"];
                                        $tmpName   = $_FILES["profile"]["tmp_name"];
                                        $validImageExtension = ["jpg", "jpeg", "png"];
                                        $imageExtension = explode(".", $imageName);
                                        $imageExtension = strtolower(end($imageExtension));
                                        if (!in_array($imageExtension, $validImageExtension)) {
                                            echo '
                                        <script>
                                            alert("invalid image extension");
                                        </script>
                                     ';
                                        } elseif ($imageSize > 12000000) {
                                            echo '
                                            <script>
                                                    alert("invalid image size ");
                                            </script>
                                        ';
                                        } else {


                                            $newImageName = $imageName . "_" . date("y.m.d");
                                            $newImageName .= "." . $imageExtension;
                                            $query = " UPDATE users SET image = '$newImageName' WHERE userName= '$name'  ";
                                            mysqli_query($conn, $query);
                                            move_uploaded_file($tmpName, 'admin/uploads/avatars//' . $newImageName);

                                            echo "<meta http-equiv='refresh' content='0'>";
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $userStatus = checkUserStatus($sessionUser); // variable taba3 if isset tba3 session['user'] user hata esta3mlou bkel application
        if ($userStatus == 1) {
            echo '<div class="container bg-danger text-white p-3 w-75  mb-5" style="border-radius:7px;margin-top:200px">
                 your account needs to activate by <span style="color:#2c3e50;font-size:20px">Admin </span> to add items. 
                 please be pation we well activate your account soon 
              </div>';
        } else {

        ?>


            <div id="my-ads" class="card  mb-4   bg-light" style="margin-top:13rem;">
                <h5 class="card-header text-center bg-dark text-white p-3 ">last 8 items</h5>
                <div class="card-body">
                    <?php
                    $sql = "SELECT * FROM items WHERE  Member_ID = '$userid'  order by item_ID DESC LIMIT 8";
                    $result = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    if ($result) {

                        echo '<div class="row p-3">';

                        foreach ($rows as $item) {

                            echo '<div class="col-sm-6 col-md-4 col-lg-3 pb-3">';
                            echo '<div class="thumbnail item-box">';
                            if ($item['Approve'] == 0) {
                                echo '<span class="approve-status">waiting approval </span>';
                            }
                            echo '<span class="price">$ ' . $item['Price'] . '</span>';


                            $link     = urlencode(base64_encode($item['item_ID']));
                            $linkuser = urlencode(base64_encode($userid));

                            //  edit image 
                            if (empty($item['itemPics'])) {
                                echo "  
                                <img class='img-responsive' style='width:180px;height:200px;'  src='admin/uploads/items/no-profile.jpg'>";
                            } else {
                                echo " 
                                <img class='img-responsive' style='width:250px;height:200px;' src='admin/uploads/items/" . $item["itemPics"] . "'  title='admin/uploads/itesm/"  . $item["itemPics"] . "'>  ";
                            }
                            ";

                        echo '<div class='caption'>";
                            echo '<h4 class="htitle"><a href="items.php?itemid=' . $item['item_ID'] . '">' . $item['Name'] . '</a></h4>';
                            echo '<p class="commentd">' . $item['Description'] . '</p>';
                            echo '<a style="position:absolute; top:330px;left:2px;" class="btn btn-primary"
                                          href="profile.php?do=EditItem&itemid=' . $link . '&memberid=' . $linkuser . '"> edit </a>';

                            echo '<a  style="position:absolute; top:330px;left:60px;" class="btn btn-danger confirm"
                                          href="profile.php?do=DeleteItem&itemid=' . $link . '&memberid=' .  $linkuser . '" 
                                          style="margin:5px;"> Delete
                                     </a>';
                            echo '<div class="dated">' . $item['Add_Date'] . '</div>';

                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>';
                        echo ' <a href="newad.php" class="btn btn-primary bg-dark"> add new item</a>';
                        $check = getItems("Member_ID", $id);
                        if ($check) {

                            echo ' <a href="profile.php?do=showallitem&memberid=' . $linkuser . '" class="btn btn-primary bg-dark"> show all item</a>';
                        }
                        echo '</div>';
                    } else {
                        echo 'there is no ads to show , create <a href="newad.php">New ad </a> ';
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
        <div class="card mt-5 mb-5 bg-light">
            <h5 class="card-header bg-dark text-center p-3 text-white">latest comments</h5>
            <div class="card-body">
                <?php
                $sql = "SELECT * FROM comments WHERE user_id = '$info[userID]' order by c_id DESC LIMIT 5 ";
                $result = mysqli_query($conn, $sql);
                $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if (!empty($comments)) {
                    foreach ($comments as $comment) {
                        $com = urlencode(base64_encode($comment['c_id']));
                        $linkuser = urlencode(base64_encode($userid));
                ?>
                        <div class="commentp">
                            <?php echo $comment['comment'] ?>
                            <?php
                            if (isset($_SESSION['user']) && ($comment['user_id'] == $_SESSION['uid'])) {
                                echo "<a class='btn confirm' href='profile.php?do=DeleteComment&cid=" . $com . "&memberid=" . $linkuser . "'>X</a>";
                            }
                            ?>
                        </div>
                <?php }
                    echo ' <a href="profile.php?do=showallcomments&memberid=' . $linkuser . '" class="btn bg-dark text-white mt-5"> show all Comments</a>';
                } else {
                    echo '<div class="text-white bg-success p-3 text-center w-50 m-auto rounded-1">
                    there is no comments here
                    </div>';
                }

                ?>
            </div>
        </div>

        <?php } elseif ($do == 'Edit') {
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $sql = "SELECT * FROM users WHERE userName = '$sessionUser'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
        ?>
            <h1 class="text-center">Edit Profile</h1>
            <div class="container rounded bg-white mt-5 mb-5" style="height:800px">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="admin/uploads/avatars/<?php echo $row['image'] ?>"><span class=" font-weight-bold"><?php echo $row['userName'] ?></span><span class="text-black-50"><?php echo $row['email'] ?></span><span> </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <form class="form-horizontal" autocomplete="off" action="?do=Update" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">edit Profile</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6"><label class="labels">Name</label> <input type="text" name="username" class="form-control" value="<?php echo $row['userName'] ?>" readonly></div>
                                    <div class="col-md-6"><label class="labels">Full Name</label><input type="text" name="full" class="form-control" value="<?php echo $row['fullName'] ?>"></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="number" name="phone" class="form-control" value="<?php echo $row['phone'] ?>"></div>
                                    <div class="col-md-12">
                                        <label class="labels ">password</label>
                                        <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>">
                                        <input type="password" id="pass" name="newpassword" class="form-control p-relative" placeholder="Leave it emty if you don't want to change it ">
                                        <i class="fa-solid fa-eye fs-3 float-end" style="color:blue" role="button" onclick="myFunction()"></i>

                                    </div>

                                </div>
                                <!-- <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                                </div> -->
                                <div class="mt-5 text-center">
                                    <!-- <button class="btn btn-primary profile-button" type="button">Save Profile</button> -->
                                    <input type="submit" value="Save Profile" class="btn btn-primary btn-lg">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <script>
                function myFunction() {
                    var x = document.getElementById("pass");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
            </script>
            <?php } else {
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger text-center">there is no such ID </div>';
            redirectHome($theMsg, 3);
            echo "</div>";
        }
    } elseif ($do == 'Update') {
        echo "<h1 class='text-center'>Update Member</h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id    = mysqli_real_escape_string($conn, $_POST['userid']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $name  = mysqli_real_escape_string($conn, $_POST['full']);
            $user = $_SESSION['user'];
            $errors = array();

            //password trick

            $pass  = empty($_POST['newpassword']) | preg_match("/^\s+/", $_POST['newpassword'])  ? $_POST['oldpassword'] : password_hash($_POST['newpassword'], PASSWORD_BCRYPT);





            //validate the form



            if (empty($name) || ctype_space($name)) {
                $errors[] = 'full Name can\'t be empty';
            } elseif (preg_match("/^\s+/", $name) || preg_match("/\s{2,}/", $name)) {
                $errors[] = 'you cant put more than one space';
            }
            if (empty($phone) || ctype_space($phone)) {
                $errors[] = 'phone number can\'t be empty';
            } elseif (!is_numeric($phone)) {
                $errors[] = "phone must be a number not string";
            } elseif (preg_match("/^\s+/", $phone) || preg_match("/\s{2,}/", $phone)) {
                $errors[] = 'you cant put spaces between numbers';
            }
            // elseif( strlen($phone) != 11){
            //     $errors[] = 'your phone number should be 11 digit numbers';
            // }


            foreach ($errors as $error) {
                $theMsg =  '<div class="alert alert-danger text-center">' . $error . '</div>';
                redirect($theMsg, 5);
            }
            if (count($errors) == 0) {




                $sql2 = "SELECT * FROM users WHERE userName = '$user' AND userID != '$id'";
                $result =  mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result) == 1) {
                    $theMsg = "<div class='alert alert-danger text-center'> sorry this user is already exists   </div>";
                    redirectHome($theMsg, 'back', 4);
                    echo '';
                } else {
                    $sql = "UPDATE users SET fullName='$name', phone='$phone',  password='$pass' WHERE userID= '$id'";
                    $result =  mysqli_query($conn, $sql);

                    /*    echo  ' <script type="text/javascript">
                                    alert("Update Successfull");
                                    window.location = "profile.php";
                            </script>';  */
                    echo "<div class='container'>";
                    $theMsg = "<div class='alert alert-success text-center'>Record updated </div>";
                    $url = 'profile.php';
                    redirectHome($theMsg, $seconds = 5);

            ?>

                    </div>
            <?php




                }
            }
        } else {
            $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
            redirectHome($theMsg, 5);
        }
        echo "</div>";
    } elseif ($do == 'EditItem') {

        $itemid = urldecode(base64_decode($_GET['itemid']));
        $memberid = urldecode(base64_decode($_GET['memberid']));

        $sql = "SELECT * FROM items WHERE item_ID = '$itemid' AND Member_ID = '$memberid' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {


            ?>
            <h1 class="text-center">Edit my Ad</h1>
            <div class="create-ad block">
                <div class="container">
                    <div class="panel panel-primary">
                        <!--<div class="panel-heading">Edit my ad</div>-->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-horizontal" autocomplete="off" action="?do=UpdateItem" method="POST" enctype="multipart/form-data">
                                        <!-- start hidden input  -->
                                        <input type="hidden" name="itemid" value="<?php echo $itemid ?>">

                                        <!-- end hidden input  -->
                                        <!-- start name Field-->
                                        <div class="form-group form-group-lg">
                                            <label for="user" class="col-sm-3 control-label"> Name</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input pattern=".{4,}" title="this field require at least 4 characters" type="text" name="name" id="user" class="form-control live" value="<?php echo $row['Name'] ?>" data-class=".live-title" required>
                                            </div>
                                        </div>
                                        <!--end name Field   -->
                                        <!-- start description Field-->
                                        <div class="form-group form-group-lg">
                                            <label for="user" class="col-sm-3 control-label"> Description</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input pattern=".{10,}" title="this field required at least 10 characters" type="text" name="description" id="user" class="form-control live" value="<?php echo $row['Description'] ?>" data-class=".live-desc" required>
                                            </div>
                                        </div>
                                        <!--end description Field   -->
                                        <!-- start price Field-->
                                        <div class="form-group form-group-lg">
                                            <label for="user" class="col-sm-3 control-label"> Price</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input pattern=".{1,}" title="this field required at least 1 characters" type="text" name="price" id="user" class="form-control live" value="<?php echo $row['Price'] ?>" data-class=".live-price">
                                            </div>
                                        </div>
                                        <!--end price Field   -->
                                        <!-- start country Field-->
                                        <div class="form-group form-group-lg">
                                            <label for="user" class="col-sm-3 control-label"> Country</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input type="text" name="country" id="user" class="form-control" value="<?php echo $row['Country_Made'] ?>">
                                            </div>
                                        </div>
                                        <!--end country Field   -->
                                        <!-- start status Field-->
                                        <div class="form-group form-group-lg">
                                            <label for="user" class="col-sm-3 control-label"> Status</label>
                                            <div class="col-sm-10 col-md-9">
                                                <select name="status" required>
                                                    <option value="0">...</option>
                                                    <option value="1" <?php if ($row['Status'] == 1) {
                                                                            echo 'selected';
                                                                        } ?>>New</option>
                                                    <option value="2" <?php if ($row['Status'] == 2) {
                                                                            echo 'selected';
                                                                        } ?>>like New</option>
                                                    <option value="3" <?php if ($row['Status'] == 3) {
                                                                            echo 'selected';
                                                                        } ?>>used</option>
                                                    <option value="4" <?php if ($row['Status'] == 4) {
                                                                            echo 'selected';
                                                                        } ?>>old</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end status Field   -->
                                        <!-- start category Field-->
                                        <div class="form-group form-group-lg">
                                            <label for="user" class="col-sm-3 control-label"> Category </label>
                                            <div class="col-sm-10 col-md-9">
                                                <select name="category" required>
                                                    <option value="0">...</option>
                                                    <?php


                                                    $sql2 = "SELECT * FROM categories Where parent = 0";
                                                    $result2 = mysqli_query($conn, $sql2);
                                                    $cats =  mysqli_fetch_all($result2, MYSQLI_ASSOC);
                                                    foreach ($cats as $cat) {
                                                        echo "<option value='" . $cat['ID'] . "'";
                                                        if ($row['Cat_ID'] == $cat['ID']) {
                                                            echo 'selected';
                                                        }
                                                        echo ">" . $cat['Name']   . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end category Field   -->
                                        <!-- start address  -->
                                        <div class="form-group form-group-lg">
                                            <label for="location" class="col-sm-3 control-label">your address</label>
                                            <div class="col-sm-10 col-md-9">
                                                <input pattern=".{5,}" title="this field required at least 5 characters" type="text" name="address" id="location" value="<?php echo $row['address'] ?>" class="form-control live" placeholder="your address" data-class=".live-desc">
                                            </div>
                                        </div>
                                        <!-- end address  -->
                                        <!-- start item picture -->
                                        <div class="form-group form-group-lg">
                                            <label class="col-sm-3 control-label">item picture</label>
                                            <div class="col-sm-10 col-md-6">
                                                <div class="itemAdd">

                                                    <div class="upload">
                                                        <a href="admin/uploads/items/<?php echo $row['itemPics'] ?>" target="_blanck">
                                                            <img src="admin/uploads/items/<?php echo $row['itemPics'] ?>" id="image">
                                                        </a>
                                                        <input type="hidden" name="oldImage" value="<?php echo $row['itemPics'] ?>">

                                                        <div class="rightRound" id="upload">
                                                            <input type="file" name="avatar" id="picture" accept=".jpg, .jpeg, .png">
                                                            <i class="fa fa-camera text-white"></i>
                                                        </div>

                                                        <div class="leftRound" id="cancel" style="display: none;">
                                                            <i class="fa fa-times text-white"></i>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($row['itemPics2'])) { ?>
                                                        <div class="upload">
                                                            <a href="admin/uploads/items/<?php echo $row['itemPics2'] ?>" target="_blanck">
                                                                <img src="admin/uploads/items/<?php echo $row['itemPics2'] ?>" id="image2">
                                                            </a>
                                                            <input type="hidden" name="oldImage2" value="<?php echo $row['itemPics2'] ?>">

                                                            <div class="rightRound" id="upload2">
                                                                <input type="file" name="avatar2" id="picture2" accept=".jpg, .jpeg, .png">
                                                                <i class="fa fa-camera text-white"></i>
                                                            </div>

                                                            <div class="leftRound" id="cancel2" style="display: none;">
                                                                <i class="fa fa-times text-white"></i>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="upload">
                                                            <img src="admin/uploads/items/no-image.png" id="image2">

                                                            <div class="rightRound" id="upload2">
                                                                <input type="file" name="avatar2" id="picture2" accept=".jpg, .jpeg, .png">
                                                                <i class="fa fa-camera text-white"></i>
                                                            </div>

                                                            <div class="leftRound" id="cancel2" style="display: none;">
                                                                <i class="fa fa-times text-white"></i>
                                                            </div>

                                                        </div>
                                                    <?php }

                                                    if (!empty($row['itemPics3'])) { ?>
                                                        <div class="upload">
                                                            <a href="admin/uploads/items/<?php echo $row['itemPics3'] ?>" target="_blanck">
                                                                <img src="admin/uploads/items/<?php echo $row['itemPics3'] ?>" id="image3">
                                                            </a>
                                                            <input type="hidden" name="oldImage3" value="<?php echo $row['itemPics3'] ?>">

                                                            <div class="rightRound" id="upload3">
                                                                <input type="file" name="avatar3" id="picture3" accept=".jpg, .jpeg, .png">
                                                                <i class="fa fa-camera text-white"></i>
                                                            </div>

                                                            <div class="leftRound" id="cancel3" style="display: none;">
                                                                <i class="fa fa-times text-white"></i>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="upload">
                                                            <img src="admin/uploads/items/no-image.png" id="image3">

                                                            <div class="rightRound" id="upload3">
                                                                <input type="file" name="avatar3" id="picture3" accept=".jpg, .jpeg, .png">
                                                                <i class="fa fa-camera text-white"></i>
                                                            </div>

                                                            <div class="leftRound" id="cancel3" style="display: none;">
                                                                <i class="fa fa-times text-white"></i>
                                                            </div>

                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class=" form-group">
                                            <div class="col-sm-offset-3 col-sm-9 mb-5">
                                                <input type="submit" value="Save Changes" class="btn btn-success w-50 btn-md">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!--   
                                    <div class="thumbnail item-box live-preview imageAdd">
                                        <span class="price-tag ">
                                            $ <span class="live-price"><?php echo $row['Price'] ?></span>
                                        </span>
                                        <?php if (!empty($row['itemPics'])) { ?>
                                            <img class="img-responsive imgadd" src="admin/uploads/items/<?php echo $row['itemPics'] ?>" alt="img">
                                        <?php } else {
                                            echo '<img class="img-responsive" src="admin/uploads/items/no-image.png" alt="img">';
                                        }
                                        ?>
                                        <div class="caption">
                                            <h3 class="live-title"> <?php echo $row['Name'] ?></h3>
                                            <p class="live-desc"><?php echo $row['Description'] ?></p>

                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!--   start errors  -->

                        <?php
                        if (!empty($formErrors)) {
                            foreach ($formErrors as $error) {
                                echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                            }
                        }
                        if (isset($successMsg)) {
                            echo '<div class="alert alert-success text-center">' . $successMsg . '</div>';
                        }
                    } else {
                        echo "<div class='container'>";
                        $theMsg = '<div class="alert alert-danger text-center">there is no such ID </div>';
                        redirectHome($theMsg, 5);
                        echo "</div>";
                    }

                        ?>

                        <!--  end of errors -->
                        </div>
                    </div>
                </div>
            </div>

        <?php } elseif ($do == 'UpdateItem') {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_reporting(0);





            $name            = mysqli_real_escape_string($conn, $_POST['name']);
            $desc            = mysqli_real_escape_string($conn, $_POST['description']);
            $price           = mysqli_real_escape_string($conn, $_POST['price']);
            $country         = mysqli_real_escape_string($conn, $_POST['country']);
            $status          = mysqli_real_escape_string($conn, $_POST['status']);
            $category        = mysqli_real_escape_string($conn, $_POST['category']);
            $itemid          = $_POST['itemid'];
            $address  = mysqli_real_escape_string($conn, $_POST['address']);
            $formErrors = array();


            /* image trick */
            $avatar = $_POST['oldImage'];
            $updateImage = "itemPics = '$avatar'";

            if (!empty($_FILES['avatar']['name'])) {
                $avatarName = $_FILES['avatar']['name'];
                $avatarSize = $_FILES['avatar']['size'];
                $avatarTmp  = $_FILES['avatar']['tmp_name'];
                $avatarType = $_FILES['avatar']['type'];
                $avatarAllowedExtention = array("jpeg", "jpg", "png", "gif");
                $avatarExtention = strtolower(end(explode('.', $avatarName)));
                if (!empty($avatarName) && !in_array($avatarExtention, $avatarAllowedExtention)) {
                    $formErrors[] = 'This extention is not allowed';
                }
                if ($avatarSize > 4194304) {
                    $formErrors[] = 'your profile picture cant be more than 4 MB';
                }
                if (count($formErrors) == 0) {
                    //insert info into database
                    $avatar = rand(0, 1000000) . '_' . $avatarName;
                    move_uploaded_file($avatarTmp, "admin/uploads/items//" . $avatar);
                    $updateImage = "itemPics = '$avatar'";
                }
            }

            $avatar2 = $_POST['oldImage2'];
            $updateImage2 = "itemPics2 = '$avatar2'";

            if (!empty($_FILES['avatar2']['name'])) {
                $avatarName2 = $_FILES['avatar2']['name'];
                $avatarSize2 = $_FILES['avatar2']['size'];
                $avatarTmp2  = $_FILES['avatar2']['tmp_name'];
                $avatarType2 = $_FILES['avatar2']['type'];
                $avatarAllowedExtention2 = array("jpeg", "jpg", "png", "gif");
                $avatarExtention2 = strtolower(end(explode('.', $avatarName2)));
                if (!empty($avatarName2) && !in_array($avatarExtention2, $avatarAllowedExtention2)) {
                    $formErrors[] = 'This extention is not allowed';
                }
                if ($avatarSize2 > 4194304) {
                    $formErrors[] = 'your profile picture cant be more than 4 MB';
                }
                if (count($formErrors) == 0) {
                    //insert info into database
                    $avatar2 = rand(0, 1000000) . '_' . $avatarName2;
                    move_uploaded_file($avatarTmp2, "admin/uploads/items//" . $avatar2);
                    $updateImage2 = "itemPics2 = '$avatar2'";
                }
            }

            $avatar3 = $_POST['oldImage3'];
            $updateImage3 = "itemPics3 = '$avatar3'";

            if (!empty($_FILES['avatar3']['name'])) {
                $avatarName3 = $_FILES['avatar3']['name'];
                $avatarSize3 = $_FILES['avatar3']['size'];
                $avatarTmp3  = $_FILES['avatar3']['tmp_name'];
                $avatarType3 = $_FILES['avatar3']['type'];
                $avatarAllowedExtention3 = array("jpeg", "jpg", "png", "gif");
                $avatarExtention3 = strtolower(end(explode('.', $avatarName3)));
                if (!empty($avatarName3) && !in_array($avatarExtention3, $avatarAllowedExtention3)) {
                    $formErrors[] = 'This extention is not allowed';
                }
                if ($avatarSize3 > 4194304) {
                    $formErrors[] = 'your profile picture cant be more than 4 MB';
                }
                if (count($formErrors) == 0) {
                    //insert info into database
                    $avatar3 = rand(0, 1000000) . '_' . $avatarName3;
                    move_uploaded_file($avatarTmp3, "admin/uploads/items//" . $avatar3);
                    $updateImage3 = "itemPics3 = '$avatar3'";
                }
            }



            if (strlen($name) < 4) {
                $formErrors[] = 'item title must be more than 4 character';
            } elseif (empty($name) || ctype_space($name)) {
                $formErrors[] = 'item name cannot be empty';
            } elseif (preg_match("/^\s+/", $name) || preg_match("/\s{2,}/", $name)) {
                $formErrors[] = 'you cant put more than space';
            }

            if (strlen($desc) < 10) {
                $formErrors[] = 'item description must be more than 10 character';
            } elseif (empty($desc) || ctype_space($desc)) {
                $formErrors[] = 'item description cannot be empty';
            } elseif (preg_match("/^\s+/", $desc) || preg_match("/\s{2,}/", $desc)) {
                $formErrors[]  = 'you cant put more than space';
            }
            if (strlen($country) < 2) {
                $formErrors[] = 'item country must be more than 2 character';
            } elseif (empty($country) || ctype_space($country)) {
                $formErrors[] = 'country cannot be empty';
            } elseif (preg_match("/^\s+/", $country) || preg_match("/\s{2,}/", $country)) {
                $formErrors[] = 'you cant put more than space';
            }
            if (empty($price) || ctype_space($price)) {
                $formErrors[] = 'item price must be not empty';
            } elseif (preg_match("/^\s+/", $price) || preg_match("/\s{2,}/", $price)) {
                $formErrors[] = 'you cant put more than space';
            } elseif (!is_numeric($price)) {
                $formErrors[] = 'your price should be number';
            }
            if (empty($status) || ctype_space($status)) {
                $formErrors[] = 'item status must be not empty';
            }
            if (empty($category) || ctype_space($category)) {
                $formErrors[] = 'item category must be not empty';
            }
            if (empty($address) || ctype_space($address)) {
                $formErrors[] = 'address must be not empty';
            }

            foreach ($formErrors as $error) {
                $theMsg = "<div class='alert alert-danger text-center'>" .  $error . "</div>";

                redirect($theMsg, 5);
            }
            if (count($formErrors) == 0) {
                //insert info into database
                /*  $avatar = rand(0, 1000000) . '_' . $avatarName;
                move_uploaded_file($avatarTmp, "admin\uploads\items\\" . $avatar); */
                $sql = "UPDATE items SET Name = '$name', Description = '$desc', Price = '$price', Country_Made = '$country',
                   Status = '$status', Cat_ID = '$category', address = '$address', $updateImage, $updateImage2, $updateImage3  WHERE item_ID = '$itemid'   ";


                $result = mysqli_query($conn, $sql);
                if ($result == 1) {
                    $successMsg = 'Item has been added';
                    $theMsg = "<div class='container'>
                    <div class='alert alert-success text-center'> record updated 
                    </div>
                    </div>";

                    redirectHome($theMsg, 10);
                }
            }
        }
    } elseif ($do == 'DeleteItem') {
        echo "<h1 class='text-center'> Delete Item</h1>";
        echo "<div class='container'>";
        //Delete Members


        $itemid = urldecode(base64_decode($_GET['itemid']));
        $memberid = urldecode(base64_decode($_GET['memberid']));
        $sql = "SELECT * FROM items WHERE item_ID = '$itemid' AND Member_ID = '$memberid' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $sql = "DELETE FROM items WHERE item_ID='$itemid' AND Member_ID = '$memberid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>" . 'Record Deleted </div>';
            redirectHome($theMsg, 'back', 5);
        } else {
            $theMsg = '<div class="alert alert-danger text-center">this ID is not exist </div>';
            redirectHome($theMsg, 'back', 5);
        }
        echo '</div>';
    } elseif ($do == 'DeleteComment') {
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'> Delete Comment</h1>";
        echo "<div class='container'>";
        //Delete Members
        $commentid = urldecode(base64_decode($_GET['cid']));
        $memberid = urldecode(base64_decode($_GET['memberid']));
        $sql = "SELECT c_id FROM comments WHERE c_id ='$commentid' AND  user_id= '$memberid' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $sql = "DELETE FROM comments WHERE c_id='$commentid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>" . 'Record Deleted </div>';
            redirectHome($theMsg, 5);
        } else {
            $theMsg = '<div class="alert alert-danger text-center">this ID is not exist </div>';
            redirectHome($theMsg, 'back', 5);
        }
        echo '</div>';
        echo '</div>';
    } elseif ($do == 'showallitem') {
        $userid = urldecode(base64_decode($_GET['memberid'])); ?>
            <div id="my-ads" class="card  mb-4   bg-light" style="margin-top:13rem;">
                <h5 class="card-header text-center bg-dark text-white p-3 ">All items</h5>
                <div class="card-body">

                    <?php


                    $sql = "SELECT * FROM items WHERE   Member_ID = '$userid' ";
                    $result = mysqli_query($conn, $sql);
                    $rows =  mysqli_fetch_all($result, MYSQLI_ASSOC);

                    if ($result) {

                        echo '<div class="row p-3">';

                        foreach ($rows as $item) {

                            echo '<div class="col-sm-6 col-md-4 col-lg-3 pb-3">';
                            echo '<div class="thumbnail item-box">';
                            if ($item['Approve'] == 0) {
                                echo '<span class="approve-status">waiting approval </span>';
                            }
                            echo '<span class="price">$ ' . $item['Price'] . '</span>';


                            $link     = urlencode(base64_encode($item['item_ID']));
                            $linkuser = urlencode(base64_encode($userid));

                            //  edit image 
                            if (empty($item['itemPics'])) {
                                echo "  
                                <img class='img-responsive' style='width:180px;height:200px;'  src='admin/uploads/items/no-profile.jpg'>";
                            } else {
                                echo " 
                                <img class='img-responsive' style='width:250px;height:200px;' src='admin/uploads/items/" . $item["itemPics"] . "'  title='admin/uploads/itesm/"  . $item["itemPics"] . "'>  ";
                            }
                            ";

                        echo '<div class='caption'>";
                            echo '<h4 class="htitle"><a href="items.php?itemid=' . $item['item_ID'] . '">' . $item['Name'] . '</a></h4>';
                            echo '<p class="commentd">' . $item['Description'] . '</p>';
                            echo '<a style="position:absolute; top:330px;left:2px;" class="btn btn-primary"
                                          href="profile.php?do=EditItem&itemid=' . $link . '&memberid=' . $linkuser . '"> edit </a>';

                            echo '<a  style="position:absolute; top:330px;left:60px;" class="btn btn-danger confirm"
                                          href="profile.php?do=DeleteItem&itemid=' . $link . '&memberid=' .  $linkuser . '" 
                                          style="margin:5px;"> Delete
                                     </a>';
                            echo '<div class="dated">' . $item['Add_Date'] . '</div>';

                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>';
                        echo ' <a href="newad.php" class="btn btn-primary bg-dark"> add new item</a>';

                        echo '</div>';
                    } else {
                        echo 'there is no ads to show , create <a href="newad.php">New ad </a> ';
                    }
                    ?>
                </div>
            </div>
        <?php
    } elseif ($do == 'showallcomments') { ?>
            <div class="card mt-5 bg-light ">
                <h5 class="card-header bg-dark text-center p-3 text-white"> All comments</h5>
                <div class="card-body">
                    <?php
                    $userid = urldecode(base64_decode($_GET['memberid']));
                    /*  $sql = "SELECT * FROM comments WHERE user_id = '$userid' "; */
                    $sql = "SELECT comments.*, items.*   FROM comments   INNER JOIN items on items.item_ID = comments.item_id WHERE user_id = '$userid' ";
                    $result = mysqli_query($conn, $sql);
                    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    if (!empty($comments)) {
                        foreach ($comments as $comment) {
                            $com = urlencode(base64_encode($comment['c_id']));
                            $linkuser = urlencode(base64_encode($userid));
                            echo "<img class='img-circle my-image' style='width:100px;height:100px;' src='admin/uploads/items/" . $comment['itemPics'] . "'>";
                            echo '<div class="commentp" style="margin-top:20px;">';
                            if ($comment['Status'] == 0) {
                                echo  $comment['comment'] . "<br><p class='approve-comment'> not approve yet</p>";
                            } else {
                                echo $comment['comment'];
                            }

                            if (isset($_SESSION['user']) && ($comment['user_id'] == $_SESSION['uid'])) {
                                echo "<a class='btn confirm' href='profile.php?do=DeleteComment&cid=" . $com . "&memberid=" . $linkuser . "'>X</a>";
                            }



                            echo '</div>';
                            echo "  <hr class= 'custom-hr'>";
                        }
                    } else {
                        echo 'there is no comments here';
                    }

                    ?>

                </div>

            </div>

    <?php }
} else {
    header('Location: login.php');
    exit();
}
include $tpl . 'footer.php';
ob_end_flush();
