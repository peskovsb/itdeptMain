<?php
$uploaddir = '../../uploads/'; 
$ext = substr($_FILES['uploadfile']['name'],strpos($_FILES['uploadfile']['name'],'.'),strlen($_FILES['uploadfile']['name'])-1); 
$pre_fileName =  'tech_'.time().rand(100,200).$ext;
$fileName = 'tmp_' . $pre_fileName;
$shown_fileName = $pre_fileName;
$file = $uploaddir . $fileName; 

 
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
	  echo $shown_fileName; 
	} else {
		echo "error";
	}
?>