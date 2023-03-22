<?php
/*
** Categories page 
**
*/
ob_start();
session_start();
$pageTitle = 'Categories';
$noNavbar = '';
$pageCss = '';
$page = '';
if (isset($_SESSION['userName'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') {
        $sort = 'ASC';
        $sort_array = array('ASC', 'DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            $sort = $_GET['sort'];
        }
        $sql = "SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort";
        $result = mysqli_query($conn, $sql);
        $cats = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
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

                    <h1 class="text-center">Manage Categories</h1>

                    <div class="dash-content">
                        <div class="overview">

                            <div class="option pull-right">
                                ordering:[
                                <a class="<?php if ($sort == 'ASC') {
                                                echo 'active';
                                            }  ?>" href="?sort=ASC">ASC</a> |
                                <a class="<?php if ($sort == 'DESC') {
                                                echo 'active';
                                            } ?>" href="?sort=DESC">DESC</a>]
                                view:[ <span class="active" data-view="full" style="cursor:pointer;color:#337ab7;">Full</span> |
                                <span data-view="classic" style="cursor:pointer;color:#337ab7;">classic </span>]
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php
                            foreach ($cats as $cat) {
                                echo "<div class='cat'>";
                                echo "<div class='hidden-buttons'>";
                                echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa-solid fa-pen-to-square' style='padding:5px;'></i>Edit</a>";
                                echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "' class='confirm btn btn-xs btn-danger'><i class='fa-solid fa-trash' style='padding:5px;'></i>Delete</a>";
                                echo "</div>";
                                echo "<h3>" . $cat['Name'] . '</h3>';
                                echo "<div class='full-view'>";
                                echo "<p>";
                                if ($cat['Description'] == '') {
                                    echo 'this category has no description';
                                } else {
                                    echo "<p>" .$cat['Description'] . "</p>";
                                }
                                echo "</p>";

                                // get child categories
                              /*    $childCats =  getAllFrom("*", "categories", "Where parent = {$cat['ID']}", "", "ID", "ASC");
                               if (!empty($childCats)) {
                                    echo "<h4 class='child-head'>child categories</h4>";
                                    echo '<ul class="list-unstyled child-cats">';


                                    echo '</ul>';
                                } */
                                echo "</div>";

                                echo "</div>";


                                echo "<hr>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <a href="categories.php?do=Add" class="add-category btn btn-primary">
                    <ion-icon name="add-outline" style=' position:relative; top:3px; right:4px; font-size:18px;'></ion-icon> New Categories
                </a>
            </div>
            </div>
        </section>



    <?php } elseif ($do == 'Add') {

    ?>


        <div class="ncontainer">
            <h1 class="text-center">Add New Category</h1>
            <div class="container">
                <form class="form-horizontal" autocomplete="off" action="?do=Insert" method="POST">
                    <!-- start name Field-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label"> Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="catName" id="user" class="form-control"  placeholder="Name of the category">
                        </div>
                    </div>
                    <!--end name Field   -->
                    <!-- start description Field -->
                    <div class="form-group form-group-lg">
                        <label for="desc" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="description" id="desc" class="form-control"   placeholder="describe the category">
                        </div>
                    </div>
                    <!--end description Field -->
                    <!--start ordering Field  -->
                    <div class="form-group form-group-lg">
                        <label for="email" class="col-sm-2 control-label">Ordering</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="ordering" id="email" class="form-control" placeholder="Number to arrange the categories">
                        </div>
                    </div>
                    <!-- end ordering Field -->
                    <!-- start category type -->
                   <!--  <div class="form-group form-group-lg">
                        <label for="email" class="col-sm-2 control-label">Category type</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="parent">
                                <option value="0">None</option>
                                <?php
                                $allCats = getAllFrom("*", "categories", "WHERE parent = 0", "", "ID", "ASC");
                                foreach ($allCats as $cat) {
                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <!-- end category type -->
                    <!-- start visibility Field-->
                 <!--    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input type="radio" name="visibility" id="vis-yes" value="0" checked>
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="visibility" id="vis-no" value="1">
                                <label for="vis-no">No</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- end visibility Field -->
                    <!-- start commenting Field-->
                  <!--   <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Commenting</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input type="radio" name="commenting" id="com-yes" value="0" checked>
                                <label for="com-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="commenting" id="com-no" value="1">
                                <label for="com-no">No</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- end commenting Field -->
                    <!-- start Ads Field-->
                   <!--  <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input type="radio" name="ads" id="ads-yes" value="0" checked>
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div>
                                <input type="radio" name="ads" id="ads-no" value="1">
                                <label for="ads-no">No</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- end Ads Field -->
                    <div class=" form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Category" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>





        <?php
    } elseif ($do == 'Insert') {
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'></h1>";
        echo "<div class='container'>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<h1 class='text-center'>Insert Category</h1>";
            echo "<div class='container'>";
            $catName  = mysqli_real_escape_string($conn,  $_POST['catName']);
            $desc     = mysqli_real_escape_string($conn,  $_POST['description']);
            /* $parent   = mysqli_real_escape_string($conn,  $_POST['parent']); */
            $order    = mysqli_real_escape_string($conn,  $_POST['ordering']);
           /*  $visible  = mysqli_real_escape_string($conn,  $_POST['visibility']);
            $comment  = mysqli_real_escape_string($conn,  $_POST['commenting']);
            $ads      = mysqli_real_escape_string($conn,  $_POST['ads']); */
            $formErrors = array();
            if(empty($catName) || ctype_space($catName)  ){
                $formErrors[] = "category name should not be empty";
            }
            
            if(empty($desc) || ctype_space($desc)){
                $formErrors[] = "category description should not be empty";
            }
            
            if(empty($order) || ctype_space($order)){
                $formErrors[] = "order cannot be empty";
            }
            if (!is_numeric($order)) {
                $formErrors[] = "you should enter a number";
            }
            foreach ($formErrors as $error) {
                $theMsg = "<div class='alert alert-danger text-center'>" .  $error . "</div>";

                redirect($theMsg, 5);
            }

            if(count($formErrors) == 0){
                 $theMsg = "<div class='alert alert-danger text-center'>this Category is exist</div>";
            $check = checkItem("Name", "categories", $catName, $theMsg);
            if ($check == 1);
            else {
                $sql = "INSERT INTO categories (Name, Description,  Ordering)
                                         VALUES('$catName', '$desc', '$order')";/*, /* '$parent',  '$visible', '$comment', '$ads' *//*,  Visibility, Allow_Comment, Allow_Ads /* parent, */
                mysqli_query($conn, $sql);
                $theMsg = "<div class='alert alert-success text-center '>Record inserted </div>";
                redirectHome($theMsg, 5);
             }
             echo "</div>";
            }
           
        } else {
            echo "<div class='ncontainer'";
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
            redirect($theMsg,  5);
            echo "</div>";
            echo "</div>";
        }
    } elseif ($do == 'Edit') {
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $sql = "SELECT * FROM categories WHERE ID ='$catid' ";
        $result = mysqli_query($conn, $sql);
        $cat = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
        ?>
            <div class="ncontainer">
                <h1 class="text-center">Edit Category</h1>
                <div class="container">
                    <form class="form-horizontal" autocomplete="off" action="?do=Update" method="POST">
                        <input type="hidden" name="catid" value="<?php echo $catid ?>">

                        <!-- start name Field-->
                        <div class="form-group form-group-lg">
                            <label for="user" class="col-sm-2 control-label"> Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="name" id="user" class="form-control" placeholder="Name of the category" value="<?php echo $cat['Name'] ?>" >
                            </div>
                        </div>
                        <!--end name Field   -->
                        <!-- start description Field -->
                        <div class=" form-group form-group-lg">
                            <label for="pass" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="description" id="pass" class="form-control" placeholder="describe the category" value="<?php echo $cat['Description'] ?>">
                            </div>
                        </div>
                        <!--end description Field -->
                        <!--start ordering Field  -->
                        <div class="form-group form-group-lg">
                            <label for="email" class="col-sm-2 control-label">Ordering</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="ordering" id="email" class="form-control" placeholder="Number to arrange the categories" value="<?php echo $cat['Ordering'] ?>">
                            </div>
                        </div>
                        <!-- end ordering Field -->
                        <!-- start category type -->
                     <!--    <div class="form-group form-group-lg">
                            <label for="email" class="col-sm-2 control-label">parent </label>
                            <div class="col-sm-10 col-md-6">
                                <select name="parent">
                                    <option value="0">None</option>
                                    <?php
                                    $allCats = getAllFrom("*", "categories", "WHERE parent = 0", "", "ID", "ASC");
                                    foreach ($allCats as $c) {
                                        echo "<option value='" . $c['ID'] . "'";
                                        if ($cat['parent'] == $c['ID']) {
                                            echo 'selected';
                                        }
                                        echo ">" . $c['Name'] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> -->
                        <!-- end category type -->
                        <!-- start visibility Field-->
                    <!--     <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Visible</label>
                            <div class="col-sm-10 col-md-6">
                                <div>
                                    <input type="radio" name="visibility" id="vis-yes" value="0" <?php if ($cat['Visibility'] == 0) :
                                                                                                        echo 'checked';
                                                                                                    endif; ?>>
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" name="visibility" id="vis-no" value="1" <?php if ($cat['Visibility'] == 1) :
                                                                                                    echo 'checked';
                                                                                                endif; ?>>
                                    <label for="vis-no">No</label>
                                </div>
                            </div>
                        </div> -->
                        <!-- end visibility Field -->
                        <!-- start commenting Field-->
                    <!--     <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Commenting</label>
                            <div class="col-sm-10 col-md-6">
                                <div>
                                    <input type="radio" name="commenting" id="com-yes" value="0" <?php if ($cat['Allow_Comment'] == 0) :
                                                                                                        echo 'checked';
                                                                                                    endif; ?>>
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" name="commenting" id="com-no" value="1" <?php if ($cat['Allow_Comment'] == 1) :
                                                                                                    echo 'checked';
                                                                                                endif; ?>>
                                    <label for="com-no">No</label>
                                </div>
                            </div>
                        </div> -->
                        <!-- end commenting Field -->
                        <!-- start Ads Field-->
                     <!--    <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Allow Ads</label>
                            <div class="col-sm-10 col-md-6">
                                <div>
                                    <input type="radio" name="ads" id="ads-yes" value="0" <?php if ($cat['Allow_Ads'] == 0) :
                                                                                                echo 'checked';
                                                                                            endif; ?>>
                                    <label for="ads-yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" name="ads" id="ads-no" value="1" <?php if ($cat['Allow_Ads'] == 1) :
                                                                                                echo 'checked';
                                                                                            endif; ?>>
                                    <label for="ads-no">No</label>
                                </div>
                            </div>
                        </div> -->
                        <!-- end Ads Field -->
                        <div class=" form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Update" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<?php } else {
           
            $theMsg = '<div class="alert alert-danger text-center">there is no such ID </div>';
            redirect($theMsg, 5);
         
        }
    } elseif ($do == 'Update') {
        echo "<h1 class='text-center'>Update Category</h1>";
        echo "<div class='ncontainer'";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id       = mysqli_real_escape_string($conn, $_POST['catid']);
            $name     = mysqli_real_escape_string($conn, $_POST['name']);
            $desc     = mysqli_real_escape_string($conn, $_POST['description']);
            $order    = mysqli_real_escape_string($conn, $_POST['ordering']);
            $errors = array();
           /*  $parent   = mysqli_real_escape_string($conn, $_POST['parent']);
            $visible  = mysqli_real_escape_string($conn, $_POST['visibility']);
            $comment  = mysqli_real_escape_string($conn, $_POST['commenting']);
            $ads      = mysqli_real_escape_string($conn, $_POST['ads']); */
            if(empty($name) || ctype_space($name)){
                $errors[] = "you should enter a name of category";
            }
            if(!is_numeric($order)){
                $errors[] = "you should enter a number";
            }
            foreach($errors as $error){
                $theMsg = "<div class='alert alert-danger text-center'>" .  $error . "</div>";

                redirect($theMsg, 5);
            }

            if(count($errors) == 0){
                   $sql = "UPDATE categories SET
                                       `Name` ='$name',
                                       `Description` ='$desc',
                                        Ordering = '$order'
                                     
                                   WHERE ID = '$id'";
                                   
                                    /*   parent = '$parent',
                                        Visibility = '$visible',
                                        Allow_Comment = '$comment',
                                        Allow_Ads = '$ads' */
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>Record Updated </div>";
            redirectHome($theMsg, 4);
            }
            echo "</div>";

         
        } else {
            $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
            redirectHome($theMsg, 'back', 5);
        }
        echo "</div>";
        echo "</div>";
    } elseif ($do == 'Delete') {
        echo "<div class='ncontainer'";
        echo "<div class='container'>";
        echo "<h1 class='text-center'> Delete category</h1>";
        //Delete Members
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $check = "SELECT ID FROM categories WHERE ID ='$catid' LIMIT 1";
        $result = mysqli_query($conn, $check);
        if (mysqli_num_rows($result) == 1) {
            $sql = "DELETE FROM categories WHERE ID='$catid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>Record Deleted </div>";
            redirectHome($theMsg, 5);
        } else {
            $theMsg = '<div class="alert alert-danger text-center">this ID is not Exist </div>';
            redirect($theMsg, 5);
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