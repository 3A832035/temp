<!DOCTYPE html>
<html lang="en">
<head>
    <title>小藍網購</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Latest compiled and minified CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- style -->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<header>
    <!-- 導覽 -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <div class="container narbar-default narbar-fixed">
            <a class="navbar-brand" href="index.blade.php">小藍網購</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">通知</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store.blade.php">賣場</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sellercenter.blade.php">賣家中心</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.blade.php">購物車</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class='nav-item'>
                        <form method='POST'>
                            <div class='input-group'>
                                <input type='text' class='form-control' placeholder='搜尋' name='search'>
                                <button class='btn btn-dark' type='submit'>Go</button>
                            </div>
                        </form>
                    </li>
                    <?php
                    //跳轉搜尋
                    if($_POST['search'] != null)
                        header("Location: search.blade.php?search=".$_POST['search']);
                    ?>
                </ul>
               <ul class="navbar-nav">
                 <?php
                       //顯示會員
                       session_start();
                       echo "
                           <li class='nav-item dropdown'>
                               <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'>
                                   歡迎".$_SESSION['name']. "
                                   </a>
                               <ul class='dropdown-menu' >
                                   <li>
                                       <a class='dropdown-item'  href='accountadjust.blade.php' >我的帳戶</a>
                                       <a class='dropdown-item' href='dindan.blade.php'>購買清單</a>
                                       <a class='dropdown-item' href='layouts/destroy.blade.php'>登出</a>
                                   </li>
                               </ul>
                          </li>
               </li></a></ul>";
                       ?>

            </div>
        </div>
    </nav>
</header>
<?php
switch($_SESSION["level"]){
    case 0: //一般會員
        echo "
            <div class='w3-sidebar w3-gray w3-bar-block' style='margin-top:40px; width:18%'>
                <h3 class='w3-bar-item'>-我的帳戶-</h3>
                <a href='accountadjust.blade.php?page=1' class='w3-bar-item w3-button'><font size='5px'>查看/編輯基本資料</font></a>
                <a href='accountadjust.blade.php?page=2' class='w3-bar-item w3-button'><font size='5px'>申請賣家權限</font></a>
            </div>";
        break;
    case 1:
        echo "
            <div class='w3-sidebar w3-gray w3-bar-block' style='margin-top:40px;width:18%'>
                <h3 class='w3-bar-item'>*</h3>
                <h3 class='w3-bar-item'>-我的帳戶-</h3>
                <a href='accountadjust.blade.php?page=1' class='w3-bar-item w3-button'><font size='5px'>查看/編輯基本資料</font></a>

            </div>";
        break;
}
echo "<main><section class='wrap'><form class='item_form' method='post' >";
if($_GET["page"]<=1 && $_SESSION['level']!=2){
     echo "
    <!-- 編輯帳戶 -->   <p>編輯/查看基本資料</p>
            <div class='item'>
                <span>信箱</span>
                <input type='text' name='email' value='".$_SESSION['email']."'>
            </div>
            <div class='item'>
                <span>密碼</span>
                <input type='password' name='pwd' value='".$_SESSION['password']."'>
            </div>
            <div class='item'>
                <span>電話</span>
                <input type='tel' name='phone' pattern='[0-9]{10}' value='".$_SESSION['phone']."'>
            </div>
            <div class='item item_radio'>
                <span style='margin-right: 50px'>性別</span>
                <span style='margin-right: 15px'>男<input type='radio' style='width: auto; margin-left: 5px' name='newsex' value='男'></span>
                <span >女<input type='radio' style='width: auto' name='newsex' value='女'></span>
            </div>
            <div class='item'>
                <span>生日</span>
                <input type='date' name='bd' value='".$_SESSION['birthday']."'>
            </div>
            <div class='item'>
                <span>圖片</span>
                <input type='file' name='image' accept='image/gif, image/jpeg, image/png' value='".$_SESSION['image']."'>
                <img src='images/" . $_SESSION['image'] . "' width='200px' height='200px'>

            </div>
            <div class='item item_button'>
                <button type='submit'>更改/新增</button>
            </div>
       ";
 }
 elseif($_GET["page"]==2){
     echo "
    <!-- 登入 -->   <p>驗證賣家基本資料：</p>
            <div class='item'>
                <span>賣家名稱</span>
                <input type='text' name='sellername'>
            </div>
            <div class='item'>
                <span>賣家地址</span>
                <input type='text' name='selleraddress'>
            </div>
            <div class='item item_button'>
                <button type='submit'>申請</button>
            </div>
       ";
 }

 echo  "</form></section></main>";

include "test.php";

$adjust = new test();
$adjust->Adjust($_POST['email'], $_POST['pwd'], $_POST['phone'],$_POST['newsex'], $_POST['bd'],$_POST["image"],$_POST['sellername'],$_POST["selleraddress"]);

?>



</body>

</html>

