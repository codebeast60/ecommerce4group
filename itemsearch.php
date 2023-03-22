<?php
ob_start();
session_start();
$pageTitle = 'search page ';
$page = '';
include 'init.php';

?>

<div class="item mt-5 m-auto mb-5 pe-lg-5 ps-lg-5 bg-light position-relative w-100">
    <div class="container">
        <div class="row isotop-grid">


            <?php
            if (isset($_POST['submit']) ) {

                $str = mysqli_real_escape_string($conn, $_POST['search']);
                $sql = "SELECT * FROM items WHERE  Name LIKE '%$str%' AND Approve = 1  OR Description LIKE '%$str%' AND Approve = 1  ";
                $result = mysqli_query($conn, $sql);
                $rows   = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>
                    <h2 class="text-center fw-bold">Result of <span style="color:red"> <?php echo $str ?></span></h2>

<?php
                if (mysqli_num_rows($result) > 0) {
                    foreach ($rows as $row) { 
                   
                    ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 position-relative isotope-item women">
                             <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <!--  taba3 soura -->
                                    <?php
                                    echo '<span class="price">$' . $row['Price'] . '</span>';
                                    if (empty($row['itemPics'])) {
                                        echo '<img class="img-fluid" style="max-height:320px" src="admin/uploads/items/no-image.png">';
                                    } else {
                                        echo  '<a href="items.php?itemid=' . $row['item_ID'] . '" ><img class="umg-fluid" style="max-height:390px;width:370px"  src="admin/uploads/items/' . $row['itemPics'] . '"    alt="img"></a>';
                                    } ?>

                                </div>
                                <div class="block2-txt flex-w flex-t p-t-14">

                                </div>
                                <div class="mb-5 pt-1">
                                    <?php
                                    echo '<h5><a style="color:#26a69a;" class="text-decoration-none" href="items.php?itemid=' . $row['item_ID'] . '">' . $row['Name'] . '</a></h3> ';
                                    echo '<p class="desc mt-2">' . $row['Description'] . '</p>';
                                    echo '<div class="date left-sm-0">' . $row['Add_Date']  . '</div>';
                                   
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    $theMsg = "<div class='alert alert-danger text-center'>this item is not exists</div>";
                    redirectHome($theMsg, 5);
                } ?>

        </div>
    </div>
</div>

<?php }

            include $tpl . 'footer.php';

            ob_end_flush();
