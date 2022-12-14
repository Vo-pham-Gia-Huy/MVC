<?php 
$params = (isset($this->record))? array('id'=>$this->record['id']):'';
?>
<form method="post" enctype="multipart/form-data" action="<?php echo html_helpers::url(
		array('ctl'=>'products', 
			  'act'=>$this->action, 
			  'params'=>$params
)); ?>">
  <div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][name]" type="text" class="form-control" id="name" placeholder="name" <?php echo (isset($this->record))? "value='".$this->record['name']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][description]" type="text" class="form-control" id="description" placeholder="description" <?php echo (isset($this->record))? "value='".$this->record['description']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="cost" class="col-sm-2 col-form-label">Cost</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][cost]" type="text" class="form-control" id="cost" placeholder="cost" <?php echo (isset($this->record))? "value='".$this->record['cost']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="photo" class="col-sm-2 col-form-label">Photo</label>
    <div class="col-sm-10 image-upload">
      <input name="image" type="file" class="form-control" id="photo" placeholder="photo">
	  <?php if (isset($this->record)): ?>
		<img src="<?php echo "media/upload/" .$this->controller.'/'.$this->record['photo']; ?>" alt="<?php echo $this->record['name']; ?>" class="img-thumbnail">
	  <?php endif; ?>
    </div>
  </div>
    <div class="row mb-3">
    <label for="category" class="col-sm-2 col-form-label" id="categoy">Category</label>
      <div class="col-sm-10">
        <select class="form-control" name="data[<?php echo $this->controller; ?>][categorie_id]" id="category">
          <?php $tree=[];
          $category=[];
          $categories= categorie_model::getInstance();
          $this->categoryData= $categories->getAllRecords();
            while ($row = mysqli_fetch_array($this->categoryData, MYSQLI_ASSOC)) {
                html_helpers::Tree($row, $tree);  
            }
            print_r(html_helpers::treeSelection($tree)); 
            ?>
        </select>
      </div>
    </div>
  <div class="row mb-3">
    <div class="offset-sm-2 col-sm-10">
      <button name="btn_submit" type="submit" class="btn btn-primary"><?php echo ucwords($this->action); ?></button>
    </div>
  </div>
</form>
<?php global $mediaFiles; ?>
<?php array_push($mediaFiles['js'], RootREL."media/js/jquery.min.js"); ?>
<?php array_push($mediaFiles['js'], RootREL."media/js/form.js"); ?>
