<!DOCTYPE html>
<html>
<?php
  include 'header.php'; ?>
<body>
<?php include 'title.php'; ?>
<div class="dragbar-container">
	<div class="dragbar-container__left">
		<div class="white-space--nowrap">
      <?php if(!empty($resource->numberId)){ ?>
      <input type="hidden" id="number_id" name="number_id" value="<?php echo $resource->numberId;?>"/>
      <?php } ?>
			<label class="color--gray">Khu vuc: </label>
			<select id="select_area">
        <?php
        foreach( $resource->areas as $area){?>
    			<option value="<?php echo $area['id'];?>" <?php if(is_numeric($resource->areId) && $resource->areId === $area['id']) echo "selected"; ?>><?php echo $area['name'];?></option>
    		<?php } ?>
			</select>
			<label class="color--gray">Ban: </label>
			<select id="select_table">
        <?php
        foreach( $resource->tables as $table){ ?>
        <option value="<?php echo $table['id'];?>"><?php echo $table['name'];?></option>
        <?php } ?>
			</select>
			<a class="rounded hover--green padding float--right margin--left" onclick="submitAndCheckOutOrder();return false;">Thanh toan</a>
			<a class="rounded hover--blue padding float--right" onclick="submitOrder();return false;">Goi mon</a>
		</div>
		<table id="ordered_list_table">
			<tr>
        <th>Ban</th>
				<th>[0] mon</th>
				<th class="white-space--nowrap" colspan="3">Tong tien[0]</th>
			</tr>
      <?php foreach( $resource->orders as $order){ ?>
      <tr data-order-id="<?php echo $order['id']; ?>" data-table-id="<?php echo $order['table_id']; ?>" data-pid="<?php echo $order['product_id']; ?>" data-name="<?php echo $order['product_name']; ?>" data-count="<?php echo $order['count']; ?>" data-price="<?php echo $order['price']; ?>" >
        <td><strong class="rounded background-color--gray padding"><?php echo $order['table_name']; ?></strong></td>
        <td class="width--full"><strong class="color--blue"><?php echo $order['product_name']; ?></strong><div><?php echo $order['comments']; ?></div></td>
        <td class="text-align--right white-space--nowrap"><span class="rounded background-color--yellow padding"><?php echo $order['price']; ?></span></td>
        <td class="text-align--center"><img onclick="onAddRow(this)" width="24px" height="24px" src="./images/ic_add.png" alt="Them"></td>
        <td class="text-align--center"><img onclick="onDeleteRow(this)" width="24px" height="24px" src="./images/ic_close.png" alt="Xoa"></td>
      </tr>
      <?php  } ?>
		</table>
	</div>
	<div class="dragbar-container__dragbar"></div>
	<div class="dragbar-container__right">
		<div id="category_menu" class="scroll-menu margin--bottom">
    <?php foreach( $resource->categories as $category){ ?>
        <a class="hover--gray <?php if($resource->cateId === $category['id']) echo 'active'; ?>" data-id="<?php echo $category['id']; ?>" href="#" onclick="loadOrderProducts(this);return false;"><?php echo $category['name']; ?></a>
    <?php  } ?>
    </div>
		<div class="dragbar-container__right__bottom">
			<div id="order_center_list" class="grid-container">
      <?php
      foreach($resource->products as $product){?>
        <div class="hover--blue" onclick="onOrderProductClick(<?php echo $product['id'].",'".$product['name']."',".$product['add_count'].",".$product['price'] ?>);" ><?php echo $product['name']; ?></div>
      <?php } ?>
      </div>
			<div id="order_bottom_list" class="hide grid-container padding--top">
      <?php
      foreach( $resource->productComments as $productComment){?>
        <div class="hover--green"  onclick="onOrderProductCommentClick('<?php echo $productComment['name']."'" ?>);" ><?php echo $productComment['name']; ?></div>
      <?php } ?>
      </div>
		</div>
	</div>
</div>
</body>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="js/order_script.js"></script>
</html>
