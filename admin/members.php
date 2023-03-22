 <?php
ob_start();
session_start();
$pageTitle = 'Members';
$noNavbar = '';
$pageCss = '';
$page = '';
error_reporting(0);
$userID = $_GET['userid'];
//check user session
if (isset($_SESSION['userName'])) :
    include 'init.php';
    $do  =  isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {

        //Manage page
        $query = '';
        if (isset($_GET['page']) && $_GET['page'] == 'Pending') {
            $query = 'AND regStatus = 0';
        }

        $sql = "SELECT * FROM users WHERE groupID != 1 $query ORDER BY userID DESC";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                    <h1 class="text-center">Manage Member</h1>
                    <div class="container">
                        <form action="?do=searchUser" autocomplete="off" method="POST">
                             
                            
                            <div class="wrap">
                                <div class="search">
                                    <input type="text" class="searchTerm" name="user" placeholder="search.........." required>
                                    <button type="submit" class="searchButton">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="main-table manage-members text-center table table-bordered">
                                <tr>
                                    <td>ID</td>
                                    <td><i class="fa-solid fa-user-tie"></i>Avatar</td>
                                    <td>
                                        <i class="fa-solid fa-user"></i>user Name
                                    </td>
                                    <td>
                                        <i class="fa-solid fa-at"></i>email
                                    </td>
                                    
                                    <td>Full details</td>
                                    <td>Control</td>
                                </tr>
                                <?php
                                foreach ($rows as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row['userID'] . "</td>";
                                    echo "<td>
                           
                            <form id='form' enctype='multipart/form-data'  method='POST'>
                            <div class='upload1'> ";
                                    $id    = $row["userID"];
                                    $name  = $row["userName"];
                                    $image = $row["image"];
                                    if (empty($row['image'])) {
                                        echo " <img class='img-circle' src='uploads/avatars/no-profile.jpg'> ";
                                     
                                    } else {
                                        echo " <img class='img-circle' src='uploads/avatars/" . $row['image'] . "'alt='profile' title='uploads/avatars/'" . $row['image'] . "'>";
                                    }

                                    echo "</td>";
                                    echo "<td>" . $row['userName'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo   "<td> <a href='members.php?do=show&userid=" . $row['userID'] . "'class='btn' style='background-color:#0984e3;color:white;'>show</a> </td>";
                                    echo "<td style='width:300px'>
                                <a href='members.php?do=Edit&userid=" . $row['userID'] . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i>Edit</a>
                                <a href='members.php?do=Delete&userid=" . $row['userID'] . "' class='btn btn-danger confirm'><i class='fa-solid fa-trash'></i>Delete</a>";
                                    if ($row['regStatus'] == 0) {
                                        echo "<a href='members.php?do=Activate&userid=" . $row['userID'] . "'class='btn btn-info activate'><i class='fa-solid fa-check-double'></i>Activate</a>";
                                    }
                                    echo  "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <a href="members.php?do=Add" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>New Member
                        </a>
                    </div>
                </div>
            </div>
        </section>

    <?php   } elseif ($do == 'Add') {
        // Add Members Page
    ?>
        <div class="ncontainer">
            <h1 class="text-center">Add New Member</h1>
            <div class="container">
                <form class="form-horizontal" autocomplete="off" action="?do=Insert" method="POST" enctype="multipart/form-data">
                    <!-- start user name-->
                    <div class="form-group form-group-lg">
                        <label for="user" class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="username" placeholder="User name" id="user" class="form-control" required>
                        </div>
                    </div>
                    <!--end user name   -->
                    <!-- start password -->
                    <div class="form-group form-group-lg">
                        <label for="pass" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="password" name="password" id="pass" placeholder="Password" class="form-control" required>
                        </div>
                    </div>
                    <!--end password -->
                    <!--start Email  -->
                    <div class="form-group form-group-lg">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="email" name="email" id="email" placeholder="Email address" class="form-control">
                        </div>
                    </div>
                    <!-- end Email -->
                    <!--start phone  -->
                    <div class="form-group form-group-lg">
                        <label for="phone" class="col-sm-2 control-label">phone Number</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="number" name="phone" id="phone" placeholder="+961123456789" class="form-control">
                        </div>
                    </div>
                    <!-- end phone -->
                    <!-- start full name -->
                    <div class="form-group form-group-lg">
                        <label for="fullName" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="full" id="fullName" placeholder="Full Name" class="form-control">

                        </div>
                    </div>
                    <!-- end full name -->
                    <!-- start avatar -->
                    <div class="form-group form-group-lg">
                        <label for="fullName" class="col-sm-2 control-label">user image</label>
                        <div class="col-sm-10 col-md-6">
                            <div class="itemAdd">
                                

                                <div class="upload">
                                    <img src="uploads/items/no-image.png" id="image">

                                    <div class="rightRound" id="upload">
                                        <input type="file" name="avatarPic" id="picture" accept=".jpg, .jpeg, .png">
                                        <i class="fa fa-camera"></i>
                                    </div>

                                  <!--  < div class="leftRound" id="cancel" style="display: none;">
                                        <i class="fa fa-times"></i>
                                    </div> -->

                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- end avatar -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Member" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } elseif ($do == 'Insert') {
        //Insert Member Page
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            error_reporting(0);
            echo "<h1 class='text-center'>Insert Member</h1>";
            echo "<div class='container'>";

            $user     = mysqli_real_escape_string($conn,  $_POST['username']);
            $pass     = mysqli_real_escape_string($conn,  $_POST['password']);
            $email    = mysqli_real_escape_string($conn,  $_POST['email']);
            $phone    = mysqli_real_escape_string($conn,  $_POST['phone']);
            $name     = mysqli_real_escape_string($conn,  $_POST['full']);
            $hashPass = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $formErrors = array();


           
            $avatar ="no-profile.jpg";
          


         if (!empty($_FILES['avatarPic']['name'])) {
                $avatarName = $_FILES['avatarPic']['name'];
                $avatarSize = $_FILES['avatarPic']['size'];
                $avatarTmp  = $_FILES['avatarPic']['tmp_name'];
                $avatarType = $_FILES['avatarPic']['type'];


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
                    move_uploaded_file($avatarTmp, "uploads/avatars//" . $avatar);
                    
                }
                
            }


            //validate the form

            if (empty($user)  || ctype_space($user)) :
                $formErrors[] = 'user name can\'t be empty';
            elseif (strlen($user) < 3) :
                $formErrors[] = 'user name can\'t be less than 3 charactere';
            elseif (strlen($user) > 20) :
                $formErrors[] = 'user name can\'t be more than 20 charactere';
            endif;
            if (empty($email) || ctype_space($email)) :
                $formErrors[] = 'Email can\'t be empty';
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                $formErrors[] = 'enter a valid email asshole';
            endif;
            if (empty($pass) || ctype_space($pass)) :
                $formErrors[] = 'Password can\'t be empty';
            endif;
            if (empty($name) || ctype_space($name)) :
                $formErrors[] = 'full Name can\'t be empty';
            endif;

            $check = "SELECT * FROM users WHERE userName='$user' OR email='$email' OR fullName='$name'";
            $result = mysqli_query($conn, $check);
            $userChek = mysqli_fetch_assoc($result);
            if ($userChek) :
                if ($userChek['userName'] === $user) :
                    $formErrors[] = 'user name already exist';
                endif;
                if ($userChek['email'] === $email) :
                    $formErrors[] = 'email already exist';
                endif;
                if ($userChek['fullName'] === $name) :
                    $formErrors[] = 'this Name already exists';
                endif;
            endif;
            foreach ($formErrors as $error) {
                echo '<div class="alert alert-danger text-center">' . $theMsg = $error;
                redirectHome($theMsg, 'back', 5);
                '</div>';
            }
            if (count($formErrors) == 0) {



                $sql = "INSERT INTO users (userName, password, email, phone, fullName, regStatus, Date, image, status )
                     VALUES('$user', '$hashPass', '$email', '$phone', '$name', 1, now(), '$avatar', 'verified' )";
                mysqli_query($conn, $sql);
                $theMsg = "<div class='alert alert-success text-center '>Record inserted </div>";
                redirectHome($theMsg, 'back', 5);
            }
        } else {
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
            redirectHome($theMsg, 5);
            echo "</div>";
        }

        echo 'user name: '  . $_POST['username'] . '<br>'
            . 'Password: '  . $_POST['password'] . '<br> '
            . 'Email: '     . $_POST['email'] . '<br> '
            . 'Full Name: ' . $_POST['full'];
        echo "</div>";
        echo "</div>";
    } elseif ($do == 'Edit') {
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $sql = "SELECT * FROM users WHERE userID ='$userID'  LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
        ?>
            <div class="ncontainer">
                <h1 class="text-center">Edit Member</h1>
                <div class="container">
                    <form class="form-horizontal" autocomplete="off" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="userid" value="<?php echo $userid ?>" />
                        <!-- start user name-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="username" class="form-control" value="<?php echo $row['userName'] ?>" required>
                            </div>
                        </div>
                        <!--                 end user name-->
                        <!--                 start password-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>">
                                <input type="password" name="newpassword" class="form-control" placeholder="Leave it emty if you don't want to change it ">
                            </div>
                        </div>
                        <!--                 end password-->
                        <!--                 start Email-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
                            </div>
                        </div>
                        <!--                 end Email-->
                        <!--                 start phone-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">phone</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="number" name="phone" class="form-control" value="<?php echo $row['phone'] ?>">
                            </div>
                        </div>
                        <!--                 end phone-->
                        <!--                 start full name-->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Full Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="full" class="form-control" value="<?php echo $row['fullName'] ?>">
                            </div>
                        </div>
                        <!-- end full name -->
                        <!-- start avatar -->
                        <div class="form-group form-group-lg">
                            <label for="fullName" class="col-sm-2 control-label">user image</label>
                            <div class="col-sm-10 col-md-6">
                                
                                <div class="itemAdd">


                                    <div class="upload">
                                        <img src="uploads/avatars/<?php echo $row['image'] ?>" id="image">

                                        <div class="rightRound" id="upload">
                                            <input type="hidden" name="oldImage" value="<?php echo $row['image'] ?>">
                                            <input type="file" name="image" id="picture" accept=".jpg, .jpeg, .png">
                                            <i class="fa fa-camera"></i>
                                        </div>

                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end avatar -->
                        <div class=" form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="save" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                    </form>
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
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'>Update Member</h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id    = mysqli_real_escape_string($conn, $_POST['userid']);
            $user  = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $name  = mysqli_real_escape_string($conn, $_POST['full']);
            $errors = array();
            //password trick
           $pass  = empty($_POST['newpassword']) ? $_POST['oldpassword'] : password_hash($_POST['newpassword'] , PASSWORD_BCRYPT);
            // image trick
            $ava = $_POST['oldImage'];
            $uploadImage = "image='$ava'";

            if (!empty($_FILES['image']['name'])) {
                $aName = $_FILES['image']['name'];
                $aSize = $_FILES['image']['size'];
                $aTmp  = $_FILES['image']['tmp_name'];
                $aType = $_FILES['image']['type'];


                $aAllowedExtention = array("jpeg", "jpg", "png", "gif");
                $aExtention = strtolower(end(explode('.', $aName)));
                if (!empty($aName) && !in_array($aExtention, $aAllowedExtention)) :
                    $errors[] = 'This extention is not allowed';
                endif;
                if ($aSize > 4194304) :
                    $errors[] = 'your profile picture cant be more than 4 MB';
                endif;
                if (count($errors) == 0) {

                    $ava = $aName . "_" . date("y.m.d") . "." . $aExtention;
                    move_uploaded_file($aTmp, "uploads/avatars//" . $ava);
                    $uploadImage = "image='$ava'";
                }
            }


            //validate the form


            if (empty($user) || ctype_space($user)) {
                $errors[] = 'user name can\'t be empty';
            } elseif (strlen($user) < 3) {
                $errors[] = 'user name can\'t be less than 3 charactere';
            } elseif (strlen($user) > 20) {
                $errors[] = 'user name can\'t be more than 20 charactere';
            }
            if (empty($email) || ctype_space($email)) {
                $errors[] = 'Email can\'t be empty';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "enter a valid email";
            }
            if (empty($name)) {
                $errors[] = 'full Name can\'t be empty';
            }
            if (empty($phone) || ctype_space($phone)) {
                $errors[] = 'phone number can\'t be empty';
            } elseif (!is_numeric($phone)) {
                $errors[] = "your phone number must be number not string";
            }


            foreach ($errors as $error) {
                $theMsg = '<div class="alert alert-danger text-center">' . $error . '</div>';
                redirectHome($theMsg,  4);
            }
            if (count($errors) == 0) {

                $sql2 = "SELECT * FROM users WHERE userName = '$user' AND userID != '$id'";
                $result =  mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result) == 1) {
                    $theMsg = "<div class='alert alert-danger text-center'> sorry this user is already exists   </div>";
                    redirectHome($theMsg, 'back', 4);
                } else {
                    $sql = "UPDATE users SET userName ='$user', email ='$email', phone='$phone', fullName='$name', password='$pass', $uploadImage WHERE userID= '$id'";
                    $result =  mysqli_query($conn, $sql);


                    $theMsg = "<div class='alert alert-success text-center'>Record updated </div>";
                    redirectHome($theMsg, 'back', 4);
                }
            }
        } else {
            $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
            redirectHome($theMsg, 5);
        }
        echo "</div>";
        echo "</div>";
    } elseif ($do == 'Delete') {
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'> Delete Member</h1>";
        echo "<div class='container'>";
        //Delete Members
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $sql = "SELECT * FROM users WHERE userID ='$userID'  LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $sql = "DELETE FROM users WHERE userID='$userid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>" . 'Record Deleted </div>';
            redirectHome($theMsg, 5);
        } else {
            $theMsg = '<div class="alert alert-danger text-center">this ID is not exist </div>';
            redirect($theMsg, 5);
        }
        echo '</div>';
        echo '</div>';
    } elseif ($do == 'Activate') {
        echo "<div class='ncontainer'>";
        echo "<h1 class='text-center'> Activate Member</h1>";
        echo "<div class='container'>";
        //activate Members
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $sql = "SELECT * FROM users WHERE userID ='$userID'  LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $sql = "UPDATE users SET regStatus = 1 WHERE userID = '$userid'";
            mysqli_query($conn, $sql);
            $theMsg = "<div class='alert alert-success text-center'>" . 'Member Activated </div>';
            redirect($theMsg, 5);
        } else {
            $theMsg = '<div class="alert alert-danger text-center"> this ID is not exist </div>';
            redirectHome($theMsg, 5);
        }
        echo '</div>';
        echo '</div>';
    } elseif ($do == 'show'){
        $show = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $sql = "SELECT * FROM users WHERE userID = $show";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['userName'];
        if($result){
            $sql2="SELECT * FROM `location` WHERE user_name = '$user_name' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
           
       

        ?>
         
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
             <img class="img-responsive img-circle" style="width:100px;height:100px;"  src="uploads/avatars/<?php echo $row['image'] ?>" alt="img">
            <h3><?php echo $user_name ?>  </h3>

        </div>

        <div class="col-md-12">
            <table class="table text-center">
                <tr>
                    <th>IP address</th>
                    <td><?php echo $row2['ip'] ?></td>
                </tr>
                <tr>
                    <th>email address</th>
                    <td><?php echo $row['email'] ?></td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td><?php echo $row['fullName'] ?></td>
                </tr>
                <tr>
                    <th>Regestration date</th>
                    <td><?php echo $row['Date'] ?></td>
                </tr>
                <tr>
                    <th>continent name</th>
                    <td><?php echo $row2['continent_name'] ?></td>
                </tr>
                <tr>
                    <th>country Name</th>
                    <td><?php echo $row2['country_name'] ?></td>
                </tr>
                <tr>
                    <th>country Capital</th>
                    <td><?php echo $row2['country_capital'] ?></td>
                </tr>
                <tr>
                    <th>district</th>
                    <td><?php echo $row2['district'] ?></td>
                </tr>
                <tr>
                    <th>city</th>
                    <td><?php echo $row2['city'] ?></td>
                </tr>
                <tr>
                    <th>flag</th>
                   <td><img src="<?php echo ($row2['flag']); ?>" class="img-fluid"></td>
                </tr>
                <tr>
                    <th>Location on google map</th>
                    <td>
                        <iframe src="https://www.google.com/maps?q=<?php echo $row2['latitude'] ?>,<?php echo $row2['longitude']; ?>&hl=es;z=14&output=embed"></iframe>
                    </td>
                </tr>
                
                
                <tr>
                    <th>phone number</th>
                    <td><?php echo $row2['calling_code'] ." ( " . $row['phone'] . ")" ?></td>
                </tr>
                <tr>
                    <th>languages</th>
                    <td><?php echo $row2['languages'] ?></td>
                </tr>
               
            </table>
        </div>

    </div>
</div>
<?php
    } }elseif ($do == 'searchUser') {


        $str = mysqli_real_escape_string($conn, $_POST['user']);
        $sql = "SELECT * FROM users WHERE userName LIKE '%$str%' AND groupID != 1  ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)  > 0) { ?>
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
                            <a href="Members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">
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
                        <h1 class="text-center">result of { <span style="color:brown"><?php echo $str ?></span> }</h1>
                        <div class="container">

                            <div class="table-responsive">
                                <table class="main-table manage-members text-center table table-bordered">
                                    <tr>
                                        <td>ID</td>
                                        <td><i class="fa-solid fa-user-tie"></i>Avatar</td>
                                        <td>
                                            <i class="fa-solid fa-user"></i>user Name
                                        </td>
                                        <td>
                                            <i class="fa-solid fa-at"></i>email
                                        </td>
                                        <td>phone number</td>
                                        <td>Registerd Date</td>
                                        <td>Control</td>
                                    </tr>
                                    <?php

                                    echo "<tr>";
                                    echo "<td>" . $row['userID'] . "</td>";
                                    echo "<td>
                           
                            <form id='form' enctype='multipart/form-data'  method='POST'>
                            <div class='upload1'> ";
                                    $id    = $row["userID"];
                                    $name  = $row["userName"];
                                    $image = $row["image"];
                                    if (empty($row['image'])) {
                                        echo " <img class='img-circle' src='uploads/avatars/no-profile.jpg'> ";
                                    } else {
                                        echo " <img class='img-circle' src='uploads/avatars/" . $row['image'] . "'alt='profile' title='uploads/avatars/'" . $row['image'] . "'>";
                                    }

                                    echo "</td>";
                                    echo "<td>" . $row['userName'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['phone'] . "</td>";
                                    /* echo "<td>" . $row['Date']  . "</td>"; */
                                    echo "<td> <a href='members.php?do=show&userid=" . $row['userID'] . "'>show</a> </td>";
                                    echo "<td style='width:300px'>
                                <a href='members.php?do=Edit&userid=" . $row['userID'] . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i>Edit</a>
                                <a href='members.php?do=Delete&userid=" . $row['userID'] . "' class='btn btn-danger confirm'><i class='fa-solid fa-trash'></i>Delete</a>";
                                    if ($row['regStatus'] == 0) {
                                        echo "<a href='members.php?do=Activate&userid=" . $row['userID'] . "'class='btn btn-info activate'><i class='fa-solid fa-check-double'></i>Activate</a>";
                                    }
                                    echo  "</td>";
                                    echo "</tr>";

                                    ?>
                                </table>
                            </div>
                            <a href="members.php?do=Add" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>New Member
                            </a>
                        </div>
                    </div>
                </div>
            </section>


<?php } else {
            $theMsg = "<div class='alert alert-danger text-center'>this user is not exists</div>";
            redirect($theMsg, 5);
        }
    }

    include $tpl . 'footer.php';
else :
    header("location: index.php");
    exit();
endif;
ob_end_flush();
