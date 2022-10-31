<?php global $mediaFiles; ?>
<?php include_once 'views/layout/' . $this->layout . 'header.php';?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="d-flex">
		<div class="col-4 p-3">
		<img src="<?php echo "media/upload/products" .'/'.$this->record['photo']; ?>" alt="<?php echo $this->record['name']; ?>" class="img-thumbnail">
		</div>
		<div class="col">
			<div class="p-4">
				<div class=""><h1 class=""><?php echo $this->record['name']; ?></h1>
					<h4>SALE: <?php echo $this->record['cost']; ?>  đ</h4>
				</div>
				<div class="">
					<p class=""><?php echo $this->record['description']; ?></p>
				</div>
				<div class=""><h6>CATEGORY: <?php echo $this->record['categories_name']; ?></h6></div>
				<div class="">
					AMOUNT:
					<button class="btn" value="-1"><i class="fa-sharp fa-solid fa-minus" ></i></button>
					<input class="amount" type="text" value='1'>
					<button class="btn" value="1"><i class="fa-sharp fa-solid fa-plus" ></i></button>
				</div>
				<div class="">
					<a href="<?php echo html_helpers::url(['ctl'=>'menu']); ?>" class="btn btn-info btn-sm m-1 p-2">Back</a>
					<a href="javascript:void(0)" class="btn btn-danger" id="addCart" value="<?php echo $this->record['id']; ?>"><i class="fa-solid fa-cart-shopping"></i><span> Add to Cart</span></a>
				</div>	
			</div>
		</div>
	</div>
</div>
<div class="cart"><a href="<?php echo html_helpers::url(['ctl'=>'menu','act'=>'cart']); ?>" class="btn btn-danger"><i class="fa-sharp fa-solid fa-cart-shopping"></i><span> Show Cart</span></a></div>
<?php array_push($mediaFiles['js'], RootREL."media/js/cart.js"); ?>
<?php include_once 'views/layout/' . $this->layout . 'footer.php';?>
