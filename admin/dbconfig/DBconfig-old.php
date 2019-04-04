<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lemon";

$marketitem="";
//alter table market convert to character set utf8;
function insertmarket($out_trade_no, $subject, $total_amount, $notify_time, $mechine, $seller)
{
    global $servername, $username, $password, $dbname;
// 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $sql = <<<EOF
INSERT INTO market ( out_trade_no, subject,total_amount,notify_time,mechine,seller)
            VALUES ( $out_trade_no,$subject,$total_amount,$notify_time,$mechine,$seller);
EOF;
    echo '<br>' . $sql . '<br><br><br><br><br><br>';
    if ($conn->query($sql) === TRUE) {
        echo "新记录插入成功";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

//测试使用
//for ($i = 1; $i <= 1; $i++) {
//    addmarket('201904010001231', "'果粒橙'",
//        4.50, '2019-03-29 09:46:41', 101, 10001);
//}
function showmarket($table)
{
    global $servername, $username, $password, $dbname,$marketitem;
    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    /************计数**算页数*************************/
    $pageSize = 4;   //每页显示的数量
    $rowCount = 0;   //要从数据库中获取
    $pageNow = 1;    //当前显示第几页
    //如果有pageNow就使用，没有就默认第一页。
    if (!empty($_GET['pageNow'])) {
        $pageNow = $_GET['pageNow'];
    }
    $pageCount = 0;  //表示共有多少页
    $sql1 = <<<EOF
select count(id) from {$table};
EOF;
    $res1 = $conn->query($sql1);
    if ($row1 = mysqli_fetch_row($res1)) {
        foreach ($row1 as $item) {
            echo '共 ' . $item . ' 条数据';
        }
        $rowCount = $row1[0];
    }
    //计算共有多少页，ceil取进1
    $pageCount = ceil(($rowCount / $pageSize));
    //使用sql语句时，注意有些变量应取出赋值。
    $pre = ($pageNow - 1) * $pageSize;

    // 列出当前
    $sql = <<<EOF
SELECT * FROM {$table} limit {$pre},{$pageSize};
EOF;

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //输出数据
        if($table=="market") {
            echo "<table border=\"1\">   
                  <th>id</th>
                  <th>out_trade_no</th>
                  <th>subject</th>
                  <th>total_amount</th>
                  <th>notify_time</th>
                  <th>mechine</th>
                  <th>seller</th>";
            while ($row = $result->fetch_assoc()) {
                $item= "<tr><th> " . $row['id'] . '</th><th> ' . $row['out_trade_no'] .
                    '</th><th> ' . $row['subject'] . '</th><th>' . $row['total_amount'] .
                    '</th><th>' . $row['notify_time'] . '</th><th>' . $row['mechine'] .
                    '</th><th> ' . $row['seller'] . '</th></tr>';
//                echo $item;
                $marketitem.=$item;
            }
            echo "</table>";
        }elseif($table=="machinetoseller"){
            echo "<table border=\"1\">   
                    <th>id</th>
                  <th>machine</th>
                  <th>seller</th> ";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><th> " . $row['id'] ."</th><th>" . $row['machine'] ."</th><th>". $row['seller'].'</th></tr>';
            }
            echo "</table>";
        }
    } else {
        echo "数据表中  0 结果";
    }
    $conn->close();


    if ($pageNow > 1) {
        $prePage = $pageNow - 1;
        echo "<a href='DBconfig.php?pageNow=$prePage'>pre</a> ";
    }
    if ($pageNow < $pageCount) {
        $nextPage = $pageNow + 1;
        echo "<a href='DBconfig.php?pageNow=$nextPage'>next</a> ";
    }
    echo "当前页{$pageNow}/共{$pageCount}页";
    echo '<form action="DBconfig.php">
          <input type="text" size="1"  name="pageNow" value="1">
          <input type="submit" value="GO">
        </form>';

    return $marketitem;
}

//showmarket("market");
//showmarket("machinetoseller");
//insertmachinetoseller("105","10003")
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lemon";
//alter table market convert to character set utf8;
function insertmachinetoseller($machine, $seller)
{
    global $servername, $username, $password, $dbname;
// 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $sql = <<<EOF
INSERT INTO machinetoseller ( machine,seller)
            VALUES ($machine,$seller);
EOF;
    echo '<br>' . $sql . '<br><br><br><br><br><br>';
    if ($conn->query($sql) === TRUE) {
        echo "新记录插入成功";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function deletemachinetoseller($machine)
{
    global $servername, $username, $password, $dbname;
// 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $sql = <<<EOF
    DELETE FROM `lemon`.`machinetoseller` WHERE `machine` = {$machine};
EOF;
    echo '<br>' . $sql . '<br><br><br><br><br><br>';
    if ($conn->query($sql) === TRUE) {
        echo "机器已删除成功";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

