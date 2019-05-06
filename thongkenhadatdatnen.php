<?php
require "dbCon.php";
require "simple_html_dom.php";

$html = file_get_html("https://thongkenhadat.com/ban-dat-da-nang-3.html");

$tins = $html->find("div.body-content div.body_left div.wrapper-news ul li ");

set_time_limit(0);
//echo count($tins);
echo "<br />";

$query = "SELECT * From lands";
$result_query =  mysqli_query($mysqli, $query);

$arr1 = array();
while($arResult5 = mysqli_fetch_assoc($result_query)) {
	$arr1[] = $arResult5['link'];	
}		

$arr2 = array();
foreach ($tins as $t) {						

	echo $link = $t->find("a",0)->href;

	$arr2[] = $link;					
}

$LinksAdd =array_reverse(array_diff($arr2,$arr1));	

foreach($LinksAdd as $key=>$value) { 
	$qr = "INSERT INTO lands(link) VALUES ('$value')";

 	$result2 = mysqli_query($mysqli, $qr);

 	if($result2) {
 		$id = mysqli_insert_id($mysqli);
		$get = file_get_html($value);
	echo  $title = $get->find("div.body-content div.body_left div.boc_bodyleft h1.span-title",0)->innertext;


		$img = $get->find("img.img-responsive",2)->src;
		// echo "<img src='$img' />";
		$u = 'D:\workspace\.metadata\.plugins\org.eclipse.wst.server.core\tmp0\wtpwebapps\project_cland\files/'.basename($img);
		file_put_contents($u, file_get_contents($img));
		$tenFile = basename($img);

		$time = $get->find("div.section-item-new div.panel-detail-info div.ul-info",0)->plaintext;
		$time1 = strstr($time,'đăng');
		$time2 = strstr($time1,'hết');
		$time3 = str_replace(array('đăng tin ',' Ngày ',$time2,' '), array('','','',''), $time1);echo "<br />";
		$time4 = DateTime::createFromFormat('d/m/Y',$time3);
		$time5 = $time4->format('Y-m-d');
		// $desc = $get->find("div.contai div.container div.center3 div.box1 div.tit3 h1",0)->innertext;

		$area= $get->find("p.div-price-in span.span-3",0)->plaintext;
		$area2 = str_replace(array('Diện tích: ','m2'), array('',' m²'), $area);
		$area3 = str_replace('m²', '', $area2);

		
		$price = $get->find("p.div-price-in span",0)->innertext;

		$price1 = str_replace(array('Giá: ','<span>','</span>','/m²',' Tỷ'),array('','','','/m2',' '),$price);
		if($price1 == "Thỏa thuận"){
			echo $price6 = $price1;
		}else {
			$price2 = strrev($price1);

			if(substr($price2, 0, 1) == ' '){
			 	$price3 = $price1." Tỷ VNĐ";
			 	echo $price6 = str_replace('.',',',$price3);
			}else if(substr($price2, 0, 1) == 'u'){
			 	$price3 = $price1." VNĐ";
			 	echo $price6 = str_replace('.',',',$price3);
			}else if(substr($price2, 0, 1) == 'g'){
			 	echo $price6 = str_replace(' Triệu/tháng', ' Triệu VNĐ', $price1);
			}else if(substr($price2, 0, 1) == '2'){
			 	$price3 = str_replace(' Triệu/m2', '000000', $price1);
			 	$price4 = str_replace('.','',$price3);
			 	$price5 = $price4 * $area3;
				if(strlen($price5)>6 and strlen($price5)<10){
					$a = $price5 / 1000000;
					$a1 = str_replace('.',',',$a);
					echo $price6 = $a1." Triệu VNĐ";
				}

				if(strlen($price5)>9){
					$b = $price5 / 1000000000;
					$b1 = str_replace('.',',',$b);
					echo $price6 = $b1." Tỷ VNĐ";
				}
			}		
		}

		$location = $get->find("p.span-info",0)->plaintext;
		$location1 = str_replace('Vị trí: ', '', $location);
		$district = strstr($location1,'-');
		$district2 = str_replace(array('- ',' Đà Nẵng'), array('',''), $district);
		
		$tai = strstr($location1,'tại');
		$type = str_replace($tai, '', $location1);
		$type1 = str_replace(array('Bán đất nền dự án','Bán đất thổ cư'), array('Đất loại khác','Đất thổ cư'), $type);

		$detail = $get->find("div.div-mota",0)->innertext;

		$seller = $get->find("div.section-item-new",1)->find("div.panel-detail-info div.ul-info div.row-line",0)->plaintext;
		$seller1 = str_replace("Tên liên lạc", "", $seller);


		$address = $get->find("div.section-item-new",1)->find("div.panel-detail-info div.ul-info div.row-line",1)->plaintext; 
		$address1 = str_replace("Địa chỉ", "", $address);

		$phone = $get->find("div.section-item-new",1)->find("div.panel-detail-info div.ul-info div.row-line",2)->plaintext; echo "<br />";
		$phone1 = str_replace(array("Di động ","Điện thoại "), array("",""), $phone);

		
		$update1 = "INSERT INTO sellers(name, phone, address) VALUES ('$seller1', '$phone1','$address1')";
		$result124 = mysqli_query($mysqli, $update1);

		if($result124) {
			echo $idc = mysqli_insert_id($mysqli);


			$update = "UPDATE lands set title = '$title', description='$title',price='$price6',image ='$tenFile', create_day='$time5', area='$area2', location='$location1',district='$district2', type='$type1' ,detail ='$detail', id_contact='$idc' where id='$id'";

			$result123 = mysqli_query($mysqli, $update);

			if($result123){
				$qr1 ="UPDATE lands set id_district = case district 
			 	when 'Cẩm Lệ' then 1 
			 	when 'Hải Châu' then 2
			 	when 'Ngũ Hành Sơn' then 3
			 	when 'Sơn Trà' then 4
			 	when 'Thanh Khê' then 5
			 	when 'Liên Chiểu' then 6
			 	when 'Hòa Vang' then 7
			 	when 'Huyện đảo Hoàng Sa' then 8
			 	else id_district
			 	end
			 	where district IN('Cẩm Lệ','Hải Châu','Ngũ Hành Sơn','Sơn Trà','Thanh Khê','Liên Chiểu','Hòa Vang','Huyện đảo Hoàng Sa')";
			 	$resultqr1 = mysqli_query($mysqli, $qr1);

			 	$qr2 = "UPDATE lands set id_cat = case type
			 	when 'Đất thổ cư' then 1
			 	when 'Đất nông nghiệp' then 2
			 	when 'Đất công nghiệp' then 3
			 	when 'Đất loại khác' then 4
			 	else id_cat
			 	end 
			 	where type IN('Đất thổ cư','Đất nông nghiệp', 'Đất công nghiệp','Đất loại khác')";
			 	$resultqr2 = mysqli_query($mysqli, $qr2);
			}
		}
	}
}

?>