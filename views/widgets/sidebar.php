<?php 
	global $obMediaFiles;
	array_push($obMediaFiles['css'], "media/css/sidebar.css");
?>
<div class="list-group">
	<a href="#" class="list-group-item active">
		<h4 class="list-group-item-heading">Management <?php echo $_GET['ctl'];?></h4>
	</a>
	<a href="<?php echo html_helpers::url(array('ctl'=>$_GET['ctl'])); ?>" class="list-group-item">List all <?php echo $_GET['ctl'];?></a>
	<a href="<?php echo html_helpers::url(array('ctl'=>$_GET['ctl'], 'act'=>'add')); ?>" class="list-group-item">Add new <?php echo rtrim($_GET['ctl'],'s');?></a>
</div>
