<?php
ob_start();   // output Buffering start
session_start();
if (isset($_SESSION['userName'])) {        //hata ma kel mara yetlob sign in
  $pageTitle = 'Dashboard';
  $noNavbar = '';
  $pageCss = '';
  $page = '';
  include 'init.php';
  /* start Dashbord Page */
  $numUsers = 5; // Number of Latest user
  $latestUsers = getLatest('*', 'users', 'userID', $numUsers);
  $numItems = 7;
  $latestItems = getLatest('*', 'items', 'item_ID', $numItems);
  $numComments = 7;

?>

  <nav>
    <div class="logo-name">
      <div class="logo-image">

        <!-- <img src="images/logo.png"  /> -->


      </div>
      <span class="logo_name"><?php echo $_SESSION['userName'] ?></span>
    </div>

    <div class="menu-items">
      <ul class="nav-links">
        <li>
          <a href="dashboard.php">
            <i class="uil uil-estate"></i>
            <span class="link-name">Home</span>
          </a>
        </li>
        <li>
          <a href="categories.php">
            <i class=" uil uil-files-landscapes"></i>
            <span class="link-name">Category</span>
          </a>
        </li>
        <li>
          <a href="items.php">
            <i class="uil uil-chart"></i>
            <span class="link-name">items</span>
          </a>
        </li>
        <!-- <li>
          <a href="#">
            <i class="uil uil-thumbs-up"></i>
            <span class="link-name">Like</span>
          </a>
        </li> -->
        <li>
          <a href="comments.php">
            <i class="uil uil-comments"></i>
            <span class="link-name">Comment</span>
          </a>
        </li>
        <li>
          <a href="members.php">
            <i class="fa-solid fa-user-group"></i>
            <span class="link-name">Members</span>
          </a>
        </li>
      </ul>

      <ul class="logout-mode">
        <li>
          <a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ?>">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="link-name">edit Profile</span>
          </a>
        </li>
        <li>
          <a href="../index.php">
            <i class="fa-brands fa-golang"></i>
            <span class="link-name">vist shop</span>
          </a>
        </li>
        <li>
          <a href="logout.php">
            <i class="uil uil-signout"></i>
            <span class="link-name">Logout</span>
          </a>
        </li>

        <li class="mode">
          <a href="#">
            <i class="uil uil-moon"></i>
            <span class="link-name">Dark Mode</span>
          </a>

          <div class="mode-toggle">
            <span class="switch"></span>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <section class="dashboard">
    <div class="top">
      <i class="uil uil-bars sidebar-toggle"></i>

      <!-- <div class="search-box">
        <i class="uil uil-search"></i>
        <input type="text" placeholder="Search here..." />
      </div> 
 
      <img src="images/profile.jpg" alt="pics" />-->
    </div>

    <div class="dash-content">
      <div class="overview">
        <div class="title">
          <i class="uil uil-tachometer-fast-alt"></i>
          <span class="text"><b><?php echo $_SESSION['userName'] ?></b> Dashboard</span>
        </div>

        <div class="boxes">
          <div class="box box1">
            <i class="fa-solid fa-users"></i>
            <span class="text">Total Users</span>
            <span class="number"><a href="members.php"><?php echo countItem('userID', 'users') ?></a></span>
          </div>
          <div class="box box2">
            <i class="uil uil-comments"></i>
            <span class="text">Comments</span>
            <span class="number"><a href="comments.php"><?php echo countItem('c_id', 'comments') ?></a></span>
          </div>
          <div class="box box3">
            <i class="fa-solid fa-clock"></i>
            <span class="text">Pending Members</span>
            <span class="number"><a href="members.php?do=Manage&page=Pending">
                <?php echo checkCount("regStatus", "users", 0) ?></a></span>
          </div>
          <div class="box box4">
            <i class="fa-solid fa-tag"></i>
            <span class="text">Total Items</span>
            <span class="number"><a href="items.php"><?php echo countItem('item_ID', 'items') ?></a></span>
          </div>
        </div>
      </div>

      <div class="activity">
        <div class="title">
          <i class="fa-solid fa-users"></i>
          <span class="text">Latest <?php echo $numUsers ?> Registerd Users</span>
        </div>
        <div class="panel-body">
          <ul class="list-unstyled latest-users">
            <?php
            foreach ($latestUsers as $user) {
              echo '<li class="link-name">';
              echo   $user['userName'];
              echo '<a href="members.php?do=Edit&userid=' .  $user['userID'] . '">';
              echo "<span class='btn btn-success pull-right'><i class='fa-solid fa-pen-to-square'></i>Edit";

              if ($user['regStatus'] == 0) {
                echo "<a href='members.php?do=Activate&userid=" . $user['userID'] . "'class='btn btn-info pull-right activate'><i class='fa-solid fa-thumbs-up'></i>Activate</a>";
              }
              echo '</span>';
              echo '</a>';
              echo '</li>';
            }
            ?>
          </ul>
        </div>
      </div>
      <!-------------------------------------------------- latest items ------------------------------------------->
      <div class="activity">
        <div class="title">
          <i class="fa-solid fa-tag"></i>
          <span class="text">Latest <?php echo $numItems ?> Items</span>
        </div>
        <div class="panel-body">
          <ul class="list-unstyled latest-users">
            <?php
            foreach ($latestItems as $item) {
              echo '<li>';
              echo $item['Name'];
              echo '<a href="items.php?do=Edit&itemid=' .  $item['item_ID'] . '">';
              echo "<span class='btn btn-success pull-right'><i class='fa-solid fa-pen-to-square'></i>Edit</a>";

              if ($item['Approve'] == 0) {
                echo "<a href='items.php?do=Approve&itemid=" . $item['item_ID'] . "'class='btn btn-info pull-right activate'><i class='fa-solid fa-check-double'></i>Approve</a>";
              }
              echo '</span>';
              echo '</a>';
              echo '</li>';
            }
            ?>
          </ul>
        </div>
      </div>
      <!-------------------------------------------------- latest comments ------------------------------------------->
      <div class="activity">
        <div class="title">
          <i class="uil uil-comments"></i>
          <span class="text">Latest <?php echo $numComments  ?> comments</span>
        </div>
        <div class="panel-body">
          <ul class="list-unstyled latest-users">
            <?php
            $sql = "SELECT
                          comments.*,  users.userName AS Member
                      FROM
                          comments
                      INNER JOIN
                          users
                      on
                          users.userID = comments.user_id
                      ORDER BY c_id DESC     
                      LIMIT $numComments ";

            $result = mysqli_query($conn, $sql);
            $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($comments as $comment) {
              echo '<div class="comment-box">';
              echo '<span class="member-n">' . $comment['Member'] . '</span>';
              echo '<p class="member-c">' . $comment['comment'] . '</p>';
              echo '</div>';
            }

            ?>
          </ul>
        </div>
      </div>

    </div>
  </section>

<?php
  /* End Dashbord Page */
  include $tpl . 'footer.php';
} else {
  echo 'you shoud login first';
  header("location: index.php");
  exit();
}
ob_end_flush();
?>