$(function() {
    "use strict";
    //dashboard

    $(".toggle-info").click(function() {
        $(this)
            .toggleClass("selected")
            .parent()
            .next(".panel-body")
            .fadeToggle(100);
        if ($(this).hasClass("selected")) {
            $(this).html('<ion-icon name="remove-outline"></ion-icon>');
        } else {
            $(this).html('<ion-icon name="add-outline"></ion-icon>');
        }
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
    var passField = $(".password");
    $(".show-pass").hover(
        function() {
            passField.attr("type", "text");
        },
        function() {
            passField.attr("type", "password");
        }
    );
    $(".confirm").click(function() {
        return confirm("are you sure budy?");
    });
    // category view option

    $(".cat h3").click(function() {
        $(this).next(".full-view").fadeToggle(200);
    });

    $(".option span").click(function() {
        $(this).addClass("active").siblings("span").removeClass("active");
        if ($(this).data("view") === "full") {
            $(".cat .full-view").fadeIn(200);
        } else {
            $(".cat .full-view").fadeOut(200);
        }
    });
    //show delete btn on child cats
    $(".child-link").hover(
        function() {
            $(this).find(".show-delete").fadeIn(400);
        },
        function() {
            $(this).find(".show-delete").fadeOut(400);
        }
    );
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