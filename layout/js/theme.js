$("document").ready(function() {
    $("#doctorSlideshow").owlCarousel({
        nav: true,
        dots: false,
        navText: [
            "<span class='mai-arrow-back'></span>",
            "<span class='mai-arrow-forward'></span>",
        ],
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
    });
});

$("document").ready(function() {
    $("a[data-role='smoothscroll']").click(function(e) {
        e.preventDefault();

        var position = $($(this).attr("href")).offset().top - nav_height;

        $("body, html").animate({
                scrollTop: position,
            },
            1000
        );
        return false;
    });
});

$("document").ready(function() {
    // Back to top
    var backTop = $(".back-to-top");

    $(window).scroll(function() {
        if ($(document).scrollTop() > 400) {
            backTop.css("visibility", "visible");
        } else if ($(document).scrollTop() < 400) {
            backTop.css("visibility", "hidden");
        }
    });

    backTop.click(function() {
        $("html").animate({
                scrollTop: 0,
            },
            1000
        );
        return false;
    });
});

$("document").ready(function() {
    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Popovers
    $('[data-toggle="popover"]').popover();

    // Page scroll animate
    new WOW().init();
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