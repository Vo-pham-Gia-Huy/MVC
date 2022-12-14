<?php
global $obMediaFiles;
array_push($obMediaFiles['css'], "media/css/sidebar.css");
?>

<div class="list-group">
	<a href="#" class="list-group-item active">
		<h4 class="list-group-item-heading">Management <?php echo $_GET['ctl']; ?></h4>
	</a>
	<ul id="myUL">
		<li><span class="caret list-group-item">List all <?php echo $_GET['ctl']; ?></span>
			<ul class="nested">
			<?php for ($i = 0; $i < count($cate); $i++) {
				echo '<li><a href="' . html_helpers::url(array('ctl' => $_GET['ctl'], 'cate' => $cate[$i]["path"])) . '">' . $cate[$i]["name"] . '</a></li>';
			}
			;?>
			</ul>
		</li>
	</ul>
<a href="<?php echo html_helpers::url(array('ctl' => $_GET['ctl'], 'act' => 'add')); ?>" class="list-group-item">Add new <?php echo rtrim($_GET['ctl'], 's'); ?></a>
<a href="<?php echo html_helpers::url(array('ctl' => $_GET['ctl'])); ?>" class="list-group-item">Show all <?php echo rtrim($_GET['ctl'], 's'); ?></a>
</div>
