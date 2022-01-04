
<!DOCTYPE html>
<html lang="en">
<head>
    <title>小藍網購</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        #category{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        #category-item{
            height: auto;
            width: 85px;
            position: relative;
        }
        #category-item .icon{
            margin: 8px;
            font-size: 50px;
            text-align: center;
            line-height: 50px;
        }
        #category-item p{
            text-align: center;
            font-size: 20px;
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
//                    if($_POST['search'] != null)
//                        header("Location: search.blade.php?search=".$_POST['search']);
                    ?>
                </ul>
                <ul class="navbar-nav">
                    <?php
                    //顯示會員
//                    session_start();
//                    if($_SESSION['name'] == null)
//                        echo "<li class='nav-item'><a class='nav-link' href='login.blade.php'>會員登入</a></li>";
//                    else
//                    {
//                        echo "
//                            <li class='nav-item dropdown'>
//                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
//                                    歡迎".$_SESSION['name']. "
//                                </a>
//                                <ul class='dropdown-menu'>
//                                    <li>
//                                        <a class='dropdown-item' href='accountadjust.blade.php'>我的帳戶</a>
//                                        <a class='dropdown-item' href='dindan.blade.php'>購買清單</a>
//                                        <a class='dropdown-item' href='layouts/destroy.blade.php'>登出</a>
//                                    </li>
//                                </ul>
//                            </li>
//                            ";
//                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 輪播 -->
    <div id="advertisement" class="carousel slide container" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#advertisement" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#advertisement" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#advertisement" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#advertisement" data-bs-slide-to="3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item bg-secondary active">
                <img class="d-block" src="images/廣告1.png">
            </div>
            <div class="carousel-item bg-secondary">
                <img class="d-block" src="images/test1.jfif">
            </div>
            <div class="carousel-item bg-secondary">
                <img class="d-block" src="images/test2.jfif">
            </div>
            <div class="carousel-item bg-secondary">
                <img class="d-block" src="images/test3.jfif">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#advertisement" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#advertisement" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

</header>

<main class="container">
    <!-- 工具欄 -->

    <!-- 推薦商品(個人化) -->
    <article>
        <h2 class="my-4">推薦商品</h2>
        <section class="row">
            <?php
//            include "test.php";
//
//            $aaa=new test();
//            $aaa->HistorySearch();
            ?>
        </section>
    </article>

    <!-- 分類 -->
    <article>
        <h3 class="my-4">分類</h3>
        <section id="category">
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="storefront-outline"></ion-icon>
                </div>
                <p>生活</p>
                <a href="category.blade.php?category=生活" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="shirt-outline"></ion-icon>
                </div>
                <p>服飾</p>
                <a href="category.blade.php?category=服飾" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="dice-outline"></ion-icon>
                </div>
                <p>娛樂</p>
                <a href="category.blade.php?category=娛樂" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="tv-outline"></ion-icon>
                </div>
                <p>3C</p>
                <a href="category.blade.php?category=3C" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="game-controller-outline"></ion-icon>
                </div>
                <p>遊戲</p>
                <a href="category.blade.php?category=遊戲" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                </div>
                <p>書</p>
                <a href="category.blade.php?category=書" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="fast-food-outline"></ion-icon>
                </div>
                <p>零食</p>
                <a href="category.blade.php?category=零食" class="stretched-link"></a>
            </div>
            <!--                <ion-icon name="cart-outline"></ion-icon>-->
        </section>

    </article>

    <!-- 暢銷/最新商品 -->
    <article>
        <h2 class="my-4">暢銷商品</h2>
        <section class="row">
            <?php

//            $bbb=new test();
//            $bbb->Hottest();
            ?>
        </section>
    </article>

    <article>
        <h2 class="my-4">最新商品</h2>
        <section class="row">
            <?php

//            $ccc=new test();
//            $ccc->Latest();
            ?>
        </section>
    </article>

</main>

<footer class="py-5 bg-dark">

</footer>

</body>

</html>
