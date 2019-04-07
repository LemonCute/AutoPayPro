<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lemon";
    //验证登录
    function loginLive()
    {
        $loginname = $_COOKIE['username'];
        $secret = base64_decode($_COOKIE['password']);
        echo var_dump($loginname) . var_dump($secret);
        if ($loginname != null && strpos($secret, $loginname . 'lcke') !== false) {
            echo var_dump('欢迎登录');
        } else {
            echo '<script language="JavaScript">
        alert("你还没有登录！！");
        location.href="http://localhost:8888/AutoPayPro/admin/login/index.html";
    </script>';
        }
    }

    loginLive();

    $itemall = "";
    function showdetail()
    {
        global $servername, $username, $password, $dbname;
        global $itemall;
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        /************计数**算页数*************************/
        $pageSize = 6;   //每页显示的数量
        $rowCount = 0;   //要从数据库中获取
        $pageNow = 1;    //当前显示第几页
        $pageCount = 0;  //表示共有多少页
        //如果有pageNow就使用，没有就默认第一页。
        if (!empty($_GET['pageNow'])) {
            $pageNow = $_GET['pageNow'];
        }

        $sql1 = <<<EOF
    select count(id) from market;
EOF;
        $res1 = $conn->query($sql1);
        if ($row1 = mysqli_fetch_row($res1)) {
            $rowCount = $row1[0];
        }
        $pageCount = ceil(($rowCount / $pageSize));
        $pre = ($pageNow - 1) * $pageSize;
        /***************************分页结束******************************/
        $loginname=$_COOKIE['username'];
        if ($loginname === 'root') {
            $sql = <<<EOF
    SELECT * FROM market  limit {$pre},{$pageSize};
EOF;
        } else {
            $sql = <<<EOF
    SELECT * FROM market where seller='{$_COOKIE['username']}' limit {$pre},{$pageSize};
EOF;
        }

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
//            echo var_dump($row);
            $item = <<<EOF
            
            <tr>
                 <td class='active'> $row[id]</td>
                 <td class="success"> $row[out_trade_no]  </td>
                 <td class="warning">  $row[subject]</td>
                 <td class="danger"> $row[total_amount]   </td>
                 <td class="info"> $row[notify_time] </td>
                 <td class="active"> $row[mechine] </td>
                 <td class="success"> $row[seller]</td>
            </tr>
EOF;
            $itemall .= $item;
        }
        $itemall = $itemall . '</table>';
//        echo var_dump($itemall);
        $conn->close();

        /********************换页*************************/
        if ($pageNow > 1) {
            $prePage = $pageNow - 1;
            $itemall .= "<div style='float: right;font-size: 18px;'> <a href='selldetail.php?pageNow=$prePage'>上一页</a> ";
        } else {
            $itemall .= "<div style='float: right;font-size: 18px;'>";
        }
        if ($pageNow < $pageCount) {
            $nextPage = $pageNow + 1;
            $itemall .= "<a href='selldetail.php?pageNow=$nextPage'>下一页</a> ";
        }
        $itemall .= '<form action="selldetail.php" style="display: inline">
          <input class="btn btn-xs btn-info"  type="text" size="1"  name="pageNow" value="1">
          <input class="btn btn-xs" type="submit" value="GO">
        </form>';
        $itemall .= "<span><br>当前第{$pageNow}页/共{$pageCount}页</span></div>";
        /************************************换页结束**********************/
        echo var_dump($itemall);
        return $itemall;
    }

    ?>
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/login.css">
    <script src='../../bootstrap/js/jquery-3.3.1.min.js'></script>
    <script src='../../bootstrap/js/bootstrap.min.js'></script>
    <script src="../../bootstrap/echarts.js"></script>
    <script src="./js/login.js"></script>
    <title>销售详情</title>
</head>
<body>
<div class="">
    <div class="box">
        <div class="other">
            <button class="btn btn-danger btn-lg item" id="realtime"></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="login.php">个人主页</a>
            </button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="selldetail.php">销售详情</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="merAdmin.php">商品管理</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="msgAdmin.php">留言管理</a></button>
            <button class="btn btn-primary btn-lg item">
                <a style="color: white;text-decoration: none" href="#">不要点我</a></button>
            <button class="btn btn-primary btn-lg item" onclick="logout()">退出登录</button>
        </div>

        <div class="panel panel-default col-md-12 col-xs-12 personal">
            <div class="panel-heading">
                <h3 class="panel-title"> 销售详情 </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td class="active">id</td>
                        <td class="success">out_trade_no</td>
                        <td class="warning">subject</td>
                        <td class="danger">total_amount</td>
                        <td class="info">notify_time</td>
                        <td class="active">mechine</td>
                        <td class="success">seller</td>
                    </tr>
                    <br style="border: 5px solid black">
                    <?php echo showdetail() ?>
                </table>

            </div>
        </div>
    </div>
    <script language="JavaScript">
        CurentTime();
        snow();
        setInterval(function () {
            CurentTime();
        }, 1000);
        setTimeout(t, 1000);
    </script>

    <script language="JavaScript">
        setTimeout(theLocation(), 1000);</script>
</div>
</body>

</html>