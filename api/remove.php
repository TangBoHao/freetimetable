<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);

$id=$_POST['id'];

$week=$_POST['week'];
$day=$_POST['day'];
$section=$_POST['section'];
if(!$id)
{
$id=$_GET['id'];

$week=$_GET['week'];
$day=$_GET['day'];
$section=$_GET['section'];
}


function insertdb($week,$day,$section,$data)
{
	$servername="localhost";
	$dbusername="root";
	$dbpassword="123456";
	$databasename="bitoa";
	$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);

	} 
	$week="week"."$week";
	$day="day"."$day";
	
	mysqli_set_charset($conn,"utf8");
	$sql = " update $week set $day='$data' where section=$section;";
	if ($conn->query($sql) === TRUE) {
   			 // echo "success";
   			 // echo "第"."$day"."天"."第"."$section"."个时间段";
   			 // echo $data;
			} else {
   		echo "插入数据出现问题: " . $conn->error;
			}



}

function fetchdata($week,$day,$section)
{
	$servername="localhost";
	$dbusername="root";
	$dbpassword="123456";
	$databasename="bitoa";
	$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);

	} 
	$week="week"."$week";
	//echo $week;
	$day="day"."$day";
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT * FROM $week WHERE section=$section";
	$count=0;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $data=$row[$day];
        return json_decode($data,1);
    }
	} else {
		$re=array();
   		return $re;
	}



}

$member=fetchdata($week,$day,$section);
// var_dump($member);
unset($member[$id]);
//$member[$id]=$name;
// var_dump($member);
$member =json_encode($member,JSON_UNESCAPED_UNICODE);
insertdb($week,$day,$section,$member);

$re["code"]="200";
$re["message"]="改成员调度成功";
echo json_encode($re,JSON_UNESCAPED_UNICODE);



