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

    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* 寫法過於繁瑣 */
        .flex {
            position: center;
            display: flex;
            height: 83px;
            width: 100%;
            background-color: #F5F5F5;
            flex-wrap: wrap;
            border: 2px solid #1e2125;
            padding: 10px;

        }
        .flex-flex {
            position: center;
            display: flex;
            height: 250px;
            width: 100%;
            background-color: #F5F5F5;
            flex-wrap: wrap;
            border: 2px solid #1e2125;
            padding: 10px;

        }

        .father{
            display:flex;
            flex-direction:row;
        }

        .container{



        }

        .wrap{

            width:35%;

            height:auto;

        }

        .wrap-2{

            width:65%;
            height:auto;
        }

        /* 錯誤使用 */
        item{
            background-color: #F5F5F5;
            display: flex;
            justify-content: left;
            align-items: center;
            color: black;
            font-size: medium;


        }


    </style>

</head>

<body>

<header>
    <!-- 導覽 -->
    <div class="navbar navbar-expand-sm navbar-dark bg-dark narbar-fixed-top" >
        <div class="container ">
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
                    if($_SESSION["name"]==NULL){
                        echo "<script>alert('要先登入會員才能使用該功能')</script>";
                        echo "<script>window.location='index.blade.php';</script>";
                    }
                    if($_SESSION['level']!=1)
                        {
                            echo "<script>alert('請先驗證賣家資料')</script>";
                            echo "<script>window.location='accountadjust.blade.php?page=2';</script>";
                        }
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
                          </li>";
                    ?>
                </ul>
            </div>
        </div>
    </div>
</header>
<div><!-- 改良/重改 -->
    <form method="post">
        <div class="container">
            <div class="father">
                <div class="wrap">
                    <div class="flex" >
                        <div class="item">
                            <p>商品名稱:</p>
                            <input type="text" name="productname" required>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="item"> 商品類型:
                            <select name="productcategory">
                                <option value="生活">生活</option>
                                <option value="服飾">服飾</option>
                                <option value="娛樂">娛樂</option>
                                <option value="3C">3C</option>
                                <option value="家電">家電</option>
                                <option value="其他">其他</option>
                                <option value="零食">零食</option>
                                <option value="書">書</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="item" >
                            庫存量:
                            <input type="text" name="quantity" required>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="item" >
                            價格:
                            <input type="text" name="price" required>
                        </div>
                    </div>
                </div>

                <div class="wrap-2">
                    <div class="flex">
                        <div class="item">
                            <input type="file" name="productimage" accept="image/gif, image/jpeg, image/png">
                        </div>
                    </div>
                    <div class="flex-flex">
                        <div class="item">
                            商品描述:
                            <textarea style="resize:none;width:600px;height:200px;color:black" name="description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="launch" value="上架">
            <?php
            include "test.php";

            $launch=new test();
            $launch->Product($_POST['launch'],$_POST['productname'],$_POST["description"], $_POST['productimage'], $_POST['productcategory'],$_POST['price'], $_POST['quantity']);
            ?>
        </div>
    </form>
</div>


</body>

</html>

