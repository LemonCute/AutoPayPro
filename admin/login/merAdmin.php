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

    //显示详情
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
    select count(id) from merchandise;
EOF;
        $res1 = $conn->query($sql1);
        if ($row1 = mysqli_fetch_row($res1)) {
            $rowCount = $row1[0];
        }
        $pageCount = ceil(($rowCount / $pageSize));
        $pre = ($pageNow - 1) * $pageSize;
        /***************************分页结束******************************/

        $sql = <<<EOF
    SELECT * FROM merchandise limit {$pre},{$pageSize};
EOF;
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
//            echo var_dump($row);
            $item = <<<EOF
            
            <tr>
                 <td class='active'> $row[id]</td>
                 <td class="success"> $row[merName]  </td>
                 <td class="warning">  $row[merMoney]</td>
                 <td class="danger"> $row[merLeft]   </td>
                 <td class="info"> $row[merSrc] </td>
                 <td class="success"> $row[merSold] </td>
                <td class="info" onclick="delajax($row[id])"> ⊙删除 ⊙</td>     
            </tr>
EOF;
            $itemall .= $item;
        }
        $itemall = $itemall . '</table>';
//      echo var_dump($itemall);
        $conn->close();
        /*******************************换页*************************/
        if ($pageNow > 1) {
            $prePage = $pageNow - 1;
            $itemall .= "<div style='float: right;font-size: 18px;'> <a href='merAdmin.php?pageNow=$prePage'>上一页</a> ";
        } else {
            $itemall .= "<div style='float: right;font-size: 18px;'>";
        }
        if ($pageNow < $pageCount) {
            $nextPage = $pageNow + 1;
            $itemall .= "<a href='merAdmin.php?pageNow=$nextPage'>下一页</a> ";
        }
        $itemall .= '<form action="merAdmin.php" style="display: inline">
          <input class="btn btn-xs btn-info"  type="text" size="1"  name="pageNow" value="1">
          <input class="btn btn-xs" type="submit" value="GO">
        </form>';
        $itemall .= "<span><br>当前第{$pageNow}页/共{$pageCount}页</span></div>";
        /************************************换页结束**********************/
        echo var_dump($itemall);
        return $itemall;
    }

    //插入一条信息
    function insertMer($Name, $Money, $Left, $Src)
    {
        global $servername, $username, $password, $dbname;
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        $sql = <<<EOF
INSERT INTO merchandise ( merName,merMoney,MerLeft,merSrc)
VALUES ( {$Name},{$Money},{$Left},'{$Src}');
EOF;
        if ($conn->query($sql) === TRUE) {
            echo '<script language="JavaScript">
            alert("新记录插入成功");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    if ($_POST) {
        insertMer($_POST['merName'], $_POST['merMoney'], $_POST['merLeft'], $_POST['merSrc']);
        echo '<script language="JavaScript">window.location.reload();\'</script> ';
    }

    //删除一条数据
    function delMer($index)
    {
        global $servername, $username, $password, $dbname;
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        $sql = <<<EOF
 DELETE FROM `lemon`.`merchandise` WHERE `id` = {$index};
EOF;
        if ($conn->query($sql) === TRUE) {
            echo '<script language="JavaScript">
            alert("删除成功");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    if (isset($_GET['index'])) {
        delMer($_GET['index']);
    }
    ?>


    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/common.css">
    <script src='../../bootstrap/js/jquery-3.3.1.min.js'></script>
    <script src='../../bootstrap/js/bootstrap.min.js'></script>
    <script src="../../bootstrap/echarts.js"></script>
    <script src="./js/login.js"></script>
    <script type="text/javascript">

        function delajax(index) {
            $.ajax({
                url: 'http://localhost:8888/AutoPayPro/admin/login/merAdmin.php',
                data: {
                    index: index
                },
                type: 'GET',
                success: function (str) {	//成功回调函数
                    console.log(str);
                    document.write(str);
                },
                error: function (err) {	//失败回调函数
                    alert(err);
                }
            });
        }


        function changepic() {
            var reads = new FileReader();
            f = document.getElementById('file').files[0];
            reads.readAsDataURL(f);
            reads.onload = function (e) {
                document.getElementById('show').innerText = f.name;
            };
            console.log(f);
        }

        var w, h, className;

        function getSrceenWH() {
            w = $(window).width();
            h = $(window).height();
            $('#dialogBg').width(w).height(h);
        }

        window.onresize = function () {
            getSrceenWH();
        }
        $(window).resize();

        $(function () {
            getSrceenWH();
            //显示弹框
            $('#fade').click(function () {
                className = $(this).attr('class');
                $('#dialogBg').fadeIn(300);
                $('#dialog').removeAttr('class').addClass('animated ' + className + '').fadeIn();
                console.log("dianji");
            });

            //关闭弹窗
            $('.claseDialogBtn').click(function () {
                $('#dialogBg').fadeOut(300, function () {
                    $('#dialog').addClass('bounceOutUp').fadeOut();
                });
            });
        });
    </script>
    <title>商品管理</title>
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
                <h3 class="panel-title"> 商品管理
                    <button style="float:right "
                            class="btn btn-info btn-xs" id="fade">添加
                    </button>
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td class="active">id</td>
                        <td class="success">merName</td>
                        <td class="warning">merMoney(元)</td>
                        <td class="danger">merLeft</td>
                        <td class="info">merSrc</td>
                        <td class="success">merSold</td>
                        <td class="active">status</td>
                    </tr>
                    <br style="border: 5px solid black">
                    <?php echo showdetail() ?>
                </table>

            </div>
            <!--            以下是弹窗-->
            <div id="dialogBg"></div>
            <div id="dialog" class="animated">
                <img class="dialogIco" width="50" height="50" src="images/ico.png" alt=""/>
                <div class="dialogTop"><a href="javascript:;" class="claseDialogBtn">关闭</a></div>
                <form action="merAdmin.php" method="post" id="editForm">
                    <!--                    function insertMer($Name, $Money, $Left, $Src)-->
                    <ul class="editInfos" style="color: black">
                        <li>* 名称：<input type="text" name="merName" required value="" placeholder="果粒橙" class="ipt"/>
                        </li>
                        <li>* 价格：<input type="text" name="merMoney" required value="" placeholder="4.50" class="ipt"/>
                        </li>
                        <li>* 剩余：<input type="text" name="merLeft" required value="" placeholder="20" class="ipt"/></li>
                        <li><input type="file" accept="image/*" name="merSrc" id="file" onchange="changepic(this)"
                                   style="opacity: 0;"/>
                            <label style="margin-top: -30px;width: 180px" for="file" id="show"
                                   class='btn btn-sm btn-info'>选择商品图片</label></li>
                        <li><input type="submit" value="确认提交" class="submitBtn"/></li>
                    </ul>
                </form>
            </div>
            <!--            以上是弹窗-->
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