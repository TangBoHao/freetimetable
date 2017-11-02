<?php
header("Access-Control-Allow-Origin:*");    //允许访问的域名，*表示所有的
header("Access-Control-Allow-Methods:POST,GET");		//允许访问的请求方式
//header("Content-type: application/html; charset=utf-8");
header("Content-type: text/html; charset=utf-8");
error_reporting(0);

function copyallweek($src,$dic)
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
	$sql = " replace into $dic select * from $src";
	if ($conn->query($sql) === TRUE) {
   			 echo "success";
   			 
			} else {
   		echo "插入数据出现问题: " . $conn->error;
			}



}

for($i=1;$i<=17;$i++)
{
	$src="allweek";
	$dic="week"."$i";
	copyallweek($src,$dic);
}