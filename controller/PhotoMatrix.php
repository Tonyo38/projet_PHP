<?php
	require_once("lib/data.php");
	require_once("model/imageDAO.php");
	
	class PhotoMatrix {

		function __construct(){
			$this->imgDAO = new ImageDAO();
		}

		protected function getParam() {

			global $size,$imgID,$nb;
			if (isset($_GET["imgID"])) {
				$imgID = $_GET["imgID"];
			} else {
				$imgID = 1;
			}

			if (isset($_GET["nb"])) {
				$nb = $_GET["nb"];
			} else {
				$nb = 2;
			}


			// Recupere la taille de l'image
			if (isset($_GET["size"])) {
				$size = $_GET["size"];
			} else {
				$size = "320";
			}
		}


		function first(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$img=$this->imgDAO->getImage($imgID);
			$data->imgID=$imgID;

			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			$data->size=$size;
			$data->nb=$nb;
			$nb=$nb*2;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&size=$size&nb=$data->nb";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID"; 
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";   
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function next(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$nextId = $imgID + $nb;
			$img=$this->imgDAO->getImage($nextId);
			$data->imgID=$nextId;

			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			$data->size=$size;
			$data->nb=$nb;
			$nb=$nb*2;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID"; 
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";   
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function prev(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$prevId = $imgID - $nb;
			if($prevId<=0) $prevId=1;
			$img=$this->imgDAO->getImage($prevId);
			$data->imgID=$prevId;

			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			$data->size=$size;
			$data->nb=$nb;
			$nb=$nb*2;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID"; 
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";   
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

		function random(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$img=$this->imgDAO->getRandomImage();
			$data->imgID=$img->getId();

			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			$data->size=$size;
			$data->nb=$nb;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID"; 
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";   
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function zoomPlus(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$img=$this->imgDAO->getImage($imgID);
			$data->imgID=$imgID;
			$data->nb=$nb;
			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			# Adapte la taille des images au nombre d'images présentes
			$size = $size+60;
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID";
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function zoomMoins(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$img=$this->imgDAO->getImage($imgID);
			$data->imgID=$imgID;
			$data->nb=$nb;
			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			# Adapte la taille des images au nombre d'images présentes
			$size = $size-60;
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID";
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function more(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$img=$this->imgDAO->getImage($imgID);
			$data->imgID=$imgID;
			# Calcul la liste des images à afficher
			$nb=$nb*2;
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			$data->nb=$nb;
			
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			# Adapte la taille des images au nombre d'images présentes
			$size = 320 / sqrt(count($data->imgMatrixURL));
			$data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=photoMatrix&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=photoMatrix&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID";
			$data->menu['Less']="index.php?controller=photoMatrix&action=less&nb=$data->nb&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=photoMatrix&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=photoMatrix&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

		}

		function less(){
			global $size,$nb,$imgID;
			$data = new Data();
			$this->getParam();
			$img=$this->imgDAO->getImage($imgID);
			$data->imgID=$imgID;
			$data->img = $img;			
			$data->commentaire = $data->img->getCom();
			$data->cathegorie = $data->img->getCat();

			if($nb>1) {
				$nb=$nb/2;
				$controller = "photoMatrix";
				$action = "less";
			}
			else {
				$nb=1;
				$controller = "photo";
				$action = "solo";


			}
			$data->nb=$nb;
			# Calcul la liste des images à afficher
			$imgLst= $this->imgDAO->getImageList($img,$nb);
			# Transforme cette liste en liste de couples (tableau a deux valeurs)
			# contenant l'URL de l'image et l'URL de l'action sur cette image
			foreach ($imgLst as $i) {
				# l'identifiant de cette image $i
				$iId=$i->getId();
				$data->imgMatrixURL[] = array($i->getURL(),"index.php?controller=photo&action=solo&imgID=$iId");
			}
			# Adapte la taille des images au nombre d'images présentes
			$size = 320 / sqrt(count($data->imgMatrixURL));
			if($nb==1) $data->size=40;
			else $data->size=$size;
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=photo&action=first&size=40";
			$data->menu['First']="index.php?controller=$controller&action=first&nb=$data->nb&size=$size";
			$data->menu['Random']="index.php?controller=$controller&action=random&nb=$data->nb&size=$size";
			# Pour afficher plus d'image passe à une autre page
			$data->menu['More']="index.php?controller=photoMatrix&action=more&nb=$data->nb&imgID=$data->imgID";
			$data->menu['Less']="index.php?controller=$controller&action=$action&nb=$data->nb&imgID=$data->imgID";    
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom +']="index.php?controller=$controller&action=zoomPlus&nb=$data->nb&size=$size&imgID=$data->imgID";
			// Demande à calculer un zoom sur l'image
			$data->menu['Zoom -']="index.php?controller=$controller&action=zoomMoins&nb=$data->nb&size=$size&imgID=$data->imgID"; 

			if($nb==1)
				$data->content = "view/photoView.php";
			else
				$data->content = "view/photoMatrixView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");

			
		}
	}
?>