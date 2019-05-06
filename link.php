<?php
require "dbCon.php";
require "simple_html_dom.php";

		$get = file_get_html("https://thongkenhadat.com/ban-dat-da-nang-3.html");

		
		

		// echo $location = $get->find("p.span-info",0)->plaintext;
		// $location1 = str_replace('Vị trí: ', '', $location);
		// $district = strstr($location1,'-');
		// $district1 = str_replace(array('- ',' Đà Nẵng'), array('',''), $district);
		// echo "<br />";
		// $tai = strstr($location1,'tại');
		// echo $type = str_replace($tai, '', $location1);
		// echo "<br />";
		// echo $type1 = str_replace(array('Bán đất nền dự án','Bán đất thổ cư'), array('Đất loại khác','Đất thổ cư'), $type);

		// // echo $detail = $get->find("div.div-mota",0)->innertext;

		// // $area= $get->find("p.div-price-in span.span-3",0)->plaintext;

		// echo $area1 = str_replace(array('Diện tích: ','m2'), array('',' m²'), $area);
		// echo "<br />";
		// echo $area3 = str_replace('m²', '', $area1);

		// $price = $get->find("p.div-price-in span",0)->innertext;

		// $price1 = str_replace(array('Giá: ','<span>','</span>','/m²',' Tỷ'),array('','','','/m2',' '),$price);
		// if($price1 == "Thỏa thuận"){
		// 	echo $price6 = $price1;
		// }else{
		// 	$price2 = strrev($price1);

		// 	if(substr($price2, 0, 1) == ' '){
		// 	 	echo $price6 = $price1." Tỷ VNĐ";
		// 	}

		// 	if(substr($price2, 0, 1) == 'u'){
		// 	 	echo $price6 = $price1." VNĐ";
		// 	}

		// 	if(substr($price2, 0, 1) == 'g'){
		// 	 	$price6 = str_replace(' Triệu/tháng', ' Triệu VNĐ', $price1);
		// 	}

		// 	if(substr($price2, 0, 1) == '2'){
		// 	 	$price3 = str_replace(' Triệu/m2', '000000', $price1);
		// 	 	$price4 = str_replace('.','',$price3);
		// 	 	$price5 = $price4 * $area3;
		// 	}
			
		// 	if(strlen($price5)>6 and strlen($price5)<10){
		// 		$a = $price5 / 1000000;
		// 		$a1 = str_replace('.',',',$a);
		// 		$price6 = $a1." Triệu VNĐ";
		// 	}

		// 	if(strlen($price5)>9){
		// 		$b = $price5 / 1000000000;
		// 		$b1 = str_replace('.',',',$b);
		// 		$price6 = $b1." Tỷ VNĐ";
		// 	}
			
		// }

		// echo $title = $get->find("div.body-content div.body_left div.boc_bodyleft h1.span-title",0)->innertext;

		// echo $img = $get->find("img.img-responsive",2)->src;
		// echo "<img src='$img' />";


 $tins = $get->find("div.body-content div.body_left div.wrapper-news ul li ");
//  echo count($tins);
foreach ($tins as $t) {						
	echo $link = $t->find("a",0)->href;
	echo "<br />";
}

//kenhbds.vn okay
//http://nhadatbactrungnam.com/   okay
//https://thongkenhadat.com/ban-dat-nen-du-an-da-nang-3.html okay duyet
//https://sieuthihomeland.com/category/dat-nen/page/2/ okay

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
//http://minhtrungland.com/ ko lay dc

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