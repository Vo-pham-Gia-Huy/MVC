<?php session_start();?>
<?php
class contact_controller extends main_controller
{
	public function index() 
	{
		print_r($_SESSION);
		$this->display();
	}
	public function add(){
		if(isset($_POST['btn_submit'])){
			$_SESSION['login']['status']='login';
		}
		header( "Location: ".html_helpers::url(array('ctl'=>'menu')));
	}
}
?>
