<?php 

require "simple_html_dom.php";
		$get = file_get_html("https://thongkenhadat.com/ban-dat-nen-du-an-fpt-city-da-nang-34907/nhan-dat-cho-ck-den-6-khu-ven-song-co-co-thuoc-da-nang-100-200m2-ngan-6m.html");

		// $seller = $get->find("div.section-item-new",1)->find("div.panel-detail-info div.ul-info div.row-line",0)->plaintext;
		// $seller1 = str_replace("Tên liên lạc", "", $seller);


		$address = $get->find("div.section-item-new",1)->find("div.panel-detail-info div.ul-info div.row-line",1)->plaintext; 
		echo $address1 = str_replace('Địa chỉ', '', $address); echo "<br />";

		$phone = $get->find("div.section-item-new",1)->find("div.panel-detail-info div.ul-info div.row-line",2)->plaintext; echo "<br />";
		echo $phone1 = str_replace(array('Di động ','Điện thoại '), array('',''), $phone);

		// $area3=53;
		
		// $price = $get->find("p.div-price-in span",0)->innertext;

		// $price1 = str_replace(array('Giá: ','<span>','</span>','/m²',' Tỷ'),array('','','','/m2',' '),$price);
		// if($price1 == "Thỏa thuận"){
		// 	echo $price6 = $price1;
		// }else {
		// 	$price2 = strrev($price1);

		// 	if(substr($price2, 0, 1) == ' '){
		// 	 	$price3 = $price1." Tỷ VNĐ";
		// 	 	echo $price6 = str_replace('.',',',$price3);
		// 	}else if(substr($price2, 0, 1) == 'u'){
		// 	 	$price3 = $price1." VNĐ";
		// 	 	echo $price6 = str_replace('.',',',$price3);
		// 	}else if(substr($price2, 0, 1) == 'g'){
		// 	 	echo $price6 = str_replace(' Triệu/tháng', ' Triệu VNĐ', $price1);
		// 	}else if(substr($price2, 0, 1) == '2'){
		// 	 	$price3 = str_replace(' Triệu/m2', '000000', $price1);
		// 	 	$price4 = str_replace('.','',$price3);
		// 	 	$price5 = $price4 * $area3;
		// 		if(strlen($price5)>6 and strlen($price5)<10){
		// 			$a = $price5 / 1000000;
		// 			$a1 = str_replace('.',',',$a);
		// 			echo $price6 = $a1." Triệu VNĐ";
		// 		}

		// 		if(strlen($price5)>9){
		// 			$b = $price5 / 1000000000;
		// 			$b1 = str_replace('.',',',$b);
		// 			echo $price6 = $b1." Tỷ VNĐ";
		// 		}
		// 	}		
		// }
		
?>