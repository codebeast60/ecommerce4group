<?php
session_start();
$pageTitle = 'create New Item';
$page = '';
include 'init.php';

error_reporting(0);
if (isset($_SESSION['user'])) {


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $formErrors = array();
        $name     = mysqli_real_escape_string($conn, $_POST['name']);
        $desc     = mysqli_real_escape_string($conn, $_POST['description']);
        $price    = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
        $country  = mysqli_real_escape_string($conn, $_POST['country']);
        $status   = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
        $id       = $_SESSION['uid'];
        $address  = mysqli_real_escape_string($conn, $_POST['address']);

        // add image

        $avatar = "no-image.png";



        if (!empty($_FILES['item']['name'])) {
            $avatarName = $_FILES['item']['name'];
            $avatarSize = $_FILES['item']['size'];
            $avatarTmp  = $_FILES['item']['tmp_name'];
            $avatarType = $_FILES['item']['type'];


            $avatarAllowedExtention = array("jpeg", "jpg", "png", "gif");
            $avatarExtention = strtolower(end(explode('.', $avatarName)));
            if (!empty($avatarName) && !in_array($avatarExtention, $avatarAllowedExtention)) :
                $formErrors[] = 'This extention is not allowed';
            endif;
            if ($avatarSize > 4194304) :
                $formErrors[] = 'your profile picture cant be more than 4 MB';
            endif;
            if (count($formErrors) == 0) {


                $avatar = $avatarName . "_" . date("y.m.d") . "." . $avatarExtention;
                move_uploaded_file($avatarTmp, "admin/uploads/items//" . $avatar);
            }
        }
        $avatar2 = "no-image.png";



        if (!empty($_FILES['item2']['name'])) {
            $avatarName2 = $_FILES['item2']['name'];
            $avatarSize2 = $_FILES['item2']['size'];
            $avatarTmp2  = $_FILES['item2']['tmp_name'];
            $avatarType2 = $_FILES['item2']['type'];


            $avatarAllowedExtention2 = array("jpeg", "jpg", "png", "gif");
            $avatarExtention2 = strtolower(end(explode('.', $avatarName2)));
            if (!empty($avatarName2) && !in_array($avatarExtention2, $avatarAllowedExtention2)) :
                $formErrors[] = 'This extention is not allowed';
            endif;
            if ($avatarSize2 > 4194304) :
                $formErrors[] = 'your profile picture cant be more than 4 MB';
            endif;
            if (count($formErrors) == 0) {


                $avatar2 = $avatarName2 . "_" . date("y.m.d") . "." . $avatarExtention2;
                move_uploaded_file($avatarTmp2, "admin/uploads/items//" . $avatar2);
            }
        }
        $avatar3 = "no-image.png";



        if (!empty($_FILES['item3']['name'])) {
            $avatarName3 = $_FILES['item3']['name'];
            $avatarSize3 = $_FILES['item3']['size'];
            $avatarTmp3  = $_FILES['item3']['tmp_name'];
            $avatarType3 = $_FILES['item3']['type'];


            $avatarAllowedExtention3 = array("jpeg", "jpg", "png", "gif");
            $avatarExtention3 = strtolower(end(explode('.', $avatarName3)));
            if (!empty($avatarName3) && !in_array($avatarExtention3, $avatarAllowedExtention3)) :
                $formErrors[] = 'This extention is not allowed';
            endif;
            if ($avatarSize3 > 4194304) :
                $formErrors[] = 'your profile picture cant be more than 4 MB';
            endif;
            if (count($formErrors) == 0) {


                $avatar3 = $avatarName3 . "_" . date("y.m.d") . "." . $avatarExtention3;
                move_uploaded_file($avatarTmp3, "admin/uploads/items//" . $avatar3);
            }
        }








        if (strlen($name) < 4) {
            $formErrors[] = 'item title must be more than 4 character';
        } elseif (empty($name) || ctype_space($name)) {
            $formErrors[] = "item name should not be empty";
        }
        if (strlen($desc) < 10) {
            $formErrors[] = 'item description must be more than 10 character';
        } elseif (empty($desc) || ctype_space($desc)) {
            $formErrors[] = "item description should not be empty";
        }
        if (strlen($country) < 2) {
            $formErrors[] = 'item country must be more than 2 character';
        }
        if (empty($price) || ctype_space($price)) {
            $formErrors[] = 'item price must be not empty';
        } elseif (!is_numeric($price)) {
            $formErrors[] = 'item price must be number';
        }
        if (empty($status)) {
            $formErrors[] = 'item status must be not empty';
        }
        if (empty($category)) {
            $formErrors[] = 'item category must be not empty';
        }
        if (empty($address) || ctype_space($address)) {
            $formErrors[] = 'address must be not empty';
        }


        if (count($formErrors) == 0) {
            //insert info into database



            $sql = "INSERT INTO items (Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID,address, itemPics, itemPics2, itemPics3) 
                VALUES ('$name', '$desc', '$price', '$country', '$status', now(),'$category', '$id', '$address',  '$avatar', '$avatar2', '$avatar3') ";
            $result = mysqli_query($conn, $sql);
            if ($result == 1) {
                $successMsg = 'Item has been aded and waiting for approving by admin be pation please';
            }
        }
    }



?>


    <h1 class="text-center">create new Ad</h1>
    <div class="create-ad block">
        <div class="container">
            <div class="panel panel-primary">
                <!--<div class="panel-heading">create new ad</div>-->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-horizontal" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <!-- start name Field-->
                                <div class="form-group form-group-lg">
                                    <label for="user" class="col-sm-3 control-label"> Name</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input pattern=".{4,}" title="this field require at least 4 characters" type="text" name="name" id="user" class="form-control live" placeholder="Name of the Item" data-class=".live-title" required>
                                    </div>
                                </div>
                                <!--end name Field   -->
                                <!-- start description Field-->
                                <div class="form-group form-group-lg">
                                    <label for="user" class="col-sm-3 control-label"> Description</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input pattern=".{10,}" title="this field required at least 10 characters" type="text" name="description" id="user" class="form-control live" placeholder="Description of the Item" data-class=".live-desc" required>
                                    </div>
                                </div>
                                <!--end description Field   -->
                                <!-- start price Field-->
                                <div class="form-group form-group-lg">
                                    <label for="user" class="col-sm-3 control-label"> Price</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input pattern=".{1,}" title="this field required at least 1 characters" type="text" name="price" id="user" class="form-control live" placeholder="price of the Item" data-class=".live-price" required>
                                    </div>
                                </div>
                                <!--end price Field   -->
                                <!-- start country Field-->
                                <div class="form-group form-group-lg">
                                    <label for="user" class="col-sm-3 control-label"> Country Made</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="country" id="user" class="form-control" placeholder="country of made">
                                    </div>
                                </div>
                                <!--end country Field   -->
                                <!-- start status Field-->
                                <div class="form-group form-group-lg">
                                    <label for="user" class="col-sm-3 control-label"> Status</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="status" required>
                                            <option value="0">...</option>
                                            <option value="1">New</option>
                                            <option value="2">like New</option>
                                            <option value="3">used</option>
                                            <option value="4">very used</option>
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
                                            $allCats = getAllFrom("*", "categories", "Where parent = 0", "", "ID");
                                            foreach ($allCats as $cat) {
                                                echo "<option value='" . $cat['ID'] . "'>" . $cat['Name']   . "</option>";
                                                $childCats = getAllFrom("*", "categories", "Where parent = {$cat['ID']}", "", "ID");
                                                /*    foreach ($childCats as $child) {
                                                echo "<option value='" . $child['ID'] . "'>--- " . $child['Name']   . "</option>";
                                            } */
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
                                        <input pattern=".{5,}" title="this field required at least 5 characters" type="text" name="address" id="location" class="form-control live" placeholder="your address" data-class=".live-desc" required>
                                    </div>
                                </div>
                                <!-- end address  -->
                                <!-- start item picture -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-3 control-label">item picture</label>
                                    <div class="col-sm-10 col-md-6">
                                        <div class="itemAdd">

                                            <div class="upload">
                                                <img src="admin/uploads/items/no-image.png" id="image">

                                                <div class="rightRound" id="upload">
                                                    <input type="file" name="item" id="picture" accept=".jpg, .jpeg, .png" required>
                                                    <i class="fa fa-camera text-white"></i>
                                                </div>

                                                <div class="leftRound text-white" id="cancel" style="display: none;">
                                                    <i class="fa fa-times"></i>
                                                </div>

                                            </div>
                                            <div class="upload">
                                                <img src="admin/uploads/items/no-image.png" id="image2">

                                                <div class="rightRound" id="upload2">
                                                    <input type="file" name="item2" id="picture2" accept=".jpg, .jpeg, .png">
                                                    <i class="fa fa-camera text-white"></i>
                                                </div>

                                                <div class="leftRound text-white" id="cancel2" style="display: none;">
                                                    <i class="fa fa-times"></i>
                                                </div>

                                            </div>
                                            <div class="upload">
                                                <img src="admin/uploads/items/no-image.png" id="image3">

                                                <div class="rightRound " id="upload3">
                                                    <input type="file" name="item3" id="picture3" accept=".jpg, .jpeg, .png">
                                                    <i class="fa fa-camera text-white"></i>
                                                </div>

                                                <div class="leftRound text-white" id="cancel3" style="display: none;">
                                                    <i class="fa fa-times"></i>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end item picture -->
                                <!-- start Tags Field
                                
                                 onload="getLocation();"
                               
                                end Tags Field   -->
                                <div class=" form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="submit" value="Add Item" class="btn btn-primary btn-md mb-5">
                                    </div>
                                </div>
                            </form>
                        </div>

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

                    ?>

                    <!--  end of errors -->
                </div>
            </div>
        </div>
    </div>


<?php
} else {
    header("Location:index.php");

    exit();
}
include $tpl . 'footer.php';
