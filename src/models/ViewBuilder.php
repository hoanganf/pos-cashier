<?php
	class ViewBuilder{
		public function buildViewHtml($action,$resource){
			$viewBuilder=new ViewBuilder();
			switch ($action) {
        case 'loadOrderGroups_tr':
          $adapter=new OrderDAO();
					$resource->orders=$adapter->getOrderListGroupByTableInArea($resource->areaId);
          if(!empty($resource)){
            include constant('VIEW_DIR').'view_cashier_order_groupby_table_tr.php';
            break;
          }
				case 'loadTables_option':
					if(is_numeric($resource->areaId)){
						$adapter=new TableDAO();
						$resource->tables=$adapter->getTablesByAreaId($resource->areaId,true);
						include constant('VIEW_DIR').'view_order_tables_option.php';
					}
					break;
				case 'loadProducts_div':
					if(is_numeric($resource->categoryId)){
						$adapter=new ProductDAO();
						$resource->products=$adapter->getProducts($resource->categoryId,true);
						include constant('VIEW_DIR').'view_order_products_div.php';
					}
					break;
				case 'loadProductComments_div':
					if(is_numeric($resource->productId)){
						$adapter=new ProductCommentDAO();
						$resource->productComments=$adapter->getProductComments($resource->productId,true);
						include constant('VIEW_DIR').'view_order_product_comments_div.php';
					}
					break;
        default:
          $this->buildErrorHtml();
      }
		}
    public function buildErrorHtml(){
      include constant('VIEW_DIR').'noData.php';
    }
	}
?>
