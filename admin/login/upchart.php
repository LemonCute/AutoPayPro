<?php
$str='ufashusa';

if (true) {//isset($_GET['merdata'])) {
    $servernae = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lemon";

    $merdata[] = array();
    $i = 0;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
//        die("连接失败: " . $conn->connect_error);
    }

    $sql = <<<EOF
    SELECT merSold FROM merchandise ;
EOF;
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
        // echo var_dump($row);
        $merdata[$i] = (int)$row[0];
        $i++;
    }
    echo json_encode($merdata);
}
    //echo json_encode("asidjiasjdias");

?>



