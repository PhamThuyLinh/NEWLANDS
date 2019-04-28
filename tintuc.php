<?php 
require "simple_html_dom.php";
require "dbCon.php";

//for($i =2 ; $i<4; $i++){

//$html = file_get_html("https://kenhbds.vn/thong-tin/tin-tuc-su-kien/page/".$i);
$html = file_get_html("https://kenhbds.vn/thong-tin/tin-tuc-su-kien/page/2");

$tins = $html->find("div#main div#page_content div#pg_content_center div.pg_content_ct_11");

set_time_limit(0);
echo count($tins);
echo "<hr />";

$query = "SELECT * From news";
$result_query =  mysqli_query($mysqli, $query);

$arr1 = array();
while($arResult5 = mysqli_fetch_assoc($result_query)) {
	$arr1[] = $arResult5['link'];			// Lấy toàn bộ link trong website đưa vào mảng $arr1
}

$arr2 = array();
foreach ($tins as $t) {						//Lọc mảng để lấy $link từ mảng $tins của dòng số 7

	$link = $t->find("h2.h_tt_h2 a",0)->href;

	$arr2[] = $link;					//	Lấy toàn bộ $link lọc từ mảng $tins đưa vào mảng $arr2
}

$LinksAdd =array_reverse(array_diff($arr2,$arr1));	
//So sánh 2 mảng $arr1 và $arr2. Nếu link nào trùng sẽ tự động xóa bỏ, link nào không trùng sẽ đưa vào 1 mảng mới có tên lả $linksAdd . 

foreach($LinksAdd as $key=>$value) { //Foreach để lấy $link mới insert vào database
	$qr = "INSERT INTO news(link) VALUES ('$value')";

 	$result2 = mysqli_query($mysqli, $qr);

 	if($result2) {
 		$id = mysqli_insert_id($mysqli);
		$get = file_get_html($value);

	echo $title = $get->find("div#page_content h1.article_title",0)->innertext;
	
	echo "<br />";
	$time = $get->find("div.article_time",0)->innertext;
	$time = substr($time, 0,10);
	$time = DateTime::createFromFormat('d/m/Y',$time);
	$time = $time->format('Y-m-d');
	
	$desc = $get->find("h2.article_excerpt",0)->innertext;
	$img =$get->find("img",1)->src;


	$u = 'D:\workspace\.metadata\.plugins\org.eclipse.wst.server.core\tmp0\wtpwebapps\project_cland\files/'.basename($img);
	file_put_contents($u, file_get_contents($img));
	$tenFile = basename($img);
		
	$detail = $get->find("div.article_content",0)->plaintext;

	$qr ="UPDATE news set title='$title', description='$desc', image ='$tenFile', time='$time', detail='$detail' where id='$id'";

 	$result2 = mysqli_query($mysqli, $qr);
}
}
//}
?>