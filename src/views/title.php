<div id="navbar" class="navbar">
  <a <?php if($resource->isCashier){ ?>class="active" <?php }?> href="?pageId=cashier">Thanh toan</a>
  <a <?php if($resource->isOrder){ ?>class="active" <?php }?> href="?pageId=order">Goi mon</a>
  <div class="dropdown">
    <button class="dropbtn">Khac</button>
    <div class="dropdown-content">
      <a href="#">Chua phat trien</a>
    </div>
  </div>
</div>
