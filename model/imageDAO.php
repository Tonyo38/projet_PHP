<?php
	require_once("image.php");
	# Le 'Data Access Object' d'un ensemble images
	class ImageDAO {
		
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# A MODIFIER EN FONCTION DE VOTRE INSTALLATION
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# Chemin LOCAL où se trouvent les images
		private $path="model/IMG/";
		# Chemin URL où se trouvent les images
		const urlPath="http://localhost/lp/php/tp1/image/model/IMG";
		# Variable pour utiliser la base de donnée
		private $db;
		# Tableau pour stocker tous les chemins des images
		private $imgEntry;
		
		# Lecture récursive d'un répertoire d'images
		# Ce ne sont pas des objets qui sont stockes mais juste
		# des chemins vers les images.
		private function readDir($dir) {
			# build the full path using location of the image base
			$fdir=$this->path.$dir;
			if (is_dir($fdir)) {
				$d = opendir($fdir);
				while (($file = readdir($d)) !== false) {
					if (is_dir($fdir."/".$file)) {
						# This entry is a directory, just have to avoid . and .. or anything starts with '.'
						if (($file[0] != '.')) {
							# a recursive call
							$this->readDir($dir."/".$file);
						}
					} else {
						# a simple file, store it in the file list
						if (($file[0] != '.')) {
							$this->imgEntry[]="$dir/$file";
						}
					}
				}
			}
		}
		
	
		
		function __construct() {
			#$this->readDir("");
			$dsn = 'sqlite:D:\Tony\Dropbox\lp\php\tp2\image\DB\imageDB'; // Data source name 
			$user= ''; // Utilisateur 
			$pass= ''; // Mot de passe 
			try {	
				$this->db = new PDO($dsn, $user, $pass); //$db est un attribut privé d'ImageDAO 
			} 
			catch (PDOException $e) { 
				die ("Erreur : ".$e->getMessage()); 
			} 

		}
		
		# Retourne le nombre d'images référencées dans le DAO
		function size() {
			#return count($this->imgEntry);
			$s = $this->db->query('SELECT * FROM image'); 
			$res = $s->fetchAll();
			return count($res);
		}
		
		# Retourne un objet image correspondant à l'identifiant
		function getImage($imgId) {

			$s = $this->db->query('SELECT * FROM image WHERE id='.$imgId); 
			 if ($s) { 
			 	$result = $s->fetchAll();
			 	
			 	return new Image($this->path.$result[0]['path'],$imgId,$result[0]['comment'],$result[0]['category']);
			 } 
			 else { 
			 print "Error in getImage. id=".$imgId."<br/>"; 
			 $err= $this->db->errorInf;
			 die("<H1>Erreur dans ImageDAO.getImage: imgId=$imgId incorrect</H1>");
			}
		}
				# Retourne un objet image correspondant à l'identifiant et a la catégorie
		function getImageCat($imgId,$cat) {
			
				$s = $this->db->query("SELECT * FROM image WHERE category=$cat");
				if ($s) { 
				$result = $s->fetchAll();
				 	
				return new Image($this->path.$result[$imgId]['path'],$imgId,$result[$imgId]['comment'],$result[$imgId]['category']);
				 } 
				 else { 
				 print "Error in getImage. id=".$imgId."<br/>"; 
				
				 die("<H1>Erreur dans ImageDAO.getImage: imgId=$imgId incorrect</H1>");
				}
		}

		# Retourne une image au hazard
		function getRandomImage() {
			$randomImg = $this->getImage(rand(1, $this->size()));
			return 	$randomImg;	
		}
		
		# Retourne l'objet de la premiere image
		function getFirstImage() {
			return $this->getImage(1);
		}
		# Retourne l'objet de la premiere image correspondant à la cathégorie
		function getFirstImageCat($cat) {
			return $this->getImageCat(1,$cat);
		}
		
		# Retourne l'image suivante d'une image
		function getNextImage(image $img) {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
			}
			return $img;
		}
		
		# Retourne l'image précédente d'une image
		function getPrevImage(image $img) {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id-1);
			}
			return $img;
		}
		
		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(image $img,$nb) {
			$id=$img->getId();
			$id = $id + $nb;
			if($id<=$this->size() && $id>0){
				$img = $this->getImage($id);
			}
			return $img;
		}
		
		# Retourne la liste des images consécutives à partir d'une image
		function getImageList(image $img,$nb) {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			while ($id < $this->size() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}

		# Retourne la liste des cathégorie présentes dans la BDD
		function getListCathegorie() {
			
			//On récupere seulement les première occurence des catégories
			$s = $this->db->query('SELECT DISTINCT(category) FROM image');
			$res = $s->fetchAll();

			//On rempli un tableau avec les valeur récupérés
			for($i=0;$i<count($res);$i++){
				$list[$i] = $res[$i]['category'];
			}



			return $list;
		}

		function modifImg($imgId,$cat,$com){
			$s = $this->db->query("UPDATE image SET category='$cat', comment='$com' WHERE id=$imgId");
			if($s){

			} else { 
			 print "Error in update. id=".$imgId."<br/>"; 
			 $err= $this->db->errorInf;
			 die("<H1>Erreur dans ImageDAO.modifImg: imgId=$imgId incorrect</H1>");
			}
		}

	}
	
	# Test unitaire
	# Appeler le code PHP depuis le navigateur avec la variable test
	# Exemple : http://localhost/image/model/imageDAO.php?test
	if (isset($_GET["test"])) {
		echo "<H1>Test de la classe ImageDAO</H1>";
		$imgDAO = new ImageDAO();
		echo "<p>Creation de l'objet ImageDAO.</p>\n";
		echo "<p>La base contient ".$imgDAO->size()." images.</p>\n";
		$img = $imgDAO->getFirstImage();
		echo "La premiere image est : ".$img->getURL()."</p>\n";
		# Affiche l'image
		echo "<img src=\"".$img->getURL()."\"/>\n";
		# Affiche l'image suivant
		$img = $imgDAO->getNextImage($img);
		echo "<img src=\"".$img->getURL()."\"/>\n";
		# Affiche l'image précedente (donc la premiere)
		echo "<img src=\"".$imgDAO->getPrevImage($img)->getURL()."\"/>\n";
		
		# Affiche l'image 5 
		echo "<img src=\"".$imgDAO->jumpToImage($img,4)->getURL()."\"/>\n";
		
		# Affiche l'image aléatoire
		echo "<img src=\"".$imgDAO->getRandomImage()->getURL()."\"/>\n";
	}
	
	
	?>
