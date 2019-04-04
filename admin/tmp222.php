<?php
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
            echo "<table border=\"1\"> ";
            while ($row = $result->fetch_assoc()) {
                $item= "<tr><td> " . $row['id'] . '</td><td> ' . $row['out_trade_no'] .
                    '</td><td> ' . $row['subject'] . '</td><td>' . $row['total_amount'] .
                    '</td><td>' . $row['notify_time'] . '</td><td>' . $row['mechine'] .
                    '</td><td> ' . $row['seller'] . '</td></tr>';
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


}

?>