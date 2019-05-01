<?php
	include_once 'config.php';
	include_once constant("CONTROLLER_DIR").'CashierPageGetter.php';
	set_error_handler("errorRedirect");
	$pageId='cashier';
	if(isset($_GET['pageId'])){
		$pageId=$_GET['pageId'];
	}
	$pageBuilder=new CashierPageGetter();
	$pageBuilder->get($pageId);
?>
