<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);


$week=$_POST['week'];
$day=$_POST['day'];
$section=$_POST['section'];
if(!$week)
{
$week=$_GET['week'];
$day=$_GET['day'];
$section=$_GET['section'];

}




//连接数据库，取出成员课程信息
$servername="localhost";
$dbusername="root";
$dbpassword="123456";
$databasename="bitoa";
$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM course ";
$count=0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
    	$count++;
        $courseinfo[$count]=json_decode($row['courseinfo'],1);
        $id[$count]=$row['id'];
        $name[$count]=$row['username'];
    }
} else {
    echo "0 个结果";
}

for($i=1;$i<=$count;$i++)
{
	if($section==1)
	{
		if($courseinfo[$i][$week][$day][1]==0||$courseinfo[$i][$week][$day][2]==0)
		{
			$member[$id[$i]]=$name[$i];
		}
		
	}
	if($section==2)
	{
		if($courseinfo[$i][$week][$day][3]==0||$courseinfo[$i][$week][$day][4]==0)
		{
			$member[$id[$i]]=$name[$i];
		}
		
	}
	if($section==3)
	{
		if($courseinfo[$i][$week][$day][5]==0||$courseinfo[$i][$week][$day][6]==0)
		{
			$member[$id[$i]]=$name[$i];
		}
		
	}
	if($section==4)
	{
		if($courseinfo[$i][$week][$day][7]==0||$courseinfo[$i][$week][$day][8]==0)
		{
			$member[$id[$i]]=$name[$i];
		}
		
	}


}


$re['code']="200";
$re['member']=$member;
echo json_encode($re,JSON_UNESCAPED_UNICODE);