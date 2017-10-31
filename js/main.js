window.onload=function(){
	$("#showTable table tr:eq(0)").addClass('info');
};
var clicktochange= new Vue({
	el:"#menu",
	data:{
		"first":"排班表",
		"second":"添加人员",
		"third":"关于",
		"menu_id":["showTable","addMember","About"]
	},
	methods:{
		tochange:function(p){//菜单栏点击
			for (i of this.menu_id){
				$("#"+i).css({"display":"none"});
				if (i==p) thisvalue=p;
			}
			$("#"+thisvalue).css({"display":"block"});
		}
	}
});

var selection= new Vue({
	el:'#showTable',
	data:{
		"options":[
			{ option:"查看某一周排班情况", value:0 },
			{ option:"查看某一时间段可安排的成员", value:1 },
			{ option:"安排某个成员到某个时间段值班", value:2 },
			{ option:"把某个成员从某个时间段移除", value:3 },
			{ option:"将全局排班表复制给17个周的排班表", value:4 },
			{ option:"重新计算(获取)全局排班表", value:5 }
		],
		"selected":false,
		"submit":false,
		"button":"查询",
		"nowOption":"-1",
		"dataOfNowInput":Array(),
		"weekOfTable":'',
		"Info":'暂无',
		"obtain":false,
		"dataSubmit":[
			{ id:0, key:0, name:'' },
			{ week:0 },
			{ week:0, day:0, section:0},
			{ id:0, name:'', week:0, day:0, section:0},
			{ id:0, name:'', week:0, day:0, section:0},
			{ id:0, day:0, section:0}
		],
		"form":[
			[
				{ type:"number", placeholder:"第几周", name:"week" }
			],
			[
				{ type:"number", placeholder:"第几周", name:"week" },
				{ type:"number", placeholder:"这周的第几天", name:"day" },
				{ type:"number", placeholder:"这天的第几个时间段（一天有四个时间段）", name:"section" }
			],
			[
				{ type:"number", placeholder:"安排的对象的学号", name:"id" },
				{ type:"text", placeholder:"安排对象的姓名", name:"name" },
				{ type:"number", placeholder:"安排到的周数", name:"week" },
				{ type:"number", placeholder:"安排到的星期几", name:"day" },
				{ type:"number", placeholder:"这天的第几个时间段（一天有四个时间段）", name:"section" }
			],
			[
				{ type:"number", placeholder:"移除的对象的学号", name:"id" },
				{ type:"number", placeholder:"移除的周数", name:"week" },
				{ type:"number", placeholder:"移除星期几", name:"day" },
				{ type:"number", placeholder:"移除的是当天的第几个时间段（一天有四个时间段）", name:"section" }
			],
		],
		"dataOfTable":[
			{ td1:"Mon.", td2:"Tues.", td3:"Wed.", td4:"Thu.", td5:"Fri.", td6:"Sat.", td7:"Sun." },
			{ td1:"", td2:"", td3:"", td4:"", td5:"", td6:"", td7:"" },
			{ td1:"", td2:"", td3:"", td4:"", td5:"", td6:"", td7:"" },
			{ td1:"", td2:"", td3:"", td4:"", td5:"", td6:"", td7:"" },
			{ td1:"", td2:"", td3:"", td4:"", td5:"", td6:"", td7:"" },
		]
	},
	methods:{
		query:function(){
			selection.obtainData();
			//console.log(selection.obtain);
			if (selection.obtain==false) return;
			setTimeout(function(){
				selection.cssChange();
				selection.doAjax();
			},300);
		},
		filterInput:function(input){
			while(input.value.includes(' ')){
				let value=input.value;
				value=value.replace(' ','');
				input.value=value;
			};
		},
		checkNumber:function(input){
			let isRight=true;
			$(input).parent("span").removeClass('has-error has-success');
			if (input.name=='week'){
				input.value=parseInt(input.value);
				if (input.value>17||input.value<1){
					input.value='';
					$(input).parent("span").addClass('has-error');
					isRight=false;
				}
			}else if (input.name=='day') {
				input.value=parseInt(input.value);
				if (input.value>5||input.value<1){
					input.value='';
					$(input).parent("span").addClass('has-error');
					isRight=false;
				};
			}else if (input.name=='section') {
				input.value=parseInt(input.value);
				if (input.value>4||input.value<1){
					input.value='';
					$(input).parent("span").addClass('has-error');
					isRight=false;
				};
			}else if (input.name=='name'){
				if (input.value.match(/[0-9]/)){
					input.value='';
					$(input).parent("span").addClass('has-error');
					isRight=false;
				}
			}
			if (input.value=='') $(input).parent("span").addClass('has-error');
			if (isRight) $(input).parent("span").addClass('has-success');
		},
		obtainData:function(){
			let nowInput=$(".selection_order:eq("+this.nowOption+") input");
			let i=0;
			for (n of nowInput){
				if (n.value=='') return this.obtain=false;
				this.dataOfNowInput[i]=n.value;
				i++;
			}
			this.obtain=true;
		},
		cssChange:function(){
			let now=$(".selection_order:eq("+this.nowOption+")");
			now.hide('normal');
			if (this.nowOption==0){
				this.weekOfTable="第 "+$(".selection_order:eq("+this.nowOption+") input").val()+" 周";
				$("#weekOfTable").show();
				$("#showTable table").show(); 
			}
			$("#showTable button").hide();
		},
		doAjax:function(){
			let arr_data=new Array();
			arr_data[0]=Array("week");
			arr_data[1]=Array("week","day","section");
			arr_data[2]=Array("id","name","week","day","section");
			arr_data[3]=Array("id","week","day","section");
			arr_data[4]=Array("id","day","section");
			let ajax_way=Array("oneweek","available","arrange","remove","copyallweek","calschedule");
			let ajax_data='{';
			if (typeof(arr_data[this.nowOption])=='undefined'){
				ajax_data='';
			}else{
				for (let i=0;i<arr_data[this.nowOption].length;i++){
					ajax_data+='\"'+arr_data[this.nowOption][i]+'\":\"'+this.dataOfNowInput[i]+'\",';
				};
				ajax_data=ajax_data.substring(0, ajax_data.length - 1);
				ajax_data+='}';
				ajax_data=$.parseJSON(ajax_data);
			}
			$.ajax({
				url:        "php/"+ajax_way[this.nowOption]+".php",
				async:      false,
				type:       "post",
				data:       ajax_data,
				complete:function(data){
					//console.log(data);
					switch (parseInt(selection.nowOption)+1){	
						case 1:{
							data=JSON.parse(data.responseText);
							for (let i=1;i<=5;i++){
								for (let d=1;d<5;d++){
									let replaceText=JSON.stringify(data['day'+i]['section'+d]);
									replaceText=replaceText.replace(/^[A-Za-z0-9]+/g,'');
									replaceText=replaceText.replace(/\"/g,'');
									replaceText=replaceText.replace(/\{/g,'');
									replaceText=replaceText.replace(/\}/g,'');
									replaceText=replaceText.replace(/\:/g,'');
									replaceText=replaceText.replace(/[0-9]/g,'');
									selection.dataOfTable[d]['td'+i]=replaceText;
								}
							}
							break;
						}
						case 2:{
							data=JSON.parse(data.responseText);
							//console.log(data['member']);
							let replaceText=JSON.stringify(data['member']);
							replaceText=replaceText.replace(/^[A-Za-z0-9]+/g,'');
							replaceText=replaceText.replace(/\"/g,'');
							replaceText=replaceText.replace(/\{/g,'');
							replaceText=replaceText.replace(/\}/g,'');
							replaceText=replaceText.replace(/\:/g,'');
							replaceText=replaceText.replace(/[0-9]/g,'');
							//console.log(replaceText);
							$("#queryInfo").show();
							//console.log(replaceText);
							if (replaceText!=''){
								selection.Info="此时段有："+replaceText;
							}else{
								selection.Info="暂无";
							}
							break;
						}
						case 3:{
							data=JSON.parse(data.responseText);
							if (data['code']==200) alert(data['message']);
							else alert('调度失败，请重试');
							break;
						}
						case 4:{
							data=JSON.parse(data.responseText);
							if (data['code']==200) alert('成员移除成功！');
							else alert('移除失败，请重试');
							break;
						}
						case 5:{
							alert('复制完成');
							break;
						}
						case 6:{
							alert('成功！已更新全局排班表。');
							break;
						}
						default:{
							alert('未知错误，请刷新页面后重试。');
						}
					}
				}
			});
		},
	},
	watch:{
		selected:function(val){
			this.nowOption=val;
			$(".selection_order").css({"display":"none"});
			$(".selection_order:eq("+this.nowOption+")").show('normal');
			$("#showTable button").show();
			$("#queryInfo").hide();
			$("#selection input").parent("span").removeClass('has-success has-error');
		},
	}
});

//________________________________________________________________________________
var Submit= new Vue({
	el:'#addMember',
	data:{
		"input":[
			[
				{ type:"number", placeholder:"该成员的学号", name:"id" },
			],
			[
				{ type:"password", placeholder:"密码", name:"key" },
			],
			[
				{ type:"text", placeholder:"姓名", name:"name" },
			]
		],
		"button":"添加"
	},
	methods:{
		onSubmit:function(){
			let dataOfInput='{';
			let temp=$("#addMember input");
			for (let i=0;i<temp.length;i++){
				dataOfInput+='\"'+temp[i].name+'\":\"'+temp[i].value+'\",';
			}
			dataOfInput=dataOfInput.substring(0, dataOfInput.length - 1);
			dataOfInput+='}';
			dataOfInput=$.parseJSON(dataOfInput);
			this.doAjax(dataOfInput);
			$("#addMember input").parent("span").removeClass('has-success has-error');
		},
		doAjax:function(data){
			//console.log(data);
			$.ajax({
				url:        "php/addmember.php",
				async:      false,
				type:       "post",
				data:data,
				success:function(data){
					data=$.parseJSON(data);
					if (data['code']==200){
						alert(data['message']);
						Submit.calschedule();
					}
					else alert(data['message']);
				},
				error:function(data){
					alert('添加失败，请重试');
				}
			});
		},
		calschedule:function(){
			$.ajax({
				url:        "php/calschedule.php",
				async:      false,
				type:       "post",
				data:       "",
				success:function(data){
					return true;
				},
				error:function(data){
					return false;
				}
			});
		},
		checkInput:function(input){
			$(input).parent("span").removeClass('has-error has-success');
			let isRight=true;
			//console.log(input.value.length);
			if (input.name=='id') {
				input.value=parseInt(input.value);
				if (input.value<0 || input.value=='') {
					input.value='';
					$(input).parent("span").addClass('has-error');
					isRight=false;
				}
			}else if (input.name=='name'){
				if (input.value.match(/[0-9]/) || input.value==''){
					input.value='';
					$(input).parent("span").addClass('has-error');
					isRight=false;
				}
			}else if (input.name=='key'){
				if (input.value.length==0){
					$(input).parent("span").addClass('has-error');
					isRight=false;
				}
			}
			if (isRight) $(input).parent("span").addClass('has-success');
		},
		filterInput:function(input){
			while(input.value.includes(' ')){
				let value=input.value;
				value=value.replace(' ','');
				input.value=value;
			};
		}
	}
});	