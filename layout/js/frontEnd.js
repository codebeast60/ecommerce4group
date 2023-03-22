  $(function() {
    "use strict";

    //switch between login and signup

    $(".login-page h1 span").click(function() {
        $(this).addClass("selected").siblings().removeClass("selected");
        $(".login-page form").hide();
        $("." + $(this).data("class")).fadeIn(200);
    });

    // trigger the selectbox

    $("select").selectBoxIt({
        autoWidth: false,
    });

    // hide placeholder

    $("[placeholder]")
        .focus(function() {
            $(this).attr("data-text", $(this).attr("placeholder"));
            $(this).attr("placeholder", "");
        })
        .blur(function() {
            $(this).attr("placeholder", $(this).attr("data-text"));
        });

    $(".confirm").click(function() {
        return confirm("are you sure budy?");
    });

    //hatta y5ali yektob bnafs el wa2et

    $(".live").keyup(function() {
        $($(this).data("class")).text($(this).val());
    });
});


// add image
document.getElementById("picture").onchange = function() {
    document.getElementById("image").src = URL.createObjectURL(picture.files[0]); // Preview new image

    document.getElementById("cancel").style.display = "block";

    document.getElementById("upload").style.display = "none";
};
document.getElementById("picture2").onchange = function() {
    document.getElementById("image2").src = URL.createObjectURL(
        picture2.files[0]
    ); // Preview new image

    document.getElementById("cancel2").style.display = "block";

    document.getElementById("upload2").style.display = "none";
};
document.getElementById("picture3").onchange = function() {
    document.getElementById("image3").src = URL.createObjectURL(
        picture3.files[0]
    ); // Preview new image

    document.getElementById("cancel3").style.display = "block";

    document.getElementById("upload3").style.display = "none";
};

var userImage = document.getElementById("image").src;
document.getElementById("cancel").onclick = function() {
    document.getElementById("image").src = userImage; // Back to previous image

    document.getElementById("cancel").style.display = "none";

    document.getElementById("upload").style.display = "block";
};

var userImage2 = document.getElementById("image2").src;
document.getElementById("cancel2").onclick = function() {
    document.getElementById("image2").src = userImage2; // Back to previous image

    document.getElementById("cancel2").style.display = "none";

    document.getElementById("upload2").style.display = "block";
};

var userImage3 = document.getElementById("image3").src;
document.getElementById("cancel3").onclick = function() {
    document.getElementById("image3").src = userImage3; // Back to previous image

    document.getElementById("cancel3").style.display = "none";

    document.getElementById("upload3").style.display = "block";
};
console.log("hi");
 


















