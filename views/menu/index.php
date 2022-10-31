<?php
global $mediaFiles;
array_push($mediaFiles['css'], RootREL . 'media/fontawesome/css/all.css');
?>
<?php include_once 'views/layout/' . $this->layout . 'header.php';?>
<?php if(!isset($_SESSION['login'])){ ?>
  <h1>You are not logged in! Do you want to login?</h1>
  <h3><a href="<?php echo html_helpers::url(array('ctl'=>'menu','act'=>'login'));?>" class="btn btn-outline-info">Login</a></h3>
<?php } ?>
<?php $e=mysqli_fetch_row($this->numRows)[0] ?>
<?php $numPage=ceil($e/12);?>
<?php 	$categories = categorie_model::getInstance();
$this->categoriesQuery = $categories->getAllRecords();
$categoriesData = [];
$cate = [];
while ($row = mysqli_fetch_array($this->categoriesQuery, MYSQLI_ASSOC)) {
    array_push($categoriesData, $row);
}
$tree = array();
foreach ($categoriesData as $row1) {
    html_helpers::Tree($row1, $tree);
}
// echo '<pre>';
// print_r($tree);
// echo '</pre>';
?>
<!-- <div class="row row-offcanvas row-offcanvas-right">
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>

    </div>
</div> -->
	<div class="row mb-5">
	<?php $d=0 ?>
	<?php if($this->records) { ?>
			<?php while($row = mysqli_fetch_array($this->records)) : ?>
				<div class="w-25 text-center d-flex flex-column p-3">
					<div class="border p-3 h-100 w-100">
						<a href="<?php echo html_helpers::url(
								['ctl'=>'menu', 
									  'act'=>'view', 
									  'params'=>array(
										'id'=>$row['id']
										)
								]); ?>" class="">
							<div class=""><img src="<?php echo "media/upload/products" .'/'.$row['photo']; ?>" alt="<?php echo $row['name']; ?>" class="img-thumbnail"></div>
							<div class="text-start p-4">
								<h6 class="mt-3 mb-3">Name: <?php echo $row['name']; ?></h6>
								<p class="mt-3 mb-3">Describe: <?php echo $row['description']; ?></p>
								<p class="mt-3 mb-3">Category: <?php echo $row['categories_name']; ?></p>
							</div>
						</a>
					</div>
				</div>
				<?php $d++;
			endwhile; ?>
		<?php } else { ?>
			  <p>
				<td colspan="7" scope="row">There are no record!</td>
			  </p>
		<?php }  ?>
    </div>
	<div class="row mb-5">
		<div class="col-sm-12 col-md-5">
			<p class="">Show <?php echo $c=isset($_GET['page'])?($_GET['page']-1)*12+1:1 ; ?> to <?php echo $c+$d-1 ?> of <?php echo $e ?> products</p>
		</div>
		<div class="col-sm-12 col-md-7">
			<nav aria-label="Page navigation example">
				<ul class="pagination jt-end">
					<li class="page-item"><a class="page-link" href="<?php echo html_helpers::url(array('ctl'=>'menu','params'=>array('page'=>(isset($_GET['page'])?$_GET['page']-1:'')))).($id=(isset($_GET['category_id']))?'&category_id='.$_GET['category_id']:'') ;?>">Previous</a></li>
						<?php for($i=1;$i<=$numPage;$i++){
							echo '<li class="page-item"><a class="page-link" href="'.html_helpers::url(array('ctl'=>'menu','params'=>array('page'=>$i))).($id=(isset($_GET['category_id']))?'&id='.$_GET['category_id']:'').'">'.$i.'</a></li>';
						} ?>
					<li class="page-item"><a class="page-link" href="<?php echo html_helpers::url(array('ctl'=>'menu','params'=>array('page'=>(isset($_GET['page'])?$_GET['page']+1:'2')))).($id=(isset($_GET['category_id']))?'&category_id='.$_GET['category_id']:'') ;?>">Next</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="cart"><a class="btn btn-danger" href="<?php echo html_helpers::url(['ctl'=>'menu','act'=>'cart']); ?>"><i class="fa-sharp fa-solid fa-cart-shopping"></i><span> Show Cart</span></a></div>
<?php include_once 'views/layout/' . $this->layout . 'footer.php';?>
