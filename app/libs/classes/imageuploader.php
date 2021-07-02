<?php
    namespace AGENCE_VOYAGE\LIBS\CLASSES;


    class ImageUploader{
        private $fullImage;
        private $name;
        private $fullName;
        private $mimtype;
        private $ext;
        private $taille;
        private $tmp_name;
        private $error;
        private $authExt = ['png' , 'jpeg' , 'jpg' , 'GIF'];
        private $authmimtype = ['image/png', 'image/jpeg', 'image/gif'];
        private $dest_path;
    
        // constructeur
        function __construct($fullImage){
            $this->fullImage = $fullImage;
            $this->name = explode('.',$fullImage["name"])[0]; // name
            $this->fullName = explode('.',$fullImage["name"]); // name + ext
            $this->mimtype = $fullImage["type"];
            $this->taille = $fullImage["size"];
            $this->tmp_name = $fullImage["tmp_name"];
            $this->error = $fullImage["error"];
            // get all ext for current file
            $arrayext =  $this->fullName;
            $this->ext = end($arrayext);
            $this->error = [];
            
            
        }
    
        // setters
    
        public function setDestPath($dest = GALLERIE_PATH){
            $this->dest_path = $dest;
        }
    
        public function setError($error){
            $this->error[] = $error;
        }
    
        public function setName($name){
            $this->name = $name;
        }
    
        // getters
    
        public function getDesPath(){
            return $this->dest_path;
        }
    
        public function getExt(){
            return $this->ext;
        }
    
        public function getAllExt(){
            $fullname = $this->fullName;
            $rev = array_reverse($fullname);
            array_pop($rev);
            return $rev;
        }
    
        public function getName(){
            return $this->name;
        }
    
        public function getType(){
            return $this->mimtype;
        }
    
        public function getTaille(){
            return $this->taille;
        }
    
        public function getErrors(){
            return $this->error;
        }
    
        public function getTmp(){
            return $this->tmp_name;
        }
    
        // chnage name function
    
        public function changeName(){
            $this->setName(substr(md5(uniqid()),22));
        }
            
        public function secureImage(){
            $valide = 0;
    
            // ext of image

            if (!in_array($this->getExt(),$this->authExt)){
                $valide -= 1;
                $this->setError("Extension non autoriser");
            }
            
            if (count($this->getAllExt()) > 1 ){
                $valide -= 1;
                $this->setError("double extension détécter");
            }
            // mimetype of image
            if (!in_array($this->mimtype,$this->authmimtype)){
                $valide -= 1;
                $this->setError("Type d'image invalide");
            }
    
            // size of image muste be at max 5 mb
            if ($this->taille > 5242880 ){
                $valide -= 1;
                $this->setError("image trop large");
            }
    
            // another test (magic byte)
            
    
            if ($valide === 0){
                // change name to random one
                $this->changeName();
    
                // place the image to right file
                $fullDest = $this->getDesPath().$this->getName().'.'.$this->getExt();
                move_uploaded_file($this->getTmp(),$fullDest);
                return $this->getErrors();

            }else{
                return $this->getErrors();
            }
    
        }
    }
?>