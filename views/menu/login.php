<?php
global $mediaFiles;
array_push($mediaFiles['css'], "media/css/login.css");
?>

<?php include_once 'views/layout/' . $this->layout . 'header.php';?>
<div class="col-6 jumbotron d-flex flex-wrap">
	<div class="shadow p-3 mb-5 bg-body rounded w-50 mx-auto">
		<h1 class="p-3">LOGIN</h1>
		<form method="post" class="form-horizontal w-100" action="<?php echo html_helpers::url(
		array('ctl' => 'menu',
			'act' => 'login',
		)); ?>">
		<div class="form-group  w-100 p-3">
			<input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email/Phone Number/Username">
		</div>
		<div class="form-group  w-100 p-3">
			<input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
		</div>
		<?php if($this->check['0']==0 && $this->check['0']!=null){
				echo '<div class="form-group px-3 m-0 w-100"><p class="text-danger">Email or password is incorrect, please re-enter</p></div>';
			} ?>
		<div class="form-group  w-100 p-3 d-flex justify-content-between align-items-center">
			<label>
		      <input type="checkbox"> Remember me
		    </label>
			<button type="submit" name="btn_submit" class="btn btn-outline-info">Login</button>
		</div>
		</form>
		<div class="d-flex justify-content-between w-100 forgot px-3 py-2">
			<div class=""><a class="">Forgot password</a></div>
			<div class=""><a class="">Login with SMS</a></div>
		</div>
		<div class="d-flex justify-content-between w-100 align-items-center px-3 py-2"><hr class="featurette-divider hr-divider">Or<hr class="featurette-divider hr-divider"></div>
		<div class="d-flex justify-content-between w-100 px-3 py-2 link-social mb-2">
			<a class="px-3 shadow-sm p-3  bg-body rounded rounded-circle text-center"><i class="fa-brands fa-facebook"></i></a>
			<a class="px-3 shadow-sm p-3  bg-body rounded rounded-circle text-center"><i class="fa-brands fa-google"></i></a>
			<a class="px-3 shadow-sm p-3  bg-body rounded rounded-circle text-center"><i class="fa-brands fa-apple"></i></a>
		</div>
		<div class="text-center m-1"><p class="">You Have An Account ? <a class="text-decoration-underline" href="<?php echo html_helpers::url(array('ctl'=>'menu','act'=>'register'));?>">Register</a></p></div>
	</div>
</div>
<?php include_once 'views/layout/' . $this->layout . 'footer.php';?>
