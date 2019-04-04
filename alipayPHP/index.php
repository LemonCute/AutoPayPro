<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    $tmpmate = <<<EOT
<!--css文件-->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="../css/pay.css"/>
    <!--js文件-->
    <script src='../bootstrap/js/jquery-3.3.1.min.js'></script>
    <script src='../bootstrap/js/bootstrap.min.js'></script>
    <script src='../js/pay.js'></script>
EOT;
    echo $tmpmate;
    ?>

    <script language="JavaScript">
        function testpay() {
            var form = document.getElementById('payform');
            form.submit();
        }
    </script>
    <title>Document</title>
</head>
<body style="background:#dadada;">

<div class=" container ptop">
    <!--图-->
    <div class="col-xs-3">
        <img src="../img/pay/icon.jpg" alt="" class="icon">
    </div>
    <!--姓名电话-->
    <div class="col-xs-6">
        <div class="row" style="margin: 35px 5px 10px 5px">
            <span>柠檬不萌却心酸</span><br>
            <span style="display: block"> 电话：18332178037</span>
        </div>
    </div>
    <!--拨打电话-->
    <div class="col-xs-3">
        <a href="tel:18332178037" class="btn">
            <img src="../img/request/tel.png" alt="" class="phone">
        </a>
    </div>
</div>
<!--分割线：-->
<hr width="100%" color="#987cb9" size=2 style="">

<?php
$allpic = $_GET['allpic'];
$detail = $_GET['detail'];

$detaillength = count($detail);

$fevstr = explode(',', $detail);
$strins = "";
for ($i = 0; $i < count($fevstr) / 2; $i++) {
    $strins .= <<<EOF
    <div class="payitem">
    <span>{$fevstr[2 * $i]}</span>
    <span style="float:right;padding-right: 10px"><b>{$fevstr[2 * $i + 1]}</b>件</span>
</div>
EOF;
}
$str = <<<EOT
<form action="./wappay/pay.php" method="post" id="payform">
<div class="showitem " style="text-align: center">
    <p style="margin-top: 10px">
        <input  class="Money" style="text-indent:30%;background:#888;border: #888;width: 100%";"  name="allpic" value={$allpic}>
    </p>
</div>
  {$strins}
  <div class="leaveMsg">
    <b>其他需求请留言（选填）</b>
    <textarea rows="5" name="leftMsg"></textarea>
</div>
<div style="height: 20px;text-align: center">
    我是有底线的...
</div>
<!--底部标签-->
  <div class="nav container">
    <div class="col-xs-5 ftips">
        <img src="../img/show/shopping.png" alt="" style="margin-top: -10px; margin-left: 20px">
        <span class="ball"><span class="balltxt">{$detaillength}</span></span><br>
        <span class="ftips">已选<span>{$detaillength}</span>件商品</span>
    </div>
    <div style="float: right" class=" facbtn">
        <button onclick="testpay()" class="btn btn-info">立即支付</button>
    </div>
</div>
    <input type="text" style="visibility:hidden" name="detial" value={$detail} >
    </form>
EOT;
echo $str;
?>

</body>
</html>













