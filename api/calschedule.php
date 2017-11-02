<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);

function initdb()
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
	$sql="REPLACE INTO allweek(section) VALUES ('1')";
	if ($conn->query($sql) === TRUE) {
   			 echo "success";
			} else {
   		echo "初始化错误" ;
			}
		

	$sql="REPLACE INTO allweek(section) VALUES ('2')";
	if ($conn->query($sql) === TRUE) {
   			 echo "success";
			} else {
   		echo "初始化错误" ;
			}

	$sql="REPLACE INTO allweek(section) VALUES ('3')";
	if ($conn->query($sql) === TRUE) {
   			 echo "success";
			} else {
   		echo "初始化错误" ;
			}


	$sql="REPLACE INTO allweek(section) VALUES ('4')";
	if ($conn->query($sql) === TRUE) {
   			 echo "success";
			} else {
   		echo "初始化错误" ;
			}



}
initdb();   //每一次计算都将数据库初始化

function insertdb($day,$section,$data)
{
	$servername="localhost";
	$dbusername="root";
	$dbpassword="123456";
	$databasename="bitoa";
	$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);

	} 
	$day="day"."$day";
	
	mysqli_set_charset($conn,"utf8");
	$sql = " update allweek set $day='$data' where section=$section;";
	if ($conn->query($sql) === TRUE) {
   			 echo "success";
   			 echo "第"."$day"."天"."第"."$section"."个时间段";
   			 echo $data;
			} else {
   		echo "插入数据出现问题: " . $conn->error;
			}



}



function fetchdata($day,$section)
{
	$servername="localhost";
	$dbusername="root";
	$dbpassword="123456";
	$databasename="bitoa";
	$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);

	} 
	$day="day"."$day";
	mysqli_set_charset($conn,"utf8");
	
	$sql = "SELECT * FROM allweek WHERE section=$section";
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




$servername="localhost";
$dbusername="root";
$dbpassword="123456";
$databasename="bitoa";
$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM course";
$count=0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // 输出每行数据
    while($row = $result->fetch_assoc()) {
        $info[$count]=$row['courseinfo'];
        $name[$count]=$row['username'];
        $id[$count]=$row['id'];
        $count++;
    }
} else {
    echo "0 个结果";
}

echo "$count"."条记录";



for($num=0;$num<$count;$num++)
{       //将某个时间段的值班人员的学号和姓名插入到数据库中
	echo "这个是一次执行";
$obj=json_decode($info[$num],1);

for($i=1;$i<6;$i++)
{
	for($j=1;$j<5;$j++)
	{
		$section[$i][$j]=0;
	}
	
}

for($week=1;$week<18;$week++)
{

	for($day=1;$day<6;$day++)
	{
		if($obj[$week][$day][1]==0&&$obj[$week][$day][2]==0)  //判断第一个时间段
		{
			$section[$day][1]++;
		}
		if($obj[$week][$day][3]==0&&$obj[$week][$day][4]==0)  //判断第二个时间段
		{
			$section[$day][2]++;
		}
		if($obj[$week][$day][5]==0&&$obj[$week][$day][6]==0)	//判断第三个时间段
		{
			$section[$day][3]++;
		}
		if($obj[$week][$day][7]==0&&$obj[$week][$day][8]==0)	//判断第四个时间段
		{
			$section[$day][4]++;
		}
	}
}
echo "<br>";
echo $section[1][1];
echo "<br>";
echo $section[1][2];
echo "<br>";
echo $section[1][3];
echo "<br>";
echo $section[1][4];
echo "<br>";



//将某个时间端的安排插入到数据库中




for($i=1;$i<6;$i++)   //遍历天
{
	for($j=1;$j<5;$j++)  //遍历时间段
	{
		
		if($section[$i][$j]==17)  
		{
			$schedule=fetchdata($i,$j);
			echo "取出的数据";
			var_dump($schedule);
			$schedule[$id[$num]]=$name[$num];
			
			$schedule=json_encode($schedule,JSON_UNESCAPED_UNICODE);
			insertdb($i,$j,$schedule);
			echo "插入后取出的数据";
			$schedule=fetchdata($i,$j);
			var_dump($schedule);


		}

	}
	
}




}   //将某个时间段的值班人员的学号和姓名，插入到数据库中




$re=fetchdata(2,3);
var_dump($re);

