<!DOCTYPE html>
<html lang="en">
<head>
    <title>小藍網購</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <!-- icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- style -->
    <link rel="stylesheet" type="text/css" href="style3.css">


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
                    echo "
                    <li class='nav-item'>

                        <a class='nav-link' href='login.blade.php'>
                           <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'>
                                    歡迎" .$_SESSION['name']. "
                                </a>
                                <ul class='dropdown-menu' >
                                     <li>
                                         <a class='dropdown-item'  href='accountadjust.blade.php' >我的帳戶</a>
                                         <a class='dropdown-item' href='dindan.blade.php'>購買清單</a>
                                         <a class='dropdown-item' href='layouts/destroy.blade.php'>登出</a>
                                      </li>
                                </ul>
                           </li>
                        </a>
                    </li>

                </ul>";
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container">
    <article>
        <!-- 常用連結 -->
        <section id="category">
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="storefront-outline"></ion-icon>
                </div>
                <p>已完成訂單</p>
                <a href="dindan.blade.php?page=1" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="shirt-outline"></ion-icon>
                </div>
                <p>待出貨</p>
                <a href="dindan.blade.php?page=2" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="dice-outline"></ion-icon>
                </div>
                <p>待取貨</p>
                <a href="dindan.blade.php?page=3" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="tv-outline"></ion-icon>
                </div>
                <p>退貨</p>
                <a href="dindan.blade.php?page=4" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="game-controller-outline"></ion-icon>
                </div>
                <p>取消訂單</p>
                <a href="dindan.blade.php?page=5" class="stretched-link"></a>
            </div>
            <div id="category-item">
                <div class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                </div>
                <p>優惠券</p>
                <a href="dindan.blade.php?page=6" class="stretched-link"></a>
            </div>
            <!--                <ion-icon name="cart-outline"></ion-icon>-->
        </section>
        <section class="wrap">
        <?php
        if(isset($_SESSION['buy'],$_SESSION['ordernumber'])){
            if(isset($_SESSION['name'])){
                include 'test.php';
                $dindan = new test();
                $dindan->Dindan($_GET['p_id']);
                $_SESSION['ordernumber']=NULL;
                unset($_SESSION['buy']);
                echo "<script>alert('購買成功')</script>";
            }
            else{
                echo "<script>alert('請先登入會員才能購買商品')</script>";
                echo "<script>window.location='login.blade.php'</script>";
            }
        }
        ?>
        </section>
    </article>
</main>

</body>

</html>
<?php
