<?php
namespace AGENCE_VOYAGE\LIBS;

class UrlHandler{

    private $_controller;
    private $_action;
    private $_params;
    
    function __construct(){
        $this->_parseUrl();
    }
    private function _parseUrl(){
    
    $url = explode("/",trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),"/"),3);

    if (!empty($url[0]))
        $this->_controller = $url[0];
    else 
        $this->_controller = "index";
    if (!empty($url[1]))
        $this->_action = $url[1];
    else
        $this->_action = "default";
    if (!empty($url[2]))
        $this->_params = explode("/",$url[2]);
    else
        $this->_params = "";
    }
    
    public function dispatch(){
        $controllerClassName = CONTROLLERS_NAMESPACE . ucfirst($this->_controller) ."Controller";
        $actionName = $this->_action . "Action";
        
        if(!class_exists($controllerClassName))
            $controllerClassName = CONTROLLERS_NAMESPACE . NOT_FOUND_CONTROLLER;
        
        $controller = new $controllerClassName();
        
        if(!method_exists($controller,$actionName))
            $this->_action = $actionName = NOT_FOUND_ACTION;
        
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        
        $controller->$actionName();

    }
}
?>