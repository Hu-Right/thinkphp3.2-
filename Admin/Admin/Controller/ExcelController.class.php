<?php
namespace Admin\Controller;
use Admin\Controller\IndexController;
class ExcelController extends IndexController
{
    
   function index($info,$times)
	{
		
		vendor('PHPExcel.PHPExcel');
		$objPHPExcel=new \PHPExcel();
		$objSheet=$objPHPExcel->getActiveSheet();
		$objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getDefaultStyle()->getFont()->setSize(12)->setName("微软雅黑");
		$objSheet->getStyle("A1:H1")->getFont()->setSize(14)->setBold(true);
		$objSheet->getStyle("A1:H1")->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_WHITE);
		$objSheet->getColumnDimension("A")->setAutoSize(true);
		$objSheet->getColumnDimension("G")->setAutoSize(true);
		$objSheet->getColumnDimension("H")->setAutoSize(true);
		$objSheet->getRowDimension(1)->setRowHeight(50);
		$objSheet->getStyle("A1:H1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3c8dbc');
		$objSheet->setTitle("财务记录统计");
		$objSheet->setCellValue("A1","ID")->setCellValue("B1","货币类型")->setCellValue("C1","会员登录ID")->setCellValue("D1","说明")->setCellValue("E1","类型")->setCellValue("F1","金额")->setCellValue("G1","时间")->setCellValue("H1","奖励币种");
		$k =2;
		foreach($info as $key=>$val)
		{
			if(strpos($val['nickname'],'=')=== 0)
			{
				$val['nickname'] ="'".$val['nickname'];
			}
			$objSheet->setCellValue("A".$k,' '.$val['id'])->setCellValue("B".$k,'电子币')->setCellValueExplicit("C".$k,$val['email'], \PHPExcel_Cell_DataType::TYPE_STRING)->setCellValue("D".$k,' '.$val['info'])->setCellValue("E".$k,$val['income'])->setCellValue("F".$k,$val['money'])->setCellValue("G".$k,$val['time'])->setCellValueExplicit("H".$k, $val['type'], \PHPExcel_Cell_DataType::TYPE_STRING);
			$k++;
		}
		$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$this->browser_export('Excel','财务记录统计'.$times.'.xls');
		$objWriter->save("php://output");
	}

	function indexs($info,$times)
	{
		
		vendor('PHPExcel.PHPExcel');
		$objPHPExcel=new \PHPExcel();
		$objSheet=$objPHPExcel->getActiveSheet();
		$objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getDefaultStyle()->getFont()->setSize(12)->setName("微软雅黑");
		$objSheet->getStyle("A1:H1")->getFont()->setSize(14)->setBold(true);
		$objSheet->getStyle("A1:H1")->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_WHITE);
		$objSheet->getStyle('C')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$objSheet->getStyle('H')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$objSheet->getColumnDimension("A")->setAutoSize(true);
		$objSheet->getColumnDimension("G")->setAutoSize(true);
		$objSheet->getColumnDimension("H")->setAutoSize(true);
		$objSheet->getRowDimension(1)->setRowHeight(50);
		$objSheet->getStyle("A1:H1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3c8dbc');
		$objSheet->setTitle("提现记录统计");
		$objSheet->setCellValue("A1","提现人账号")->setCellValue("B1","提现方式")->setCellValue("C1","提现账号")->setCellValue("D1","提现人姓名")->setCellValue("E1","金额")->setCellValue("F1","留言")->setCellValue("G1","时间");
		$k =2;
		foreach($info as $key=>$val)
		{
			if(strpos($val['nickname'],'=')=== 0)
			{
				$val['nickname'] ="'".$val['nickname'];
			}
			$objSheet->setCellValue("A".$k,$val['email'])->setCellValue("B".$k,$val['mode'])->setCellValueExplicit("C".$k,$val['email'], \PHPExcel_Cell_DataType::TYPE_STRING)->setCellValue("D".$k,' '.$val['name'])->setCellValue("E".$k,$val['money'])->setCellValue("F".$k,$val['info'])->setCellValue("G".$k,$val['time']);
			$k++;
		}
		$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$this->browser_export('Excel','提现记录统计'.$times.'.xls');
		$objWriter->save("php://output");
	}

	function detail($info,$username)
	{
		import("Org.Util.PHPExcel");
		import('Org.Util.PHPExcel.Writer.Excel5');
		import('Org.Util.PHPExcel.IOFactory.php');
		$objPHPExcel=new \PHPExcel();
		$objSheet=$objPHPExcel->getActiveSheet();
		$objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getDefaultStyle()->getFont()->setSize(10)->setName("微软雅黑");
		$objSheet->getStyle("A1:H1")->getFont()->setSize(12)->setBold(true);
		$objSheet->getStyle("A1:H1")->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_WHITE);
		$objSheet->getColumnDimension("D")->setAutoSize(true);
		$objSheet->getColumnDimension("E")->setAutoSize(true);
		$objSheet->getColumnDimension("G")->setAutoSize(true);
		$objSheet->getColumnDimension("C")->setWidth(300);
		$objSheet->getDefaultRowDimension()->setRowHeight(25);
		$objSheet->getRowDimension(1)->setRowHeight(50);
		$objSheet->getStyle("A1:H1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3c8dbc');
		$objSheet->setTitle("订单表");
		$objSheet->setCellValue("A1","订单编号")->setCellValue("B1","订单金额")->setCellValue("C1","商品名称")->setCellValue("D1","用户名字")->setCellValue("E1","收货人")->setCellValue("F1","联系方式")->setCellValue("G1","收货地址")->setCellValue("H1","下单时间");
		$k =2;
		foreach($info as $key=>$val)
		{
			$objSheet->setCellValue("A".$k,$val['order_sn'])->setCellValue("B".$k,$val['total_fee'])->setCellValue("C".$k,$val['pay_more'])->setCellValue("D".$k,$val['user_id']."、".$val['username'])->setCellValue("E".$k,$val['address']['username'])->setCellValue("F".$k,$val['address']['telphone'])->setCellValue("G".$k,$val['address']['address'])->setCellValue("H".$k,$val['time']);
			$k++;
		}
		$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$this->browser_export('Excel5',$username.'订单统计.xls');
		$objWriter->save("php://output");
	}




	function chongzhi($info)
	{
		import("Org.Util.PHPExcel");
		import('Org.Util.PHPExcel.Writer.Excel5');
		import('Org.Util.PHPExcel.IOFactory.php');
		\PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;
		$objPHPExcel=new \PHPExcel();
		$objSheet=$objPHPExcel->getActiveSheet();
		$objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getDefaultStyle()->getFont()->setSize(12)->setName("微软雅黑");
		$objSheet->getStyle("A1:E1")->getFont()->setSize(14)->setBold(true);
		$objSheet->getStyle("A1:E1")->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_WHITE);
		
		$objSheet->getColumnDimension("A")->setAutoSize(true);
		$objSheet->getColumnDimension("E")->setAutoSize(true);
		$objSheet->getRowDimension(1)->setRowHeight(50);
		$objSheet->getStyle("A1:E1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3c8dbc');
		$objSheet->setTitle("充值记录统计");
		$objSheet->setCellValue("A1","会员名称")->setCellValue("B1","会员ID")->setCellValue("C1","充值金额")->setCellValue("D1","操作员ID")->setCellValue("E1","充值时间");
		$k =2;
		foreach($info as $key=>$val)
		{
			if(strpos($val['nickname'],'=')=== 0)
			{
				$val['nickname'] ="'".$val['nickname'];
			}
			$objSheet->setCellValue("A".$k,' '.$val['nickname'])->setCellValue("B".$k,$val['user_id'])->setCellValue("C".$k,$val['money'])->setCellValue("D".$k,' '.$val['admin_id'])->setCellValue("E".$k,$val['time']);
			$k++;
		}
		$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$this->browser_export('Excel','充值记录统计.xls');
		$objWriter->save("php://output");
	}





	function broke($info)
	{
		import("Org.Util.PHPExcel");
		import('Org.Util.PHPExcel.Writer.Excel5');
		import('Org.Util.PHPExcel.IOFactory.php');
		\PHPExcel_CachedObjectStorageFactory::cache_in_memory_serialized;
		$objPHPExcel=new \PHPExcel();
		$objSheet=$objPHPExcel->getActiveSheet();
		$objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getDefaultStyle()->getFont()->setSize(12)->setName("微软雅黑");
		$objSheet->getStyle("A1:H1")->getFont()->setSize(14)->setBold(true);
		$objSheet->getStyle("A1:H1")->getFont()->getColor()->setARGB(\PHPExcel_Style_Color::COLOR_WHITE);
		
		$objSheet->getColumnDimension("B")->setAutoSize(true);
		$objSheet->getColumnDimension("C")->setAutoSize(true);
		$objSheet->getColumnDimension("D")->setAutoSize(true);
		$objSheet->getColumnDimension("E")->setAutoSize(true);
		$objSheet->getColumnDimension("F")->setAutoSize(true);
		$objSheet->getColumnDimension("G")->setAutoSize(true);
		$objSheet->getRowDimension(1)->setRowHeight(50);
		$objSheet->getStyle("A1:G1")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('3c8dbc');
		$objSheet->setTitle("提现记录统计");
		$objSheet->setCellValue("A1","序号")->setCellValue("B1","收款银行账户")->setCellValue("C1","开户名")->setCellValue("D1","开户行名称")->setCellValue("E1","提现支付宝账号")->setCellValue("F1","提现支付宝姓名")->setCellValue("G1","转账金额")->setCellValue("H1","联系方式");
		$k =2;
		foreach($info as $key=>$val)
		{
			if(strpos($val['nickname'],'=')=== 0)
			{
				$val['nickname'] ="'".$val['nickname'];
			}
			$objSheet->setCellValue("A".$k,' '.$val['id'])->setCellValue("B".$k,' '.$val['banknumber'] )->setCellValue("C".$k,$val['bankuse'])->setCellValue("D".$k,' '.$val['bankname'])->setCellValue("E".$k,$val['alipay'])->setCellValue("F".$k,$val['alipayname'])->setCellValue("G".$k,$val['fee'])->setCellValue("G".$k,$val['mobile']);
			$k++;
		}
		$objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$this->browser_export('Excel','提现记录统计.xls');
		$objWriter->save("php://output");
	}







	function browser_export($type,$filename)
	{
		if($type=="Excel5")
		{
			header('Content-Type: application/vnd.ms-excel');
		}
		else
		{
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		}
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
	}


}
?>