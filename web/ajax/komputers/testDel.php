<?
$dbConfig = @require_once '../../../config/db.php';
@require_once '../../../config/classPDO.php';
$db = new Database($dbConfig['dsn'],$dbConfig['username'],$dbConfig['password']);

$dataID = isset($_POST['dataID']) ? $_POST['dataID'] : false;

	$sql = 'SELECT *, CONCAT(company_prefix, type_prefix, comp_name) as webname FROM computers LEFT JOIN company ON computers.comp_company = company.company_id LEFT JOIN computers_type ON computers_type.type_id = computers.comp_type WHERE computers.id=:computers_id';
		$tb = $db->connection->prepare($sql);
		$tb->execute([':computers_id'=>$dataID]);
		$arrComputers = $tb->fetch(PDO::FETCH_ASSOC);	
?>
<form id="komputersDelete">
	<input type="hidden" value="<?=$dataID?>" name="recordID">

	<div class="mistakePopUp" style="display: block;">
		Вы уверены, что хотите удалить элемент:"<b><?=$arrComputers['webname']?></b>"?
	</div>

<div style="clear:both"></div>
	<div style="text-align: center;">
		<input type="submit" value="Да" class="btncreate" style="width:140px;">
		<a class="btnordinary WindowCloser" href="javascript:void(0);">Отмена</a>
	</div>
</form>