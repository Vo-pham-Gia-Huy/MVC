<?php
global $mediaFiles;
array_push($mediaFiles['css'], RootREL.'media/fontawesome/css/all.css');
?>
<?php include_once 'views/layout/'.$this->layout.'header.php';?>
<?php $numPage=ceil(mysqli_fetch_row($this->numRows)[0]/5);?>
<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-9">
	<div class="table-responsive">
	  <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>name</th>
			<th>category</th>
            <th>photo</th>
			<th>action</th>
          </tr>
        </thead>
        <tbody>
        <?php if($this->records) { ?>
			<?php while($row = mysqli_fetch_array($this->records)) : ?>
			  <tr>
				<td width="5%" scope="row"><?php echo $row['id']; ?></td>
				<td width="12%"><?php echo $row['name']; ?></td>
				<td width="30%"><?php echo $row['categories_name']; ?></td>
				<td width="15%"><img src="<?php echo "media/upload/" .$this->controller.'/'.$row['photo']; ?>" alt="<?php echo $row['name']; ?>" class="img-thumbnail"></td>
				<td width="15%">
				  <a class="btn btn-outline-info table-link" role="button" href="<?php echo html_helpers::url(
								['ctl'=>'products', 
									  'act'=>'view', 
									  'params'=>array(
										'id'=>$row['id']
										)
								]); ?>">
					<i class="fa fa-eye" aria-hidden="true"></i>
				  </a>
				  <a class="btn btn-outline-warning" role="button" href="<?php echo html_helpers::url(
								array('ctl'=>'products', 
									  'act'=>'edit', 
									  'params'=>array(
										'id'=>$row['id']
								))); ?>">
					<i class="fas fa-edit"></i>
				  </a>
				  <a class="btn btn-outline-danger table-link danger delete" role="button" href="<?php echo html_helpers::url(
								array('ctl'=>'products', 
									  'act'=>'del', 
									  'params'=>array(
										'id'=>$row['id']
								))); ?>" >
					<i class="fas fa-trash"></i>
				  </a>
				</td>
			  </tr>
			<?php endwhile; ?>
		<?php } else { ?>
			  <tr>
				<td colspan="7" scope="row">There are no record!</td>
			  </tr>
		<?php }  ?>
        </tbody>
      </table>
	  <nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item"><a class="page-link" href="<?php echo html_helpers::url(array('ctl'=>'products','params'=>array('page'=>(isset($_GET['page'])?$_GET['page']-1:'')))).($id=(isset($_GET['category_id']))?'&category_id='.$_GET['category_id']:'') ;?>">Previous</a></li>
				<?php for($i=1;$i<=$numPage;$i++){
					echo '<li class="page-item"><a class="page-link" href="'.html_helpers::url(array('ctl'=>'products','params'=>array('page'=>$i))).($id=(isset($_GET['category_id']))?'&category_id='.$_GET['category_id']:'').'">'.$i.'</a></li>';
				} ?>
			<li class="page-item"><a class="page-link" href="<?php echo html_helpers::url(array('ctl'=>'products','params'=>array('page'=>(isset($_GET['page'])?$_GET['page']+1:'2')))).($id=(isset($_GET['category_id']))?'&category_id='.$_GET['category_id']:'') ;?>">Next</a></li>
		</ul>
	  </nav>
	</div>
  </div>
  <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	<?php include_once 'views/widgets/sidebar.php'; ?>
	<ul id="myUL" class="list-group mt-2">
		<li class="list-group-item list-group-item-info">
			<span class="caret"><a href="<?php echo html_helpers::url(array('ctl'=>'products')); ?>" >Categories</a></span>
			<?php echo html_helpers::menuW3($tree) ?>
		</li>
	</ul>	
  </div>
</div>
<?php array_push($mediaFiles['js'], RootREL."media/js/products.js"); ?>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
