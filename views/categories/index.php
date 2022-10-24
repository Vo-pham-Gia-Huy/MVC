<?php
global $mediaFiles;
array_push($mediaFiles['css'], RootREL . 'media/fontawesome/css/all.css');
array_push($mediaFiles['css'], RootREL . 'media/jstree/css/style.min.css');
?>

<?php include_once 'views/layout/' . $this->layout . 'header.php';?>
<div class="relative">
	<div class="row row-offcanvas row-offcanvas-right pt-5">
		<?php $categories = [];
		$cate = [];
		while ($row = mysqli_fetch_array($this->records, MYSQLI_ASSOC)) {
			$arr = explode(".", $row['path']);
			if (count($arr) == 1) {
				array_push($cate, $row);
			}
			array_push($categories, $row);
		}
		$tree = array();
		foreach ($categories as $row1) {
			html_helpers::Tree($row1, $tree);
		}
		// echo '<pre>';
		// print_r($tree);
		// echo '</pre>';
		?>

		<div id="treeview_div" class="well" style='width:40%!important'>
			<?php print_r(html_helpers::treeview($tree));?>
		</div>
		<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" >
			<div class="row" width="100%">
				<div class="col-md-4 col-sm-8 col-xs-8 " style="width:50%">
					<button type="button" class="btn btn-success btn-sm m-1 create" ><i class="glyphicon glyphicon-asterisk"></i> Create category </button>
					<button type="button" class="btn btn-warning btn-sm m-1 rename" ><i class="glyphicon glyphicon-pencil"></i> Rename</button>
					<button type="button" class="btn btn-danger btn-sm m-1 delete" ><i class="glyphicon glyphicon-remove"></i> Delete</button><br>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-4" style="text-align:right;">
					<input type="text" value="" style="box-shadow:inset 0 0 4px #eee; width:120px; margin:0; padding:6px 12px; border-radius:4px; border:1px solid silver; font-size:1.1em;" id="demo_q" placeholder="Search" />
				</div>
			</div>
		</div>
	</div>
</div>
<?php array_push($mediaFiles['js'], RootREL . "media/js/jquery.min.js");?>
<?php array_push($mediaFiles['js'], RootREL . "media/jstree/js/jstree.min.js");?>
<?php array_push($mediaFiles['js'], RootREL . "media/js/sidebar.treeview.js");?>
<?php array_push($mediaFiles['js'], RootREL . "media/js/categories.js");?>
<?php include_once 'views/layout/' . $this->layout . 'footer.php';?>
