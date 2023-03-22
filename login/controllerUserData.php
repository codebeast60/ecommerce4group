 <?php
    session_start();
    require "connection.php";
    $email = "";
    $name = "";
    $errors = array();
    if (isset($_SESSION['user'])) :         //hata ma kel mara yetlob signin
        header("Location: index.php");
    endif;

    //if user signup button
    if (isset($_POST['signup'])) {
        $name        = strtolower(mysqli_real_escape_string($con, $_POST['name']));
        $email       = mysqli_real_escape_string($con, $_POST['email']);
        $password    = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword   = mysqli_real_escape_string($con, $_POST['cpassword']);
        $phone       = mysqli_real_escape_string($con, $_POST['number']);
        $fullName    = strtolower(mysqli_real_escape_string($con, $_POST['full']));
        $image       =  'no-profile.jpg';
        $latitude    = $_POST['latitude'];
        $longitude   = $_POST['longitude'];
        // badword
        $badword = ['shit', 'god', 'admin', 'motherfucker', 'haven', 'fuck', 'hell', 'dick', 'creater', 'bullshit', 'bitch', 'allah'];

        $ip = $_POST['ip'];
        $continent = $_POST['continent'];
        $country = $_POST['country'];
        $capital = $_POST['capital'];
        $district = $_POST['district'];
        $city = $_POST['city'];

        $flag = $_POST['flag'];
        $calling = $_POST['calling'];
        $languages = $_POST['languages'];
        $zone = $_POST['zone'];



        if ($password !== $cpassword) {
            $errors['password'] = "Confirm password not matched!";
        }
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        }



        if (strlen($name) < 2 && strlen($name) > 25) {
            $errors['name'] = 'user name must be greater than 4 char and less than 25 char';
        }
        if (ctype_space($name)) {
            $errors['name'] = "user name cant be spaces";
        }
        if (in_array($name, $badword)) {
            $errors['name'] = "you cant use  " . $name . "  such a user name";
        }

        if (isset($email)) {
            $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true) {
                $errors['email'] = 'this email is not valid';
            }
        } elseif (empty($email) || ctype_space($email)) {
            $errors['email'] = 'email cant be empty';
        }
        if (empty($fullName) || ctype_space($fullName)) {
            $errors['full'] = 'full name can\'t be empty';
        }
        if (in_array($fullName, $badword)) {
            $errors['full'] = "you cant use " . $fullName . "   such a Full Name";
        }
        if (!empty($phone) && !(is_numeric($phone)) || ctype_space($phone)) {
            $errors['number'] = 'your phone Number should be a number';
        }


        $email_check = "SELECT * FROM users WHERE email = '$email' OR userName = '$name'";
        $res = mysqli_query($con, $email_check);
        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = "Email or Name that you have entered is already exist!";
        }
        if (count($errors) === 0) {
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $code = rand(999999, 111111);
            $status = "notverified";
            $insert_data = "INSERT INTO users (userName, email, password, code, status, phone, fullName, regStatus, Date, image)
                        values('$name', '$email', '$encpass', '$code', '$status',  '$phone' ,  '$fullName', 0, now(), '$image')";

            $data_check = mysqli_query($con, $insert_data);
            if ($data_check) {




                $insert_information = " INSERT INTO location (ip, continent_name, country_name, country_capital, district, city, latitude, longitude, flag,calling_code, languages, time_zone, user_name) values
        ('$ip','$continent','$country','$capital','$district','$city','$latitude','$longitude','$flag', '$calling', '$languages', '$zone', '$name')";

                mysqli_query($con, $insert_information);
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                $sender = "From: ecommerce4group@gmail.com";
                if (mail($email, $subject, $message, $sender)) {
                    $info = "We've sent a verification code to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: user-otp.php');
                    exit();
                } else {
                    $errors['otp-error'] = "Failed while sending code!";
                }
            } else {
                $errors['db-error'] = "Failed while inserting data into database!";
            }
        }
    }
    //if user click verification code submit button
    if (isset($_POST['check'])) {
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if (mysqli_num_rows($code_res) > 0) {
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = $code , status = '$status' WHERE code = $fetch_code";
            $sql = "SELECT * FROM users Where code = $fetch_code";
            $result = mysqli_query($con, $sql);
            $get = mysqli_fetch_assoc($result);
            $update_res = mysqli_query($con, $update_otp);
            if ($update_res) {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['uid'] = $get['userID'];
                $_SESSION['user'] = $get['userName'];
                header('location: ../index.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while updating code!";
            }
        } else {
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if (isset($_POST['login'])) {
        $email    = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $sql = "SELECT * FROM users  WHERE email = '$email'";
        $result1 = mysqli_query($con, $sql);
        $get1 = mysqli_fetch_assoc($result1);
        $res = mysqli_query($con, $check_email);
        if (mysqli_num_rows($res) > 0) {
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if (password_verify($password, $fetch_pass)) {
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if ($status == 'verified') {

                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['uid'] = $get1['userID'];
                    $_SESSION['user'] = $get1['userName'];
                    header('location: ../index.php');
                } else {
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            } else {
                $errors['email'] = "Incorrect email or password!";
            }
        } else {
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if (isset($_POST['check-email'])) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if (mysqli_num_rows($run_sql) > 0) {
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if ($run_query) {
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: ecommerce4group.com";
                if (mail($email, $subject, $message, $sender)) {
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                } else {
                    $errors['otp-error'] = "Failed while sending code!";
                }
            } else {
                $errors['db-error'] = "Something went wrong!";
            }
        } else {
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if (isset($_POST['check-reset-otp'])) {
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if (mysqli_num_rows($code_res) > 0) {
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        } else {
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if (isset($_POST['change-password'])) {
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);



        if ($password !== $cpassword) {
            $errors['password'] = "Confirm password not matched!";
        }
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        } else {
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if ($run_query) {
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            } else {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    //if login now button click
    if (isset($_POST['login-now'])) {
        header('Location: login-user.php');
    }
    ?>