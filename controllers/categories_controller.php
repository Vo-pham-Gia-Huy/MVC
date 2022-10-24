<?php
class categories_controller extends main_controller
{
    //public $components = array('SimpleImage');
    public function index()
    {
        $categories = categorie_model::getInstance();
        $this->records = $categories->getAllRecords();
        //$this->setProperty('records',$records);
        $this->display();
    }
    public function getTree()
    {

    }
    public function add()
    {
        if (isset($_POST['btn_submit'])) {
            $categorieData = $_POST['data'][$this->controller];
            if (!empty($categorieData['name'])) {
                $categorieData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
                $categorie = categorie_model::getInstance();
                if ($categorie->addRecord($categorieData)) {
                    header("Location: " . html_helpers::url(array('ctl' => 'categories')));
                }

            }
        }
        $this->display();
    }
    
    // public function getAjax()
    // {
    //     $categorie = categorie_model::getInstance();
    //     echo $categorie->last_id;
    // }
    public function deleteAjax()
    {
        $respondData = ['status' => 'success', 'data' => ''];
        if (!empty($_POST)) {
            $id = array($this->pathToID($_POST['path']));
            if (isset($_POST['child'])) {
                foreach ($_POST['child'] as $v) {
                    array_push($id, $this->pathToId($v));
                }
            }
            $categorie = categorie_model::getInstance();
            $condition = '';
            $i = 0;
            foreach ($id as $v) {
                if ($i) {
                    $condition .= ' OR';
                }
                $condition .= " id = '$v'";
                $i++;
            }
            if (!$categorie->delRecord($id, $condition)) {
                $respondData['status'] = 'error';
            }
        }
        // $respondData = ['status' => 'success', 'data' => ''];
        // $id = array_pop(explode('.', $_POST['path']));
        // if (!empty($_POST['path'])) {
        //     $categorie = categorie_model::getInstance();
        //     if ($categorie->delRecord($id)) {
        //         $respondData['status'] = 'error';
        //     }
        // }
        echo json_encode($respondData);
        exit();
    }
    public function moveAjax()
    {
        $respondData = ['status' => 'success', 'data' => ''];
        $id = [];
        if ($_POST['parent'] == '#') {
            $id['parent'] = '';
        } else {
            $id['parent'] = $_POST['parent'] . ".";
        }
        $id['id'] = $this->pathToID($_POST['id']);
        if (isset($_POST['children'])) {
            foreach ($_POST['children'] as $v) {
                $id['children'][] = array(substr($v, strpos($v, $id['id'])), $this->pathToID($v));
            }
        }
        $categorie = categorie_model::getInstance();
        if (!$categorie->moveRecord($id)) {
            $respondData['status'] = 'error';
        }
        echo json_encode($respondData);
        exit();
    }
    public function editAjax()
    {
        $respondData = ['status' => 'success', 'data' => ''];
        $path = explode('.', $_POST['id']);
        $categorieData = ['name' => $_POST['name']];
        if (!empty($categorieData)) {
            $categorie = categorie_model::getInstance();
            if (!$categorie->editRecord(array_pop($path), $categorieData)) {
                $respondData['status'] = 'error';
            }
        }

        echo json_encode($respondData);
        exit();
    }
    public function addAjax()
    {
        $respondData = ['status' => 'success', 'data' => ''];
        $categorieData['path'] = $_POST['parent'];
        $categorieData['name'] = $_POST['name'];
        if (!empty($categorieData)) {
            $categorie = categorie_model::getInstance();
            $respondData['data'] = $categorie->addRecord($categorieData);
        }
        echo json_encode($respondData);
        exit();
    }
    public function getCategories(){
        // print_r($_POST);
        $categorie = categorie_model::getInstance();
        $Data=$categorie->getAllRecords('path');
        $result=[];
        while ($row = mysqli_fetch_array($Data, MYSQLI_ASSOC)) {
            if(str_contains($row['path'],$_POST['value'])){
                array_push($result,$this->pathToID($row['path']));
            }
        }
        print_r($result);
        exit();
    }
    public function edit($id)
    {
        $categorie = categorie_model::getInstance();
        $record = $categorie->getRecord($id);
        $this->setProperty('record', $record);
        if (isset($_POST['btn_submit'])) {
            $categorieData = $_POST['data'][$this->controller];
            if (!empty($categorieData['name'])) {
                if (isset($_FILES) and $_FILES["image"]["name"]) {
                    if (file_exists(UploadREL . $this->controller . '/' . $record['photo'])) {
                        unlink(UploadREL . $this->controller . '/' . $record['photo']);
                    }
                    $categorieData['photo'] = SimpleImage_Component::uploadImg($_FILES, $this->controller);
                }
                if ($categorie->editRecord($id, $categorieData)) {
                    header("Location: " . html_helpers::url(array('ctl' => 'categories')));
                }

            }
        }
        $this->display();
    }

    public function view($id)
    {
        $categorie = categorie_model::getInstance();
        $record = $categorie->getRecord($id);
        $this->setProperty('record', $record);
        $this->display();
    }

    public function del($id)
    {
        $categorie = categorie_model::getInstance();
        $record = $categorie->getRecord($id);
        if (file_exists(RootURI . "/media/upload/" . $this->controller . '/' . $record['photo'])) {
            unlink(RootURI . "/media/upload/" . $this->controller . '/' . $record['photo']);
        }

        echo $categorie->delRecord($id);
        exit();
        //$categorie->delRecord($id);
        //header( "Location: ".html_helpers::url(array('ctl'=>'categories')));
    }
}
