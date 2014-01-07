<?php
	require_once("lib/data.php");
	require_once("model/imageDAO.php");
	class Photo {
		
		function __construct(){
			$this->imgDAO = new ImageDAO();

		}
		// Recupere les parametres de manière globale
		// Pour toutes les actions de ce contrôleur
		protected function getParam() {

			global $size,$imgID,$category;
			if (isset($_GET["imgID"])) {
				$imgID = $_GET["imgID"];
			} else {
				$imgID = 1;
			}

			if (isset($_GET["cathegorie"])) {
				$category = $_GET["cathegorie"];
			} else {
				$category= "All";
			}


			// Recupere la taille de l'image
			if (isset($_GET["size"])) {
				$size = $_GET["size"];
			} else {
				$size = "40";
			}
		}
		
		function first(){
			global $size,$category;
			$data = new Data();
			# On récupère toutes les cathégories
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$img=$this->imgDAO->getFirstImage();
			$data->img=$img;
			$data->commentaire = $img->getCom();
			$data->cathegorie = $img->getCat();
			$data->imgID=$img->getId();
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 
			
			# On affiche la bonne vue en fonction du mode dans lequel on ce trouve
			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function next(){
			global $size,$imgID,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$data->img=$this->imgDAO->getNextImage($this->imgDAO->getImage($imgID));
			$data->imgID=$data->img->getId();
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 

			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";;
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

		function prev(){
			global $size,$imgID,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			if($imgID<=1){
				$data->img=$this->imgDAO->getImage($imgID);
			} else {
				$data->img=$this->imgDAO->getPrevImage($this->imgDAO->getImage($imgID));
			}
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->imgID=$data->img->getId();
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 

			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

		function random(){

			global $size,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$data->img=$this->imgDAO->getRandomImage();
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->imgID=$data->img->getId();
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 

			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

		function zoomPlus(){
			global $size,$imgID,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$data->img=$this->imgDAO->getImage($imgID);
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->imgID=$data->img->getId();
			$size = $size +2;
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 
			
			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function zoomMoins(){
			global $size,$imgID,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$data->img=$this->imgDAO->getImage($imgID);
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->imgID=$data->img->getId();
			$size = $size - 2;
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 

			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

		function solo(){
			global $size,$imgID,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$data->img=$this->imgDAO->getImage($imgID);
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->imgID=$data->img->getId();
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 

			if(isset($_GET['edit']))
				$data->content = "view/photoViewEdit.php";
			else
				$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function modif(){
			# Si le boutton retouur n'est pas appuyé on fait la mise a jour sinon on la fait pas
			if(!isset($_GET['retour']))
				if($_GET['newcathegorie'] != "") # si le champs nouvelle cathégorie n'est pas vide on prend sa valeur
					$this->imgDAO->modifImg($_GET['imgID'],$_GET['newcathegorie'],$_GET['commentaire']);
				else
					$this->imgDAO->modifImg($_GET['imgID'],$_GET['cathegorie'],$_GET['commentaire']);

			global $size,$imgID,$category;
			$data = new Data();
			$data->listCathegorie = $this->imgDAO->getListCathegorie();	
			$this->getParam();
			$data->img=$this->imgDAO->getImage($imgID);
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();
			$data->imgID=$data->img->getId();
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=$size";
			$data->menu['First']="index.php?controller=photo&action=first&size=$size";
			$data->menu['Random']="index.php?controller=photo&action=random&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=first&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photo&action=zoomPlus&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photo&action=zoomMoins&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

	}
?>