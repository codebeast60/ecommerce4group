 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>

 <body onload="getLocation()">



     <script type="text/javascript">
         function getLocation() {
             if (navigator.geolocation) {
                 navigator.geolocation.getCurrentPosition(showPostion,showError);

             }
         }

         function showPostion(position) {
             document.querySelector('.signup input[name = "latitude"]').value = position.coords.latitude;
             document.querySelector('.signup input[name = "longtitude"]').value = position.coords.longtitude;
         }
         function shoError(error){
            switch(error.code){
                case error.PERMISSION_DENIED:
                    alert("you must allow the requset for geolocation to fill out the sign up");
                    location.reload();
                    break;
            }
         }
     </script>

 </body>

 </html>