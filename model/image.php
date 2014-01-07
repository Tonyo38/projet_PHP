<?php
  
  # Notion d'image
  class Image {
    private $url=""; 
    private $id=0;
    private $com="";
    private $cat="";
    
    function __construct($u,$id,$com,$cat) {
      $this->url = $u;
      $this->id = $id;
      $this->com = $com;
      $this->cat = $cat;
    }
    
    # Retourne l'URL de cette image
    function getURL() {
		return $this->url;
    }
    function getId() {
      return $this->id;
    }
    function getCom(){
      return $this->com;
    }
    function getCat(){
      return $this->cat;
    }
  }
  
  
?>