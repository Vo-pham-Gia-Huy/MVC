<?php
class main_controller
{
    protected $layout = "";
    protected $model;
    protected $controller = "home";
    protected $action = "index";
    public $components;
    //protected $htmlhp;

    public function __construct()
    {
        global $cn, $app;
        $this->controller = $cn;
        $app['ctl'] = $this->controller;
        if (isset($_GET["act"])) {
            $this->action = $_GET["act"];
        }

        $app['act'] = $this->action;

        if (method_exists($this, $this->action)) {
            if (count($_GET) > 2) {
                // This build for CRUD
                if ($this->action == 'changePass' || $this->action == 'logout' || $this->action == 'view' || $this->action == 'register' || $this->action == 'login' || $this->action == 'edit' || $this->action == 'del' || $this->action == 'addAjax' || $this->action == 'moveAjax' || $this->action == 'deleteAjax' || $this->action == 'editAjax' || $this->action == 'getCategories' || $this->action == 'cart') {
                    $id = '';
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                    $this->{$this->action}($id);
                } else {
                    $params = array_slice($_GET, 2, count($_GET));
                    $this->{$this->action}($params);
                }
            } else {
                $this->{$this->action}();
            }

        } else {
            include "views/staticpages/error.php";
        }
    }
    public function pathToID($path)
    {
        $pathArray = explode('.', $path);
        $id = $pathArray[count($pathArray) - 1];
        return $id;
    }
    public function display($options = null)
    {
        if (!isset($options['ctl'])) {
            $options['ctl'] = $this->controller;
        }

        if (!isset($options['act'])) {
            $options['act'] = $this->action;
        }

        include_once "views/" . $options['ctl'] . "/" . $options['act'] . ".php";
    }

    public function setProperty($name, $value)
    {
        $this->$name = $value;
    }
}
