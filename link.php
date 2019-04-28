<?php
require "dbCon.php";
require "simple_html_dom.php";

		$get = file_get_html("https://sieuthihomeland.com/category/dat-nen/page/2/");
echo $get;

//kenhbds.vn okay
//http://nhadatbactrungnam.com/   okay
//https://thongkenhadat.com/ban-dat-nen-du-an-da-nang-3.html okay
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