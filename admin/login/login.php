<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lemon";
    //alter table market convert to character set utf8;
    function loginCheck()
    {
        global $servername, $username, $password, $dbname;
        global $loginFlag;
        $name = $_POST['loginName'];
        $pwd = $_POST['Possword'];
//      echo '<br>' . var_dump($pwd);
        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        $sql = <<<EOF
    SELECT pwd FROM user WHERE name='{$name}';
EOF;
        echo var_dump($sql);
        $result = $conn->query($sql);
        if ($result)
            $row = $result->fetch_assoc();
        echo var_dump($row);
        if ($row['pwd'] === $pwd) {
            $sercookie = base64_encode($name . "lcke" . $pwd);
            setcookie("username", $name, time() + 3600 * 24);
            setcookie("password", $sercookie, time() + 3600 * 24);
            //base64_encode()为双向加密，可用base64_decode()来解密

        } else {
            echo '<script language="JavaScript">
        alert("用户名或密码错误");
        location.href="http://localhost:8888/AutoPayPro/admin/login/index.html";
    </script>';
        }
        $conn->close();
    }

    if ($_POST) {
        loginCheck();
    } elseif (!$_COOKIE['username']) {
        echo '<script language="JavaScript">
        alert("请输入用户名和密码");
        location.href="http://localhost:8888/AutoPayPro/admin/login/index.html";
    </script>';
    }

    $mymachine = "";
    function sellermsg()
    {
        global $servername, $username, $password, $dbname;
        global $mymachine;
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        if ($_COOKIE["username"] == null)
            echo '<script language="JavaScript">
            window.location.reload()</script>';

        $sql = <<<EOF
    SELECT machine FROM machinetoseller WHERE seller={$_COOKIE["username"]};
EOF;
        if ($_COOKIE['username'] == 'root') {
            $sql = <<<EOF
    SELECT machine FROM machinetoseller ;
EOF;
        }
        $result = $conn->query($sql);
        if ($result)
            echo var_dump($result->num_rows);
        while ($row = $result->fetch_assoc()) {
//            echo var_dump($row);
            $mymachine .= ' <li>' . $row['machine'] . '</li>';
        }
    }

    sellermsg();

    $todayM = "0.00";
    $monthM = "0.00";
    $totalM = "0.00";
    function Money($str)
    {
        global $servername, $username, $password, $dbname;
        global $todayM, $monthM, $totalM;
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        if ($str == "today") $nowdate = date("Y-m-d") . '%';
        elseif ($str == "month") $nowdate = date("Y-m") . '%';
        elseif ($str == "total") $nowdate = date("Y") . '%';
        echo var_dump($nowdate);
        $sql = <<<EOF
    SELECT total_amount FROM market WHERE notify_time LIKE '{$nowdate}';
EOF;

//        echo var_dump($sql);
        $result = $conn->query($sql);
//        echo var_dump($result);
        if ($result)
            echo var_dump($result->num_rows);
        while ($row = $result->fetch_assoc()) {
//            echo var_dump($row);
            if ($str == "today") $todayM += floatval($row['total_amount']);
            elseif ($str == "month") $monthM += floatval($row['total_amount']);
            elseif ($str == "total") $totalM += floatval($row['total_amount']);
        }
    }

    Money("today");
    Money("month");
    Money("total");


    ?>


    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/login.css">
    <script src='../../bootstrap/js/jquery-3.3.1.min.js'></script>
    <script src='../../bootstrap/js/bootstrap.min.js'></script>
    <script src="../../bootstrap/echarts.js"></script>
    <script src="./js/login.js"></script>
    <script src="js/upcharts.js"></script>   
       
    <title>销售统计</title>
</head>
<body>
<div class="">
    <div class="box">
        <div class="other">
            <button class="btn btn-danger btn-lg item" id="realtime"></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="#">个人主页</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="selldetail.php">销售详情</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="merAdmin.php">商品管理</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="msgAdmin.php">留言管理</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="sellerAdmin.php">经销商管理</a></button>
            <button class="btn btn-primary btn-lg item" onclick="logout()">退出登录</button>

        </div>

        <div class="one " id="personalhome">  <!--div class="show">...</div> <div class="hidden">...</div-->
            <div class="per2tol">
                <div class="panel panel-default col-md-5 col-xs-12 personal">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 商户信息 </h3>
                    </div>
                    <div class="panel-body">
                        <ul style="font-size:18px;line-height: 28px;">
                            <li> 当前商户：<b> <?php echo $_COOKIE['username'] ?></b></li>
                            <li></li><!--style="list-style-type:none;"-->
                            <li> 我的机器：</li>
                        </ul>
                        <ol type="circle" style="padding-left:140px;font-size:18px;line-height: 28px;">
                            <?php echo $mymachine ?>
                        </ol>
                    </div>
                </div>

                <div class="panel panel-default col-md-6 col-md-offset-1 col-xs-12 personal">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 销售统计 </h3>
                    </div>
                    <div class="panel-body box" id="bills" style="font-size:18px;line-height: 28px;">
                        <div style="width: 33%;text-align: center"> 今日入账：
                            <hr>
                            <b><?php echo Number_format($todayM, 2) ?></b></div>
                        <div style="width: 33%;text-align: center"> 本月入账：
                            <hr>
                            <b><?php echo Number_format($monthM, 2) ?></b></div>
                        <div style="width: 33%;text-align: center">总账单：
                            <hr>
                            <b><?php echo Number_format($totalM, 2) ?></b></div>
                    </div>
                </div>
            </div>
            <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
            <div class="panel panel-primary" id="main" style="width: 95%;height:500px;"></div>
        </div>
    </div>

</div>
<script language="JavaScript">
    CurentTime();
    // snow();

    setInterval(function () {
        CurentTime();
    }, 1000);
</script>

<script type="text/javascript" language="JavaScript">
    var jqxhr = $.ajax('upchart.php', {
        // dataType: 'json'
    }).done(function (data) {
        console.log(data);
        // alert('成功, 收到的数据: ' + data);
        UpChart(data);
    }).fail(function (xhr, status) {
        alert('失败: ' + xhr.status + ', 原因: ' + status);
    }).always(function () {
        // alert('请求完成: 无论成功或失败都会调用');
    });
</script>
</body>
</html>