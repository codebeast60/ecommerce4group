<?php
session_start();
$pageTitle = 'Comments';
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

        $sql = "SELECT 
                    comments.*, items.Name AS Item_Name, users.userName AS Member
                FROM 
                      comments
                INNER JOIN
                      items
                on
                      items.item_ID = comments.item_id
                INNER JOIN
                      users
                on
                      users.userID = comments.user_id
                ORDER BY
                      c_id DESC   ";
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
                    <h1 class="text-center">Manage Comments</h1>
                    <div class="container">
                        <div class="table-responsive">
                            <table class="main-table text-center table table-bordered">
                                <tr>
                                    <td>ID</td>
                                    <td>Comment</td>
                                    <td> Item Name</td>
                                    <td>User Name</td>
                                    <td>Added Date</td>
                                    <td>Control</td>
                                </tr>
                                <?php
                                foreach ($rows as $row) {
                                    echo "<tr>";
                                    echo "<td>" . $row['c_id'] . "</td>";
                                    echo "<td style='width:450px;color:#6060c7;'>" . $row['comment'] . "</td>";
                                    echo "<td>" . $row['Item_Name'] . "</td>";
                                    echo "<td>" . $row['Member'] . "</td>";
                                    echo "<td>" . $row['comment_date']  . "</td>";
                                    echo "<td>
                                <a href='comments.php?do=Edit&comid=" . $row['c_id'] . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square' '></i>Edit</a>
                                <a href='comments.php?do=Delete&comid=" . $row['c_id'] . "'onclick='return confirm()' class='btn btn-danger confirm'><i class='fa-solid fa-trash' ></i>Delete</a>";
                                    if ($row['statusC'] == 0) {
                                        echo "<a href='comments.php?do=Approve&comid=" . $row['c_id'] . "'class='btn btn-info activate'><i class='fa-solid fa-thumbs-up'></i>Approve</a>";
                                    }
                                    echo  "</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </table>
                        </div>
                    </div>


                    <?php   } elseif ($do == 'Edit') {
                    $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                    $sql = "SELECT * FROM comments WHERE c_id ='$comid'  ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if (mysqli_num_rows($result) == 1) {
                    ?>
                        <div class="ncontainer">
                        <h1 class="text-center">Edit Comment</h1>
                        <div class="container">
                            <form class="form-horizontal" autocomplete="off" action="?do=Update" method="POST">
                                <input type="hidden" name="comid" value="<?php echo $comid ?>" />
                                <!-- start comment-->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Comment</label>
                                    <div class="col-sm-10 col-md-6">
                                        <textarea class="form-control" style="max-width:300px;height:400px" name="comment">
                                    <?Php echo $row['comment'] ?>
                                </textarea>
                                    </div>
                                </div>
                                <!--  end comment-->
                                <div class=" form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" value="save" class="btn btn-primary btn-lg">
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                        </div>
                        </div>
        </section>
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
                        $comid    = mysqli_real_escape_string($conn, $_POST['comid']);
                        $comment  = mysqli_real_escape_string($conn, $_POST['comment']);
                        $errors= array();
                        if(empty($comment) || ctype_space($comment)){
                            $errors[]= "comment should not be empty";
                        }
                        foreach($errors as $error){
                            $theMsg = "<div class='alert alert-danger text-center'>" .  $error . "</div>";

                             redirect($theMsg, 5);
                        }

                        $sql = "UPDATE comments SET comment ='$comment'  WHERE c_id= '$comid'";
                        mysqli_query($conn, $sql);
                        $theMsg = "<div class='alert alert-success text-center'>" . 'record updated </div>';
                        redirectHome($theMsg, 'back', 4);
                    } else {
                        $theMsg = '<div class="alert alert-danger text-center">sorry you cant Browse this page directly</div>';
                        redirect($theMsg, 5);
                    }
                    echo "</div>";
                    echo "</div>";
                } elseif ($do == 'Delete') {
                    echo "<div class='ncontainer'>";
                    echo "<h1 class='text-center'> Delete Comment</h1>";
                    echo "<div class='container'>";
                    //Delete Members
                    $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                    $sql = "SELECT c_id FROM comments WHERE c_id ='$comid' ";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        $sql = "DELETE FROM comments WHERE c_id='$comid'";
                        mysqli_query($conn, $sql);
                        $theMsg = "<div class='alert alert-success text-center'>" . 'Record Deleted </div>';
                        redirect($theMsg, 5);
                    } else {
                        $theMsg = '<div class="alert alert-danger text-center">this ID is not exist </div>';
                        redirect($theMsg, 'back', 5);
                    }
                    echo '</div>';
                    echo '</div>';
                } elseif ($do == 'Approve') {
                    echo "<div class='ncontainer'>";
                    echo "<h1 class='text-center'> Approve Comment</h1>";
                    echo "<div class='container'>";
                    //Approve comments
                    $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                    $sql = "SELECT * FROM comments WHERE c_id ='$comid' ";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        $sql = "UPDATE comments SET statusC = 1 WHERE c_id = '$comid'";
                        mysqli_query($conn, $sql);
                        $theMsg = "<div class='alert alert-success text-center'>" . 'Comment Approved </div>';
                        redirect($theMsg, 5);
                    } else {
                        $theMsg = 'this ID is not exist';
                        redirect($theMsg, 5);
                    }
                    echo '</div>';
                    echo '</div>';
                }
                include $tpl . 'footer.php';
            else :
                header("location: index.php");
                exit();
            endif;
