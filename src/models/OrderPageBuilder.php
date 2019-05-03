<?php
	include_once constant("MODEL_DIR").'dao/OrderDAO.php';
	include_once constant("MODEL_DIR").'dao/AreaDAO.php';
	include_once constant("MODEL_DIR").'dao/TableDAO.php';
	include_once constant("MODEL_DIR").'dao/CategoryDAO.php';
	include_once constant("MODEL_DIR").'dao/ProductDAO.php';
	include_once constant("MODEL_DIR").'dao/CommentDAO.php';
	class OrderPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			if(is_numeric($resource->numberId)){
				$adapter=new OrderDAO();
				$resource->orders=$adapter->getOrderListByNumberId($resource->numberId);
			}else{
				$resource->orders=array();
			}
			$adapter=new AreaDAO();
			$resource->areas=$adapter->getAll();
			if(!empty($resource->areas)){
				$adapter=new TableDAO();
				$resource->tables=$adapter->getTablesByAreaId($resource->areas[0]['id']);
			}else{
				$resource->tables=array();
			}
			$adapter=new CategoryDAO();
			$resource->categories=$adapter->getAll();
			if(!empty($resource->categories)){
				$adapter=new ProductDAO();
				$resource->cateId=$resource->categories[0]['id'];
				$resource->products=$adapter->getProductsByCategoryId($resource->cateId);
			}else{
				$resource->products=array();
			}
			$adapter=new CommentDAO();
			$resource->productComments=$adapter->getAll();
			include constant('VIEW_DIR').'page_order.php';
		}
	}
?>
