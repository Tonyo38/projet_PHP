<?php
	
	require_once("lib/data.php");
	class Home {

		// LISTE DES ACTIONS DE CE CONTROLEUR
		
		// Action par défaut
		function index() {
			$data = new Data();
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=Home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=Photo&action=first";

			$data->content = "view/homeView.php";
			// Selectionne et charge la vue
			require_once("view/mainView.php");
		}

		function apropos(){
			$data = new Data();
			$data->menu['Home'] = "index.php";
			$data->menu['A propos'] = "index.php?controller=Home&action=apropos";
			$data->menu['Voir photos'] = "index.php?controller=Photo&action=first";

			$data->content = "view/aproposView.php";
			// Selectionne et charge la vue
			require_once("view/aproposView.php");
		}
		
	}
?>