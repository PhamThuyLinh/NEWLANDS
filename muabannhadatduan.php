<?php
require "dbCon.php";
require "simple_html_dom.php";

$html = file_get_html("https://duan.muabannhadat.vn/tim-kiem/da-nang/dat-nen-phan-lo/tat-ca-gia");

$tins = $html->find("div.container div.row div.col-md-9 div.project div.row div.col-md-4");

set_time_limit(0);
echo count($tins);
echo "<br />";
$query = "SELECT * From projects";
$result_query =  mysqli_query($mysqli, $query);

$arr1 = array();
while($arResult5 = mysqli_fetch_assoc($result_query)) {
	$arr1[] = $arResult5['link'];			
}

$arr2 = array();
foreach ($tins as $t) {						

	$link = $t->find("div.project-top div.project-content h3.head-pro a",0)->href;
	$arr2[] = $link;					
}

$LinksAdd =array_reverse(array_diff($arr2,$arr1));	

foreach($LinksAdd as $key=>$value) { 
	$qr = "INSERT INTO projects(link) VALUES ('$value')";

 	$result2 = mysqli_query($mysqli, $qr);

 	if($result2) {
 		$id = mysqli_insert_id($mysqli);
		$get = file_get_html($value);

		echo $title = $get->find("div.slide-content h4",0)->innertext;

		$seller = $get->find("div.intro-content ul li",2)->innertext;
	
	echo "<br />";


	$address = $get->find("div.slide-content span",0)->innertext;

	$desc = $get->find("div.slide-content ul",0)->innertext;

	echo $tongquan = $get->find("div#introduce div.introduce-text h2.text-title",0)->innertext;

	$tongquan = str_replace('<img                                     src="https://duan.muabannhadat.vn/wp-content/themes/themenhadat/image/icon-introduce.png">','<h4><i class="fa fa-arrow-circle-right"></i>',$tongquan);
	$tongquan = $tongquan.'</h4>';

	$dong1 = $get->find("div.intro-content p#gioi-thieu",0)->innertext;

	$dong2 = $get->find("div.intro-content p.text-justify",1)->innertext;

	$mucluc = $get->find("div.intro-content h2.h3",0)->innertext;

	$mucluc1 = $get->find("div.intro-content ol",0)->innertext;

	$canbiet = $get->find("div.intro-content h3#can-biet",0)->innertext;

	$ul = $get->find("div.intro-content ul",1)->innertext;

	//
	$detail1 = $tongquan.'<br />'.$dong1.'<br />'.$dong2.'<br />'.$mucluc.'<br />'.$mucluc1.'<br />'.$canbiet.'<br />'.$ul.'<br />';

	$uunhuoc = $get->find("div#utility h2.text-title",0)->innertext;

	$uunhuoc = str_replace('<img                                     src="https://duan.muabannhadat.vn/wp-content/themes/themenhadat/image/icon-unity.png">','<h4><i class="fa fa-user-md"></i>',$uunhuoc);
	$uunhuoc = $uunhuoc.'</h4>';

	$dong11 = $get->find("div.intro-content p#tien-ich-du-an",0)->innertext;

	$dong22 = $get->find("div.col-md-12 div.intro-content p",1)->innertext;

	$dong33 = $get->find("div.col-md-12 div.intro-content ul",0)->innertext;

	$dong44 = $get->find("div.col-md-12 div.intro-content p",2)->innertext;

	$nhuoc = $get->find("div.col-md-12 div.intro-content h3#uu-nhuoc-diem",0)->innertext;

	$dong55 = $get->find("div.col-md-12 div.intro-content p",3)->innertext;

	$dong66 = $get->find("div.col-md-12 div.intro-content ul",1)->innertext;

	//
	$detail2 = $uunhuoc.'<br />'.$dong11.'<br />'.$dong22.'<br />'.$dong33.'<br />'.$dong44.'<br />'.$nhuoc.'<br />'.$dong55.'<br />'.$dong66.'<br />';

	$vitri = $get->find("div.content-location h2",0)->innertext;

	$vitri = str_replace('<img                                     src="https://duan.muabannhadat.vn/wp-content/themes/themenhadat/image/icon-location.png">','<h4><i class="fa fa-map-marker"></i>',$vitri);
	$vitri = $vitri.'</h4>';

	$dong7 = $get->find("div.content-location div.intro-content p",0)->innertext;

	$dong8 = $get->find("div.content-location div.intro-content p",1)->innertext;

	$dong9 = $get->find("div.content-location ul",0)->innertext;

	$detail3 = $vitri.'<br />'.$dong7.'<br />'.$dong8.'<br />'.$dong9.'<br />';

	

	$intro1 = $get->find("div.content-introduce div.col-md-12 a.prettyphoto img.image-size",0)->src;
	$u1 = 'duan/'.basename($intro1);
	file_put_contents($u1, file_get_contents($intro1));
	$tenFile1 = basename($intro1);

	$intro2 = $get->find("div.content-introduce div.container div.row div.col-md-6 div.row div.col-md-6",0)->find("a.prettyphoto img",0)->src;
	$u2 = 'duan/'.basename($intro2);
	file_put_contents($u2, file_get_contents($intro2));
	$tenFile2 = basename($intro2);

	$intro3 = $get->find("div.content-introduce div.container div.row div.col-md-6 div.row div.col-md-6",1)->find("a.prettyphoto img",0)->src;
	$u3 = 'duan/'.basename($intro3);
	file_put_contents($u3, file_get_contents($intro3));
	$tenFile3 = basename($intro3);

	//
	$introimg = $tenFile1.$tenFile2.$tenFile3;
	

	$tienich1 = $get->find("div#utility div.col-md-6",0)->find("a.prettyphoto img",0)->src;
	$t1 = 'duan/'.basename($tienich1);
	file_put_contents($t1, file_get_contents($tienich1));
	$tenFile6 = basename($tienich1);

	$tienich2 = $get->find("div#utility div.col-md-6",1)->find("a.prettyphoto img",0)->src;
	$t2 = 'duan/'.basename($tienich2);
	file_put_contents($t2, file_get_contents($tienich2));
	$tenFile7 = basename($tienich2);

	$tienich3 = $get->find("div#utility div.utility-image div.col-md-12",0)->find("a.prettyphoto img",0)->src;
	$t3 = 'duan/'.basename($tienich3);
	file_put_contents($t3, file_get_contents($tienich3));
	$tenFile8 = basename($tienich3);

	//
	$tienichimg = $tenFile6.$tenFile7.$tenFile8;
	

	$vitri = $get->find("div.content-location div.image-map img",0)->src;
	$v = 'duan/'.basename($vitri);
	file_put_contents($v, file_get_contents($vitri));
	$tenFile11 = basename($vitri);

	$qr1 ="INSERT INTO image(trangchu, gioithieu, gioithieu1, gioithieu2, tienich, tienich2, tienich3, vitri) VALUES ('$tenFile1','$tenFile1','$tenFile2','$tenFile3','$tenFile6','$tenFile7','$tenFile8','$tenFile11')";
	$result1 = mysqli_query($mysqli, $qr1);

	
 	if($result1){
 		$idi = mysqli_insert_id($mysqli);
		
		$qr ="UPDATE projects set title='$title', description='$desc', sellers='$seller',id_image='$idi',address='$address', overview='$detail1', utility='$detail2', location='$detail3' where id='$id'";
 		$result2 = mysqli_query($mysqli, $qr);
		}
	}
}
?>