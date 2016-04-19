<?php
//-- Params
$mistake = 0;
$rezArr = [];
// [locField]
// [compField]
// [nameField]
// [statusField]
// [ipField]
// [typeField]

if($_POST['statusField']==0){
	$rezArr['statusField']['mistakeIU'] = 'mistake';
}

if($_POST['locField']==0){
	$rezArr['locField']['mistakeIU'] = 'mistake';
}

if(strlen($_POST['ipField'])==0){
	$rezArr['ipField']['mistakeIU'] = 'mistake';
}

if(strlen($_POST['nameField'])==0){
	$rezArr['nameField']['mistakeIU'] = 'mistake';
}

if(!isset($_POST['compField'])){
	$rezArr['compField']['mistakeIU'] = 'mistake';
}

if(!isset($_POST['typeField'])){
	$rezArr['typeField']['mistakeIU'] = 'mistake';
}
