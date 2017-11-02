<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);

$id=$_GET['id'];

$servername="localhost";
$dbusername="root";
$dbpassword="123456";
$databasename="bitoa";
$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM course WHERE id=$id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $info=$row['courseinfo'];
    }
} else {
    echo "0 个结果";
}


$info=json_decode($info,1);
//var_dump($info);

for($i=1;$i<=17;$i++)
{
	echo "第".$i."周";
	echo "<br/>";
	for($j=1;$j<=5;$j++)
	{
		echo "这周的第".$j."天：";
		echo "<br/>";
		for($q=1;$q<12;$q++)
		{
			echo "第".$q."节课：";
			echo $info[$i][$j][$q];        //三个索引键依次代表周数，天数，课数
			echo "|||||";
		}
		echo "<br/>";

	}
}