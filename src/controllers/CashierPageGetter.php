<?php
	include_once constant("LIB_DIR").'/php/dao/Data.php';
	include_once constant("LIB_DIR").'/php/dao/BaseDAO.php';
	include_once constant("LIB_DIR").'/php/util/PageBuilder.php';
	include_once constant("LIB_DIR").'/php/util/PageGetter.php';
	include_once constant("MODEL_DIR").'CashierPageBuilder.php';
	include_once constant("MODEL_DIR").'OrderPageBuilder.php';
	include_once constant("MODEL_DIR").'CheckOutPageBuilder.php';
	class CashierPageGetter extends PageGetter{
		public function buildHtml($pageId,$pageResource){
			switch ($pageId) {
        case 'order':
					$pageBuilder=new OrderPageBuilder();
					$pageResource->isOrder=TRUE;
					break;
				case 'editOrder':
					$pageBuilder=new OrderPageBuilder();
					if(isset($_GET['numberId'])){
		      	$pageResource->numberId=$_GET['numberId'];
			      $pageResource->isOrder=TRUE;
						break;
		      }else{
						trigger_error("Xay ra su co xin vui long lien he quan ly",E_NO_NUMBER_ID);
					}
        case 'cashier':
          $pageBuilder=new CashierPageBuilder();
					$pageResource->isCashier=TRUE;
					break;
				case 'checkOut':
					$pageBuilder=new CheckOutPageBuilder();
					if(isset($_GET['numberId']) && is_numeric($_GET['numberId'])){
						$pageResource->numberId=$_GET['numberId'];
						$pageResource->isCashier=TRUE;
						break;
					}else{
						trigger_error("Xay ra su co xin vui long lien he quan ly",E_NO_NUMBER_ID);
					}
					break;
        default:
          $pageBuilder=new CashierPageBuilder();
					//TODO have to set value to another page
					$pageResource->isCashier=TRUE;
      }
      $pageBuilder->buildHtml($pageResource);
		}
	}
?>
