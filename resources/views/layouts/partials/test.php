<?php

class test
{
    private $result;
    private $fetch_all;
    private $fetch_array;

    public function DBLink_Query($sql, $fetch = null)
    {// ( 輸入SQL語法, [選擇要fetch_all 還是fetch_array] )
        $db_link = mysqli_connect("127.0.0.1", "root", "wenchun0502", "enterprise") or die("資料庫連結失敗");
        mysqli_query($db_link, $sql);

        if($fetch == "fetch_all")
        {//回傳所有行(row)和列(column)的資料，Array[][]
            $this->result = mysqli_query($db_link, $sql);
            $this->fetch_all = mysqli_fetch_all($this->result, MYSQLI_ASSOC);//默認是數字
        }elseif ($fetch == "fetch_array")
        {//擷取一行(row)的資料，再次擷取會是第二行資料以此類推，Array[]
            $this->result = mysqli_query($db_link, $sql);
            $this->fetch_array = mysqli_fetch_array($this->result);
        }
    } //資料庫

    public function SearchResults_SaveHistory($search)
    {
        if($search!=null)
        {
            //搜尋結果
            $this->DBLink_Query("SELECT * FROM `product` WHERE p_name LIKE '%$search%' AND status=1", "fetch_all");
            if($this->fetch_all == null)
                echo "查無結果";
            else
            {
                echo "<h2>$search 的查詢結果</h2>";
                echo "<div class='row'>";
               foreach ($this->fetch_all as $item)
                {
                    echo "
                    <div class='col-lg-2 col-sm-6'>
                        <div class='card'>
                                <div class='card-img'>
                                    <img class='card-img-top' src='./images/".$item['p_image']."' alt='".$item['p_image']."' height='200px' width='100px'>
                                </div>
                                <div class='card-body'>
                                    <p class='card-text'>".$item['p_name']."</p>
                                    <span>NT$ ".$item['price']."</span>
                                    <a href='product-detail.php?p_id=".$item['p_id']."' class='stretched-link'></a>
                                </div>
                        </div>
                    </div>                                                                         
                     ";

                }
               echo "<div>";
            //儲存紀錄(類別)
            $save=$this->fetch_all[0][p_categ];
            $this->DBLink_Query("INSERT INTO `history`(`id`, `h`) VALUES (".$_SESSION['id'].", '$save')");
        }
    }
    } //將搜尋紀錄(類別)放進歷史紀錄中

    public function Cart($act=null, $product_id=null, $number=null)
    {
        if(isset($_SESSION['name'])){
            //使用購物車
            switch ($act)
            {
                case "add":
                    //要新增商品的cart_id
                    $this->DBLink_Query("SELECT `cart_id` FROM `cart` order by `cart_id` DESC", "fetch_array");
                    $id = $this->fetch_array["cart_id"] + 1;

                    //新增至購物車
                    $this->DBLink_Query("INSERT INTO `cart`(`cart_id`, `p_id`, `id`, `number`) VALUES ($id, $product_id, ".$_SESSION['id'].", $number)");
                    break;
                case "delete":
                    $this->DBLink_Query("DELETE FROM `cart` WHERE `p_id` = $product_id");
                    break;
            }

            //顯示購物車
            $this->DBLink_Query("SELECT `cart`.`p_id`, `p_name`, `p_des`, `p_image`, `price`, `number` FROM `product`, `cart`, `customer` 
                                WHERE `product`.`p_id` = `cart`.`p_id` AND `customer`.`c_name` = '".$_SESSION['name']."'", "fetch_all");
            $total=0;
            foreach ($this->fetch_all as $item)
            {
                echo "<div class='item'>
                        <div class='item--select'>
                            <input type='checkbox' name='select[]' value='".$item['p_id']."'>
                        </div>
                        <div class='item--pic'>
                            <img src='./images/".$item['p_image']."' alt='".$item['p_image']."'>
                        </div>
                        <div class='item--content'>
                            <div class='wrap-top'>
                                <div class='wrap-top--name'>
                                    <p>".$item['p_name']."</p>
                                </div>
                                <div class='wrap-top--quantity'>
                                    <p>".$item['number']."</p>
                                </div>
                                <div class='wrap-top--price'>
                                    <p>".$item['price']."</p>
                                </div>
                            </div>
                            <div class='wrap-button'>
                                <p>小計： ".$item['number']*$item['price']."</p>
                            </div>
                        </div>
                        <div class='item--delete'>
                            <button name='123' value='delete'>刪除</button>
                        </div>
                    </div>";
                $_SESSION['p_id']=$_POST['select'][0];
                $total+=$item['number']*$item['price'];
                $this->DBLink_Query("INSERT INTO `cart`(`cart_id`, `p_id`, `id`, `number`) VALUES ($id, $product_id, ".$_SESSION['id'].", $number)");
            }
            $_SESSION['total']=$total;
        }else{
            echo "<script>window.location='login.php';</script>";
        }

    }

    public function Login($name, $pwd)
    {
        session_start();
       if($name!='administrator'){
            if($name != null && $pwd != null)
            {
                $_SESSION['name'] = $name;
                $_SESSION['pwd'] = $pwd;
            }

            //isset: null無設置->false; ""有設置(空值)->true
            if (isset($_SESSION['name'], $_SESSION['pwd']))
            {
                //搜尋帳號密碼是否正確
                $this->DBLink_Query("SELECT * FROM `customer` where c_name ='".$_SESSION['name']."' and c_pword ='".$_SESSION['pwd']."'", fetch_array);

                $_SESSION['id'] = $this->fetch_array["id"];
                $_SESSION['level']=$this->fetch_array["level"];
                $_SESSION["email"] = $this->fetch_array["c_email"];
                $_SESSION["password"] = $this->fetch_array["c_pword"];
                $_SESSION["phone"] = $this->fetch_array["phone"];
                $_SESSION["sex"]= $this->fetch_array["sex"];
                $_SESSION["birthday"]= $this->fetch_array["bd"];
                $_SESSION["image"]= $this->fetch_array["image"];

                if(isset($_SESSION['id']))
                {
                    header("Location: index.php");
                }
                else
                {
                    echo "查無此帳號";
                    $_SESSION['name'] = null;
                    $_SESSION['pwd'] = null;
                }
            }
        }
        else{
            header("Location: administrator.php");
        }

    } //登入功能

    public function Register($name, $pwd, $phone, $sex)
    {
        if($name != null && $pwd != null && $phone != null && $sex != null)
        {
            //搜尋帳號是否已被申請
            $this->DBLink_Query("SELECT * FROM `customer` where c_name = '$name'", "fetch_array");

            if ($this->fetch_array == null)
            {
                //自動編號碼
                $this->DBLink_Query("SELECT id FROM `customer` order by id DESC", "fetch_array");
                $id = $this->fetch_array['id'] + 1;
                //註冊
                $this->DBLink_Query("INSERT INTO `customer`(`id`, `c_name`, `c_pword`, `phone`, `sex`, `level`) 
                                VALUES ('$id', '$name', '$pwd', '$phone', '$sex', '0')");
                #刪
                session_start();
                $_SESSION['name'] = $name;
                $_SESSION['pwd'] = $pwd;
                $_SESSION['id']=$id;
                header("Location: index.php");
            }
            else
            {
                echo "已經有人使用";
            }
        }
    } //註冊功能

    public function Product($launch, $name, $description, $image , $category, $price , $quantity)
    {//賣家新增商品功能
        if(isset($launch)) {
            //產品自動編號碼
            $this->DBLink_Query("SELECT p_id FROM `product` order by p_id DESC", "fetch_array");
            $pid = $this->fetch_array['p_id'] + 1;

            //目前日期
            $date= date('Y/m/d');

            //新增商品
            $this->DBLink_Query("INSERT INTO `product`(`p_id`,`id`,`p_name`,`p_des`,`p_image`,`p_categ`,`price`,`p_quan`,`date`,`status`) VALUES ('".$pid."', ".$_SESSION['id'].", '$name', '$description', '$image', '$category', '$price', '$quantity','$date',1)");
            echo "<script>window.location='store.php'</script></div>";
        }
    }

    public function Store()
    {//賣場功能 顯示賣家以上市產品 以及決定哪些商品可下架、上架
        echo "<font size='25px' bold>你上架的商品有:</font>";

        //判別上架
        if($_GET['status']==0){
            $this->DBLink_Query("UPDATE `product` SET `status`=0 WHERE `p_id`=".$_GET['p_id'], "fetch_all");
        }
        elseif($_GET['status']==1){
            $this->DBLink_Query("UPDATE `product` SET `status`=1 WHERE `p_id`=".$_GET['p_id'], "fetch_all");
        }

        //顯示
        $this->DBLink_Query("SELECT * FROM `product` WHERE id=".$_SESSION['id']." ORDER BY `p_id` ASC", "fetch_all");
        foreach ($this->fetch_all as $item) {

            #改良
            echo "<div class='display-group'>";
            echo "<main class='container'>
                        <aside>
                            <img class='card-img-top' src='./images/".$item['p_image']."' alt='".$item['p_image']."'height='200px'>
                        </aside>
                  <article>
                        <section>
                            <div>
                                    <span>產品名稱：" . $item['p_name'] . "</span>
                            </div>
                            <div>
                                    <span>產品描述：" . $item['p_des'] . "</span>
                            </div>
                            <div>
                                    <span>產品類型：" . $item['p_categ'] . "</span>
                            </div>
                            <div>
                                 <span>售價：$" . $item['price'] . "</span>
                            </div>
                            <div>
                                 <span>數量：" . $item['p_quan'] . "</span>
                            </div>
                            ";


            //判別上架(提示視窗)
            if($item['status']==1){
                echo "<input type='button' value='下架' onclick=location.href='store.php?&p_id=".$item['p_id']."&status=0'>
                         </section>
                    </article>
                    </main>
                    </div>";
            }
            elseif($item['status']==0){
                echo "<input type='button' value='上架' onclick=location.href='store.php?&p_id=".$item['p_id']."&status=1'>
                        </section>
                    </article>
                    </main>
                    </div>";
            }
            ###
        }
    }

    public function ProductDetail($p_id)
    {//顯示產品資訊功能

        $this->DBLink_Query("SELECT * FROM product WHERE p_id='$p_id'", "fetch_array");
        $price=round($this->fetch_array['price']*4/3);

        //取商品數量的值
        $_SESSION['quantity']=$this->fetch_array['p_quan'];
        //取訂購數量的值
        $_SESSION['ordernumber']=$_POST['ordernumber'];

        if(isset($_POST['incart'])){
            $this->Cart("add", $p_id, $_SESSION['ordernumber']);
            echo "<script>window.location='cart.php';</script>";
        }
        elseif (isset($_POST['buy'])){
            $_SESSION['buy']=$_POST['buy'];
            echo "<script>window.location='dindan.php?p_id=".$this->fetch_array['p_id']."'</script>";
        }

        echo "
            <section class='product'>
                <div class='product-pic'>
                    <img src='images/".$this->fetch_array['p_image']."'>
                </div>
                <div class='product-detail'>
                        <h1>".$this->fetch_array['p_name']."</h1>
                        <div class='prise'>
                            <span>原價：$$price</span>
                            <h2>$".$this->fetch_array['price']."</h2>
                        </div>
                    <form method='post'>
                        <table>
                            <tr>
                                <td>數量：</td>
                                <td>                           
                                    <input type='number' name='ordernumber' min='0' max='".$_SESSION['quantity']."' required>                            
                                </td>
                            </tr>
                            <tr>
                                <td>剩餘數量：</td>
                                <td>".$this->fetch_array['p_quan']."件</td>
                            </tr>
                        </table>
                            <div class='cart'>
                                <input type='submit' value='加入購物車' name='incart'>
                                <input type='submit' value='直接購買' name='buy' onclick='self.location.href="."mailto:dustin0502.l@gmail.com"."'>
                            </div>
                    </form>
                </div>
            </section>
    
            <section>
                <p>商品描述：</p>
                <pre>".$this->fetch_array['p_des']."</pre>
            </section>
        ";
    }

    public function Category($category)
    {
        $this->DBLink_Query("SELECT * FROM `product` WHERE p_categ = '$category' AND status=1", "fetch_all");

        echo "<div class='row'>";

        foreach ($this->fetch_all as $item)
        {
            echo "
                    <div class='col-lg-2 col-sm-6'>
                        <div class='card'>
                                <div class='card-img'>
                                    <img class='card-img-top' src='./images/".$item['p_image']."' alt='".$item['p_image']."' height='200px' width='100px'>
                                </div>
                                <div class='card-body'>
                                    <p class='card-text'>".$item['p_name']."</p>
                                    <span>NT$ ".$item['price']."</span>
                                    <a href='product-detail.php?p_id=".$item['p_id']."' class='stretched-link'></a>
                                </div>
                        </div>
                    </div>                                                                         
                     ";


        }
        echo "</div>";
    } //類別搜尋功能

    public function HistorySearch(){

        $this->DBLink_Query("SELECT `h`,COUNT(`h`) AS `times` FROM `history` WHERE id=".$_SESSION['id']." GROUP BY `h` ORDER BY COUNT(`h`) DESC", "fetch_array");
        $category=$this->fetch_array[0];

        $this->DBLink_Query("SELECT `p_id`, `p_name`, `p_image`, `price` FROM `product` WHERE p_categ='$category' AND status=1", "fetch_all");
        $item=$this->fetch_all;
        for ($i=0; $i<6; $i++)
        {
            if($item[$i]['p_id'] != null)
            {
                echo "
                    <div class='col-lg-2 col-sm-6'>
                        <div class='card'>
                            <div class='card-img'>
                                <img class='card-img-top' src='./images/".$item[$i]['p_image']."' alt='".$item[$i]['p_image']."' >
                            </div>
                            <div class='card-body'>
                                <p class='card-text'>".$item[$i]['p_name']."</p>
                                <span>NT$ ".$item[$i]['price']."</span>
                                <a href='product-detail.php?p_id=".$item[$i]['p_id']."' class='stretched-link'></a>
                            </div>
                        </div>
                    </div>
                    ";
            }
        }
    } //推薦商品功能

    public function Hottest(){
        $this->DBLink_Query("SELECT `p_id`, `p_name`, `p_image`, `price` FROM `product` WHERE status=1 ORDER BY `frequency` DESC", "fetch_all");
        $item=$this->fetch_all;
        for ($i=0; $i<6; $i++)
        {
            if($item[$i]['p_id'] != null)
            {
                echo "
                    <div class='col-lg-2 col-sm-6'>
                        <div class='card'>
                            <div class='card-img'>
                                <img class='card-img-top' src='./images/".$item[$i]['p_image']."' alt='".$item[$i]['p_image']."' >
                            </div>
                            <div class='card-body'>
                                <p class='card-text'>".$item[$i]['p_name']."</p>
                                <span>NT$ ".$item[$i]['price']."</span>
                                <a href='product-detail.php?p_id=".$item[$i]['p_id']."' class='stretched-link'></a>
                            </div>
                        </div>
                    </div>
                    ";
            }
        }
    } //暢銷商品

    public function Latest(){
        $this->DBLink_Query("SELECT `p_id`, `p_name`, `p_image`, `price` FROM `product` WHERE status=1 ORDER BY `date` DESC", "fetch_all");
        $item=$this->fetch_all;
        for ($i=0; $i<6; $i++)
        {
            if($item[$i]['p_id'] != null)
            {
                echo "
                    <div class='col-lg-2 col-sm-6'>
                        <div class='card'>
                            <div class='card-img'>
                                <img class='card-img-top' src='./images/".$item[$i]['p_image']."' alt='".$item[$i]['p_image']."' >
                            </div>
                            <div class='card-body'>
                                <p class='card-text'>".$item[$i]['p_name']."</p>
                                <span>NT$ ".$item[$i]['price']."</span>
                                <a href='product-detail.php?p_id=".$item[$i]['p_id']."' class='stretched-link'></a>
                            </div>
                        </div>
                    </div>
                    ";
            }
        }
    } //最新上市商品

    public function Rate($comment,$rate)
    {//評分功能

        if( $rate!=NULL)
        { //判斷是否有人評分

            //根據cid排列
            $this->DBLink_Query("SELECT `c_id` FROM `comment` order by c_id DESC", "fetch_array");
            $comment_id = $this->fetch_array["c_id"] + 1; //c_id自動編號

            //輸入評論內容
            $this->DBLink_Query("INSERT INTO `comment`(`c_id`, `id`, `p_id`, `c_ment`, `rate`) VALUES ('$comment_id', '".$_SESSION['id']."', '".$_GET['p_id']."', '$comment', '$rate')");
            echo "<script>window.location='product-detail.php?p_id=".$_GET['p_id']."';</script>";
        }

        //透過cid排列評論區
        $this->DBLink_Query("SELECT * FROM `comment` WHERE `p_id`=".$_GET['p_id']." ORDER BY `c_id` DESC " , "fetch_all");
        foreach ($this->fetch_all as $comment)
        {//印出所有評論
            //查詢客戶名稱 #少修改留言
            $this->DBLink_Query("SELECT `c_name` FROM `customer` WHERE `id`=".$comment['id'], "fetch_array");
            $customer_name=$this->fetch_array['c_name'];

            echo "<div class='display-group'>
                    <div class='display-item'>
                        <div>
                            <span>客戶名稱：" . $customer_name . "</span>
                        </div>
                        <div>
                            <span>評論：" . $comment['c_ment'] . "</span>
                        </div>
                        <div>
                            <span>評分：" . $comment['rate'] . "</span>
                        </div>
                        <hr>
                    </div>
                </div>
                ";
        }
    }

    public function Adjust($email, $newpd, $newphone, $sex, $bd, $image,$sellername, $selleraddress){
        if(isset($email) || isset($newpd) ||isset($newphone) || isset($sex) ||isset($bd) || isset($image)){
            if($email!=NULL){
                $this->DBLink_Query("UPDATE `customer` SET `c_email`='$email' WHERE id='".$_SESSION['id']."'");
                $_SESSION["email"] = $email;
            }
            if($newpd!=NULL){
                $this->DBLink_Query("UPDATE `customer` SET  `c_pword`='$newpd' WHERE id='".$_SESSION['id']."'");
                $_SESSION["password"] = $newpd;
            }
            if($newphone!=NULL){
                $this->DBLink_Query("UPDATE `customer` SET  `phone`='$newphone' WHERE id='".$_SESSION['id']."'");
                $_SESSION["phone"] = $newphone;
            }
            if($sex!=NULL){
                $this->DBLink_Query("UPDATE `customer` SET `sex`='$sex' WHERE id='".$_SESSION['id']."'");
                $_SESSION["sex"]= $sex;
            }
            if($bd!=NULL){
                $this->DBLink_Query("UPDATE `customer` SET `bd`='$bd' WHERE id='".$_SESSION['id']."'");
                $_SESSION["birthday"]= $bd;
            }
            if($image!=NULL){
                $this->DBLink_Query("UPDATE `customer` SET `image`='$image' WHERE id='".$_SESSION['id']."'");
                $_SESSION["image"]= $image;
            }
            echo "<script>alert('帳戶修改成功')</script>";
            echo "<script>window.location='index.php'</script>";
        }
        if(isset($sellername) || isset($selleraddress)){
            if($sellername!=NULL && $selleraddress!=NULL){

                $_SESSION["level"]=1;

                $this->DBLink_Query("UPDATE `customer` SET  `level`='1' WHERE c_name='".$_SESSION['name']."'");

                $this->DBLink_Query("INSERT INTO `seller`(`id`, `s_name`, `s_address`) VALUES ('".$_SESSION['id']."', '$sellername', '$selleraddress')");

                echo "<script>alert('賣家申請已成功送出')</script>";
                echo "<script>window.location='index.php';</script>";
            }
        }
    } //帳戶調整功能

    public function Dindan($product_id) // 購物車放入訂單 or 直接購買
    {
        if(isset($_SESSION['buy'])){
            $quantity=$_SESSION['quantity']-$_SESSION['ordernumber']; //算出剩餘庫存量
            $this->DBLink_Query("SELECT `frequency` FROM `product`  WHERE `p_id`=".$product_id, "fetch_array");
            $frequency=$this->fetch_array[0]+1;
            $this->DBLink_Query("UPDATE `product` SET `frequency`= '".$frequency."', `p_quan` =".$quantity." WHERE `p_id`=".$product_id);
            //o_id 編號
            $this->DBLink_Query("SELECT `o_id` FROM `dindan` order by `o_id` DESC", "fetch_array");
            $oid = $this->fetch_array["o_id"] + 1;
            //資料新增至訂單
            $this->DBLink_Query("INSERT INTO `dindan`(`o_id`, `p_id`, `id`,`ordernumber`) VALUES ('$oid','".$product_id."','".$_SESSION['id']."','".$_SESSION['ordernumber']."')");
            Mail('dustin0502.l@gmail.com','訂單通知','我們已收到你的訂單了','From:dustin0502.l@gmail.com' . '\r\n' );
        }
        elseif(isset($_SESSION['bill'])){
            $this->DBLink_Query("SELECT `number` FROM `cart` WHERE `p_id`=".$product_id, "fetch_array");//取出選購量
            $number=$this->fetch_array['number'];
            $this->DBLink_Query("SELECT `p_quan` FROM `product` WHERE `p_id`=".$product_id, "fetch_array");
            $quantity=$this->fetch_array['p_quan']-$number; //算出剩餘庫存量
            $this->DBLink_Query("SELECT `frequency` FROM `product`  WHERE `p_id`=".$product_id, "fetch_array");
            $frequency=$this->fetch_array[0]+1;
            $this->DBLink_Query("UPDATE `product` SET `frequency`= '".$frequency."', `p_quan` =".$quantity." WHERE `p_id`=".$product_id);
            //取出產品資料表裡的被購買次數frequency,並將其值與訂購量相加成被購買數量

            //o_id 編號
            $this->DBLink_Query("SELECT `o_id` FROM `dindan` order by `o_id` DESC", "fetch_array");
            $oid = $this->fetch_array["o_id"] + 1;
            //資料新增至訂單
            $this->DBLink_Query("INSERT INTO `dindan`(`o_id`, `p_id`, `id`,`ordernumber`) VALUES ('$oid','".$product_id."','".$_SESSION['id']."','".$number."')");
            Mail('dustin0502.l@gmail.com','訂單通知','我們已收到你的訂單了','From:dustin0502.l@gmail.com' . '\r\n' );
        }
    }

    public function Administrator() //管理者功能
    {
        echo "<main>
                <section class='wrap'><form class='item_form' method='post' >";

        if ($_GET["page"] == 3) {
            $this->DBLink_Query("UPDATE `customer` SET `level`=0 WHERE `id`=".$_GET['id'], "fetch_all");
            $this->DBLink_Query("UPDATE `product` SET `status`=0 WHERE `id`=".$_GET['id'], "fetch_all");
            $this->DBLink_Query("SELECT * FROM `customer` WHERE `level`=1 ORDER BY `id` ASC ", "fetch_all");

            foreach ($this->fetch_all as $item) {
                echo "<div class='display-group'>";
                    echo "<main class='container'>
                                <article>
                                    <section>
                                          <div>
                                          <span>賣家名稱：" . $item['c_name'] . "</span>
                                          </div>
                                          <a href='administrator.php?page=3&id=".$item['id']."'>撤銷賣家權限</a>
                                    </section>
                                </article>
                            </main>
                        </div>
                        ";
            }

        }
            elseif ($_GET["page"] == 4) {

                $this->DBLink_Query("DELETE FROM `comment` WHERE c_id=".$_GET['c_id'] ,"fetch_all");
                $this->DBLink_Query("SELECT * FROM `comment` ORDER BY `c_id` ASC ", "fetch_all");

                foreach ($this->fetch_all as $item) {
                    echo "<div class='display-group'>";
                    echo "<main class='container'>
                             <article>
                                <section>
                                  <div>
                                  <span>評論內容：" . $item['c_ment'] . "</span>
                                  </div>
                                    <a href='administrator.php?page=4&c_id=".$item['c_id']."'>刪除該評論</a>
                                </section>
                                </article>
                            </main>
                            </div>
                            ";
                }

        }
        echo "</form>
                </section>
                    </main>";
    }
}