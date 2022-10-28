<?php include_once 'views/layout/' . $this->layout . 'header.php';?>
<?php global $mediaFiles; ?>
<div class="col-xs-12">
	<div class="table-responsive">
	  <table class="table table-bordered">
        <thead>
          <tr>
            <th>Product</th>
            <th>Cost</th>
            <th>Amount</th>
            <th>Total Money</th>
			      <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php $total=0 ?>
        <?php if(isset($_SESSION['cart'])) { ?>
			<?php foreach($_SESSION['cart'] as $v) : ?>
			  <tr>
				<td width="" class="d-flex"><div class="w-50"><img src="<?php echo "media/upload/products".'/'.$v['photo']; ?>" alt="<?php echo $v['name']; ?>" class="img-thumbnail w-75"></div><div class=" flex-wrap"><h6>Name: <?php echo $v['name']; ?></h6><br><h5>Category: <?php echo $v['categories_name']; ?></h5><br><p>Description: <?php echo $v['description']; ?></p></div></td>
                <td width="15%"><?php echo $v['cost']; ?> đ</td>
                <td width="15%"><?php echo $v['amount']; ?></td>
                <td width="15%"><?php echo intval($v['cost'])*intval($v['amount']) ?> đ</td>
                <td width="15%"><?php echo(date("Y-m-d",time())); ?></td>
                <td width="5%">
				  <a class="btn btn-outline-danger table-link danger deleteSession" role="button" href="javascript:void(0)" value="<?php echo $v['id'] ?>" >
					<i class="fas fa-trash"></i>
				  </a>
				</td>
			  </tr>
      <?php $total+=intval($v['cost'])*intval($v['amount']) ?>
			<?php endforeach; ?>
		<?php } else { ?>
			  <tr>
				<td colspan="7" scope="row">There are no record!</td>
			  </tr>
		<?php }  ?>
        </tbody>
      </table>
	</div>
  </div>
  <?php if(!isset($_SESSION['login'])){ ?>
    <div class="">
      <h4 class="">CUSTOMER INFORMATION</h4>
      <form action="" class="form-customer">
        <div class="sex-customer p-2">
          <input type="radio" id="man">
          <label for="men" class="">Man</label>
          <input type="radio" id="woman">
          <label for="women" class="">Woman</label>
        </div>
        <div class="name-mobile">
          <div class="fill p-2">
            <input placeholder="Full Name" type="text" id='fullName' required>
          </div>
          <div class="fill p-2">
            <input placeholder="Phone Number" type="text" id='contact' required>
          </div>
        </div>
        <div class="address">
          <h5>ADDRESS</h5>
          <div class="d-flex flex-wrap">
            <div class="fill p-2">
              <input placeholder="City" type="text" id='city' required>
            </div>
            <div class="fill p-2">
              <input placeholder="District" type="text" id='district' required>
            </div>
            <div class="fill p-2">
              <input placeholder="Ward" type="text" id='ward' required>
            </div>
            <div class="fill p-2">
              <input placeholder="Street Number" type="text" id='street' required>
            </div>
          </div>
        </div>
      </form>
      <div class=""><h6>Tổng tiền: </h6></div>
    </div>
  <?php } ?>
<?php array_push($mediaFiles['js'], RootREL."media/js/cart.js"); ?>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
