<?php
$testdata='
	{"status":200,"message":"","data":{"adj_info":[{"origin":{"from_week":5,"to_week":5,"day_in_week":5,"from_section":3,"to_section":4,"teacher":"\u675c\u5c0f\u5764","place":"11510"},"modified":{"from_week":6,"to_week":6,"day_in_week":4,"from_section":7,"to_section":8,"teacher":"\u675c\u5c0f\u5764","place":"11511"}}],"current_week":-21,"timetable":[[{"name":"\u6982\u7387\u8bba\u4e0e\u6570\u7406\u7edf\u8ba1[05]","from_week":"1","to_week":"16","from_section":"3","to_section":"4","teacher":"\u9648\u6668","place":"15\u53f7\u697c 15223"},{"name":"\u6570\u5b57\u7535\u5b50\u6280\u672f[03]","from_week":"1","to_week":"16","from_section":"5","to_section":"7","teacher":"\u4f55\u79c9\u59e3","place":"11\u53f7\u697c 11313"}],[{"name":"\u4e2d\u56fd\u6587\u5316\u6982\u51b5\uff08\u82f1\u6587\uff09[12]","from_week":"3","to_week":"14","from_section":"3","to_section":"4","teacher":"\u674e\u5c0f\u82b3","place":"10\u53f7\u697c 10214"},{"name":"\u4f53\u80b24[155]","from_week":"1","to_week":"16","from_section":"7","to_section":"8","teacher":"\u90ed\u9e3f","place":"\u4f53\u80b2\u573a\u9986 \u6392\u7403\u573a(\u5357\u533a2)"},{"name":"\u6570\u636e\u7ed3\u6784(\u5b9e\u9a8c)[03]","from_week":"5","to_week":"16","from_section":"9","to_section":"10","teacher":"\u675c\u5c0f\u5764","place":"9\u53f7\u697c S090206"}],[{"name":"\u6570\u636e\u7ed3\u6784[03]","from_week":"1","to_week":"16","from_section":"3","to_section":"4","teacher":"\u675c\u5c0f\u5764","place":"15\u53f7\u697c 15521"},{"name":"\u6982\u7387\u8bba\u4e0e\u6570\u7406\u7edf\u8ba1[05]","from_week":"1","to_week":"16","from_section":"5","to_section":"6","teacher":"\u9648\u6668","place":"15\u53f7\u697c 15223"},{"name":"\u6bdb\u6cfd\u4e1c\u601d\u60f3\u548c\u4e2d\u56fd\u7279\u8272\u793e\u4f1a\u4e3b\u4e49\u7406\u8bba\u4f53\u7cfb\u6982\u8bba[08]","from_week":"1","to_week":"16","from_section":"7","to_section":"8","teacher":"\u6613\u65b0\u6d9b","place":"15\u53f7\u697c 15103"},{"name":"\u4fe1\u606f\u7cfb\u7edf\u5206\u6790\u4e0e\u8bbe\u8ba1(\u5b9e\u9a8c)[02]","from_week":"10","to_week":"15","from_section":"9","to_section":"10","teacher":"\u5468\u6676\u5e73","place":"9\u53f7\u697c S090202"},{"name":"\u6570\u5b57\u7535\u5b50\u6280\u672f(\u5b9e\u9a8c)[03]","from_week":"12","to_week":"15","from_section":"9","to_section":"11","teacher":"\u4f55\u79c9\u59e3","place":"9\u53f7\u697c S090307"}],[{"name":"\u4fe1\u606f\u7cfb\u7edf\u5206\u6790\u4e0e\u8bbe\u8ba1[02]","from_week":"1","to_week":"16","from_section":"1","to_section":"2","teacher":"\u5468\u6676\u5e73","place":"11\u53f7\u697c 11301"},{"name":"\u4e2d\u56fd\u6587\u5316\u6982\u51b5\uff08\u82f1\u6587\uff09[12]","from_week":"3","to_week":"14","from_section":"3","to_section":"4","teacher":"\u674e\u5c0f\u82b3","place":"10\u53f7\u697c 10214"},{"name":"\u6bdb\u6cfd\u4e1c\u601d\u60f3\u548c\u4e2d\u56fd\u7279\u8272\u793e\u4f1a\u4e3b\u4e49\u7406\u8bba\u4f53\u7cfb\u6982\u8bba[08]","from_week":"1","to_week":"16","from_section":"5","to_section":"6","teacher":"\u6613\u65b0\u6d9b","place":"15\u53f7\u697c 15212"},{"name":"\u8ba1\u7b97\u673a\u524d\u6cbf\u6280\u672f\u82e5\u5e72\u4e13\u9898\u8da3\u8c08\uff08\u516c\u9009\uff09[01]","from_week":"5","to_week":"12","from_section":"9","to_section":"10","teacher":"\u674e\u6ce2","place":"15\u53f7\u697c 15112"}],[{"name":"\u6570\u636e\u7ed3\u6784[03]","from_week":"1","to_week":"16","from_section":"3","to_section":"4","teacher":"\u675c\u5c0f\u5764","place":"11\u53f7\u697c 11510"},{"name":"\u6c47\u7f16\u8bed\u8a00[03]","from_week":"1","to_week":"16","from_section":"5","to_section":"6","teacher":"\u5510\u83c0","place":"11\u53f7\u697c 11204"},{"name":"\u6c47\u7f16\u8bed\u8a00(\u5b9e\u9a8c)[03]","from_week":"3","to_week":"14","from_section":"7","to_section":"8","teacher":"\u5510\u83c0","place":"9\u53f7\u697c S090203"}],[],[]]}}';
$testdata=json_decode($testdata);

//var_dump($testdata->data->timetable);
$daycourse=$testdata->data->timetable;

for($i=1;$i<=17;$i++)
{
	for($j=1;$j<=5;$j++)
	{
		for($q=1;$q<12;$q++)
		{
			$eachfreetime[$i][$j][$q]=0;        //三个索引键依次代表周数，天数，课数
		}

	}
}

echo json_encode($eachfreetime);


for($day=0;$day<5;$day++)   //对课表数据的每一天进行遍历

{
	for($c=0;$c<count($daycourse[$day]);$c++)     //对其中的一天进行便利,表示当天的课数
	{
		echo "这是第".$day."天的第".$c."节课的开始时间:";
		$sectionfrom=$daycourse[$day][$c]->from_section;
		echo $sectionfrom;
		echo "结束时间为:";
		$sectionto=$daycourse[$day][$c]->to_section;
		echo $sectionto;
		echo "<br/>";

		for($week=$daycourse[$day][$c]->from_week;$week<=$daycourse[$day][$c]->to_week;$week++)
		{
			echo "第".$week."周";
			for($ss=$sectionfrom;$ss<=$sectionto;$ss++)
			{
				$eachfreetime[$week][$day+1][$ss]=1;
			}
			
		}

	}

}

var_dump($eachfreetime);

