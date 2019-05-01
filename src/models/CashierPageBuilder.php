<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	include_once constant("MODEL_DIR").'dao/AreaDAO.php';
	class CashierPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$adapter=new AreaDAO();
			$resource->areas=$adapter->getAll();
			include constant('VIEW_DIR').'page_cashier.php';
		}
	}
?>
