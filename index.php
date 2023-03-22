<?php
ob_start();
session_start();
$pageTitle = 'Home Page';
include 'init.php';

$limit = 24; // number of item i will see in page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$result = $conn->query("SELECT * FROM items WHERE Approve = 1 order by item_ID desc LIMIT $start, $limit");
$items = $result->fetch_all(MYSQLI_ASSOC);

$result1 = $conn->query("SELECT count(item_ID) AS id FROM items WHERE Approve = 1 order by item_ID");
$custCount = $result1->fetch_all(MYSQLI_ASSOC);
$total = $custCount[0]['id'];
$pages = ceil($total / $limit);

$Previous = $page - 1;
$Next = $page + 1;
$counter = 1;
?> 

 
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

<div class="item mt-5 m-auto mb-5 pe-lg-5 ps-lg-5 bg-light position-relative w-100">
    <div class="container">
        <div class="row isotop-grid">
            <?php

            foreach ($items as $item) { 
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
                            <?php echo "<span class='price'>" .  $item['Price'] . " $</span>" ?>
                            <?php if (empty($item['itemPics'])) {
                                echo "<img class='img-fluid' style='max-heigth:400px' src='admin/uploads/items/no-image.png'>";
                            } else { ?>
                                <a href="items.php?itemid=<?php echo  $item['item_ID'] ?> ">
                                    <img class="img-fluid" style="max-height:390px;width:370px" src="admin/uploads/items/<?php echo $item['itemPics'] ?>" alt="img">
                                </a>
                            <?php  } ?>
                        </div>
                        <div class="mb-5 pt-1">
                            <?php
                            echo '<h5><a  class="text-decoration-none" href="items.php?itemid=' . $item['item_ID'] . '">' . $item['Name'] . '</a></h5> ';
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
                             echo '<br><span class="position-absolute end-0 fs-6 fw-bold blu">'. $rate .' / 5</span> </div>';
                              }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
         <nav aria-label="Page navigation" class="ms-5 mt-5 ">
            <ul class="pagination">
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?> pe-4">
                    <a class="page-link " href="index.php?page=<?= $Previous; ?>" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa-solid fa-backward"></i> </span>
                    </a>
                </li>
                <?php
                for ($i = 1; $i <= $pages; $i++) :
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                ?>
                    <li class="page-item current <?php echo $active ?> ps-1 pe-1"><a class="page-link" href="index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>

                <li class="page-item <?php echo $page >= $pages ? 'disabled' : ''; ?> ps-4">
                    <a class="page-link" href="index.php?page=<?= $Next; ?>" aria-label="Next">
                        <span aria-hidden="true"> <i class="fa-solid fa-forward"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<button class="btn btn-primary scrollup"><i class="fa-solid fa-arrow-up"></i> </button>
<script>
   let btn = document.querySelector(".scrollup");
window.onscroll = function() {
    if (window.scrollY >= 600) {
        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
};
btn.onclick = function() {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth",
    });
};

     
</script>
 
 





 
 


 





<?php
include $tpl . 'footer.php';
ob_end_flush();
