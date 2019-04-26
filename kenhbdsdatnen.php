<?php 
require "dbCon.php";
require "simple_html_dom.php";

$html = file_get_html("http://kenhbds.vn/can-ban/dat-nen-dat-tho-cu-l7/da-nang-t15");

$tins = $html->find("div.contai div.container div.left_cont div.center div.box1 div.tt_dong1");

set_time_limit(0);
echo count($tins);
echo "<br />";

$query = "SELECT * From lands";
$result_query =  mysqli_query($mysqli, $query);

$arr1 = array();
while($arResult5 = mysqli_fetch_assoc($result_query)) {
	$arr1[] = $arResult5['link'];	
}		

$arr2 = array();
foreach ($tins as $t) {						

	echo $link = $t->find("div a.tooltip",0)->href;

	$arr2[] = $link;					
}

$LinksAdd =array_reverse(array_diff($arr2,$arr1));	

foreach($LinksAdd as $key=>$value) { 
	$qr = "INSERT INTO lands(link) VALUES ('$value')";

 	$result2 = mysqli_query($mysqli, $qr);

 	if($result2) {
 		$id = mysqli_insert_id($mysqli);
		$get = file_get_html($value);

		echo $title = $get->find("div.contai div.container div.center3 div.box1 div.tit3 h1",0)->innertext;

		

		$img = $get->find("div.c3_img ul li img",0)->src;
		// echo "<img src='$img' />";
		$u = 'D:\workspace\.metadata\.plugins\org.eclipse.wst.server.core\tmp0\wtpwebapps\project_cland\files/'.basename($img);
		file_put_contents($u, file_get_contents($img));
		$tenFile = basename($img);

		$time = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",1)->innertext;
		$time1 = str_replace('<span>Ngày đăng tin: </span>', '', $time);
		$time2 = DateTime::createFromFormat('d/m/Y',$time1);
		$time3 = $time2->format('Y-m-d');

		$desc = $get->find("div.contai div.container div.center3 div.box1 div.tit3 h1",0)->innertext;

		$area = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",4)->innertext;
		$area1 = str_replace('<span>Diện tích: </span>','',$area);
		$area2 = str_replace('m2','m²',$area1);
		$area3 = str_replace(' m²','',$area2);


		
		$price = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",5)->innertext;
		$price1 = str_replace('<span>Giá: </span>','',$price);
		if($price1 == "Thỏa thuận "){
			$price6 = $price1;
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
			
			if(strlen($price5)>6 and strlen($price5)<10){
				$a = $price5 / 1000000;
				$a1 = str_replace('.',',',$a);
				echo $price6 = $a1."  Triệu VNĐ";
			}

			if(strlen($price5)>9){
				$b = $price5 / 1000000000;
				$b1 = str_replace('.',',',$b);
				echo $price6 = $b1."  Tỷ VNĐ";
			}
			
		}

		$district = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",3)->innertext;
		$district1 = strstr($district, 'Quận');
		$district2 = str_replace(' -  			 Đà Nẵng			 ','',$district1);

		$detail = $get->find("div.contai div.container div.center3 div.box1 div.c3_ct",0)->plaintext;

		$type = "Đất thổ cư";

		$seller = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",6)->innertext;
		$seller1 = str_replace('<span>Họ tên: </span>', '', $seller);
		

		$phone = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",8)->innertext;
		$phone1 = str_replace('<span>Điện thoại: </span>', '', $phone);

		$address = $get->find("div.contai div.container div.center3 div.box1 div.c3_tt p",9)->innertext;
		$address1 = str_replace('<span>Địa chỉ: </span>', '', $address);

		$location = "";
		$update1 = "INSERT INTO sellers(name, phone, address) VALUES ('$seller1', '$phone1','$address1')";
		$result124 = mysqli_query($mysqli, $update1);

		if($result124) {
			echo $idc = mysqli_insert_id($mysqli);


			$update = "UPDATE lands set title = '$title', description='$desc',price='$price6',image ='$tenFile', create_day='$time3', area='$area2', location='$location',district='$district2', type='$type' ,detail ='$detail', id_contact='$idc' where id='$id'";

			$result123 = mysqli_query($mysqli, $update);

			if($result123){
				$qr1 ="UPDATE lands set id_district = case district 
			 	when 'Quận Cẩm Lệ' then 1 
			 	when 'Quận Hải Châu' then 2
			 	when 'Quận Ngũ Hành Sơn' then 3
			 	when 'Quận Sơn Trà' then 4
			 	when 'Quận Thanh Khê' then 5
			 	when 'Quận Liên Chiểu' then 6
			 	when 'Huyện Hòa Vang' then 7
			 	when 'Huyện đảo Hoàng Sa' then 8
			 	else id_district
			 	end
			 	where district IN('Quận Cẩm Lệ','Quận Hải Châu','Quận Ngũ Hành Sơn','Quận Sơn Trà','Quận Thanh Khê','Quận Liên Chiểu','Huyện Hòa Vang','Huyện đảo Hoàng Sa')";
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