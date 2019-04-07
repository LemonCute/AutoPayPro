<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="../css/show.css"/>
    <script src='../bootstrap/js/jquery-3.3.1.min.js'></script>
    <script src='../bootstrap/js/bootstrap.min.js'></script>
    <script src='../js/show.js'></script>
    <script type="text/javascript" src="../bootstrap/echarts.js"></script>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lemon";
    function showmerchandise()
    {
        global $servername, $username, $password, $dbname, $marketitem;
        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        $sql = <<<EOF
SELECT * FROM merchandise;
EOF;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            //输出数
            while ($row = $result->fetch_assoc()) {
                $row['id']=$row['id']-1;
                $item = <<<EOF
                <div class="showitem ">
                      <div class="col-xs-3 item">
                          <img src="{$row['merSrc']}" class="imgshow" alt="">
                      </div>
                      <div class="col-xs-9 item">
                          <div style=" position: absolute;top: 15%;">
                              <span class="goodsitem">{$row['merName']}</span><br/>
                              <span>￥<sapan style="font-size: 20px;color: crimson;" class="item-1-left">{$row['merMoney']}</sapan>元</span>
                              <div class="chooseitem ">
                                  <span>剩<sapan class="item-left">{$row['merLeft']}</sapan>件</span>
                                  <div class="col-xs-8 col-xs-offset-3" style="padding-left: 26px">
                                      <img src="../img/show/sub.png" alt="" onclick="subplus('sub',{$row['id']})">
                                      <label type="text" class="inputsm" id="item-2">0</label>
                                      <img src="../img/show/plus.png" alt="" onclick="subplus('plus',{$row['id']})">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
EOF;
                echo var_dump($item);
                $marketitem .= $item;
            }
        }
        $conn->close();
        return $marketitem;
    }

   // showmerchandise();

    ?>
    <title>Lemon</title>
</head>
<body style="background:#dadada;">

<div class="container ptop">
    <div class="col-xs-3">
        <img src="../img/pay/icon.jpg" alt="" class="icon">
    </div>

    <div class="col-xs-6">
        <div class="row" style="margin: 35px 5px 10px 5px">
            <span>柠檬不萌却心酸</span><br>
            <span style="display: block"> 电话：18332178037</span>
        </div>
    </div>
    <div class="col-xs-3">
        <a href="tel:18332178037" class="btn">
            <img src="../img/request/tel.png" alt="" class="phone"><br>
            成为经销商
        </a>
    </div>

</div>
<!--5、虚线：-->
<hr width="100%" color="#987cb9" size=2 style="">


<div class="showcontent">
    <?php echo showmerchandise(); ?>



    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div class="showitem "></div>
    <div style="height: 200px;text-align: center">
        我是有底线的...
    </div>
</div>


<div class="nav container">
    <div class="col-xs-4 ftips">
        <img src="../img/show/shopping.png" alt="" style="margin-top: -10px; margin-left: 20px">
        <span class="ball"><span class="balltxt">0</span></span><br>
        <span class="ftips">已选<span id="allQuantity">1</span>件</span>
    </div>
    <div style="float: right" class=" facbtn">
        <!--<button onclick="test('request')" class="btn btn-success">申请补货</button>-->
        <label class="btn btn-success">￥<span id="allMoney">5.50</span></label>
        <button onclick="doSubmitForm()" class="btn btn-info">去支付</button>
        <!--<button onclick="test('pay')" class="btn btn-info">选好了</button>-->
    </div>
</div>
<form id="test-form" method="get" action='../alipayPHP/index.php' target="_blank">
    <input type="text" name="machineno" id="mechineno" value="1">
    <input type="text" name="allpic" id="allpic">
    <input type="text" name="detail" id="detail">
</form>
<script language="JavaScript">  var ua = navigator.userAgent.toLowerCase();
    var isWeixin = ua.indexOf('micromessenger') != -1;
    if (isWeixin) {
        alert("当前页面不支持在微信中打开\r\n请使用【支付宝】或浏览器打开");
    } else {

    }</script>

</body>
</html>