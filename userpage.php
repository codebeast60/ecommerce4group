<?php
ob_start();
session_start();
$pageTitle = "categories";
$page = '';
include 'init.php';
?>
<div class="item mt-5 m-auto mb-5 bg-light  ">
    <div class="container">
        <div class="row isotop-grid">


            <?php
            if (isset($_GET['userpageid']) && is_numeric($_GET['userpageid'])) {
                $userpageid = intval($_GET['userpageid']);

                $sql = "SELECT *  FROM items  WHERE Member_ID = {$userpageid} AND Approve = 1 ORDER BY item_ID DESC";
                $result = mysqli_query($conn, $sql);
                $allItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $counter = 1;

                $sql2 = "SELECT userName, image FROM users where userID = {$userpageid}";
                $result2 = mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result2);

                echo "<div class='img img-respnsive text-center'>
                            <img class='rounded-circle'src='admin/uploads/avatars/" . $row['image']  . "' style='width:150px;'>
                   </div>";
                echo "<h1 class='text-center' style='color:#337ab7;'>" . $row['userName'] . " Items  </h1>";

                /* getAllFrom("*", "items", "where Cat_ID = {$category}", "and Approve= 1", "item_ID", "DESC"); */
                foreach ($allItems as $item) { ?>
                    <div class="col-lg-3 col-md-4  position-relative isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <?php
                                echo '<span class="price">$' . $item['Price'] . '</span>';
                                if (empty($item['itemPics'])) {
                                    echo "<img class='img-fluid' style='max-heigth:300px' src='admin/uploads/avatars/no-image.png'>";
                                } else {

                                    echo  '<a href="items.php?itemid=' . $item['item_ID'] . '"><img class="img-fluid" style="max-height:320px;" src="admin/uploads/items/' . $item['itemPics'] . '"    alt="img"></a>';
                                } ?>

                            </div>

                            <div class="mb-5 pt-1">
                                <?php
                                echo '<h4><a style="color:#26a69a;" class="text-decoration-none" href="items.php?itemid=' . $item['item_ID'] . '">' . $item['Name'] . '</a></h4> ';
                                echo '<p class="desc mt-2">' . $item['Description'] . '</p>';
                                echo '<div class="date left-sm-0">' . $item['Add_Date']  . '</div>';
                                ?>
                            </div>
                         
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





<?php
include $tpl . 'footer.php';
ob_end_flush();
