<?php
session_start();
$noNavbar = '';
$pageTitle = 'Login';
$page = '';
if (isset($_SESSION['userName'])) :         //hata ma kel mara yetlob signin
    header("location: dashboard.php");
endif;
include 'init.php';
echo '<br>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $userName = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn,$_POST['pass']);
    // encrypt password
   // $hashedPass = sha1($password);

    $sql = "SELECT userID, userName, password
              FROM users
                WHERE userName ='$userName'
                
                AND groupID = 1 LIMIT 1";

    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $fetch_pass = $row['password'];
        if(password_verify($password, $fetch_pass)){
        $_SESSION['userName'] = $userName;
        $_SESSION['ID'] = $row['userID'];
        header("location: dashboard.php");
        exit();
    }
     }
endif;
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h4 class="text-center">Admin Login</h4>
    <input type="text" class="form-control input-lg text-center" name="user" placeholder="User Name" autocomplete="off">
    <input type="password" class="form-control input-lg text-center" name="pass" placeholder="Password" autocomplete="new-password">
    <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
</form>
<?php include $tpl . 'footer.php'; ?>