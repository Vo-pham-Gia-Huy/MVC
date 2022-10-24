<?php
class users_controller extends main_controller
{
	//public $components = array('SimpleImage');
	public function index() 
	{
		$users = user_model::getInstance();
        $users->createTable();
		$this->records = $users->getAllRecords();
		
		//$this->setProperty('records',$records);
		
		$this->display();
	} 

	public function add() 
	{
		if(isset($_POST['btn_submit'])) {
			$userData = $_POST['data'][$this->controller];
			if(!empty($userData['email']))  {
				$userData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
				$user = user_model::getInstance();
				if($user->addRecord($userData))
					header( "Location: ".html_helpers::url(array('ctl'=>'users')));
			}
		}
		$this->display();
	}

	public function edit($id) {
		$user = user_model::getInstance();
		$record = $user->getRecord($id);
		$this->setProperty('record',$record);
		if(isset($_POST['btn_submit'])) {
			$userData = $_POST['data'][$this->controller];
			if(!empty($userData['email']))  {
				if(isset($_FILES) and $_FILES["image"]["name"]) {
					if(file_exists(UploadREL .$this->controller.'/'.$record['photo']))
						unlink(UploadREL .$this->controller.'/'.$record['photo']);
					$userData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
				}
				if($user->editRecord($id, $userData))
					header( "Location: ".html_helpers::url(array('ctl'=>'users')));
			}
		}
		$this->display();
	}
	
	public function view($id) 
	{
		$user = user_model::getInstance();
		$record = $user->getRecord($id);
		$this->setProperty('record',$record);
		$this->display();
	}
	
	public function del($id) 
	{
		$user = user_model::getInstance();
		$record = $user->getRecord($id);
		if(file_exists(RootURI."/media/upload/" .$this->controller.'/'.$record['photo']))
			unlink(RootURI."/media/upload/" .$this->controller.'/'.$record['photo']);
			
		echo $user->delRecord($id);
		exit();
		//$user->delRecord($id);
		//header( "Location: ".html_helpers::url(array('ctl'=>'users')));
	}
}
?>
