<?
$dbConfig = @require_once '../../../config/db.php';
@require_once '../../../config/classPDO.php';
$db = new Database($dbConfig['dsn'],$dbConfig['username'],$dbConfig['password']);

	/*
	 * Getting All @Locations;
	 */
	$sql = 'SELECT * FROM location;';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$arrLocations = $tb->fetchAll(PDO::FETCH_ASSOC);

	/*
	 * Getting All @staff;
	 */
	$sql = 'SELECT * FROM staff ORDER by staff_lastname ASC;';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$arrStaff = $tb->fetchAll(PDO::FETCH_ASSOC);

	/*
	 * Getting MAX @computers;
	 */
	$sql = 'SELECT MAX(comp_name) as max_number FROM computers';
	$tb = $db->connection->prepare($sql);
	$tb->execute();
	$arrComp = $tb->fetch(PDO::FETCH_ASSOC);

	$maxNumberGen = sprintf('%03d', $arrComp['max_number']+1);

$dataID = isset($_POST['dataID']) ? $_POST['dataID'] : false;
/*echo $dataID;*/

		$sql = 'SELECT *,CONCAT(staff_lastname," ",staff_name) as profile,CONCAT(company_prefix, type_prefix, comp_name) as webname FROM computers LEFT JOIN staff ON computers.comp_profile = staff.staff_id LEFT JOIN company ON computers.comp_company = company.company_id LEFT JOIN computers_type ON computers_type.type_id = computers.comp_type WHERE computers.id=:computers_id';
		$tb = $db->connection->prepare($sql);
		$tb->execute([':computers_id'=>$dataID]);
		$arrComputers = $tb->fetch(PDO::FETCH_ASSOC);	
		// echo '<pre>'; print_r($arrComputers); echo '</pre>';
?>

<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/inputmask.js" type="text/javascript"></script>
<script src="js/jquery.inputmask.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js"></script>
<link rel="stylesheet" href="js/chosen.css">
<script type="text/javascript">
$(document).ready(function(){
	var btnUpload=$('#upload');
	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: 'ajax/komputers/upload-file.php',
		name: 'uploadfile',
		onSubmit: function(file, ext){
			status.text('Загрузка...');
		},
		onComplete: function(file, response){
			//On completion clear the status
			status.text('');
			//Add uploaded file to list
			if(response!="error"){
				$('#rezultLoader').html('файл загружен: '+response).addClass('successLoader');
				$('#sidF').val(response);
			} else{
				$('#rezultLoader').html('файл не загружен: '+file).addClass('errorLoader');
			}
		}
	});

	$('.chosen-select').chosen();
	$('#ipAdressField').inputmask({'mask' : '999.999.9{1,3}.9{1,3}',skipOptionalPartCharacter: ".", "placeholder" : "0"});	
	// $('#numberKomp').inputmask({"mask": "999", "placeholder" : ""});	
});

</script>
<form id="komputersCreate">
<input type="hidden" value="<?=$dataID?>" name="recordID">
<input id="sidF" type="hidden" value="<?=$arrComputers['comp_sid']?>" name=sidField>
<div class="mistakePopUp">
	<svg aria-hidden="true" class="octicon-x" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path d="M7.48 8l3.75 3.75-1.48 1.48-3.75-3.75-3.75 3.75-1.48-1.48 3.75-3.75L0.77 4.25l1.48-1.48 3.75 3.75 3.75-3.75 1.48 1.48-3.75 3.75z"></path></svg>
	Ошибка в заполнении формы. Исправьте все ошибки (помеченные красным), чтобы успешно отравить форму
</div>
<div style="float:left;width:50%">
	<div style="padding-right:10px">
		<label class="fieldMain"><h2 class="fieldHeader">Локация<span class="importantField">*</span></h2>
			<select name="locField" class="fieldStyle">
				<option value="0">-- Выбрать --</option>
				<?php
					foreach($arrLocations as $items){
						$locChecked = $items['location_id']== $arrComputers['comp_location']? 'selected' : '';
						echo "<option {$locChecked} value='{$items['location_id']}'>{$items['location_name']}</option>";
						$locChecked = '';
					}
				?>
			</select>
		</label>
	</div>
</div>
<div style="float:left;width:50%">
<?php
$compChecked = '1'== $arrComputers['comp_company'] ? 'checked="checked"' : '';
?>
	<h2 class="fieldHeader" style="margin-bottom:11px">Компания<span class="importantField">*</span></h2>
	<input <?=$compChecked?> id="ChkcompBl" class="radioboxreq" type='radio' value="1" name="compField">
	<label for="ChkcompBl" class="fieldChkMain"><span class="checkText">BL</span></label>
<?php
$compChecked = '2'== $arrComputers['comp_company'] ? 'checked="checked"' : '';
?>	
	<input <?=$compChecked?> id="ChkcompBs" class="radioboxreq" type='radio' value="2" name="compField">
	<label for="ChkcompBs" class="fieldChkMain"><span class="checkText">BS</span></label>
<?php
$compChecked = '10'== $arrComputers['comp_company'] ? 'checked="checked"' : '';
?>		
	<input <?=$compChecked?> id="ChkcompBm" class="radioboxreq" type='radio' value="10" name="compField">
	<label for="ChkcompBm" class="fieldChkMain"><span class="checkText">BM</span></label>
</div>
<div style="clear:both"></div>

<div style="float:left;width:50%;">
	<div style="padding-right:10px">
		<label class="fieldMain"><h2 class="fieldHeader">Номер<span class="importantField">*</span></h2>
		<div style="position:relative;">
		<span data-gen="<?=$maxNumberGen?>" id="numberGeneratorField" style="position: absolute; right: 1px; top: 1px; display: block; height: 30px; line-height: 30px; background: #eee; font-size: 10px; box-sizing: border-box; padding: 0 10px; border-left: 1px solid #e5e5e5;">Сгенерировать</span>
<?php
$compNumber = (isset($arrComputers['comp_name']) && strlen($arrComputers['comp_name'])>0) ? $arrComputers['comp_name'] : '';
?>				
			<input id="numberKomp" value="<?=$compNumber?>" type='text' name="nameField" class="fieldStyle">
		</div>
		</label>
	</div>
</div>
<div style="float:left;width:50%">
	<label class="fieldMain"><h2 class="fieldHeader">Статус<span class="importantField">*</span></h2>
		<select name="statusField" class="fieldStyle">
			<option value="0">-- Выбрать --</option>
			<?php
			$compStatus = "1" == $arrComputers['comp_status'] ? 'selected' : '';
			?>
			<option <?=$compStatus?> value="1">Работает</option>
			<?php
			$compStatus = "2" == $arrComputers['comp_status'] ? 'selected' : '';
			?>
			<option <?=$compStatus?> value="2">Свободен</option>
			<?php
			$compStatus = "3" == $arrComputers['comp_status'] ? 'selected' : '';
			?>			
			<option <?=$compStatus?> value="3">Ремонт</option>
		</select>
	</label>
</div>
<div style="clear:both"></div>

<?php
$compIp = (isset($arrComputers['comp_ip']) && strlen($arrComputers['comp_ip'])>0) ? $arrComputers['comp_ip'] : '';
?>
<div style="float:left;width:50%">
	<div style="padding-right:10px">
	<label class="fieldMain"><h2 class="fieldHeader">IP адрес<span class="importantField">*</span></h2>

		<input id="ipAdressField" placeholder="     .     .     ." type='text' value="<?=$compIp?>" name="ipField" class="fieldStyle">
	</label>
	</div>
</div>

<div style="float:left;width:50%">
	<label class="fieldMain"><h2 class="fieldHeader">Профиль</h2>
		<select style="width:180px;" name="profileField" class="fieldStyle chosen-select">
			<option value="0">-- Выбрать --</option>
			<?php
				foreach($arrStaff as $items){
					$staffChecked = $items['staff_id']== $arrComputers['comp_profile']? 'selected' : '';
					echo "<option {$staffChecked} value='{$items['staff_id']}'>{$items['staff_lastname']} {$items['staff_name']} {$items['staff_secondname']}</option>";
				}
			?>			
		</select>
	</label>
</div>
<div style="clear:both"></div>
<span style="font-size: 9px;color:#888">(Чтобы разделить - английская ТОЧКА!)</span>

	<h2 class="fieldHeader" style="margin-bottom:11px">Тип устройства<span class="importantField">*</span></h2>
			<?php
			$compType = "1" == $arrComputers['comp_type'] ? 'checked="checked"' : '';
			?>	
	<input id="ChkcompWS" <?=$compType?> class="radioboxreq" type='radio' value="1" name="typeField">
	<label for="ChkcompWS" class="fieldChkMain"><span class="checkText">WS</span></label>
			<?php
			$compType = "2" == $arrComputers['comp_type'] ? 'checked="checked"' : '';
			?>		
	<input id="ChkcompNB" <?=$compType?> class="radioboxreq" type='radio' value="2" name="typeField">
	<label for="ChkcompNB" class="fieldChkMain"><span class="checkText">NB</span></label>

<?php
$compKomment = (isset($arrComputers['comp_komment']) && strlen($arrComputers['comp_komment'])>0) ? $arrComputers['comp_komment'] : '';
?>
<label class="fieldMain"><h2 class="fieldHeader">Комментарий</h2>
	<textarea rows="6" class="fieldStyle" style="width:100%" name="kommentField"><?=$compKomment?></textarea>
</label>

<?php
$compSid = (isset($arrComputers['comp_sid']) && strlen($arrComputers['comp_sid'])>0) ? 'файл загружен: '.$arrComputers['comp_sid'] : '';
?>
<!-- файл загружен: tech_1461073986169.М-468.JPG -->
<label class="fieldMain">
	<h2 class="fieldHeader">Загрузить SID<span class="importantField">*</span></h2>
	<div id="upload" ><span>Выбрать файл<span></div><span id="status" ></span>
	<div id="rezultLoader" <?php if(isset($arrComputers['comp_sid']) && strlen($arrComputers['comp_sid'])){?>class="successLoader"<?php }?>><?=$compSid?></div>
</label>
		
		

<div style="clear:both"></div>


<input type="submit" value="Отправить" class="btncreate">
</form>