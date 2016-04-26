<?php
$dbConfig = @require_once '../../../config/db.php';
@require_once '../../../config/classPDO.php';
$db = new Database($dbConfig['dsn'],$dbConfig['username'],$dbConfig['password']);


if(isset($_POST['recordID']) && strlen($_POST['recordID'])>0){
		$sql = 'DELETE FROM computers WHERE id=:computers_id';
		$tb = $db->connection->prepare($sql);
		$tb->execute([':computers_id'=>$_POST['recordID']]);
		$confirmJson = [
			[
				'recordID'  => $_POST['recordID']
			]
		];
	echo json_encode($confirmJson);
}
