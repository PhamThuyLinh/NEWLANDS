<?php
require "dbCon.php";
require "simple_html_dom.php";

$html = file_get_html("http://www.muabannhadat.vn/dat-ban-3515/tp-da-nang-s31?sf=dpo&so=d&p=12");

$tins = $html->find("div.body-content div.container div.row div.container div.row div.col-xs-12 div.pull-left div.list-group div.mbnd-item ");
set_time_limit(0);
echo count($tins);
// echo "<hr />";

$query = "SELECT * From lands";
$result_query =  mysqli_query($mysqli, $query);

$arr1 = array();
while($arResult5 = mysqli_fetch_assoc($result_query)) {
	$arr1[] = $arResult5['link'];			// Lấy toàn bộ link trong website đưa vào mảng $arr1
}

$arr2 = array();
foreach ($tins as $t) {						//Lọc mảng để lấy $link từ mảng $tins của dòng số 7

	$link = $t->find("div.mbnd-item-body div.row div.col-lg-12 a",0)->href;
	//echo "<hr />";
	$link1 = "http://www.muabannhadat.vn".$link; //link chính 

	$arr2[] = $link1;					//	Lấy toàn bộ $link lọc từ mảng $tins đưa vào mảng $arr2
}

$LinksAdd =array_reverse(array_diff($arr2,$arr1));	
//So sánh 2 mảng $arr1 và $arr2. Nếu link nào trùng sẽ tự động xóa bỏ, link nào không trùng sẽ đưa vào 1 mảng mới có tên lả $linksAdd . 

foreach($LinksAdd as $key=>$value) { //Foreach để lấy $link mới insert vào database
	$qr = "INSERT INTO lands(link) VALUES ('$value')";

 	$result2 = mysqli_query($mysqli, $qr);

 	if($result2) {
 		$id = mysqli_insert_id($mysqli);
		$get = file_get_html($value);

		$type = $get->find("ol.breadcrumb li",1)->find("a p",0)->innertext;
		
		$title = $get->find("div.body-content div.container div.row div.col-xs-12 div.row div.col-md-10",0)->innertext;

		$title1 = str_replace('<h1>','',$title);
		$title2 = str_replace('</h1>','',$title1);
		$title3 = str_replace('                                                ','',$title2);
		$title4 = str_replace('                                            <span>                          ','',$title3);
		$title5 = str_replace('                      </span>    ', '', $title4);

		$price = $get->find("div.body-content div.container div.row div.container div.col-xs-12 span.price",0)->innertext;

		$img = $get->find("div.body-content div.clearfix div.flexslider ul.slides li",0)->find("a.swipebox",0)->find("img",0)->src;
		// echo "<img src='$img' />";
		$u = 'D:\workspace\.metadata\.plugins\org.eclipse.wst.server.core\tmp0\wtpwebapps\project_cland\files/'.basename($img);
		file_put_contents($u, file_get_contents($img));
		$tenFile = basename($img);

		$time = $get->find("div.body-content div.date-listing-detail span",0)->innertext;
		$time1 = DateTime::createFromFormat('d.m.Y',$time);
		$time2 = $time1->format('Y-m-d');

		$desc = $get->find("div.body-content div.container div.row div.container div.row div.col-md-8",0)->innertext;

		$area = $get->find("div.body-content span#MainContent_ctlDetailBox_lblSurface",0)->innertext;
		$location = $get->find("div.body-content span#MainContent_ctlDetailBox_lblStreet",0)->innertext;

		$district = $get->find("div.body-content span#MainContent_ctlDetailBox_lblDistrict a",0)->innertext;
		$detail = $get->find("div.row div.description-area div.col-xs-12 div.box-description",0)->innertext;
		$seller = $get->find("div.box-contact div.detail-contact span#MainContent_ctlDetailBox_lblContactName",0)->innertext;
		echo "<br />";

		$address = $get->find("div.box-contact div.detail-contact span#MainContent_ctlDetailBox_lblAddressContact",0)->innertext;

		$phone = $get->find("div.box-contact div.detail-contact span#MainContent_ctlDetailBox_lblContactPhone a.btn-call-contact",0)->plaintext;
		$phone = str_replace(' (click để xem)','',$phone);
		
		$update1 = "INSERT INTO sellers(name, phone, address) VALUES ('$seller', '$phone','$address')";
		$result124 = mysqli_query($mysqli, $update1);

		if($result124) {
			echo $idc = mysqli_insert_id($mysqli);


			$update = "UPDATE lands set title = '$title5', description='$desc',price='$price',image ='$tenFile', create_day='$time2', area='$area', location='$location',district='$district', type='$type' ,detail ='$detail', id_contact='$idc' where id='$id'";

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