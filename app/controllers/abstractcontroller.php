<?php
namespace AGENCE_VOYAGE\CONTROLLERS;
/* abstract class for repeated/commun actions */
class AbstractController{
    
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_data = [];
    protected $_error = [];
    
    public function notFoundAction(){
        $this->_view();
    }
    
    public function setController($controller){
        $this->_controller = $controller;
    }
    
    public function setAction($action){
        $this->_action = $action;
    }
    
    public function setParams($params){
        $this->_params = $params;
    }
    
    protected function _view(){
        if($this->_action === NOT_FOUND_ACTION){
            require_once  VIEWS_PATH . "notfound/404.view.php";
            header("HTTP/1.0 404 Not Found");
            exit(0);
        }
        else{
            $view = VIEWS_PATH . $this->_controller . "/" . $this->_action . ".view.php";
            if (file_exists($view)){
                extract($this->_data);
                extract($this->_error);
                require_once $view;
            }
            else{
                require_once  VIEWS_PATH . "notfound/404.view.php";
                header("HTTP/1.0 404 Not Found");
                exit(0);
            }
        }
    }
}
?>