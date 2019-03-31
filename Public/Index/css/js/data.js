DATA={
	menu:[{//一级菜单
		menuid:'m001',
		name:'主页',
		code:'m001',
		icon:'/Public/Index/css/images/home.png'
	},{
		menuid:'m002',
		name:'我的资料',
		code:'m002',
		icon:'/Public/Index/css/images/0011.png'
	},{
		menuid:'m003',
		name:'推广大厅',
		code:'m003',
		icon:'/Public/Index/css/images/0022.png'
	},{
		menuid:'m004',
		name:'充值大厅',
		code:'m004',
		icon:'/Public/Index/css/images/0033.png'
	},{
		menuid:'m005',
		name:'财务中心',
		code:'m005',
		icon:'/Public/Index/css/images/0044.png'
	},{
		menuid:'m006',
		name:'购物中心',
		code:'m006',
		icon:'/Public/Index/css/images/0055.png'
	}],
	app:{//桌面1
		'wdzl':{
			appid:'2534',
			icon:'0011.png',
			name:'我的资料',
			url:'',
			sonMenu:"[{"+
				"appid:'8858',"+
				"icon:'0066.png',"+
				"name:'会员信息',"+
				"url:'/index.php/Home/Member/member'"+
			"},{"+
				"'appid':'8856',"+
				"'icon':'0077.png',"+
				"'name':'修改资料',"+
				"'url':'/index.php/Home/Member/membersave'"+
			"},{"+
				"appid:'0011',"+
				"icon:'0088.png',"+
				"name:'修改登陆密码',"+
				"url:'/index.php/Home/Member/updatepassword'"+
			// "},{"+
			// 	"appid:'0011',"+
			// 	"icon:'00999.png',"+
			// 	"name:'会员升级',"+
			// 	"url:'/index.php/Home/Member/upgrade'"+
			"}]",
			asc :1
		},
		'tgdt':{
			appid:'42',
			icon:'0022.png',
			name:'推广大厅',
			url:'',
			sonMenu:"[{"+
				"'appid':'10010',"+
				"'icon':'0023.png',"+
				"'name':'我的团队',"+
				"'enname':'fastsearch',"+
				"'url':'/index.php/Home/Member/team',"+
			"},{"+
				"appid:'10011',"+
				"icon:'0088.png',"+
				"enname:'doudizhu',"+
				"name:'注册会员',"+
				"url:'/index.php/Home/Member/useradd',"+
			"},{"+
				"appid:'10012',"+
				"icon:'0025.png',"+
				"enname:'doudizhu',"+
				"name:'我的直推',"+
				"url:'/index.php/Home/Member/Recommend',"+
			"},{"+
				"appid:'10013',"+
				"icon:'0026.png',"+
				"enname:'doudizhu',"+
				"name:'待激活报单',"+
				"url:'/index.php/Home/Member/user_activate',"+
			"}]",
			asc :2
		},
		'czdt':{
			appid:'8992',
			icon:'0033.png',
			name:'充值大厅',
			url:'',
			sonMenu:"[{"+
				"appid:'10015',"+
				"icon:'0034.png',"+
				"enname:'doudizhu',"+
				"name:'充值列表',"+
				"url:'/index.php/Home/Transaction/rechargelist',"+
			"},{"+
				"appid:'10015',"+
				"icon:'001010.png',"+
				"enname:'doudizhu',"+
				"name:'公告',"+
				"url:'/index.php/Home/Transaction/announcement',"+
			"}]",
			asc :3
		},
		'cwzx':{
			appid:'3402',
			icon:'0044.png',
			name:'财务中心',
			url:'',
			sonMenu:"[{"+
				"appid:'10021',"+
				"icon:'0046.png',"+
				"enname:'doudizhu',"+
				"name:'消费记录',"+
				"url:'/index.php/Home/Transaction/xiaofei_credit',"+
			"},{"+
				"appid:'10021',"+
				"icon:'00471.png',"+
				"enname:'doudizhu',"+
				"name:'分红记录',"+
				"url:'/index.php/Home/Transaction/chaifen',"+
			"},{"+
				"appid:'10021',"+
				"icon:'00541.png',"+
				"enname:'doudizhu',"+
				"name:'转账记录',"+
				"url:'/index.php/Home/Transaction/yu_log',"+
			"},{"+
				"appid:'10021',"+
				"icon:'1214001.png',"+
				"enname:'doudizhu',"+
				"name:'奖金提现记录',"+
				"url:'/index.php/Home/Withdrawals/withdrawalslist',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0048.png',"+
				"enname:'doudizhu',"+
				"name:'每日收益',"+
				"url:'/index.php/Home/Transaction/bonusbd',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0054.png',"+
				"enname:'doudizhu',"+
				"name:'我的购物币',"+
				"url:'/index.php/Home/Transaction/gou_log',"+
			// "},{"+
			// 	"appid:'10021',"+
			// 	"icon:'00545.png',"+
			// 	"enname:'doudizhu',"+
			// 	"name:'我的量碰奖',"+
			// 	"url:'/index.php/Home/Transaction/liangpeng',"+
			// "},{"+
			// 	"appid:'10021',"+
			// 	"icon:'00546.png',"+
			// 	"enname:'doudizhu',"+
			// 	"name:'我的管理奖',"+
			// 	"url:'/index.php/Home/Transaction/manage',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0099.png',"+
				"enname:'doudizhu',"+
				"name:'推广奖金',"+
				"url:'/index.php/Home/Transaction/tj_log',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0050.png',"+
				"enname:'doudizhu',"+
				"name:'报单提成',"+
				"url:'/index.php/Home/Transaction/baodan_log',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0049.png',"+
				"enname:'doudizhu',"+
				"name:'转账',"+
				"url:'/index.php/Home/Transaction/gouwu',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0051.png',"+
				"enname:'doudizhu',"+
				"name:'激活币转账',"+
				"url:'/index.php/Home/Transaction/activate_zz',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0052.png',"+
				"enname:'doudizhu',"+
				"name:'奖金兑换激活币',"+
				"url:'/index.php/Home/Transaction/zhbonus',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0053.png',"+
				"enname:'doudizhu',"+
				"name:'积分转换',"+
				"url:'/index.php/Home/Transaction/balancebds',"+
			"},{"+
				"appid:'10019',"+
				"icon:'0045.png',"+
				"enname:'doudizhu',"+
				"name:'奖金提现',"+
				"url:'/index.php/Home/Withdrawals/bonuswithdrawals',"+
			"}]",

			asc :4
		},
		'gwzx':{
			appid:'18',
			icon:'0055.png',
			name:'购物中心',
			url:'',
			sonMenu:"[{"+
				"appid:'10022',"+
				"icon:'0056.png',"+
				"enname:'doudizhu',"+
				"name:'购物商城',"+
				"url:'/index.php/Home/Goods/goodslist',"+
			"},{"+
				"appid:'10023',"+
				"icon:'0057.png',"+
				"enname:'doudizhu',"+
				"name:'我的订单',"+
				"url:'/index.php/Home/Goods/orderlist',"+
			"}]",
			asc:5
		},
		'tcdl':{
			appid:'19',
			icon:'tc.png',
			name:'退出登录',
			url:'/index.php/Home/Login/logout',
			sonMenu:"[]",
			asc:6
		},
		'grxx':{
			appid:'2527',
			icon:'0066.png',
			name:'会员信息',
			url:'/index.php/Home/Member/member',
			sonMenu:"[]",
			asc :2
		},
		'xgzl':{
			appid:'3401',
			icon:'0077.png',
			name:'修改资料',
			url:'/index.php/Home/Member/membersave',
			sonMenu:"[]",
			asc :2
		},
		'xgdlmm':{
			appid:'2527',
			icon:'0088.png',
			name:'修改登陆密码',
			url:'/index.php/Home/Member/updatepassword',
			sonMenu:"[]",
			asc :2
		},
		'wdtd':{
			appid:'21',
			icon:'0023.png',
			name:'我的团队',
			url:'/index.php/Home/Member/team',
			sonMenu:"[]",
			asc :1
		},
		'zchy':{
			appid:'31',
			icon:'0100.png',
			name:'注册会员',
			url:'/index.php/Home/Member/useradd',
			sonMenu:"[]",
			asc :2
		},
		'wdzt':{
			appid:'32',
			icon:'0025.png',
			name:'我的直推',
			url:'/index.php/Home/Member/Recommend',
			sonMenu:"[]",
			asc :3
		},
		'yecz':{
			appid:'2535',
			icon:'0033.png',
			name:'余额充值',
			url:'/index.php/Home/Transaction/recharge',
			sonMenu:"[]",
			asc :5
		},
		'czlb':{
			appid:'2528',
			icon:'0034.png',
			name:'充值列表',
			url:'/index.php/Home/Transaction/rechargelist',
			sonMenu:"[]",
			asc :1
		},
		'yedh':{
			appid:'45',
			icon:'0033.png',
			name:'余额兑换',
			url:'/index.php/Transaction/balancebd',
			sonMenu:"[]",
			asc :2
		},
		'jjdh':{
			appid:'2526',
			icon:'0048.png',
			name:'奖金兑换',
			url:'/index.php/Home/Transaction/bonusbd',
			sonMenu:"[]",
			asc :3
		},
		'yetx':{
			appid:'56',
			icon:'0033.png',
			name:'余额提现',
			url:'/index.php/Home/Withdrawals/withdrawals',
			sonMenu:"[]",
			asc :4
		},
		// 'jjtx':{
		// 	appid:'15',
		// 	icon:'0099.png',
		// 	name:'',
		// 	url:'/index.php/Home/Withdrawals/bonuswithdrawals',
		// 	sonMenu:"[]",
		// 	asc :5
		// },
		'txlb':{
			appid:'3148',
			icon:'0120.png',
			name:'提现列表',
			url:'/index.php/Home/Withdrawals/withdrawalslist',
			sonMenu:"[]",
			asc :6
		},
		'gwsc':{
			appid:'48',
			icon:'0110.png',
			name:'购物商城',
			url:'/index.php/Home/Goods/goodslist',
			sonMenu:"[]",
			asc :1
		},'bdsc':{
			// appid:'48',
			// icon:'0055.png',
			// name:'报单商城',
			// url:'/Home/Decgoods/goodslist',
			// sonMenu:"[]",
			// asc :1
		},
		'wddd':{
			appid:'49',
			icon:'0057.png',
			name:'我的订单',
			url:'/index.php/Home/Goods/orderlist',
			sonMenu:"[]",
			asc :2
		},
		'bddd':{
			// appid:'49',
			// icon:'0055.png',
			// name:'报单订单',
			// url:'/Home/Decgoods/orderlist',
			// sonMenu:"[]",
			// asc :2
		}
	},
	sApp:{//侧边栏应用
		'appmarket':{
			appid:'1',
			icon:'',
			name:'退出登录',
			url:'/index.php/Home/Login/logout',
			sonMenu:"[]",
			asc :1
		}
	
	}
};
ops = {//向桌面添加应用
	Icon1:['wdzl','tgdt','czdt','cwzx','gwzx','tcdl'],
	Icon2:['grxx','xgzl','xgdlmm'],
	Icon3:['wdtd','zchy','wdzt'],
	Icon4:['czlb'],
	Icon5:['jjdh','txlb'],
	Icon6:['gwsc',	'wddd']
	
}
//初始化左边快捷菜单
var leftMenu = new Array(['appmarket']);


