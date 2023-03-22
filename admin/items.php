<?php
/*
** items page 
**
*/
ob_start();
session_start();
$pageTitle = 'Items';
$noNavbar = '';
$pageCss = '';
$page = '';
if (isset($_SESSION['userName'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') {


        $sql = "SELECT items.*,
                       categories.Name AS category_name,
                       users.userName
                 From 
                       items
                 INNER JOIN 
                      categories
                 ON 
                      categories.ID = items.Cat_ID
                 INNER JOIN
                      users
                 ON 
                      users.userID = items.Member_ID
                 ORDER BY 
                      item_ID DESC";
        $result = mysqli_query($conn, $sql);
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
        <!--------------------------------- start navbar  ------------------------------------------->
        <nav>
            <div class="logo-name">
                <div class="logo-image">
                    <!-- <img src="images/logo.png"  /> -->
                </div>

                <span class="logo_name"><?php echo $_SESSION['userName'] ?></span>
            </div>

            <div class="menu-items">
                <ul class="nav-links">
                    <li>
                        <a href="dashboard.php">
                            <i class="uil uil-estate"></i>
                            <span class="link-name">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="categories.php">
                            <i class=" uil uil-files-landscapes"></i>
                            <span class="link-name">Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="items.php">
                            <i class="uil uil-chart"></i>
                            <span class="link-name">items</span>
                        </a>
                    </li>
                    <li>
                        <a href="comments.php">
                            <i class="uil uil-comments"></i>
                            <span class="link-name">Comment</span>
                        </a>
                    </li>
                    <li>
                        <a href="members.php">
                            <i class="fa-solid fa-user-group"></i>
                            <span class="link-name">Members</span>
                        </a>
                    </li>
                </ul>

                <ul class="logout-mode">
                    <li>
                        <a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span class="link-name">edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="../index.php">
                            <i class="fa-brands fa-golang"></i>
                            <span class="link-name">vist shop</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span>
                        </a>
                    </li>

                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                            <span class="link-name">Dark Mode</span>
                        </a>

                        <div class="mode-toggle">
                            <span class="switch"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!--------------------------------- end navbar  --------------------------------------------->
        <section class="dashboard">
            <i class="uil uil-bars sidebar-toggle" style="font-size:26px;cursor:pointer;"></i>
            <div class="dash-content">
                <div class="overview">
                    <h1 class="text-center">Manage Items</h1>
                    <div class="container">
                        <div class="table-responsive">
                            <table class="main-table text-center table table-bordered">
                                <tr>
                                    <td># ID</td>
                                    <td>Name</td>
                                    <td>Description</td>
                                    <td>Price</td>
                                    <td>added Date</td>
                                    <td>category</td>
                                    <td>username</td>
                                    <td>Control</td>
                                </tr>
                                <?php
                                foreach ($items as $item) {
                                    echo "<tr>";
                                    echo "<td>" . $item['item_ID'] . "</td>";
                                    echo "<td style='width:30px;'>" . $item['Name'] . "</td>";
                                    echo "<td style='width:280px;color:#6060c7;'>" . $item['Description'] . "</td>";
                                    echo "<td>" . $item['Price'] . " $</td>";
                                    echo "<td style='width:120px'>" . $item['Add_Date']  . "</td>";
                                    echo "<td>" . $item['category_name']  . "</td>";
                                    echo "<td>" . $item['userName']  . "</td>";
                                    echo "<td style='width:320px'>
                                <a href='items.php?do=Edit&itemid=" . $item['item_ID'] . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square' ></i>Edit</a>
                                <a href='items.php?do=Delete&itemid=" . $item['item_ID'] . "' class='btn btn-danger confirm'><i class='fa-solid fa-trash' ></i>Delete</a>";
                                    if ($item['Approve'] == 0) {
                                        echo "<a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "'class='btn btn-info activate'><i class='fa-solid fa-thumbs-up'></i>Approve</a>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <a href="items.php?do=Add" class="btn btn-sm btn-primary">
                            <ion-icon name="add-outline" style=' position:relative; top:3px; right:2px; font-size:16px;'></ion-icon>New item
                        </a>
                    </div>
                </div>
            </div>
        </section>

    <?php
    } elseif ($do == 'Add') {
    ?>
        <div class="ncontainer">
            <h1 class="text-center">Add New Item</h1>
            <div class="container">
                <form class="form-horizontal" autocomplete="off" action="?do=Insert" method="POST" enctype="multipart/form-data">
                    <!-- start name Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="name" id="user" class="form-control" placeholder="Name of the Item" required>
                        </div>
                    </div>
                    <!--end name Field   -->
                    <!-- start description Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="description" id="user" class="form-control" placeholder="Description of the Item">
                        </div>
                    </div>
                    <!--end description Field   -->
                    <!-- start price Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="price" id="user" class="form-control" placeholder="price of the Item">
                        </div>
                    </div>
                    <!--end price Field   -->
                    <!-- start country Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Country</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="country" id="user" class="form-control" placeholder="country of made">
                        </div>
                    </div>
                    <!--end country Field   -->
                    <!-- start status Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status">
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">like New</option>
                                <option value="3">used</option>
                                <option value="4">old</option>
                            </select>
                        </div>
                    </div>
                    <!--end status Field   -->
                    <!-- start Member Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Member</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="member">
                                <option value="0">...</option>
                                <?php
                                $allMembers = getAllFrom("*", "users", "WHERE regStatus = 1", "", "userID");
                                foreach ($allMembers as $user) {
                                    echo "<option value='" . $user['userID'] . "'>" . $user['userName']   . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end Member Field   -->
                    <!-- start category Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Category </label>
                        <div class="col-sm-10 col-md-6">
                            <select name="category">
                                <option value="0">...</option>
                                <?php
                                $allCats = getAllFrom("*", "categories", "Where parent = 0", "", "ID");
                                foreach ($allCats as $cat) {
                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name']   . "</option>";
                                    $childCats = getAllFrom("*", "categories", "Where parent = {$cat['ID']}", "", "ID");
                                    /* foreach ($childCats as $child) {
                                        echo "<option value='" . $child['ID'] . "'>--- " . $child['Name']   . "</option>";
                                    } */
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end category Field   -->
                    <!-- start picture  -->
                    <div class="form-group form-group-lg">
                        <label for="fullName" class="col-sm-2 control-label">item photo</label>
                        <div class="col-sm-10 col-md-6">
                            
                            <div class="itemAdd">

                                <div class="upload">
                                    <img src="uploads/items/no-image.png" id="image">
                                    <div class="rightRound" id="upload">
                                        <input type="file" name="item" id="picture" accept=".jpg, .jpeg, .png">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                <div class="upload">
                                    <img src="uploads/items/no-image.png" id="image2">
                                    <div class="rightRound" id="upload2">
                                        <input type="file" name="item2" id="picture2" accept=".jpg, .jpeg, .png">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                <div class="upload">
                                    <img src="uploads/items/no-image.png" id="image3">
                                    <div class="rightRound" id="upload3">
                                        <input type="file" name="item3" id="picture3" accept=".jpg, .jpeg, .png">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                     <!-- end picture -->
                    <!-- start Tags Field
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> tags</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="tags" id="user" class="form-control" placeholder="seperate with comma (,)">
                        </div>
                    </div>
                    end Tags Field   -->
                    <div class=" form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Item" class="btn btn-primary btn-md">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } elseif ($do == 'Insert') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<div class='ncontainer'>";
            echo "<h1 class='text-center'>Insert Item</h1>";
            echo "<div class='container'>";


            $name     = mysqli_real_escape_string($conn,  $_POST['name']);
            $desc     = mysqli_real_escape_string($conn,  $_POST['description']);
            $price    = mysqli_real_escape_string($conn,  $_POST['price']);
            $country  = mysqli_real_escape_string($conn,  $_POST['country']);
            $status   = mysqli_real_escape_string($conn,  $_POST['status']);
            $member   = mysqli_real_escape_string($conn,  $_POST['member']);
            $cat      = mysqli_real_escape_string($conn,  $_POST['category']);
 
            $formErrors = array();
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
                    move_uploaded_file($avatarTmp, "uploads/items//" . $avatar);
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
                    move_uploaded_file($avatarTmp2, "uploads/items//" . $avatar2);
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
                    move_uploaded_file($avatarTmp3, "uploads/items//" . $avatar3);
                }
            }


           


            //validate the form

            if (empty($name) || ctype_space($name)) :
                $formErrors[] = 'Name can\'t be empty';
            endif;
            if (empty($desc) || ctype_space($desc)) :
                $formErrors[] = 'Description can\'t be empty';
            endif;
            if (empty($price) || ctype_space($price)) :
                $formErrors[] = 'Price can\'t be empty';
            endif;
            if (empty($country) || ctype_space($country)) :
                $formErrors[] = 'Country can\'t be empty';
            endif;
            if ($status == 0) :
                $formErrors[] = 'you must choose the status';
            endif;
            if ($member == 0) :
                $formErrors[] = 'you must choose the <strong>member</strong>';
            endif;
            if ($cat == 0) :
                $formErrors[] = 'you must choose the status';
            endif;

            foreach ($formErrors as $error) {
                $theMsg = "<div class='alert alert-danger text-center'>" .  $error . "</div>";

                redirect($theMsg, 5);
            }
            if (count($formErrors) == 0) {
                //insert info into database

               $sql = "INSERT INTO items (Name, Description, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID,   Approve, itemPics, itemPics2, itemPics3) 
                       VALUES
                       ('$name', '$desc', '$price', '$country', '$status', now(),'$cat', '$member',  1, '$avatar','$avatar2','$avatar3' ) ";
                $result = mysqli_query($conn, $sql);

                if ($result == 1) {

                    $theMsg = "<div class='alert alert-success text-center'> item added </div>";
                    redirectHome($theMsg, 5);
                }
                echo "</div>";
            }
        } else {
            echo "<div class='ncontainer'>";
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger text-center">sorry you can\'t Browse this page directly</div>';
            redirect($theMsg, 5);
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } elseif ($do == 'Edit') {
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        $sql = "SELECT * FROM items WHERE item_ID ='$itemid' ";
        $result = mysqli_query($conn, $sql);
        $item = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
        ?>
            <div class="ncontainer">
                <h1 class="text-center">Edit Item</h1>
                <div class="container">
                    <form class="form-horizontal" autocomplete="off" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
                        <!-- start name Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="name" id="user" class="form-control" placeholder="Name of the Item" value="<?php echo $item['Name'] ?>">
                            </div>
                        </div>
                        <!--end name Field   -->
                        <!-- start description Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Description</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="description" id="user" class="form-control" placeholder="Description of the Item" value="<?php echo $item['Description'] ?>">
                            </div>
                        </div>
                        <!--end description Field   -->
                        <!-- start price Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Price</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="price" id="user" class="form-control" placeholder="price of the Item" value="<?php echo $item['Price'] ?>">
                            </div>
                        </div>
                        <!--end price Field   -->
                        <!-- start country Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Country</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="country" id="user" class="form-control" placeholder="country of made" value="<?php echo $item['Country_Made'] ?>">
                            </div>
                        </div>
                        <!--end country Field   -->
                        <!-- start status Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Status</label>
                            <div class="col-sm-10 col-md-6">
                                <select name="status">
                                    <option value="1" <?php if ($item['Status'] == 1) {
                                                            echo 'selected';
                                                        } ?>>New</option>
                                    <option value="2" <?php if ($item['Status'] == 2) {
                                                            echo 'selected';
                                                        } ?>>like New</option>
                                    <option value="3" <?php if ($item['Status'] == 3) {
                                                            echo 'selected';
                                                        } ?>>used</option>
                                    <option value="4" <?php if ($item['Status'] == 4) {
                                                            echo 'selected';
                                                        } ?>>old</option>
                                </select>
                            </div>
                        </div>
                        <!--end status Field   -->
                        <!-- start Member Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Member</label>
                            <div class="col-sm-10 col-md-6">
                                <select name="member">
                                    <?php
                                    $sql = "SELECT * FROM users WHERE regStatus = 1 AND groupID != 1";
                                    $result = mysqli_query($conn, $sql);
                                    $users =  mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach ($users as $user) {
                                        echo "<option value='" . $user['userID'] . "'";
                                        if ($item['Member_ID'] == $user['userID']) {
                                            echo 'selected';
                                        }
                                        echo ">" . $user['userName']   . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!--end Member Field   -->
                        <!-- start category Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Category </label>
                            <div class="col-sm-10 col-md-6">
                                <select name="category">
                                    <?php
                                    $sql2 = "SELECT * FROM categories Where parent = 0";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $cats =  mysqli_fetch_all($result2, MYSQLI_ASSOC);
                                    foreach ($cats as $cat) {
                                        echo "<option value='" . $cat['ID'] . "'";
                                        if ($item['Cat_ID'] == $cat['ID']) {
                                            echo 'selected';
                                        }
                                        echo ">" . $cat['Name']   . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!--end category Field   -->
                        <!-- start avatar -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">item image</label>
                            <div class="col-sm-10 col-md-6">
                                <div class="itemAdd">

                                    <div class="upload">
                                        <img src="uploads/items/<?php echo $item['itemPics'] ?>" alt="img" id="image">

                                        <div class="rightRound" id="upload">
                                            <input type="file" name="image" id="picture" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    <div class="upload">
                                    
                                            <img src="uploads/items/<?php echo $item['itemPics2'] ?>" alt="img" id="image2">
                                      
                                        <div class="rightRound" id="upload2">
                                            <input type="hidden" name="oldImage2" value="<?php echo $item['itemPics2'] ?>">
                                            <input type="file" name="image2" id="picture2" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    <div class="upload">
                                      
                                            <img src="uploads/items/<?php echo $item['itemPics3'] ?>" alt="img" id="image3">
                                    
                                        <div class="rightRound" id="upload3">
                                            <input type="hidden" name="oldImage3" value="<?php echo $item['itemPics3'] ?>">
                                            <input type="file" name="image3" id="picture3" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end avatar -->


                        <div class=" form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Save ITEM" class="btn btn-primary ">
                            </div>
                        </div>
                    </form>
                    <!-- item picture -->



                </div>


            </div>
            <?php
            $sql = "SELECT
                             comments.*,  users.userName AS Member
                        FROM
                             comments
                        INNER JOIN
                             users
                        on
                             users.userID = comments.user_id
                        WHERE item_id = '$itemid'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (!empty($rows)) {
            ?>
                <div class="ncontainer">
                    <h1 class="text-center"> <b><?php echo $item['Name']  ?> </b> Comments</h1>
                    <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                                <td>Comment</td>
                                <td>User Name</td>
                                <td>Added Date</td>
                                <td>Control</td>
                            </tr>
                            <?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['comment'] . "</td>";
                                echo "<td>" . $row['Member'] . "</td>";
                                echo "<td>" . $row['comment_date']  . "</td>";
                                echo "<td>
                                <a href='comments.php?do=Edit&comid=" . $row['c_id'] . "' class='btn btn-success'><ion-icon name='create-outline' style='position:relative;top:1px; right:4px;'></ion-icon>Edit</a>
                                <a href='comments.php?do=Delete&comid=" . $row['c_id'] . "'onclick='return confirm()' class='btn btn-danger confirm'><ion-icon name='trash-outline' style='position:relative;top:1px;right:4px;'></ion-icon>Delete</a>";
                                if ($row['statusC'] == 0) {
                                    echo "<a href='comments.php?do=Approve&comid=" . $row['c_id'] . "'class='btn btn-info activate'><ion-icon name='contract-outline' style='position:relative;top:1px;right:4px;'></ion-icon>Approve</a>";
                                }
                                echo  "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                <?php } ?>
                </div>
                </div>

    <?php } else {
            echo "<div class='ncontainer'>";
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger text-center">there is no such ID </div>';
            redirectHome($theMsg, 5);
            echo "</div>";
            echo "</div>";
        }
    } elseif ($do == 'Update') {
        error_reporting(0);
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'>update Item</h1>";
        echo "<div class='container'>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id       = mysqli_real_escape_string($conn, $_POST['itemid']);
            $name     = mysqli_real_escape_string($conn, $_POST['name']);
            $desc     = mysqli_real_escape_string($conn, $_POST['description']);
            $price    = mysqli_real_escape_string($conn, $_POST['price']);
            $country  = mysqli_real_escape_string($conn, $_POST['country']);
            $status   = mysqli_real_escape_string($conn, $_POST['status']);
            $cat      = mysqli_real_escape_string($conn, $_POST['category']);
            $member   = mysqli_real_escape_string($conn, $_POST['member']);

            $formErrors = array();
            // image trick
            $ava = $_POST['oldImage'];
            $uploadImage = "itemPics='$ava'";

            if (!empty($_FILES['image']['name'])) {
                $aName = $_FILES['image']['name'];
                $aSize = $_FILES['image']['size'];
                $aTmp  = $_FILES['image']['tmp_name'];
                $aType = $_FILES['image']['type'];


                $aAllowedExtention = array("jpeg", "jpg", "png", "gif");
                $aExtention = strtolower(end(explode('.', $aName)));
                if (!empty($aName) && !in_array($aExtention, $aAllowedExtention)) :
                    $formErrors[] = 'This extention is not allowed';
                endif;
                if ($aSize > 4194304) :
                    $formErrors[] = 'your profile picture cant be more than 4 MB';
                endif;
                if (count($formErrors) == 0) {

                    $ava = $aName . "_" . date("y.m.d") . "." . $aExtention;
                    move_uploaded_file($aTmp, "uploads/items//" . $ava);
                    $uploadImage = "itemPics='$ava'";
                }
            }

            $ava2 = $_POST['oldImage2'];
            $uploadImage2 = "itemPics2='$ava2'";

            if (!empty($_FILES['image2']['name'])) {
                $aName2 = $_FILES['image2']['name'];
                $aSize2 = $_FILES['image2']['size'];
                $aTmp2  = $_FILES['image2']['tmp_name'];
                $aType2 = $_FILES['image2']['type'];


                $aAllowedExtention2 = array("jpeg", "jpg", "png", "gif");
                $aExtention2 = strtolower(end(explode('.', $aName2)));
                if (!empty($aName) && !in_array($aExtention2, $aAllowedExtention2)) :
                    $formErrors[] = 'This extention is not allowed';
                endif;
                if ($aSize2 > 4194304) :
                    $formErrors[] = 'your profile picture cant be more than 4 MB';
                endif;
                if (count($formErrors) == 0) {

                    $ava2 = $aName2 . "_" . date("y.m.d") . "." . $aExtention2;
                    move_uploaded_file($aTmp2, "uploads/items//" . $ava2);
                    $uploadImage2 = "itemPics2='$ava2'";
                }
            }

            $ava3 = $_POST['oldImage3'];
            $uploadImage3 = "itemPics3='$ava3'";

            if (!empty($_FILES['image3']['name'])) {
                $aName3 = $_FILES['image3']['name'];
                $aSize3 = $_FILES['image3']['size'];
                $aTmp3  = $_FILES['image3']['tmp_name'];
                $aType3 = $_FILES['image3']['type'];


                $aAllowedExtention3 = array("jpeg", "jpg", "png", "gif");
                $aExtention3 = strtolower(end(explode('.', $aName3)));
                if (!empty($aName3) && !in_array($aExtention3, $aAllowedExtention3)) :
                    $formErrors[] = 'This extention is not allowed';
                endif;
                if ($aSize3 > 4194304) :
                    $formErrors[] = 'your profile picture cant be more than 4 MB';
                endif;
                if (count($formErrors) == 0) {

                    $ava3 = $aName3 . "_" . date("y.m.d") . "." . $aExtention3;
                    move_uploaded_file($aTmp3, "uploads/items//" . $ava3);
                    $uploadImage3 = "itemPics3='$ava3'";
                }
            }






            //validate the form

            if (empty($name) || ctype_space($name)) :
                $formErrors[] = 'Name can\'t be empty';
            endif;
            if (empty($desc) || ctype_space($desc)) :
                $formErrors[] = 'Description can\'t be empty';
            endif;
            if (empty($price) || ctype_space($price)) :
                $formErrors[] = 'Price can\'t be empty';
            endif;
            if (empty($country) || ctype_space($country)) :
                $formErrors[] = 'Country can\'t be empty';
            endif;
            if ($status == 0) :
                $formErrors[] = 'you must choose the status';
            endif;
            if ($member == 0) :
                $formErrors[] = 'you must choose the <strong>member</strong>';
            endif;
            if ($cat == 0) :
                $formErrors[] = 'you must choose the status';
            endif;
            foreach ($formErrors as $error) {
                $theMsg = "<div class='alert alert-danger text-center'>" . $error .  "</div>";
                redirect($theMsg, 5);
            }
            if (count($formErrors) == 0) {
                $sql = "UPDATE items 
                                SET     Name         = '$name',
                                        Description  = '$desc',
                                        Price        = '$price',
                                        Country_Made = '$country',
                                        Status       = '$status' ,
                                        Cat_ID       = '$cat',
                                        Member_ID    = '$member',
                                        $uploadImage,
                                        $uploadImage2,
                                        $uploadImage3
                                        
                                WHERE 
                                       item_ID = '$id'";
                $result =  mysqli_query($conn, $sql);
                if ($result == 1) {
                    $theMsg = "<div class='alert alert-success text-center'> record updated </div>";
                    redirectHome($theMsg, 4);
                }
                echo "</div>";
            }
        } else {
            $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
            redirectHome($theMsg, 5);
        }
        echo "</div>";
        echo "</div>";
    } elseif ($do == 'Delete') {
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'> Delete Item</h1>";
        echo "<div class='container'>";
        //Delete Members
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        $sql = "SELECT * FROM items WHERE item_ID ='$itemid'  LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $sql = "DELETE FROM items WHERE item_ID='$itemid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>" . 'Record Deleted </div>';
            redirectHome($theMsg, 'back', 5);
        } else {
            $theMsg = '<div class="alert alert-danger text-center">this ID is not exist </div>';
            redirect($theMsg, 5);
        }
        echo '</div>';
        echo '</div>';
    } elseif ($do == 'Approve') {
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'> Approve Item</h1>";
        echo "<div class='container'>";

        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        $sql = "SELECT * FROM items WHERE item_ID ='$itemid'  LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $sql = "UPDATE items SET Approve = 1 WHERE item_ID = '$itemid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>" . 'Item Approved </div>';
            redirect($theMsg, 5);
        } else {
            $theMsg = "<div class='alert alert-danger'> this ID is not exist </div>";
            redirectHome($theMsg, 5);
        }
        echo '</div>';
        echo '</div>';
    }
    include $tpl . 'footer.php';
} else {
    header('Location: index.php');
    exit();
}
ob_end_flush();  // Release Te Output