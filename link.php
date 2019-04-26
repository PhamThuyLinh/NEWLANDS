<?php
require "dbCon.php";
require "simple_html_dom.php";

		$get = file_get_html("https://kenhbds.vn/can-ban/nha-dat/ban-dat-nen-duong-dang-thai-than-gan-son-thuy-quan-ngu-hanh-son-da-nang/708563.html");

		$area3 ="5";

		$price = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",5)->innertext;
		$price1 = str_replace('<span>Giá: </span>','',$price);
		if($price1 == "Thỏa thuận "){
			echo $price6 = $price1;

		}else{
			$price2 = strrev($price1);
			if(substr($price2, 0, 1) == 'h'){
			 	$price3 = str_replace(' VNĐ/Diện tích', '', $price1);
			 	$price5 = str_replace('.','',$price3);
			}

			if(substr($price2, 0, 1) == '2'){
			 	$price3 = str_replace(' VNĐ/m2', '', $price1);
			 	$price4 = str_replace('.','',$price3);
			 	$price5 = $price4 * $area3;
			}
			
			//$price6 = $price5." VNĐ";
			//$price7 = strrev($price5);

			// if(substr($price7, 0, 6) == '000000'){
			// 	echo $price8 =  str_replace('000000 VNĐ', ' Triệu VNĐ', $price6);
			// }

			if(strlen($price5)>6 and strlen($price5)<10){
				$a = $price5 / 1000000;
				$a1 = str_replace('.',',',$a);
				echo $a2 = $a1."  Triệu VNĐ";
			}

			if(strlen($price5)>9){
				$b = $price5 / 1000000000;
				$b1 = str_replace('.',',',$b);
				echo $b2 = $b1."  Tỷ VNĐ";
			}
		}

		










//kenhbds.vn okay
//http://nhadatbactrungnam.com/   okay

//https://muaban.net/ ko lay anh dc
//https://batdongsan.com.vn/	ko lay dc
//https://alonhadat.com.vn/ ko lay dc anh
//https://datxanhdanang.com.vn/ ko lay dc
//vietnamnet ko lay dc
//nhadat24h.net ko lay dc
//kenhdat.com meo dc :|
//https://homedy.com/ban-dat ko lay anh dc
//muabanraovat.com ko dc
//https://danahouse.vn/ NO

// $chuoi='';
// for ($i=1; $i < 20; $i++) { 
// 	$d = $get->find("div#sevenBoxNewContentInfo p",$i)->find("span",0);
// 	$chuoi = $chuoi.$d."<br />";
// }
// echo $detail= $detail1.$chuoi;





//echo $detail = $html->find("div.row div.description-area div.col-xs-12 div.box-description",0)->innertext;
// foreach ($tins as $t) {
// 	echo $title = $t->innertext;
// 	echo "<hr />";
// 	$title = htmlentities($title, ENT_QUOTES, "UTF-8");
// 	$qr ="INSERT INTO district(name) VALUES('$title')";
// 	$ketqua = $mysqli->query($qr);
// 	if($ketqua){
// 		$sel_qr = 'SELECT * from district';
// 		$sel_res = $mysqli->query($sel_qr);
// 		while($ar = $sel_res->fetch_assoc()){
// 			$id = $ar['id'];
// 			$title = $ar['name'];
// 			echo $title;
// 		}
// 	}
// 	if($mysqli->query($qr) == TRUE){
// 		echo "<br /> Thêm data thành công";
// 	}else{
// 		echo "Lỗi: ".$qr."<br />".$mysqli->error;
// 	}
// }
//

?>



<!-- https://kenhbds.vn/thong-tin/tin-tuc-su-kien -->