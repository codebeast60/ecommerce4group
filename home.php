<?php
ob_start();
session_start();
$pageTitle = 'Home Page';
include 'init.php';
?>
<div class="landing text-light d-flex justify-content-center align-items-center ">
    <div class="text-center">
        <h2 class="text-uppercase fw-bold">sold or buy anything <br>in one place</h2>
        <p class="fs-6 text-white-50 mb-5 mt-3">welcome into amazing experiences</p>
        <a class="btn btn-primary rounded-pill main-btn w-75 " href="index.php"> Lets Get Started</a>
    </div>
</div>

<div class="features text-center pt-5 pb-5 ">
    <div class="container">
        <div class="main-title mt-5 mb-5 position-relative">

            <i class="fa-solid fa-cart-shopping mb-4" style="color:19283f;font-size:4rem; "></i>
            <h2>We are good at</h2>
            <p class="text-black-50 text-uppercase ">some of these stuff under</p>

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 ">
                <div class="feat">
                    <div class="icon-holder position-relative">
                        <i class="fa-solid fa-1 position-absolute bottom-0 number"></i>
                        <i class="fa-solid fa-pencil position-absolute bottom-0 icon"></i>
                    </div>
                    <h4 class="mb-4 mt-4 text-uppercase">Sale anything</h4>
                    <p class="text-black-50 lh-lg">
                       Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 ">
                <div class="feat">
                    <div class="icon-holder position-relative">
                        <i class="fa-solid fa-2 position-absolute bottom-0 number"></i>
                        <i class="fa-solid fa-tv position-absolute bottom-0 icon"></i>
                    </div>
                    <h4 class="mb-4 mt-4 text-uppercase">buy anything</h4>
                    <p class="text-black-50 lh-lg">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

s.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 ">
                <div class="feat">
                    <div class="icon-holder position-relative">
                        <i class="fa-solid fa-3 position-absolute bottom-0 number"></i>
                        <i class="fa-solid fa-plug position-absolute bottom-0 icon"></i>
                    </div>
                    <h4 class="mb-4 mt-4 text-uppercase">contact seller</h4>
                    <p class="text-black-50 lh-lg">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ssd">

    <div id="carouselExampleControls" class="carousel  mt-5" style="max-height:500px" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="admin/uploads/imgs/background1.png" class="d-block w-100 pe-3 ps-3" style="max-height:500px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="admin/uploads/imgs/background2.jpg" class="d-block w-100 pe-3 ps-3" style="max-height:500px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="admin/uploads/imgs/background3.png" class="d-block w-100 pe-3 ps-3" style="max-height:500px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="admin/uploads/imgs/background4.jpg" class="d-block w-100 pe-3 ps-3" style="max-height:500px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="admin/uploads/imgs/background5.avif" class="d-block w-100 pe-3 ps-3" style="max-height:500px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="admin/uploads/imgs/background6.jpg" class="d-block w-100 pe-3 ps-3" style="max-height:500px" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="our-work text-center mt-5 mb-5">
    <div class="container">
        <div class="main-title mt-5 mb-5 position-relative">

            <i class="fa-brands fa-product-hunt pt-4 pb-4" style="font-size:4rem;color:#19283f"></i>
            <h2 class="text-uppercase">our product</h2>
            <p class="text-black-50 fs-5">prepare to be amazed</p>
        </div>
        <ul class="list-unstyled d-flex justify-content-center mt-5 mb-5  tabs">
            <li class="active rounded-pill" data-cont=".one">cell phones</li>
            <li class=" rounded-pill" data-cont=".two">hand made</li>
            <li class=" rounded-pill" data-cont=".three">computer</li>
            <li class=" rounded-pill" data-cont=".four">clothing</li>
            <li class=" rounded-pill" data-cont=".five">boxes</li>
            <li class=" rounded-pill" data-cont=".six">clean</li>
        </ul>
        <div class="content">
            <?php
            $sql = "SELECT * FROM items WHERE Cat_ID = '10' AND Approve = 1 limit 4";
            $result = mysqli_query($conn, $sql);
            $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($result) {
            ?>
                <div class="row one d-f">
                    <?php
                    foreach ($items as $item) {
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 ">
                            <div class="block2">

                                <img class="img-fluid img-responsive" style="height:250px;width:300px;" src="admin/uploads/items/<?php echo $item['itemPics'] ?>">
                            </div>
                        </div>
                    <?php } ?>
                <?php
            } ?>
                </div>
                <?php
                $sql = "SELECT * FROM items WHERE Cat_ID = '14' AND Approve = 1 ORDER BY item_ID DESc  LIMIT 4";
                $result = mysqli_query($conn, $sql);
                $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if ($result) {
                ?>
                    <div class="row two d-none">
                        <?php
                        foreach ($items as $item) {
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <div class="block2">

                                    <img class="img-fluid img-responsive" style="height:250px;width:300px;" src="admin/uploads/items/<?php echo $item['itemPics'] ?>">
                                </div>
                            </div>
                        <?php } ?>
                    <?php
                } ?>
                    </div>
                    <?php
                    $sql = "SELECT * FROM items WHERE Cat_ID = '15' AND Approve = 1 ORDER BY item_ID DESc  LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    if ($result) {
                    ?>
                        <div class="row three d-none">
                            <?php
                            foreach ($items as $item) {
                            ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 ">
                                    <div class="block2">

                                        <img class="img-fluid img-responsive" style="height:250px;width:300px;" src="admin/uploads/items/<?php echo $item['itemPics'] ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        <?php
                    } ?>
                        </div>
                        <?php
                        $sql = "SELECT * FROM items WHERE Cat_ID = '17' AND Approve = 1 ORDER BY item_ID DESc  LIMIT 4";
                        $result = mysqli_query($conn, $sql);
                        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        if ($result) {
                        ?>
                            <div class="row four d-none">
                                <?php
                                foreach ($items as $item) {
                                ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 ">
                                        <div class="block2">

                                            <img class="img-fluid img-responsive" style="height:250px;width:300px;" src="admin/uploads/items/<?php echo $item['itemPics'] ?>">
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php
                        } ?>
                            </div>
                            <?php
                            $sql = "SELECT * FROM items WHERE Cat_ID = '23' AND Approve = 1 ORDER BY item_ID DESc  LIMIT 4";
                            $result = mysqli_query($conn, $sql);
                            $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            if ($result) {
                            ?>
                                <div class="row five d-none">
                                    <?php
                                    foreach ($items as $item) {
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 ">
                                            <div class="block2">

                                                <img class="img-fluid img-responsive" style="height:250px;width:300px;" src="admin/uploads/items/<?php echo $item['itemPics'] ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php
                            } ?>
                                </div>
                                <?php
                                $sql = "SELECT * FROM items WHERE Cat_ID = '28' AND Approve = 1 ORDER BY item_ID DESc  LIMIT 4";
                                $result = mysqli_query($conn, $sql);
                                $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                if ($result) {
                                ?>
                                    <div class="row six d-none">
                                        <?php
                                        foreach ($items as $item) {
                                        ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                                                <div class="block2">

                                                    <img class="img-fluid img-responsive" style="height:250px;width:300px;" src="admin/uploads/items/<?php echo $item['itemPics'] ?>">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php
                                } ?>
                                    </div>



        </div>

    </div>
</div>

<script>
    let tabs = Array.from(document.querySelectorAll(".tabs li"));
    let divs = Array.from(document.querySelectorAll(".content > div"));
    tabs.forEach((ele) => {
        ele.addEventListener("click", function(e) {
            tabs.forEach((ele) => {
                ele.classList.remove("active");
            });
            e.currentTarget.classList.add("active");
            divs.forEach((div) => {
                div.style.display = "none";
            });
            document.querySelector(e.currentTarget.dataset.cont).style.display = "flex";
            document.querySelector(e.currentTarget.dataset.cont).classList.remove("d-none");
        });
    });
</script>

<div class="stuff pt-4 pt-5">
    <div class="container">
        <div class="main-title text-center mt-5 mb-5 position-relative">
            <i class="fa-solid fa-anchor mb-4" style="color:#19283f;font-size:4rem;"></i>
            <h2>some stuff about us</h2>
            <p class="text-black-50  text-uppercase">the greate team</p>
            <p class="description text-center mb-5 mt-4 text-black-50">
                donec rutrum congue leo ehet malesuada. Mauris blandit aliquet elit , eget ticidunt nibh puvinar a. Pellentesque in ipsum id orci porta dapibus . Proin eget tortor risus.Sonec sollicitudin molestie malesuada.
            </p>
        </div>
        <div class="row " style="padding-top:190px;">
            <div class="col-lg-4 mb-4 pt-5 text-center text-md-start">
                <div class="text ">
                    <h4>ECOMMERCE</h4>
                    <p class="text-black-50 w-75 fs-6">donec rutrum congue leo ehet malesuada. Mauris blandit aliquet elit , eget ticidunt nibh puvinar a. Pellentesque in ipsum id orci porta dapibus . Proin eget tortor risus.Sonec sollicitudin molestie malesuada.</p>
                    <p class="text-black-50 w-75 js-6">donec rutrum congue leo ehet malesuada. Mauris blandit aliquet elit , eget ticidunt nibh puvinar a. Pellentesque in ipsum id orci porta dapibus . Proin eget tortor risus.Sonec sollicitudin molestie malesuada.</p>
                    <a href="#" class="btn btn-primary text-uppercase ">Order Me One</a>
                </div>
            </div>
            <div class="col-lg-8 " style="padding-top:145px;">
                <img class="img-fluid" src="admin/uploads/imgs/laptop.jfif" alt="">
            </div>
        </div>
    </div>
</div>

<hr class="mt-5 w-75 m-auto text-success">

<div class="team text-center pt-5 pb-5">
    <div class="container pt-5 pb-5">
        <div class="main-title text-center mt-5 mb-5 position-relative">
            <i class="fa-solid fa-people-group" style="font-size:4rem;color:#19283f"></i>
            <h2 class="fw-bold">Meet The Team</h2>
            <p class="text-black-50 mb-5 pe-5 ps-5">donec rutrum congue leo ehet malesuada. Mauris blandit aliquet elit , eget ticidunt nibh puvinar a. Pellentesque in ipsum id orci porta dapibus . Proin eget tortor risus.Sonec sollicitudin molestie malesuada.</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="box bg-white">
                    <img class="img-fluid" style="height:200px" src="admin/uploads/imgs/support1.jpg" alt="">
                    <h4>Luke Skywalker</h4>
                    <blockquote class="text-black-50 p-3">i don't understand how we hot by those troops.I thought we were dead.</blockquote>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="box bg-white">
                    <img class="img-fluid" style="height:200px" src="admin/uploads/imgs/support2.jpg" alt="">
                    <h4>Luke Skywalker</h4>
                    <blockquote class="text-black-50 p-3">i don't understand how we hot by those troops.I thought we were dead.</blockquote>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="box bg-white">
                    <img class="img-fluid" style="height:200px" src="admin/uploads/imgs/support3.jpg" alt="">
                    <h4>Luke Skywalker</h4>
                    <blockquote class="text-black-50 p-3">i don't understand how we hot by those troops.I thought we were dead.</blockquote>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="box bg-white">
                    <img class="img-fluid" style="height:200px" src="admin/uploads/imgs/support1.jpg" alt="">
                    <h4>Luke Skywalker</h4>
                    <blockquote class="text-black-50 p-3">i don't understand how we hot by those troops.I thought we were dead.</blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="subscribe pt-5 p-5 text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 pb-3">
                <div class="fw-bold  text-uppercase fs-5">subscribe to our newsletter :</div>
            </div>
            <div class="col-lg-5 col-md-6">
                <input type="text" placeholder="enter email address" class="w-100">
            </div>
            <div class="col-lg-3 col-md-4 m-auto pt-sm-4">
                <a href="#" class="btn pt-sm-2 " style="height:40px;line-height:30px">subscribe now</a>
            </div>
        </div>
    </div>
</div>


<?php
include $tpl . 'footer.php';
ob_end_flush();
