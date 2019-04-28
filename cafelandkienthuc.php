<?php
require "dbCon.php";
require "simple_html_dom.php";

//for($i =1 ; $i<3; $i++){
	//$html = file_get_html("https://cafeland.vn/kien-thuc/kien-thuc-bat-dong-san/47/page-".$i."/");

	$html = file_get_html("https://cafeland.vn/kien-thuc/kien-thuc-bat-dong-san/47/page-6/");
	$tins = $html->find("div.wrap-main div.container div.left-col div.block div.page-content div.box-content ul.list-type-14 li");
	set_time_limit(0);
	echo count($tins);

	$query = "SELECT * From knowledge";
	$result_query =  mysqli_query($mysqli, $query);

	$arr1 = array();
	while($arResult5 = mysqli_fetch_assoc($result_query)) {
		$arr1[] = $arResult5['link'];			// Lấy toàn bộ link trong website đưa vào mảng $arr1
	}

	$arr2 = array();
	foreach ($tins as $t) {						//Lọc mảng để lấy $link từ mảng $tins của dòng số 7

		$link = $t->find("h3 a",0)->href;
		$arr2[] = $link;					//	Lấy toàn bộ $link lọc từ mảng $tins đưa vào mảng $arr2
	}

	$LinksAdd =array_reverse(array_diff($arr2,$arr1));	
	//So sánh 2 mảng $arr1 và $arr2. Nếu link nào trùng sẽ tự động xóa bỏ, link nào không trùng sẽ đưa vào 1 mảng mới có tên lả $linksAdd . 

	foreach($LinksAdd as $key=>$value) { //Foreach để lấy $link mới insert vào database
		$qr = "INSERT INTO knowledge(link) VALUES ('$value')";

	 	$result2 = mysqli_query($mysqli, $qr);

	 	if($result2) {
	 		$id = mysqli_insert_id($mysqli);
			$get = file_get_html($value);


			echo $title = $get->find("div.wrap-main div.container div.left-col div.block div.box-post-main-title h1.sevenPostTitle",0)->plaintext;
			echo "<br />";
			$time = $get->find("div.wrap-main div.info-date",0)->innertext;
			$time = str_replace('     		','',$time);
			$time = substr($time, 0,10);
			$time = DateTime::createFromFormat('d/m/Y',$time);
			$time = $time->format('Y-m-d');


			$img = $get->find("img",10)->src;
			$u = 'D:\workspace\.metadata\.plugins\org.eclipse.wst.server.core\tmp0\wtpwebapps\project_cland\files/'.basename($img);
			file_put_contents($u, file_get_contents($img));
			$tenFile = basename($img);

			$desc = $get->find("div.sevenPostContent div.sevenPostDes",0)->plaintext;

			$detail = $get->find("div.sevenPostContent",0)->plaintext;
			$detail1 = $get->find("div.sevenPostContent em",0)->plaintext;
			$detail2 = str_replace($detail1,'',$detail);


			$qr ="UPDATE knowledge set title='$title', description='$desc', detail='$detail2' , time='$time',image='$tenFile' where id='$id'";
			$result = mysqli_query($mysqli, $qr);

	}
}

//}
?>