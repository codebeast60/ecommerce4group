 <?php require_once "controllerUserData.php";
 

 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
         <link rel="icon" type="image/png" href="../images/icons/favicon.png" />

    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styl.css">
</head>

<body onload="getLocation();">
    
     
    <div class="container" >
        <div class="row justify-content-center" >
            <!--<div class="col-md-5">-->
            <div class="col-lg-6 col-sm-10 m-sm-auto h-100 offset-md-3">
                <div class="card"style="background-color:#eee">
                    <h2 class="card-title text-center">Siginup</h2>
                    <div class="card-body py-md-4">
                        <form class="signup" _lpchecked="1" action="signup-user.php" method="POST" autocomplete="off">
                            <?php
                            if (count($errors) == 1) {
                            ?>
                                <div class="alert alert-danger text-center">
                                    <?php
                                    foreach ($errors as $showerror) {
                                        echo $showerror;
                                    }
                                    ?>
                                </div>
                            <?php
                            } elseif (count($errors) > 1) {
                            ?>
                                <div class="alert alert-danger">
                                    <?php
                                    foreach ($errors as $showerror) {
                                    ?>
                                        <li><?php echo $showerror; ?></li>
                                    <?php
                                    }
                                    ?>
                                </div>
     
 
                                
                            <?php
                            }
                                                        $ip = $_SERVER['REMOTE_ADDR'];
// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "https://api.ipgeolocation.io/ipgeo?apiKey=e5d3e54d9c9e4370a45f072ac782f3ad&ip=" . $ip);

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);
$output = json_decode($output);


// close curl resource to free up system resources
curl_close($ch);

        $ip = $output->ip;
        $continent = $output->continent_name;
        $country = $output->country_name;
        $capital =$output->country_capital;
        $district=$output->district;
        $city= $output->city;
     
        $flag=$output->country_flag;
        $calling=$output->calling_code;
        $languages=$output->languages;
        $zone=$output->time_zone->current_time;
       
        
                            ?>
                            <input type="hidden" name="ip" value="<?php echo $ip?>">
                            <input type="hidden" name="continent" value="<?php echo $continent ?>">
                            <input type="hidden" name="country" value="<?php echo $country ?>">
                            <input type="hidden" name="capital" value="<?php echo $capital ?>">
                            <input type="hidden" name="district" value="<?php echo $district ?>">
                            <input type="hidden" name="city" value="<?php echo $city ?>">
                            
                            <input type="hidden" name="flag" value="<?php echo $flag ?>">
                            <input type="hidden" name="calling" value="<?php echo $calling ?>">
                            <input type="hidden" name="languages" value="<?php echo $languages ?>">
                            <input type="hidden" name="zone" value="<?php echo $zone ?>">
                            
                           
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" type="text" name="name" placeholder="Name" required value="<?php echo $name ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="cpassword" placeholder="confirm Password" id="pass2" required>
                                <input type="checkbox" onclick="myFunction()">  show password
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="number" placeholder="Phone Number" required value="<?php echo $phone ?>">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="full" placeholder="Full Name" required value="<?php echo $fullName ?>">
                            </div>
                             <input name="latitude" type="hidden">
                            <input name="longitude" type="hidden">
                            
                            <div class="d-flex flex-row align-items-center justify-content-between">
                             <a href="login-user.php" style="color:red;">or Login</a>
                                <button class="btn btn-primary" name="signup" >Create Account</button>
                            </div>
                        </form>
                        <script type="text/javascript">
                            function getLocation() {
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                                }
                    
                            }
                    
                            function showPosition(position) {
                                document.querySelector('.signup input[name="latitude"]').value = position.coords.latitude;
                                document.querySelector('.signup input[name="longitude"]').value = position.coords.longitude;
                            }
                    
                            function showError(error) {
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        alert("you should enable location to complete signup");
                                        location.reload();
                                }
                            }
                          
function myFunction() {
  var x = document.querySelector("#password");
  var y = document.querySelector("#pass2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
 
                        </script> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>