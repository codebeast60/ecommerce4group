<?php
ob_start();
session_start();
$pageTitle = "categories";
$page = '';
include 'init.php';

?>

<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <div class="card-mt-2">
                <div class="card-body mt-5 ">


                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa-solid fa-arrow-down-short-wide"></i> Filter
                    </button>


                    <div class="collapse" id="collapseExample">
                        <div class="card card-body m-auto mb-4" style="right:15px;top:30px">
                            <h4>Filter your result</h4>
                            <form action="" method="post" autocomplete="off" class="mt-5 mb-3  position-relative">
                                <div class="row">
                                    <div class="col-md-2 col-lg-2 col-sm-4">
                                        <label for="">start price</label>
                                        <input type="number" name="start_price" value="<?php if (isset($_POST['start_price'])) {
                                                                                            echo $_POST['start_price'];
                                                                                        } else {
                                                                                            echo '100';
                                                                                        } ?>" class="form-control">
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-sm-4">
                                        <label for="">end price</label>
                                        <input type="number" name="end_price" value="<?php if (isset($_POST['end_price'])) {
                                                                                            echo $_POST['end_price'];
                                                                                        } else {
                                                                                            echo '900';
                                                                                        } ?>" class="form-control">
                                    </div>
                                    <div class="col-md-2 col-lg-4 col-sm-12 mt-4  ">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sort_type" value="ASC" id="flexRadioDisabled">
                                            <label style="cursor:pointer" class="form-check-label" for="flexRadioDisabled">
                                                show from old to new
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sort_type" value="DESC" id="flexRadioCheckedDisabled" checked>
                                            <label style="cursor:pointer" class="form-check-label" for="flexRadioCheckedDisabled">
                                                show from new to old
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4 col-lg-6 w-100 ">
                                        <label for=""> </label>
                                        <button type="submit" class="btn btn-primary px-4"> <i class="fa-solid fa-arrow-down-short-wide"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="mt-5 w-75 m-auto">




<div class="item mt-5 m-auto mb-5 pe-lg-5 ps-lg-5 bg-light position-relative w-100">
    <div class="container">
        <div class="row isotop-grid">

            <?php
            if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
                $category = intval($_GET['pageid']);
                /*   $sql2 = "SELECT * from categories WHERE parent != 0";
                $result2 = mysqli_query($conn, $sql2);
                $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
 */


                if (isset($_POST['start_price']) && isset($_POST['end_price'])) {
                    $start_price = mysqli_real_escape_string($conn, $_POST['start_price']);
                    $end_price  = mysqli_real_escape_string($conn, $_POST['end_price']);
                    $sort_type = mysqli_real_escape_string($conn, $_POST['sort_type']);
                    if (is_numeric($start_price) && is_numeric($end_price)) {
                        $sql = "SELECT * FROM items WHERE Cat_ID = {$category} AND Price BETWEEN $start_price AND $end_price AND Approve = 1 ORDER BY item_ID $sort_type";
                    } else {
                        $theMsg = '<div class="alert alert-danger text-center">you should enter a number</div> ';
                        redirect($theMsg, 5);
                    }
                } else {
                    $sql = "SELECT * FROM items WHERE Cat_ID = {$category} AND Approve = 1 ORDER BY item_ID DESC";
                }







                $result = mysqli_query($conn, $sql);
                $allItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $counter = 1;

                /* getAllFrom("*", "items", "where Cat_ID = {$category}", "and Approve= 1", "item_ID", "DESC"); */
                foreach ($allItems as $item) {
                
                $sql = "SELECT * FROM rating WHERE item_id = {$item['item_ID']} ";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($result);
                $cat = mysqli_fetch_all($result,MYSQLI_ASSOC);
                if($rows == 0){
                    $rate = "<div class='noRate'>this item has no rating yet</div>";
                }
                elseif($rows > 0 ){
                    // $rate = $rows;
                    $sql1 = "SELECT SUM(stars) as totalsum FROM rating WHERE item_id = {$item['item_ID']}";
                    $result1 = mysqli_query($conn, $sql1);
                    $rows1 = mysqli_fetch_assoc($result1);
                    $sum = $rows1["totalsum"];
                    $rate = round($sum/$rows);

                }
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 position-relative isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <!--  taba3 soura -->
                                <?php
                                echo '<span class="price">$' . $item['Price'] . '</span>';
                                if (empty($item['itemPics'])) {
                                    echo "<img class='img-fluid' style='max-height:300px' src='admin/uploads/avatars/no-image.png'>";
                                } else {

                                    echo  '<a href="items.php?itemid=' . $item['item_ID'] . '">
                                    <img class="img-fluid" style="max-height:390px;width:370px" src="admin/uploads/items/' . $item['itemPics'] . '"    alt="img"></a>';
                                } ?>

                            </div>



                            <div class="mb-5 pt-1">
                                <?php
                                echo '<h5><a style="color:#26a69a;" class="text-decoration-none" href="items.php?itemid=' . $item['item_ID'] . '">' . $item['Name'] . '</a></h5> ';
                                echo '<p class="desc mt-2">' . $item['Description'] . '</p>';
                                echo '<div  class="date left-sm-0">' . $item['Add_Date']  . '</div>';
                                 if($rows == 0 ){
                                 echo $rate;
                             }
                             else{ 
                                  echo '<div class="d-flex justify-content-center flex-row w-100 position-relative me-5">';
                                 for($i=0;$i<$rate;$i++){
                                  echo '
                                   <i class="fa-solid fa-star fs-4 p-0" style="color:#FFC312"></i>
                                   ';
                             }
                             echo '<br><span class="position-absolute end-0 fs-6 fw-bold">'. $rate .' / 5</span> </div>';
                              }
                                ?>
                            </div>
                            <?php if ($counter % 12 == 0) {
                            ?>

                                <!-- <div class="slide">
                                    <div class="wrapper">
                                        <img class="imageSlide" src="https://images6.alphacoders.com/462/thumb-1920-462371.jpg">
                                        <img class="imageSlide" src="https://i.pinimg.com/originals/2b/de/de/2bdede0647e3cdf75b44ea33723201d9.jpg">
                                        <img class="imageSlide" src="https://images5.alphacoders.com/343/thumb-1920-343645.jpg">
                                        <img class="imageSlide" src="https://cdn.wallpapersafari.com/24/98/dwMtqD.jpg">
                                    </div>

                                </div> -->
                                <!--<section class="automatic-sliding">-->
                                <!--    <div id="slide">-->
                                <!--        <figure>-->
                                <!--            <img src="images/ads/ads2.jpg" alt="Image">-->
                                <!--            <img src="images/ads/ads3.png" alt="Image">-->
                                <!--            <img src="images/ads/ads5.png" alt="Image">-->
                                <!--            <img src="images/ads/ads1.jpg" alt="Image">-->
                                <!--            <img src="images/ads/ads4.jpg" alt="Image">-->
                                <!--        </figure>-->
                                        <!-- <div class="indicator"></div> -->
                                <!--    </div>-->
                                <!--</section>-->

                            <?php
                            }
                            $counter++;
                            ?>

                        </div>
                    </div>

            <?php
                }
            } else {
                $theMsg = "<div class='alert alert-danger text-center'>you must add page ID</div>";
                redirectHome($theMsg, 5);
            } ?>
        </div>
    </div>
</div>





<?php
include $tpl . 'footer.php';
ob_end_flush();
