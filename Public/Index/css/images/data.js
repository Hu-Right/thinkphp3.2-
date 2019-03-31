﻿DATA={
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
				"icon:'0011.png',"+
				"name:'会员信息',"+
				"url:'/Home/Member/member'"+
			"},{"+
				"'appid':'8856',"+
				"'icon':'0011.png',"+
				"'name':'修改资料',"+
				"'url':'/Home/Member/membersave'"+
			"},{"+
				"appid:'0011',"+
				"icon:'0011.png',"+
				"name:'修改登陆密码',"+
				"url:'/Home/Member/updatepassword'"+
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
				"'icon':'0066.png',"+
				"'name':'我的团队',"+
				"'enname':'fastsearch',"+
				"'url':'/Home/Member/team',"+
			"},{"+
				"appid:'10011',"+
				"icon:'0066.png',"+
				"enname:'doudizhu',"+
				"name:'注册会员',"+
				"url:'/Home/Member/useradd',"+
			"},{"+
				"appid:'10012',"+
				"icon:'0066.png',"+
				"enname:'doudizhu',"+
				"name:'我的直推',"+
				"url:'/Home/Member/Recommend',"+
			"}]",
			asc :2
		},
		'czdt':{
			appid:'8992',
			icon:'0033.png',
			name:'充值大厅',
			url:'',
			sonMenu:"[{"+
				"appid:'10014',"+
				"icon:'0033.png',"+
				"enname:'doudizhu',"+
				"name:'余额充值',"+
				"url:'/Home/Transaction/recharge',"+
			"},{"+
				"appid:'10015',"+
				"icon:'0033.png',"+
				"enname:'doudizhu',"+
				"name:'充值列表',"+
				"url:'/Home/Transaction/rechargelist',"+
			"}]",
			asc :3
		},
		'cwzx':{
			appid:'3402',
			icon:'0044.png',
			name:'财务中心',
			url:'',
			sonMenu:"[{"+
				"appid:'10016',"+
				"icon:'0044.png',"+
				"enname:'doudizhu',"+
				"name:'余额兑换',"+
				"url:'/Home/Transaction/balancebd',"+
			"},{"+
				"appid:'10017',"+
				"icon:'0044.png',"+
				"enname:'doudizhu',"+
				"name:'奖金兑换',"+
				"url:'/Home/Transaction/bonusbd',"+
			"},{"+
				"appid:'10018',"+
				"icon:'0044.png',"+
				"enname:'doudizhu',"+
				"name:'余额提现',"+
				"url:'/Home/Withdrawals/withdrawals',"+
			"},{"+
				"appid:'10019',"+
				"icon:'0044.png',"+
				"enname:'doudizhu',"+
				"name:'奖金提现',"+
				"url:'/Home/Withdrawals/bonuswithdrawals',"+
			"},{"+
				"appid:'10020',"+
				"icon:'0044.png',"+
				"enname:'doudizhu',"+
				"name:'提现列表',"+
				"url:'/Home/Withdrawals/withdrawalslist',"+
			"},{"+
				"appid:'10021',"+
				"icon:'0044.png',"+
				"enname:'doudizhu',"+
				"name:'财务记录',"+
				"url:'/Home/Transaction/financelist',"+
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
				"icon:'0055.png',"+
				"enname:'doudizhu',"+
				"name:'购物商城',"+
				"url:'/Home/Goods/goodslist',"+
			"},{"+
				"appid:'10023',"+
				"icon:'0055.png',"+
				"enname:'doudizhu',"+
				"name:'我的订单',"+
				"url:'/Home/Goods/orderlist',"+
			"},{"+
				"appid:'10025',"+
				"icon:'0055.png',"+
				"enname:'doudizhu',"+
				"name:'报单订单',"+
				"url:'/Home/Decgoods/orderlist',"+
			"}]",
			asc:5
		},
		'grxx':{
			appid:'2527',
			icon:'0066.png',
			name:'会员信息',
			url:'/Home/Member/member',
			sonMenu:"[]",
			asc :2
		},
		'xgzl':{
			appid:'3401',
			icon:'0077.png',
			name:'修改资料',
			url:'/Home/Member/membersave',
			sonMenu:"[]",
			asc :2
		},
		'xgdlmm':{
			appid:'2527',
			icon:'0088.png',
			name:'修改登陆密码',
			url:'/Home/Member/updatepassword',
			sonMenu:"[]",
			asc :2
		},
		'wdtd':{
			appid:'21',
			icon:'0022.png',
			name:'我的团队',
			url:'/Home/Member/team',
			sonMenu:"[]",
			asc :1
		},
		'zchy':{
			appid:'31',
			icon:'0088.png',
			name:'注册会员',
			url:'/Home/Member/useradd',
			sonMenu:"[]",
			asc :2
		},
		'wdzt':{
			appid:'32',
			icon:'0022.png',
			name:'我的直推',
			url:'/Home/Member/Recommend',
			sonMenu:"[]",
			asc :3
		},
		'yecz':{
			appid:'2535',
			icon:'0033.png',
			name:'余额充值',
			url:'/Home/Transaction/recharge',
			sonMenu:"[]",
			asc :5
		},
		'czlb':{
			appid:'2528',
			icon:'0033.png',
			name:'充值列表',
			url:'/Home/Transaction/rechargelist',
			sonMenu:"[]",
			asc :1
		},
		'yedh':{
			appid:'45',
			icon:'0033.png',
			name:'余额兑换',
			url:'/Home/Transaction/balancebd',
			sonMenu:"[]",
			asc :2
		},
		'jjdh':{
			appid:'2526',
			icon:'0033.png',
			name:'奖金兑换',
			url:'/Home/Transaction/bonusbd',
			sonMenu:"[]",
			asc :3
		},
		'yetx':{
			appid:'56',
			icon:'0033.png',
			name:'余额提现',
			url:'/Home/Withdrawals/withdrawals',
			sonMenu:"[]",
			asc :4
		},
		'jjtx':{
			appid:'15',
			icon:'0033.png',
			name:'奖金提现',
			url:'/Home/Withdrawals/bonuswithdrawals',
			sonMenu:"[]",
			asc :5
		},
		'txlb':{
			appid:'3148',
			icon:'0033.png',
			name:'提现列表',
			url:'/Home/Withdrawals/withdrawalslist',
			sonMenu:"[]",
			asc :6
		},
		'cwjl':{
			appid:'3149',
			icon:'0044.png',
			name:'财务记录',
			url:'/Home/Transaction/financelist',
			sonMenu:"[]",
			asc :6
		},
		'gwsc':{
			appid:'48',
			icon:'0055.png',
			name:'购物商城',
			url:'/Home/Goods/goodslist',
			sonMenu:"[]",
			asc :1
		},'bdsc':{
			appid:'48',
			icon:'0055.png',
			name:'报单商城',
			url:'/Home/Decgoods/goodslist',
			sonMenu:"[]",
			asc :1
		},
		'wddd':{
			appid:'49',
			icon:'0055.png',
			name:'我的订单',
			url:'/Home/Goods/orderlist',
			sonMenu:"[]",
			asc :2
		},
		'bddd':{
			appid:'49',
			icon:'0055.png',
			name:'报单订单',
			url:'/Home/Decgoods/orderlist',
			sonMenu:"[]",
			asc :2
		}
	},
	sApp:{//侧边栏应用
		'appmarket':{
			appid:'1',
			icon:'appmarket.png',
			name:'应用市场',
			url:'http://www.juheweb.com/',
			sonMenu:"[]",
			asc :1
		},
		'qq':{
			appid:'2',
			icon:'big.png',
			name:'QQ',
			url:'http://www.juheweb.com/',
			sonMenu:"[]",
			asc :2
		},
		'weibo':{
			appid:'3',
			icon:'weibo.png',
			name:'微博',
			url:'http://www.juheweb.com/',
			sonMenu:"[]",
			asc :3
		},
		'mail':{
			appid:'4',
			icon:'mail.png',			
			name:'邮箱',
			url:'http://www.juheweb.com/',
			sonMenu:"[]",
			asc :4
		},
		'zone':{
			appid:'5',
			icon:'zone.png',
			name:'空间',
			url:'http://www.juheweb.com/',
			sonMenu:"[]",
			asc :5
		},
		'internet':{
			appid:'6',
			icon:'internet.png',
			name:'浏览网页',
			url:'http://www.juheweb.com/',
			sonMenu:"[]",
			asc :6
		}
	
	}
};
ops = {//向桌面添加应用
	Icon1:['wdzl','tgdt','czdt','cwzx','gwzx'],
	Icon2:['grxx','xgzl','xgdlmm'],
	Icon3:['wdtd','zchy','wdzt'],
	Icon4:['yecz','czlb'],
	Icon5:['yedh',	'jjdh',	'yetx','jjtx','txlb','cwjl'],
	Icon6:['gwsc','bdsc',	'wddd','bddd']
	
}
//初始化左边快捷菜单
var leftMenu = new Array(['appmarket','qq','weibo','mail','internet','zone']);

