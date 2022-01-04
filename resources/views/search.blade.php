<!DOCTYPE html>
<html lang="en">
<head>
    <title>小藍網購</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <!-- bootstrap js -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- style -->
    <link rel="stylesheet" type="text/css" href="style1.css">
    <style>
        footer{
            margin-top: 50px;
        }

        .carousel-item{
            height: 300px;
        }
        .carousel-item > img {
            height: 100%;
            margin: auto;
        }

        #btn{
            margin-top: 50px;
        }
        #btn > img{
            height: 50px;
            max-width: 100%;
            margin: auto;
        }
        #btn > p{
            margin-top: 5px;
            text-align: center;
            /*font-family: 微軟正黑體;*/
            font-size: large;
        }
        #category{
            text-align: center;
        }
        body{
            background: #F5F5F5;
        }


    </style>

</head>
<body>
<header>
    <!-- 導覽 -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
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
                    if($_SESSION['name'] == null)
                        echo "<li class='nav-item'><a class='nav-link' href='login.blade.php'>會員登入</a></li>";
                    else
                    {
                        echo "
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    歡迎".$_SESSION['name']. "
                                </a>
                                <ul class='dropdown-menu'>
                                    <li>
                                        <a class='dropdown-item' href='accountadjust.blade.php'>我的帳戶</a>
                                        <a class='dropdown-item' href='dindan.blade.php'>購買清單</a>
                                        <a class='dropdown-item' href='layouts/destroy.blade.php'>登出</a>
                                    </li>
                                </ul>
                            </li>
                            ";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

</header>

<main class="container">

    <aside>
        <section class="product-category">
            <div>
                <a href="category.blade.php?category=生活">生活</a>
            </div>
            <div>
                <a href="category.blade.php?category=服飾">服飾</a>
            </div>
            <div>
                <a href="category.blade.php?category=娛樂">娛樂</a>
            </div>
            <div>
                <a href="category.blade.php?category=3C">3C</a>
            </div>
            <div>
                <a href="category.blade.php?category=家電">家電</a>
            </div>
            <div>
                <a href="category.blade.php?category=其他">其他</a>
            </div>
            <div>
                <a href="category.blade.php?category=零食">零食</a>
            </div>
            <div>
                <a href="category.blade.php?category=書">書</a>
            </div>
        </section>
    </aside><article>

                        <?php
                        include "test.php";

                        $SearchResults = new test();
                        $SearchResults->SearchResults_SaveHistory($_GET['search']);

                        if($_GET['category'] != null){
                            echo "<h4>".$_GET['category']." 的搜尋結果</h4>";
                        }
                        ?>


</article></main>
<footer class="fixed-bottom py-5 bg-dark">
    <div class="container">

    </div>
</footer>

</body>




