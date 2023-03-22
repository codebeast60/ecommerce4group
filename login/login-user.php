 <?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
         <link rel="icon" type="image/png" href="../images/icons/favicon.png" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styl.css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-10 m-sm-auto h-100 offset-md-3">
                <h2 class="text-center text-dark mt-6">Login </h2>

                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" action="login-user.php" method="POST" autocomplete="off">

                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>
                        <?php
                        if (count($errors) > 0) {
                        ?>
                            <div class="alert alert-danger text-center">
                                <?php
                                foreach ($errors as $showerror) {
                                    echo $showerror;
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="mb-3">
                            <input type="email" class="form-control" id="Username" name="email" aria-describedby="emailHelp" placeholder="@email" value="<?php echo $email ?>">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" class="form-control" id="password" placeholder="password">
                            <input type="checkbox" onclick="myFunction()">  show password
                        </div>
                        <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div><br>
                        <div class="text-center"><button type="submit" name="login" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="signup-user.php"  style="color:red;"> Create an Account</a>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
function myFunction() {
  var x = document.querySelector("#password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>

</html>