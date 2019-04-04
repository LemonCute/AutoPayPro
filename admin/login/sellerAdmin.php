<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    //    require dirname(__FILE__) . DIRECTORY_SEPARATOR . './../dbconfig/DBconfig.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lemon";
    //alter table market convert to character set utf8;
    function loginCheck()
    {
        global $servername, $username, $password, $dbname;
        $name = $_POST['loginName'];
        $pwd = $_POST['Possword'];
//        echo '<br>' . var_dump($pwd);
        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        $sql = <<<EOF
    SELECT pwd FROM user WHERE name={$name};
EOF;
        //    echo '<br>' . $sql . '<br><br><br><br>';
        $result = $conn->query($sql);
        if ($result)
            $row = $result->fetch_assoc();
        //    echo var_dump($row);
        if ($row['pwd'] === $pwd) {
            echo '<script language="JavaScript">
        alert("登录成功");
    </script>';
        } else {
            echo '<script language="JavaScript">
        alert("用户名或密码错误");
        location.href="http://localhost:8888/AutoPayPro/admin/login/index.html";
    </script>';
        }
        $conn->close();
    }

    if ($_POST != null) {
        loginCheck();
    } else
        echo '<script language="JavaScript">
        alert("请输入用户名和密码");
        location.href="http://localhost:8888/AutoPayPro/admin/login/index.html";
    </script>';
    ?>
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/login.css">
    <script src='../../bootstrap/js/jquery-3.3.1.min.js'></script>
    <script src='../../bootstrap/js/bootstrap.min.js'></script>
    <script src="../../bootstrap/echarts.js"></script>
    <script src="./js/login.js"></script>
    <title>销售统计</title>
</head>
<body>
<div class="">
    <div class="box">
        <div class="other">
            <button class="btn btn-danger btn-lg item" id="realtime"></button>
            <button class="btn btn-primary btn-lg item">个人主页</button>
            <button class="btn btn-primary btn-lg item">销售详情</button>
            <button class="btn btn-primary btn-lg item">商品管理</button>
            <button class="btn btn-primary btn-lg item">留言管理</button>
            <button class="btn btn-primary btn-lg item">经销商管理</button>
        </div>
        <div class="one " id="personalhome">  <!--div class="show">...</div> <div class="hidden">...</div-->
            <div class="per2tol">
                <div class="panel panel-default col-md-5 col-xs-12 personal">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 商户信息 </h3>
                    </div>
                    <div class="panel-body">
                        <ul style="font-size:18px;line-height: 28px;">
                            <li> 当前商户：<b> 10001</b></li>
                            <li></li><!--style="list-style-type:none;"-->
                            <li> 我的机器：共 <b>4</b>台</li>
                        </ul>
                        <ol type="circle" style="padding-left:140px;font-size:18px;line-height: 28px;">
                            <li>101</li>
                            <li>102</li>
                            <li>103</li>
                            <li>104</li>
                        </ol>
                    </div>
                </div>

                <div class="panel panel-default col-md-6 col-md-offset-1 col-xs-12 personal">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 销售统计 </h3>
                    </div>
                    <div class="panel-body box" id="bills" style="font-size:18px;line-height: 28px;">
                        <div style="width: 33%"> 今日入账：
                            <hr>
                            <b>15.50</b></div>
                        <div style="width: 33%"> 本月入账：
                            <hr>
                            <b>15.50</b></div>
                        <div style="width: 33%">总账单：
                            <hr>
                            <b>15.50</b></div>
                    </div>

                </div>
            </div>

            <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
            <div class="panel panel-primary" id="main" style="width: 95%;height:500px;"></div>
        </div>
    </div>
        <script language="JavaScript">
            CurentTime();
            snow();
            setInterval(function () {
                CurentTime();
            }, 1000);

        </script>

</div>
</body>

</html>