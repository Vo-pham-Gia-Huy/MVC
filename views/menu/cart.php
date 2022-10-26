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
        <?php if(isset($_SESSION['cart'])) { ?>
			<?php foreach($_SESSION['cart'] as $v) : ?>
			  <tr>
				<td width="" class="d-flex flex-wrap"><div class="w-50"><img src="<?php echo "media/upload/products".'/'.$v['photo']; ?>" alt="<?php echo $v['name']; ?>" class="img-thumbnail"></div><div class=""><h6>Name: <?php echo $v['name']; ?></h6><br><h5>Category: <?php echo $v['categories_name']; ?></h5><br><p>Description: <?php echo $v['description']; ?></p></div></td>
                <td width="15%"><?php echo $v['cost']; ?></td>
                <td width="15%"></td>
                <td width="15%"></td>
                <td width="15%"><?php echo(date("Y-m-d",time())); ?></td>
                <td width="5%">
				  <a class="btn btn-outline-danger table-link danger deleteSession" role="button" href="javascript:void(0)" value="<?php echo $v['id'] ?>" >
					<i class="fas fa-trash"></i>
				  </a>
				</td>
			  </tr>
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
<?php array_push($mediaFiles['js'], RootREL."media/js/cart.js"); ?>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
