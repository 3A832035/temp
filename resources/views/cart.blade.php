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

    <!-- style -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        p{
            margin: 5px 0;
        }
        .cart-total{
            display: flex;
            justify-content: center;
        }
        .cart-total p{
            margin-right: 30px;
            text-align: right;
        }
    </style>

    <!-- checkbox全選(javascript) -->
    <script type="text/javascript">
        function check_all(obj,cName)
        {
            var checkboxs = document.getElementsByName(cName);
            for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
        }
    </script>

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
    <form method="POST">
        <div class="cart">
            <div class="item-first">
                <div class="item-first--select">
                    <label for="select-all">全選</label>
                    <input type="checkbox" name="select" onclick="check_all(this,'select[]')" id="select-all">
                </div>
                <div class="item-first--pic">
                    <p>圖片</p>
                </div>
                <div class="item-first--content">
                    <div class="item-first--content__name">
                        <p>商品名稱</p>
                    </div>
                    <div class="item-first--content__quantity">
                        <p>數量</p>
                    </div>
                    <div class="item-first--content__price">
                        <p>價格</p>
                    </div>
                </div>
                <div class="item-first--delete">
                    <p>操作</p>
                </div>
            </div>
            <?php
            include "test.php";
            $cart = new test();

            $cart->Cart();

            if($_POST['123'] == "delete")
            {
                $cart->Cart("delete", $_SESSION['p_id']);
                unset($_POST['123']);
                unset($_SESSION['p_id']);
                echo "<script>window.location='cart.blade.php'</script>";
            }
            ?>
        </div>
        <div class="cart-total">
            <div>
                <p>總計：
                    <?php
                    echo $_SESSION['total'];
                    unset($_SESSION['total']);
                    ?>
                </p>
            </div>
            <div>
                <button type="submit" class="btn btn-danger" name="bill">去買單</button>
            </div>
        </div>
    </form>
    <?php
    foreach ($_POST['select'] as $value)
    {
        if(isset($_POST['bill'])){
            echo "<script>window.location='index.blade.php'</script>";
            unset($_SESSION['bill']);
        }
        $_SESSION['bill']=$_POST['bill'];
        $cart->Dindan($value);
        $cart->Cart("delete", $value);
    }

    ?>

</main>

</body>

</html>

