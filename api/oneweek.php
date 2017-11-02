<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);

$week=$_POST['week'];

if(!$week)
{
	$week=$_GET['week'];
}
//echo $week;
function fetchoneweek($week)
{
	
	$servername="localhost";
	$dbusername="root";
	$dbpassword="123456";
	$databasename="bitoa";
	$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);

	} 
	
	
	mysqli_set_charset($conn,"utf8");
	$week="week"."$week";

	$sql = "SELECT * FROM $week WHERE section=1";
	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $info["day1"]["section1"]=json_decode($row['day1'],1);
        $info["day2"]["section1"]=json_decode($row['day2'],1);
        $info["day3"]["section1"]=json_decode($row['day3'],1);
        $info["day4"]["section1"]=json_decode($row['day4'],1);
        $info["day5"]["section1"]=json_decode($row['day5'],1);
        
        
    }
	}
    $sql = "SELECT * FROM $week WHERE section=2";
	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $info["day1"]["section2"]=json_decode($row['day1'],1);
        $info["day2"]["section2"]=json_decode($row['day2'],1);
        $info["day3"]["section2"]=json_decode($row['day3'],1);
        $info["day4"]["section2"]=json_decode($row['day4'],1);
        $info["day5"]["section2"]=json_decode($row['day5'],1);
        
        
    }
	}

    $sql = "SELECT * FROM $week WHERE section=3";
	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $info["day1"]["section3"]=json_decode($row['day1'],1);
        $info["day2"]["section3"]=json_decode($row['day2'],1);
        $info["day3"]["section3"]=json_decode($row['day3'],1);
        $info["day4"]["section3"]=json_decode($row['day4'],1);
        $info["day5"]["section3"]=json_decode($row['day5'],1);
        
        	}
    }
    $sql = "SELECT * FROM $week WHERE section=4";
	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $info["day1"]["section4"]=json_decode($row['day1'],1);
        $info["day2"]["section4"]=json_decode($row['day2'],1);
        $info["day3"]["section4"]=json_decode($row['day3'],1);
        $info["day4"]["section4"]=json_decode($row['day4'],1);
        $info["day5"]["section4"]=json_decode($row['day5'],1);
        
        
    }


	}	 

return $info;

}

$re=fetchoneweek($week);
$re['code']="200";
echo json_encode($re,JSON_UNESCAPED_UNICODE);

