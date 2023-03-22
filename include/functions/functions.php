<?php
/* 
== get all function
*/ function getAllFrom($field, $table, $where = NULL, $and = NULL, $orderfield = NULL, $ordering = "DESC")
{
    global $conn;
    $sql = "SELECT $field FROM $table $where $and ORDER BY $orderfield $ordering";
    $result = mysqli_query($conn, $sql);
    $rows =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}


/*
=== get categories records function
=== function to get categories from database
*/
function getCat()
{

    global $conn;
    $sql = "SELECT * FROM categories order by ID ASC ";
    $result = mysqli_query($conn, $sql);
    $rows =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}

function checkUserStatus($user)
{
    global $conn;
    $sql = "SELECT  userName, regStatus 
              FROM
                    users
              WHERE
                   userName ='$user'
              AND
                   regStatus = 0";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $status = mysqli_num_rows($result);
    return $status;
}




/*
** get items records function
** function to get categories from database
*/
function getItems($where, $value, $approve = null)
{
    global $conn;

    // if el mou5tasara
    $sql = $approve == null ? 'AND Approve = 1' :  '';

    /*  if ($approve == null) {
        $sql = 'AND Approve = 1';
    } else {
        $sql = null;
    } */


    $sql = "SELECT * FROM items WHERE $where = $value $sql  order by item_ID DESC ";
    $result = mysqli_query($conn, $sql);
    $rows =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}


/* to get title */
function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo 'Default';
        
    }
}



/*
** redirect function fuction v2
** $theMsg echo the message [ error | success | warning]
** $errorMsg,$seconds
*/
/* function redirectHome($theMsg, $url = null, $seconds = 3)
{
    if ($url === null) {
        $url = 'index.php';
        
    } else {
        $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '' ? $_SERVER['HTTP_REFERER'] : 'index.php';

        echo $theMsg;
        echo "<div class='alert alert-info text-center'>you will be redirected to '$url' page after $seconds Seconds.</div>";
       header("refresh: $seconds; url= $url"); 
       
        exit();
    }
} */

 function redirectHome($theMsg, $url = null ,$seconds = 3){
    if($url === null){
        $url = 'index.php';
        $link = 'Homepage';
    }
    else{
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'Previous Page';  
       }
        else {
            $url = 'index.php';
            $link = 'HomePage';
        } 
    
    }
    echo $theMsg;
   
        $url = 'index.php';
   
     echo "<div class='container'>";
    echo "<div class='alert alert-info text-center'> you will be redirect to $url after $seconds. </div>";
    echo '
     <div class="loadd bg-dark fs-2 rounded">
                        <div>
                            <p>l</p>
                            <p>o</p>
                            <p>a</p>
                            <p>d</p>
                            <p>i</p>
                            <p>n</p>
                            <p>g</p>
                        </div>
                    </div>
    ';
    echo "</div>";
    header("refresh:$seconds;url=$url");
    exit();
} 
 function redirect($theMsg, $url = null ,$seconds = 5){
    if($url === null){
        $url = 'index.php';
        $link = 'Homepage';
    }
    else{
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'Previous Page';  
       }
        else {
            $url = 'index.php';
            $link = 'HomePage';
        } 
    
    }
    echo $theMsg;
     echo "<div class='container'>";
    echo "<div class='alert alert-info text-center'> you will be redirect to $url after $seconds. </div>";
    echo '
     <div class="loadd">
                        <div>
                            <p>l</p>
                            <p>o</p>
                            <p>a</p>
                            <p>d</p>
                            <p>i</p>
                            <p>n</p>
                            <p>g</p>
                        </div>
                    </div>
    ';
    echo "</div>";
    header("refresh:$seconds;url=$url");
    exit();
} 




/*
** Function to check item in Database [Function accept parameter]
** $select = the item to select [ Example: user, item, categories ]
** $form = The table to select From [ Example: users, items, categories ]
** $value = the value of select [ Example : Hassan, Riham, abdelkarim ]
** $msg   = lezem 3aref el message abl ma esta3mel el function
*/
function checkItem($select, $from, $value, $msg)
{
    global $conn;
    $check = "SELECT $select FROM $from WHERE $select = '$value'";
    $result = mysqli_query($conn, $check);
    mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        redirectHome($msg, 'back', 5);
    }
}

function checkCount($select, $from, $value)
{
    global $conn;
    $check = "SELECT $select FROM $from WHERE $select = $value";
    $result = mysqli_query($conn, $check);
    mysqli_fetch_all($result, MYSQLI_ASSOC);
    $rows =  mysqli_num_rows($result);
    return $rows;
}


/*
**count number of items
** 
**
*/
function countItem($item, $table)
{
    global $conn;
    $sql = "SELECT $item FROM $table";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    return $rows;
}


/*
** get latest records function
** function [users, items, comments ]
** $select = Field To Select
** $table = The table to choose Form
** $order = The Desc Ordering
** $limit = Number of records to Get
*/
function getLatest($select, $table, $order, $limit = 5)
{
    global $conn;
    $sql = "SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit";
    $result = mysqli_query($conn, $sql);
    $rows =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}

/*
== function for bring pic from database
== $pic : name of picture column
== $table : name of table in database
== $varid : name of column id
== $sesion : name of session id of user
*/
function getPics($pic, $table, $varid = NULL, $sesion = NULL)
{
    global $conn;
    $sql = "SELECT $pic FROM $table WHERE $varid = $sesion";
    $result = mysqli_query($conn, $sql);
    $rows =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}



function loading()
{
    global $page;

    if (isset($page)) {
        $page = "loading.css";
        echo $page;
    }
}


