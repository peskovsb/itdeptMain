<?php
$dbConfig = @require_once '../../../config/db.php';
@require_once '../../../config/classPDO.php';
$db = new Database($dbConfig['dsn'],$dbConfig['username'],$dbConfig['password']);


@require 'validator_body.php';

if(count($rezArr) == 0){

if(isset($_POST['sidField'])){
	$sidField = $_POST['sidField'];
}else{
	$sidField = '';
}

if(isset($_POST['kommentField'])){
	$kommentField = $_POST['kommentField'];
}else{
	$kommentField = '';
}

	if(isset($_POST['recordID']) && strlen($_POST['recordID'])>0){
		echo $_POST['recordID'];
		echo 'correction...';
	}else{
		$sql = 'INSERT INTO computers (comp_location,comp_company,comp_type,comp_name,comp_status,comp_profile,comp_ip,comp_sid,comp_komment) VALUES (:comp_location,:comp_company,:comp_type,:comp_name,:comp_status,:comp_profile,:comp_ip,:comp_sid,:comp_komment)';
		$tb = $db->connection->prepare($sql);
		$tb->execute([':comp_location' => $_POST['locField'],':comp_company' => $_POST['compField'],':comp_type' => $_POST['typeField'],':comp_name' => $_POST['nameField'],':comp_status' => $_POST['statusField'],':comp_profile' => $_POST['profileField'],':comp_ip' => $_POST['ipField'],':comp_sid' => $sidField,':comp_komment' => $kommentField]);
	}

	/*
	 * Saving file To the Disk, tmp files will be removed	 
	 */
	if(isset($sidField) && strlen($sidField)>0){
		$filesRoute = "../../uploads";
		$entries = scandir($filesRoute);

		foreach($entries as $entry) {
		    $file = explode('tmp_', $entry);
		    if(isset($file[1])){
			    if($sidField == $file[1]){
			    	rename($filesRoute.'/'.$entry, $filesRoute.'/'.$sidField);
			    }
		   	}
		}
	}
	// ------------------------	
};