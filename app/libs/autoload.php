<?php
namespace AGENCE_VOYAGE\LIBS;

class AutoLoad{
    public static function autoload($classname){
        // ONLY for debug . REMOVE on production:
        //echo $classname ."<br />";
        
        $classname = str_replace("AGENCE_VOYAGE","",$classname);
        
        $classname = strtolower($classname);
        
        $classname = str_replace("\\","/",$classname);
        
        $classname = APP_PATH . $classname . ".php";
        
        //echo $classname;
        
        if(file_exists($classname))
            require_once $classname;
    }
}
spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');
