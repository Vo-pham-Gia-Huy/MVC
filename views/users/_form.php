<?php 
$params = (isset($this->record))? array('id'=>$this->record['id']):'';
?>
<form method="post" enctype="multipart/form-data" action="<?php echo html_helpers::url(
		array('ctl'=>'users', 
			  'act'=>$this->action, 
			  'params'=>$params
)); ?>">
  <div class="row mb-3">
    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][username]" type="text" class="form-control" id="username" placeholder="Nick name" <?php echo (isset($this->record))? "value='".$this->record['username']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][email]" type="text" class="form-control" id="email" placeholder="Email" <?php echo (isset($this->record))? "value='".$this->record['email']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="address" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][address]" type="text" class="form-control" id="address" placeholder="address" <?php echo (isset($this->record))? "value='".$this->record['address']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][facebook]" type="text" class="form-control" id="facebook" placeholder="Facebook" <?php echo (isset($this->record))? "value='".$this->record['facebook']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input name="data[<?php echo $this->controller; ?>][password]" type="password" class="form-control" id="password" placeholder="Password" <?php echo (isset($this->record))? "value='".$this->record['password']."'":""; ?>>
    </div>
  </div>
  <div class="row mb-3">
    <label for="photo" class="col-sm-2 col-form-label">Photo</label>
    <div class="col-sm-10 image-upload">
      <input name="image" type="file" class="form-control" id="photo" placeholder="photo">
	  <?php if (isset($this->record)): ?>
		<img src="<?php echo "media/upload/" .$this->controller.'/'.$this->record['photo']; ?>" alt="<?php echo $this->record['username']; ?>" class="img-thumbnail">
	  <?php endif; ?>
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
