<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);


$id=$_POST['id'];
$key=$_POST['key'];
$openid=$_POST['openid'];
$name=$_POST['name'];

if(!$id)
{
	$id=$_GET['id'];
$key=$_GET['key'];
$openid=$_GET['openid'];
$name=$_GET['name'];

}

$getcourse=curl_init("http://zixunminda.stuzone.com/src/API/get_timetable_temp.php?key=LKJFI30jf&id=$id&token=$key");
curl_setopt($getcourse, CURLOPT_RETURNTRANSFER, 1);
$re=curl_exec($getcourse);

$testdata=$re;
$testdata=json_decode($testdata);

//判断学号和密码是否请求正确

$rewrong1=array(
	"code"=>403,
	"message"=>"没有输入数据"
	);
$rewrong2=array(
	"code"=>403,
	"message"=>"学号或密码输入错误"
	);
$rewrong3=array(
	"code"=>406,
	"message"=>"该成员信息已存在"
	);
if(!$testdata->status)
{
	echo json_encode($rewrong1,JSON_UNESCAPED_UNICODE);
	exit;
}
if($testdata->status==403||$testdata->status==407)
{
	echo json_encode($rewrong2,JSON_UNESCAPED_UNICODE);
	exit;
}

//var_dump($testdata->data->timetable);
$daycourse=$testdata->data->timetable;

for($i=1;$i<=17;$i++)
{
	for($j=1;$j<=5;$j++)
	{
		for($q=1;$q<12;$q++)
		{
			$eachfreetime[$i][$j][$q]='0';        //三个索引键依次代表周数，天数，课数
		}

	}
}




for($day=0;$day<5;$day++)   //对课表数据的每一天进行遍历

{
	for($c=0;$c<count($daycourse[$day]);$c++)     //对其中的一天进行便利,表示当天的课数
	{
		//echo "这是第".$day."天的第".$c."节课的开始时间:";
		$sectionfrom=$daycourse[$day][$c]->from_section;
		//echo $sectionfrom;
		//echo "结束时间为:";
		$sectionto=$daycourse[$day][$c]->to_section;
		//echo $sectionto;
		//echo "<br/>";

		for($week=$daycourse[$day][$c]->from_week;$week<=$daycourse[$day][$c]->to_week;$week++)
		{
			//echo "第".$week."周";
			for($ss=$sectionfrom;$ss<=$sectionto;$ss++)
			{
				$eachfreetime[$week][$day+1][$ss]='1';
			}
			
		}

	}

}

//var_dump($eachfreetime);

$rawdata=json_encode($eachfreetime);
//echo $rawdata;



$remessage=array(
	"code"=>200,
	"message"=>"添加成员信息成功"
	);

$remessage=json_encode($remessage,JSON_UNESCAPED_UNICODE);


$servername="localhost";
$dbusername="root";
$dbpassword="123456";
$databasename="bitoa";
$conn=new mysqli($servername,$dbusername,$dbpassword,$databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_set_charset($conn,"utf8");
$sql = "INSERT INTO course(id,username,openid,courseinfo)
 VALUES ('$id','$name','$openid','$rawdata')";
if ($conn->query($sql) === TRUE) {
    echo $remessage;
} else {
   // echo "插入数据出现问题: " . $conn->error;
	echo json_encode($rewrong3,JSON_UNESCAPED_UNICODE);
	exit;
}


