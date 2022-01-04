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
            <div class="navbar-brand" href="javascript:void(0)">小藍網購</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>
<?php
        echo "
            <div class='w3-sidebar w3-gray w3-bar-block' style='margin-top:37px;width:18%'>
                <h3 class='w3-bar-item'>-管理者頁面-</h3>
                <a href='administrator.blade.php?page=3' class='w3-bar-item w3-button'><font size='5px'>賣家管理</font></a>
                <a href='administrator.blade.php?page=4' class='w3-bar-item w3-button'><font size='5px'>評論管理</font></a>
                <a href='layouts/destroy.blade.php' class='w3-bar-item w3-button'><font size='5px'>登出</font></a>
            </div>";
            include "test.php";

            $adjust = new test();
            $adjust->Administrator();

?>



</body>

</html>

