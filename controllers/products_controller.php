<?php
class products_controller extends main_controller
{
    //public $components = array('SimpleImage');

    public function index()
    {
        $products = product_model::getInstance();
        $conditions=['conditions' => null,'limit' => null];
        $page = (isset($_GET['page']))? $page=$_GET['page'] : 1;
        if(isset($_GET['category_id'])){
            $array=explode(',',$_GET['category_id']);
            $i=0;
            foreach($array as $v){
                if($i){
                    $conditions['conditions'].= ' or ';
                }
                $conditions['conditions'].='categorie_id='.$v;
                $i++;
            }
        }
        $conditions['limit'].=' limit '.strval(5*($page-1)).',5';
        $this->numRows= $products->getNumRows($conditions);
        $this->records = $products->getAllRecordsHasRelated('*',$conditions);
        //$this->setProperty('records',$records);
        $this->display();
    }

    public function add()
    {
        // $productData = $_POST['data']['categories'];
        // // print_r($productData);
        // // print_r($_FILES);
        // $productData['categorie_id'] = $this->pathToId($_POST['category']);
        // $response = '';
        // $productData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
        // $product = product_model::getInstance();
        // if ($product->addRecord($productData)) {
        //     $response = 'success';
        // } else {
        //     $response = 'error';
        // }
        // echo $response;
        // exit;
        if(isset($_POST['btn_submit'])) {
            $productData = $_POST['data'][$this->controller];
            if(!empty($productData['name']))  {
                $productData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
                $product = product_model::getInstance();
                if($product->addRecord($productData))
                    header( "Location: ".html_helpers::url(array('ctl'=>'products')));
            }
        }
        $this->display();
    }

    public function edit($id)
    {
        $product = product_model::getInstance();
        $record = $product->getRecord($id);
        $this->setProperty('record', $record);
        if (isset($_POST['btn_submit'])) {
            $productData = $_POST['data'][$this->controller];
            if (!empty($productData['name'])) {
                if (isset($_FILES) and $_FILES["image"]["name"]) {
                    if (file_exists(UploadREL . $this->controller . '/' . $record['photo'])) {
                        unlink(UploadREL . $this->controller . '/' . $record['photo']);
                    }

                    $productData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
                }
                if ($product->editRecord($id, $productData)) {
                    header("Location: " . html_helpers::url(array('ctl' => 'products')));
                }

            }
        }
        $this->display();
    }

    public function view($id)
    {
        $product = product_model::getInstance();
        $record = $product->getRecordHasRelated($id);
        $this->setProperty('record', $record);
        $this->display();
    }

    public function del($id)
    {
        $product = product_model::getInstance();
        $record = $product->getRecord($id);
        if ($record['photo'] == '') {
            if (file_exists(RootURI . "media/upload/" . $this->controller . '/' . $record['photo'])) {
				unlink(RootURI . "/media/upload/" . $this->controller . '/' . $record['photo']);
			}
        }
        $product->delRecord($id);
        exit();
        //$product->delRecord($id);
        //header( "Location: ".html_helpers::url(array('ctl'=>'products')));
    }
}
