 <?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
     <link rel="icon" type="image/png" href="../images/icons/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-10 m-sm-auto h-100 offset-md-3 form">
                <form action="forgot-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $error) {
                                echo $error;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary btn-block btn-lg" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>