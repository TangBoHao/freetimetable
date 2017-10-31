<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "123456";

// 创建连接
$conn = new mysqli($servername, $username, $password);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

// 创建数据库
$sql = "CREATE DATABASE bitoa";
if ($conn->query($sql) === TRUE) {
    echo "数据库创建成功";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>


<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "bitoa";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

// 使用 sql 创建数据表
$sql = "CREATE TABLE course (
id VARCHAR(20) PRIMARY KEY, 
username VARCHAR(30) NOT NULL,
courseinfo VARCHAR(50000) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)DEFAULT CHARSET=utf8";

if ($conn->query($sql) === TRUE) {
    echo "数据表创建成功";
} else {
    echo "创建数据表错误: " . $conn->error;
}


for($i=1;$i<=17;$i++)
{
$week="week"."$i";
echo "<br>";
echo $week;
$sql = "CREATE TABLE $week (
section INT(20)  PRIMARY KEY , 
day1 VARCHAR(50000) NOT NULL,
day2 VARCHAR(50000) NOT NULL,
day3 VARCHAR(50000) NOT NULL,
day4 VARCHAR(50000) NOT NULL,
day5 VARCHAR(50000) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)DEFAULT CHARSET=utf8";

if ($conn->query($sql) === TRUE) {
    echo "数据表创建成功";
} else {
    echo "创建数据表错误: " . $conn->error;
}

}


$sql = "CREATE TABLE allweek (
section INT(20)  PRIMARY KEY , 
day1 VARCHAR(50000) NOT NULL,
day2 VARCHAR(50000) NOT NULL,
day3 VARCHAR(50000) NOT NULL,
day4 VARCHAR(50000) NOT NULL,
day5 VARCHAR(50000) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)DEFAULT CHARSET=utf8";

if ($conn->query($sql) === TRUE) {
    echo "所有周数的数据表数据表创建成功";
} else {
    echo "创建数据表错误: " . $conn->error;
}

